<?php
    include_once "connectdb.php";
    
    session_start();
    
    $all=$_GET['all'];
    $open=$_GET['open'];
    $my_tickets=$_GET['my_tickets'];
    
    
        if(isset($all)){
            $conn = connectdb();
            $stmt = $conn->query("SELECT * FROM Issue");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $data=array();
            while($row=$result){
                $data[]=$row;
            }

            
    
           
        }
        if(isset($open)){
            $conn = $conn = connectdb();
            $stmt = $conn->query("SELECT * FROM Issue where status ='open'");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

            $data=array();
            while($row=$result){
                $data[]=$row;
            }
    
            
        }
    
        if(isset($my_tickets)){
            $conn = $conn = connectdb();
            $user=$_SESSION['userID'];
            $stmt = $conn->query("SELECT * FROM Issue where assigned_to like '% $user%'");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

            $data=array();
            while($row=$result){
                $data[]=$row;
            }
   
        }

?>