<?php
    function connectdb(){
        $host = 'localhost';
        $username = '';
        $password = '';
        $dbname = 'BugMe';
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        return $conn;

    }

?>