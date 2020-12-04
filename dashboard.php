<?php
    $host = 'localhost';
    $username = '';
    $password = '';
    $dbname = '';
    
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $stmt = $conn->query("SELECT * FROM countries");

?>