<?php
require_once('./server/db_connect.php');
require_once('./server/query.php');
require_once('./components/include.php');

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Home";
    require_once($preheader);
    ?>
    <!-- temp -->

    <script type="text/javascript">
        setInterval("my_function();", 500);

        function my_function() {
            $("#result").load("shoutbox/get_msgs.php");
        }
    </script>
</head>


<body class="d-flex flex-column h-100">

    <?php require_once($header); ?>

    <!-- Ban Check -->
    <?php if ($_SESSION["banned"] == 1) { ?>
        <div class="container align-middle">
            <div class="alert alert-dismissible fade show mt-2 box accent" role="alert">
                <b>You have been banned!</b>
            </div>
        </div>
    <?php } else { ?>
        <!-- Ban Check -->


        <div class="container align-middle mt-2">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="alert alert-dismissible fade show my-3 box accent" role="alert">
                        Welcome back, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>


                <!-- Under Maintaince Alert -->
                <?php if ($service["maintenance"] == 1) { ?>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="alert alert-dismissible fade show my-3 box accent text-center" role="alert">
                            <u>Cheat is currently under maintenance!</u>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php } else {
                } ?>
                <!-- Under Maintaince Alert -->


                <!-- Shoutbox -->
                <div class="col-lg-9 col-md-8 col-sm-12">
                    <div class="box rounded accent my-3">
                        <div class="scroll chatbox">
                            <div id="result"></div>
                        </div>
                        <div class=" container">
                            <form action="shoutbox/post_msgs.php" method="post">
                                <div class="row chatbox-input pt-4">
                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <div class="form-group">
                                            <input type="text" name="msg" class="form-control contrast" maxlength="255" placeholder="What's on your mind?" required>

                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <input type="submit" class="btn" value="Send" name="sendmsg">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Shoutbox -->


                <!-- Info Section -->
                <div class="col-lg-3 col-md-4 col-sm-12">

                    <!-- Site info -->
                    <div class="box rounded accent my-3 text-break">
                        Latest member: <font class="float-right"><?php echo htmlspecialchars($latest_mem); ?></font></br>
                        Total users: <font class="float-right"><?php echo ($user_num); ?></font></br>
                        Total Banned users: <font class="float-right"><?php echo ($banned_user_num); ?></font></br>
                        Total 'Not' banned users: <font class="float-right"><?php echo ($nbanned_user_num); ?></font></br>
                        Total Active Users: <font class="float-right"><?php echo ($active_user_num); ?></font></br>
                    </div>
                    <!-- Site info -->

                    <!-- Cheat info -->
                    <div class="box rounded accent my-3">
                        Status: <font class="float-right"><?php if ($service["status"] == 0) { ?><font class="green">Undetected</font><?php } else { ?><font class="red">Detected</font><?php } ?></font><br>
                        Version: <font class="float-right"><?php echo $service["version"] ?></font><br>
                        <hr />
                        <div class="text-center mb-2"><a href="download.php">Download loader</a></div>
                    </div>
                    <!-- Cheat info -->

                </div>
                <!-- Info Section -->

            </div>
        </div>

    <?php }
    require_once($footer); ?>

</body>

</html>