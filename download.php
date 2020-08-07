<?php
require_once('components/include.php');
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    exit;
}
if ($_SESSION["banned"] == 1) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    exit;
}

function randomName($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}
$cheat = randomName(20);
header('Content-type: application/x-dosexec');
header('Content-Disposition: attachment; filename="'.$cheat.'".exe"');
readfile($loader);
?> 