<?php

    include_once "connectdb.php";
    include_once "errors.php";

    /*$dsn = 'mysql:host=localhost;dbname=bugme';
    $username = 'admin';
    $password = 'admin';

    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/

/*$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$password = $_POST["password"];*/

    //initialize variables
    $firstname = "";
    $lastname = "";
    $password = "";
    $email = "";

    //get data from form
    if($_SERVER["REQUEST_METHOD"] == "post"){
        $firstname = validate($_POST["firstname"]);
        $lastname = validate($_POST["lastname"]);
        /*$password = validate($_POST["password"]);*/
        $email = validate($_POST["email"]);
        $password = regexcheck($_POST["password"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    }

    //connect to database
    $conn = connectdb();
    $stmt =$conn->exec("INSERT INTO User(firstname, lastname, password, email) 
    VALUES('$firstname', '$lastname', '$password', '$email')");
    /*$stmt->bind_param("ssss", $firstname, $lastname, $password, $email);
    $stmt->execute();*/
    echo("Successful registration!");

    //remove unwanted spaces and escaping
    function validate($input){
        $input = trim($input);
        $input = stripslashes($input);
        $input = filter_var($input, FILTER_SANITIZE_STRING);
    }

    //regular expression check for characters in password
    function regexcheck($input){
        if(!preg_match('^(?=.+[A-Z])(?=.+\d)[a-z]{8,}$', $input)){
            echo(errMsg("newUserErr"));
        }
    }

?>