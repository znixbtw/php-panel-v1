<?php
require_once('./server/db_connect.php');
require_once('./server/query.php');
require_once('./components/include.php');

// Initialize the session
session_start();

// Check if user is admin
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] == 0) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    exit;
}

// Check if user is banned
if ($_SESSION["banned"] == 1) {
    header("location: index.php");
    exit;
}

//Default Tab
$tab = 'features/userlist.php';

if (isset($_GET['actions'])) {
    $tab = 'features/userlist.php';
}
if (isset($_GET['invites'])) {
    $tab = 'features/invites.php';
}
if (isset($_GET['service'])) {
    $tab = 'features/service.php';
}

$version_err = $version = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (empty(trim($_POST["version"]))) {
        $version_err = "Please enter a value";
    } 
    else 
    {
        $version = trim($_POST["version"]);
    }

    if (empty($version_err))
    {
        mysqli_query($mysqli, "UPDATE `service` SET `version`=" . $version);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Admin Panel";
    require_once($preheader);
    ?>
</head>


<body class="d-flex flex-column h-100">

    <?php require_once($header); ?>


    <div class="container align-middle mt-2">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="box rounded accent my-3">
                    <button type="button" class="btn btn-custom px-2 mx-1" onclick="window.location.href='admin.php?actions'">Users</button>
                    <button type="button" class="btn btn-custom px-2 mx-1" onclick="window.location.href='admin.php?invites'">Invites</button>
                    <button type="button" class="btn btn-custom px-2 mx-1" onclick="window.location.href='admin.php?service'">Services</button>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="table-responsive-sm my-3">
                    <?php require_once($tab); ?>
                </div>
            </div>
        </div>

    </div>

    <?php require_once($footer); ?>

</body>

</html>