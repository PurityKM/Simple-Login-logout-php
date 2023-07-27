<?php

function emptyInputSignup($fullname, $email, $username, $password, $repeat)
{
    if(empty($fullname) || empty($email) || empty($username) || empty($password) || empty($repeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username)
{
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function passwordMatch($password, $repeat)
{
    if($password !== $repeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function usernameExist($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE userName=? OR userEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        mysqli_stmt_close($stmt);
        return $row;
    }
    else {
        mysqli_stmt_close($stmt);
        return false;
    }

    
}

function createUser($conn, $fullname, $email, $username, $password)
{
    $sql = "INSERT INTO users(userFull, userName, userEmail, userPass) VALUES(?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashdPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $fullname, $username, $email, $hashdPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($name, $password)
{
    if(empty($name) || empty($password)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $name, $password)
{
    $usernameExists = usernameExist($conn, $name, $name);

    if ($usernameExists === false) {
        header("Location: ../login.php?error=wronglogin");
        exit();

    }

    $hashedPass = $usernameExists['userPass'];
    $checkPass = password_verify($password, $hashedPass);

    if($checkPass === false) {
        header("Location: ../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPass === true) {
        
        session_start();
        $_SESSION["idUser"] = $usernameExists["userId"];
        $_SESSION["unameId"] = $usernameExists["userName"];
        header("Location: ../index.php");
        exit();
    }
}

?>