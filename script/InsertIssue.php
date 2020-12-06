<?php

session_start();

$dsn = 'mysql:host=localhost;dbname=bugme';
$username = 'admin';
$password = 'admin';


try{
    $bool = true;
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM user";
    
    $users = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);?>
    
    <?php foreach ($users as $user) { ?>
        <option value=<?= $user['id']; ?>>
        <?=$user['id']; ?></option>
    <?php
    }?>

    <?php 

    //logs user out
    if(!isset($_POST['logout'])){
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
    }
    
    if(!isset($_POST['submit'])){
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
            //Setting session ID since no session ID exists and I can't think of a work around it atm
            $created_by = 1;
            //$created_by = $_SESSION["id"];
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
                $submitted = "Issue Submitted";?>
                <h2><?= $submitted;?></h2>
                <?php 
            }
            else{
                $failed = "Issue Not Submitted";?>
                <h2><?= $failed;?></h2>
                <?php 
            }
        }else{
            
            echo "<script>console.log('One or More Empty Field Detected')</script>";
        }
    }
    else{
        echo "<script>console.log('submit button not set')</script>";
        //for Testing
    }?>
    <?php
}catch(PDOException $e){
    $error_message = $e->getMessage();
    echo "<script>console.log($error_message)</script>";
    exit();
}catch(Exception $ex){
    $err_message = $ex->getMessage();
    echo "<script>console.log($err_message)</script>";
}?>