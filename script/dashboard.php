<?php
    include_once "connectdb.php";
    
    
    
    $all=$_GET['all'];
    $open=$_GET['open'];
    $my_tickets=$_GET['my_tickets'];
    session_start();
    
        if(isset($all)|| !empty($all)){
            $conn = connectdb();
            $stmt = $conn->query("SELECT * FROM Issue");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $data=array();
            while($row=$result){
                $data[]=$row;
            }

            
    
           
        }
        if(sset($open)|| !empty($open)){
            $conn = $conn = connectdb();
            $stmt = $conn->query("SELECT * FROM Issue where status ='open'");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

            $data=array();
            while($row=$result){
                $data[]=$row;
            }
    
            
        }
    
        if(isset($my_tickets)|| !empty($my_tickets)){
            $conn = $conn = connectdb();
            $user=$_SESSION[''];
            $stmt = $conn->query("SELECT * FROM Issue where assigned_to like '% $user%'");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

            $data=array();
            while($row=$result){
                $data[]=$row;
            }
   
        }

?>