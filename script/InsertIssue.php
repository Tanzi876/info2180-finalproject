<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

session_start();


try{
    $bool = true;
    include_once '../script/connectdb.php';
    $conn = connectdb();

    if(empty($_POST['query'])){
        ?>
        <?php $sql = "SELECT * FROM user";
        $listv = "";
        
        $users = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);?>
        <?php foreach ($users as $user) { 
            // DO NOT INSERT HEADER FUNCTION!!!
            $var = $user['id'];
            //$listv."{$var}";
            echo "<option value={$var}>{$var}</option>";
        }
        ?>
        
        <?php }; ?>
        
        <?php 

    //logs user out
    if(isset($_POST['logout'])){
        // remove all session variables
        session_unset();

        // destroy the session
        //session_destroy();
    }
    
    if(!isset($_POST['submit']) && empty($_GET['query'])){
        //header('Location: ../InserIssue.html');
        // echo "<script>";
        // get values form input text and number
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $priority = $_POST['priority'];
        $assigned_to = $_POST['assigned_to'];

        $arr = [$title,$description,$type,$priority,$assigned_to];
        foreach ($arr as $input) {
            if(empty($input)){
                $bool = false;
            }
        }

        if($bool){
            $status = 'Open';
            $created_by = 1;
            /////////////////////////////////////
            if(empty($created_by)){
                echo "console.log('Empty')";
                header('Location: ../InserIssue.html');
            }
            else{
                date_default_timezone_set("Jamaica");
                $created = date('Y-m-d H:i:s');
                
                // mysql query to insert data
                $pdoQuery = 'INSERT INTO ISSUE (title, description, type, priority, status, assigned_to, created_by, created)
                VALUES (:title,:description,:type,:priority,:status,:assigned_to,:created_by,:created)';
                
                $pdoResult = $conn->prepare($pdoQuery);
                
                $pdoExec = $pdoResult->execute(array(':title'=>$title,':description'=>$description,':type'=>$type,':priority'=>$priority,
                ':status'=>$status,':assigned_to'=>$assigned_to,':created_by'=>$created_by,':created'=>$created));
                
                
                    // check if mysql insert query successful
                if($pdoExec)
                {
                    //header('Location: ../InserIssue.html');
                    $submitted = "Issue Submitted";
                    echo "<div>{$submitted}</div>";
                }
                else{
                    //header('Location: ../InserIssue.html');
                    $failed = "Issue Not Submitted";
                    echo "<div>{$failed}</div>";
                    echo "<script>console.log({$failed})</script>";
                }
            }
            //////////////////////////////
        }else{
            echo "'One or More Empty Field Detected'";
        }
        // echo "</script>";
    }
    ?>
    <?php
}catch(PDOException $e){
    $error_message = $e->getMessage();
    //header('Location: ../InserIssue.html');
    //echo "<script>alert(".$error_message.")</script>";
    exit();
}catch(Exception $ex){
    $err_message = $ex->getMessage();
    //header('Location: ../InserIssue.html');
    //echo "<script>alert(".$err_message.")</script>";
    exit();
}?>