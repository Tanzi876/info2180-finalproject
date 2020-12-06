<?php

//session_start();

    function connectdb(){
        $host = 'localhost';
        $username = $_SESSION['email'];
        $password = $_SESSION['password'];
        $dbname = 'BugMe';
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        return $conn;

    }

?>