<?php
$dsn = "mysql:host=localhost;dbname=VoteLogDB";
$username = "comp2190SA";
$password = "2020Sem1";

$query = $_POST[''];

if(isset($_POST['submit'])){
    try{
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    }catch(PDOException $e){
        $error_message = $e->getMessage();
        echo $error_message;
        exit();
    }

    // get values form input text and number
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
    $priority = filter_var($_POST['priority'], FILTER_SANITIZE_STRING);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);
    $assigned_to = filter_var($_POST['assigned_to'], FILTER_SANITIZE_STRING);
    $created_by = filter_var($_POST['created_by'], FILTER_SANITIZE_STRING);
    
    // mysql query to insert data

    $pdoQuery = "INSERT INTO ISSUE (title, description, type, priority, status, assigned_to, created_by)
    VALUES (:title,:description,:type,:priority,:status,:assigned_to,:created_by)";
    
    $pdoResult = $conn->prepare($pdoQuery);
    
    $pdoExec = $pdoResult->execute(array(":title"=>$title,":description"=>$description,":type"=>$type,":priority"=>$priority,
    ":status"=>$status,":assigned_to"=>$assigned_to,":created_by"=>$created_by));
    
        // check if mysql insert query successful
    if($pdoExec)
    {
        echo 'Data Inserted';

        // print database into a table

    }else{
        echo 'Data Not Inserted';
    }
}

?>