<?php

$server_host = "localhost";
$db_username ="root";
$db_password = "";
$db_name = "login-update";

$conn = mysqli_connect($server_host, $db_username, $db_password, $db_name);

if($conn){
    echo 'Connected';
} else {
    echo 'Not connected';
}

?>