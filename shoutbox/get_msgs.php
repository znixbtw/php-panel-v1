<?php

    // Get all shoutbox messages
    require_once('../server/db_connect.php');
    require_once('../server/query.php');
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
    
    
    while ($row = mysqli_fetch_array($message_list)) 
    {

        $date = strtotime($row['time']);    
        
        echo "
        <div class='row pr-2'>
            <div class='col-12 text-break' id='chat'>
                <font class='font-weight-bolder'><u>" . htmlspecialchars($row['user']) . "</u></font>: " .
                "<font class='font-weight-lighter'>" . htmlspecialchars($row['msg']) . "</font> " .
                "<small class='text-muted'>[ " . date('d/m/Y g:i A', $date) . " ]</small><br>
            </div>
        </div>";
        
    }


?>