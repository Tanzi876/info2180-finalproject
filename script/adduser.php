<?php

    session_start();

    include_once "connectdb.php";
    include_once "errors.php";
    $conn = connectdb();

    //initialize variables
    $firstname = validate($_POST['firstname']);
    $lastname = validate($_POST['lastname']);
    $cTextPW = $_POST['password'];
    $_SESSION['password'] = $cTextPW;
    $password = validatePW($cTextPW)?myHash_PWD($cTextPW):"";
    $email = validateEmail($_POST['email'])?$email:"";
    $_SESSION['email'] = $email;

    addUser($connx,$firstname,$lastname,$password,$email,$cTextPW);

    function addUser($cx, $fn, $ln, $pw, $em, $ct){
        if(!($pw=="" || $em=="")){
            $stmt =$cx->prepare("INSERT INTO User(firstname, lastname, password, email) 
            VALUES(:firstname,:lastname,:password,:email)");
            $pdoExec = $stmt->execute(array(':firstname'=>$fn, ':lastname'=>$ln, ':password'=>$pw, ':email'=>$em));
            loginAfterAdd($cx,$em,$ct);
            if($pdoExec){
                header('Location: ../dashboard.html');
                $submitted = "Successful registration!";
                echo "<script>console.log('".$submitted."')</script>";
            }
            else{
                header('Location: ../adduser.html');
                $failed = "failed to create new User!";
                echo "<script>console.log('".$failed."')</script>";
            }
        }
        else{
            echo "<script>console.log('Invalid Password or Email Address')</script>";
        }
    }

    function findDuplicateEmail(PDO $cx, $input){
        $stmt = $cx->query("select count(*) from user where email=".$input)->fetch();
        if($stmt>0){
            $bool=false;
        }
        return $bool;
    }
    

    //remove unwanted spaces and escaping
    function validate($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);
        return $input;
    }

    function validateEmail($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = filter_var($input, FILTER_SANITIZE_EMAIL);
        return $input;
    }

    function validatePW($input){
        $bool = false;
        $pass = "Success!";
        $fail = "Password must contain at least eight characters, 
        at least one number, lower 
        and uppercase letters and special characters";
        $input = filter_var($input, FILTER_SANITIZE_STRING);
        if(preg_match('^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$', $input)){
            $bool = true;
            header('Location: ../dashboard.html');
            echo "<script>alert(".$pass.")</script>";
        }
        else{
            header('Location: ../dashboard.html');
            echo "<script>alert(".$fail.")</script>";
        }
        return $bool;
    }

?>