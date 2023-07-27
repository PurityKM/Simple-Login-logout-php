<?php

if(isset($_POST['login-submit'])) {

    $name       = $_POST['name'];
    $password   = $_POST['password'];

    require_once 'connect.php';
    require_once 'functions.php';

    if(emptyInputLogin($name, $password) !== false){
        header("Location: ../login.php?error=emptyinput");
        exit();
   }

   loginUser($conn, $name, $password);
}
else {
    header("Location: ../login.php");
    exit();
}

?>