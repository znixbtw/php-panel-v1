<?php

require_once('../server/db_connect.php');
session_start();

// Disable direct access
if(!isset($_SERVER['HTTP_REFERER'])){
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
}

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Check if user is banned
if ($_SESSION["banned"] == 1) {
    header("location: index.php");
    exit;
}

$msg = $msg_err = "";

// Processing message when form is submitted
if (isset($_POST['sendmsg'])) {
    if (empty(trim($_POST["msg"]))) {
        $msg_err = "Message can not be empty.";
        header('location: ../index.php');
        exit;
    } else {
        $param_msg = trim($_POST["msg"]);
        $sql = "INSERT INTO `shoutbox` (`user`, `msg`) VALUES ('{$_SESSION["username"]}','{$param_msg}')";
        mysqli_query($mysqli, $sql);
        header('location: ../index.php');
        exit;
    }
}
