<?php
    $host = 'localhost';
    $username = '';
    $password = '';
    $dbname = 'BugMe';
    
    
    
    $all=$_GET['all'];
    $open=$_GET['open'];
    $my_tickets=$_GET['my_tickets'];
    session_start();
    if(!isset($_SESSION[' ']))/*Need Session variable from login*/{
        if($all==true && (isset($all)|| !empty($all))){
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $stmt = $conn->query("SELECT * FROM Issue");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
            echo "<table>";
                echo "<tr>";
                    echo "<th>Title</th>";
                    echo "<th>Type</th>";
                    echo "<th>Status</th>";
                    echo "<th>Assigned To</th>";
                    echo "<th>Created</th>";
                echo"</tr>";
                foreach($result as $row){
                  echo "<td>".$row['id'].$row['title']."</td>";
                  echo "<td>".$row['type']."</td>";
                  echo "<td>".$row['status']."</td>";
                  echo "<td>".$row['assigned_to']."</td>";
                  echo "<td>".$row['created']."</td>";
                }
                echo"</tr>";
            echo "</table>";
        }
        if($open==true && (isset($open)|| !empty($open))){
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $stmt = $conn->query("SELECT * FROM Issue where status ='open'");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
            echo "<table>";
                echo "<tr>";
                    echo "<th>Title</th>";
                    echo "<th>Type</th>";
                    echo "<th>Status</th>";
                    echo "<th>Assigned To</th>";
                    echo "<th>Created</th>";
                echo"</tr>";
                foreach($result as $row){
                    echo "<td>".$row['id'].$row['title']."</td>";
                  echo "<td>".$row['type']."</td>";
                  echo "<td>".$row['status']."</td>";
                  echo "<td>".$row['assigned_to']."</td>";
                  echo "<td>".$row['created']."</td>";
                }
                echo"</tr>";
            echo "</table>";
        }
    
        if($my_tickets==true && (isset($my_tickets)|| !empty($my_tickets))){
            $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $stmt = $conn->query("SELECT * FROM Issue where assigned_to like '% $_SESSION[' ']%'");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
            echo "<table>";
                echo "<tr>";
                    echo "<th>Title</th>";
                    echo "<th>Type</th>";
                    echo "<th>Status</th>";
                    echo "<th>Assigned To</th>";
                    echo "<th>Created</th>";
                echo"</tr>";
                foreach($result as $row){
                  echo "<td>".$row['id'].$row['title']."</td>";
                  echo "<td>".$row['type']."</td>";
                  echo "<td>".$row['status']."</td>";
                  echo "<td>".$row['assigned_to']."</td>";
                  echo "<td>".$row['created']."</td>";
                }
                echo"</tr>";
            echo "</table>";
        }

    } 

   


?>