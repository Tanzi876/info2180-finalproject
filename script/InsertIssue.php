<?php

session_start();


try{
    $bool = true;
    include_once '../script/connectdb.php';
    $conn = connectdb();

    if(empty($_POST['query'])){
        ?>
            <?php $sql = "SELECT * FROM user";
            //$string="<script>";
            echo "<script>";
            $users = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);?>
            <?php foreach ($users as $user) { 
                // DO NOT INSERT HEADER FUNCTION!!!
                $var = $user['id'];
                echo "<script>console.log({$var})</script>";
                echo "<option value={$var}>{$var}</option>";
            }
            //header('Location: ../InserIssue.html');
            
            echo "</script>";?>
    
        <?php }; ?>
        
        <?php 

    //logs user out
    if(isset($_POST['logout'])){
        // remove all session variables
        session_unset();

        // destroy the session
        //session_destroy();
    }
    
    if(isset($_POST['submit'])){
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
            $created_by = (int)((isset($_SESSION['id']))?$_SESSION['id']:1);
            if(empty($created_by)){
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
                    header('Location: ../InserIssue.html');
                    $submitted = "Issue Submitted";
                    echo "<script>console.log(".$submitted.")</script>";
                }
                else{
                    header('Location: ../InserIssue.html');
                    $failed = "Issue Not Submitted";
                    echo "<script>console.log(".$failed.")</script>";
                }
            }
        }else{
            header('Location: ../InserIssue.html');
            echo "<script>console.log('One or More Empty Field Detected')</script>";
        }
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