<?php

// Initialize the session
session_start();
require_once('server/db_connect.php');

// Disable direct access
if(!isset($_SERVER['HTTP_REFERER'])){
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    exit;
}

// Check if user is admin
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] == 0) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    exit;
}

/*BAN FUNC*/
if (isset($_GET['ban'])) {
    $id = $_GET['ban'];
    mysqli_query($mysqli, "UPDATE `users` SET `banned`='1' WHERE id=" . $id);
    header('location: admin.php');
}
/*BAN FUNC*/

/*UNBAN FUNC*/
if (isset($_GET['unban'])) {
    $id = $_GET['unban'];
    mysqli_query($mysqli, "UPDATE `users` SET `banned`='0' WHERE id=" . $id);
    header('location: admin.php');
}
/*UNBAN FUNC*/

/*START SUB FUNC*/
if (isset($_GET['active'])) {
    $id = $_GET['active'];
    mysqli_query($mysqli, "UPDATE `users` SET `active`='1' WHERE id=" . $id);
    header('location: admin.php');
}
/*START SUB FUNC*/

/*END SUB FUNC*/
if (isset($_GET['inactive'])) {
    $id = $_GET['inactive'];
    mysqli_query($mysqli, "UPDATE `users` SET `active`='0' WHERE id=" . $id);
    header('location: admin.php');
}
/*END SUB FUNC*/

/*REMOVE ADMIN FUNC*/
if (isset($_GET['notadmin'])) {
    $id = $_GET['notadmin'];
    mysqli_query($mysqli, "UPDATE `users` SET `admin`='0' WHERE id=" . $id);
    header('location: admin.php');
}
/*REMOVE ADMIN FUNC*/

/*MAKE ADMIN FUNC*/
if (isset($_GET['admin'])) {
    $id = $_GET['admin'];
    mysqli_query($mysqli, "UPDATE `users` SET `admin`='1' WHERE id=" . $id);
    header('location: admin.php');
}
/*MAKE ADMIN FUNC*/

/*RESET HWID FUNC*/
if (isset($_GET['hwid'])) {
    $id = $_GET['hwid'];
    mysqli_query($mysqli, "UPDATE `users` SET `hwid`=NULL WHERE id=" . $id);
    header('location: admin.php');
}
/*RESET HWID FUNC*/

/*SET CHEAT = DETECTED FUNC*/
if (isset($_GET['detected'])) {
    $id = $_GET['detected'];
    mysqli_query($mysqli, "UPDATE `service` SET `status`='1'");
    header('location: admin.php?service');
}
/*SET CHEAT = DETECTED FUNC*/

/*SET CHEAT = UNDETECTED FUNC*/
if (isset($_GET['undetected'])) {
    $id = $_GET['undetected'];
    mysqli_query($mysqli, "UPDATE `service` SET `status`='0'");
    header('location: admin.php?service');
}
/*SET CHEAT = UNDETECTED FUNC*/

/*SET CHEAT = MAINTENANCE FUNC*/
if (isset($_GET['maintenance'])) {
    $id = $_GET['maintenance'];
    mysqli_query($mysqli, "UPDATE `service` SET `maintenance`=0");
    header('location: admin.php?service');
}
/*SET CHEAT = MAINTENANCE FUNC*/

/*SET CHEAT = UNDER MAINTENANCE FUNC*/
if (isset($_GET['under_maintenance'])) {
    $id = $_GET['under_maintenance'];
    mysqli_query($mysqli, "UPDATE `service` SET `maintenance`=1");
    header('location: admin.php?service');
}
/*SET CHEAT = UNDER MAINTENANCE FUNC*/

/*GENERATE CODE FUNC*/
if (isset($_GET['gencode'])) {
    $id = $_GET['gencode'];
    function getName($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
    $codeVar = getName(20);
    mysqli_query($mysqli, "INSERT INTO `invites` (`code`) VALUES ('{$codeVar}')");
    header('location: admin.php?invites');
}
/*GENERATE CODE FUNC*/