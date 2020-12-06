<?php

// login.php

//starts session and initializes session attributes
session_start();
set_session();

/**
 * Perfoms the login function and sets session attributes accordingly
 * 
 * @param conx the PDO connection to the database
 */
function login(PDO $conx){
    //gets email and password from login form
    $emailx = $_POST['email'];
    $pwd = $_POST['password'];
    $id_sql = "select id from user where email = '${$emailx}' and password = '${$pwd}'";
    if(!empty($id = $conx->query($id_sql)->fetch())){
        set_session($emailx,$id);
        $_SESSION['password'] = $pwd;
        header('Location: ../dashboard.html');    
    }
    set_session();
    $_SESSION['password'] = "";
    header('Location: ../login.html');
}

/**
 * Sets the logged_in status to 1 if logged in or 0 if not logged in
 * 
 * Validates user's email and ID params and initializes login SESSION attributes
 * @param email string: valid email of user
 * @param iD integer: 0 represents not_logged_in
 */
function set_session( string $email="", int $iD=0){
        $_SESSION['email'] = $email;
        $_SESSION['logged_in'] = empty($_SESSION['email'])?0:1;
        $_SESSION['id'] = $iD;
        //gets the email and password from login form
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = myHash_PWD($_POST['password']);
}

/**
 * Creates a hashed password from the given password
 * @param myPWD given password 
 */
function myHash_PWD(string $myPWD){
    $myHashPWD = password_hash($myPWD, PASSWORD_DEFAULT);
    header('Location: ../login.html');
    echo "<script type='text/javascript'>console.log(<?= $myHashPWD?></script>";
    return $myHashPWD;
}

//uses connectdb function from connect.php
include 'connectdb.php';
$conn = connectdb();

//performs user login function and sets session attributes
login($conn);

//prints out log in status
echo $_SESSION['logged_in']==1?"Password matches.":"Password incorrect.";

?>