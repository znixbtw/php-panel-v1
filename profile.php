<?php
// Initialize the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Check if user is banned
if ($_SESSION["banned"] == 1) {
    header("location: login.php");
    exit;
}

// Include config file
require_once('server/db_connect.php');
require_once('components/include.php');


// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have atleast 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("si", $param_password, $param_id);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $mysqli->close();
}
?>


<!doctype html>
<html lang="en" class="h-100">

<head>
    <?php
    $title = "Profile";
    require_once($preheader);
    ?>
</head>

<body class="d-flex flex-column h-100">
    <?php require_once($header); ?>

        <div class="container align-middle mt-2">
            <div class="row">


                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="box rounded accent my-3">
                        <h4 class="text-center">Change Password</h4>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control form-control-sm">
                                <span class="help-block"><?php echo htmlspecialchars($new_password_err); ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control form-control-sm">
                                <span class="help-block"><?php echo htmlspecialchars($confirm_password_err); ?></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-9 col-md-8 col-sm-12">
                    <div class="box rounded accent my-3">
                        Username: <b><?php echo htmlspecialchars($_SESSION["username"]); ?><?php if ($_SESSION["admin"] == 1) { ?> <i class="fas fa-check-circle"></i><?php } else {
                                                                                                                                                                    } ?></b>
                        |
                        Sub: <b><?php if ($_SESSION["active"] == 1) { ?> Active <?php } else { ?> Inactive <?php } ?></b>
                        |
                        Registered On: <b><?php $date = strtotime($_SESSION["created_at"]);
                                            echo date('d/m/Y g:i A', $date); ?></b>
                        <br>
                        HWID: <b><?php echo htmlspecialchars($_SESSION["hwid"]); ?></b>
                        <br>
                    </div>
                </div>

            </div>
        </div>

        <?php require_once($footer); ?>
</body>

</html>
