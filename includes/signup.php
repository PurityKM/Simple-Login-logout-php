<?php

if(isset($_POST['signup-submit'])){

    require_once 'connect.php';
    require_once 'functions.php';

    $fullname   = $_POST['fullname'];
    $email      = $_POST['email'];
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $repeat     = $_POST['repeat'];

   if(emptyInputSignup($fullname, $email, $username, $password, $repeat) !== false){
        header("Location: ../signup.php?error=emptyinput");
        exit();
   }
   if(invalidUsername($username) !== false){
        header("Location: ../signup.php?error=invalidusername");
        exit();
   }
   if(invalidEmail($email) !== false){
        header("Location: ../signup.php?error=invalidemail");
        exit();
   }
   if(passwordMatch($password, $repeat) !== false){
        header("Location: ../signup.php?error=passwordmismatch");
        exit();
   }
   if(usernameExist($conn, $username, $email) !== false){
        header("Location: ../signup.php?error=usernametaken");
        exit();
   }

   createUser($conn, $fullname, $email, $username, $password);

}
// else {
//     echo "It fails";
// }

?>