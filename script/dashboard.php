<?php
    include_once "connectdb.php";
    
    session_start();
    
    $all=$_GET['all'];
    $open=$_GET['open'];
    $my_tickets=$_GET['my_tickets'];
    
    
        if(array_key_exists('all',$_POST)){
            $conn = connectdb();
            $stmt = $conn->query("SELECT * FROM Issue");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $data=array();
            while($row=$result){
                $data[]=$row;
            }

            
    
           
        }
        if(array_key_exists('open',$_POST)){
            $conn = $conn = connectdb();
            $stmt = $conn->query("SELECT * FROM Issue where status ='open'");
            $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

            $data=array();
            while($row=$result){
                $data[]=$row;
            }
    
            
        }
    
        if(array_key_exists('my_tickets',$_POST)){
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