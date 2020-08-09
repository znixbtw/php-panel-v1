<?php
// Disable errors
error_reporting(0);

// Connect to DB
require_once('./server/db_connect.php');
require_once('./components/config.php');

$web_url = $_SERVER["REQUEST_URI"];
$query = parse_url($web_url, PHP_URL_QUERY);
parse_str($query, $apiquery);

// read_api var
$api_username = $apiquery['username']; 
$api_password = $apiquery['pass']; 

// insert_api var
$api_hwid = $apiquery['hwid']; 
$api_ip = $apiquery['ip']; 
$api_inject = $apiquery['inject']; 

// key_api var
$webapi_key = $apiquery['key']; 

// Set default to false
$empty_login = false;
$empty_hwid = false;
$empty_ip = false;
$empty_inject = false;

if ($webapi_key == $read_api) 
{

    if ($api_username == ""){ $empty_login = true; }
    if ($api_password == ""){ $empty_login = true; }

    if ($empty_login == false) 
    {
        $data_query = mysqli_query($mysqli, "SELECT * FROM users WHERE username ='" . $api_username."'");
        $data = mysqli_fetch_array($data_query);
        //$decode_password = base64_decode($data['password']);
        if(password_verify($api_password, $data['password'])) 
        {
            $data_json = array('id' => $data['id'], 'admin' => $data['admin'], 'hwid' => $data['hwid'], 'active' => $data['active'], 'banned' => $data['banned']);
            header('Content-type: text/javascript');
            echo json_encode($data_json);
        }
        else {
            echo("error");
        }
    }

}


if ($webapi_key == $insert_api) 
{
    
    if ($api_hwid == ""){ $empty_hwid = true; }
    if ($api_ip == ""){ $empty_ip = true; }
    if ($api_inject == ""){ $empty_inject = true; }

    if ($empty_hwid == false)
    {
        $data_query = mysqli_query($mysqli, "SELECT * FROM users WHERE username ='" . $api_username."'");
        $data = mysqli_fetch_array($data_query);
        //$decode_password = base64_decode($data['password']);
        if(password_verify($api_password, $data['password'])) 
        {
            $hwid_query = mysqli_query($mysqli, "UPDATE `users` SET `hwid` ='".$api_hwid."' WHERE username ='".$api_username."'");
        }
        else {
            echo("error");
        }
    }
    
    if ($empty_ip == false)
    {
        $data_query = mysqli_query($mysqli, "SELECT * FROM users WHERE username ='" . $api_username."'");
        $data = mysqli_fetch_array($data_query);
        //$decode_password = base64_decode($data['password']);
        if(password_verify($api_password, $data['password'])) 
        {
            $hwid_query = mysqli_query($mysqli, "UPDATE `users` SET `ip` ='".$api_ip."' WHERE username ='".$api_username."'");
        }
        else {
            echo("error");
        }
    }
    
    if ($empty_inject == false)
    {
        $data_query = mysqli_query($mysqli, "SELECT * FROM users WHERE username ='" . $api_username."'");
        $data = mysqli_fetch_array($data_query);
        //$decode_password = base64_decode($data['password']);
        if(password_verify($api_password, $data['password'])) 
        {
            $hwid_query = mysqli_query($mysqli, "UPDATE `users` SET `inject` ='".$api_inject."' WHERE username ='".$api_username."'");
        }
        else {
            echo("error");
        }
    }
}

if ($webapi_key == $service_api)
{
    $data_query = mysqli_query($mysqli, "SELECT * FROM service");
    $data = mysqli_fetch_array($data_query);
    $data_json = array('status' => $data['status'], 'version' => $data['version'], 'maintenance' => $data['maintenance']);
    header('Content-type: text/javascript');
    echo json_encode($data_json);
}
