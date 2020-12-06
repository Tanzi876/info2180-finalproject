<?php
    function connectdb(){
        $host = 'localhost';
        $username = 'admin';
        $password = 'admin';
        $dbname = 'BugMe';
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;

    }

?>
