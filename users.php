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

// Check if user is banned
if ($_SESSION["banned"] == 1) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $title = "Users";
    require_once($preheader);
    ?>
</head>


<body class="d-flex flex-column h-100">

    <?php require_once($header); ?>



        <div class="container align-middle mt-2">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <table class="rounded accent table box my-3">

                        <thead>
                            <tr class="text-center">
                                <th scope="col">UID</th>
                                <th scope="col">USERNAME</th>
                                <th scope="col">BANNED</th>
                                <th scope="col">ACTIVE</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            //$i = 1;
                            while ($row = mysqli_fetch_array($user_list)) { ?>
                                <tr class="text-center">
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo htmlspecialchars($row['username']); ?><?php if ($row["admin"] == 1) { ?> <i class="fas fa-check-circle"></i><?php } else { } ?></td>
                                    <td><?php if ($row["banned"] == 1) { ?><i class="fas fa-check-circle"></i><?php } else { ?><i class="fas fa-times-circle"></i><?php } ?></td>
                                    <td><?php if ($row["active"] == 1) { ?><i class="fas fa-check-circle"></i><?php } else { ?><i class="fas fa-times-circle"></i><?php } ?></td>
                                </tr>
                            <?php //$i++;
                            } ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>

    <?php require_once($footer); ?>

</body>

</html>