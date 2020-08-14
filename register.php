<?php
// Include config file
require_once("server/db_connect.php");
require_once('components/include.php');

// Define variables and initialize with empty values
$username = $password = $confirm_password = $invite_code = "";
$username_err = $password_err = $confirm_password_err = $invite_code_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (strlen(trim($_POST["username"])) < 3) {
        $username_err = "Username must have atleast 4 characters.";
    } elseif (strlen(trim($_POST["username"])) > 10) {
        $username_err = "Username is too long.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // store result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate code
    if (empty(trim($_POST["invite_code"]))) {
        $invite_code_err = "Please enter an invite code.";
    } else {
        // Prepare a select statement
        $provided = $_POST["invite_code"];

        $getCode = "SELECT code FROM invites WHERE code ='{$provided}'";
        $checkCode = "SELECT used FROM invites WHERE code ='{$provided}'";
        $updateCode = "UPDATE invites SET used = 1 WHERE code = '{$provided}'";
        
        $fetchGetCode = mysqli_query($mysqli, $getCode);
        $run_fetchGetCode = mysqli_fetch_all($fetchGetCode, MYSQLI_ASSOC);
        $fetchCheckCode = mysqli_query($mysqli, $checkCode);
        $run_fetchCheckCode = mysqli_fetch_array($fetchCheckCode);

        if ($run_fetchGetCode) {
            if ($run_fetchCheckCode[0] == 1) {
                $invite_code_err = "The code is already used.";
            } else {
                $invite_code_err = "";
            }
        } else {
            $invite_code_err = "The code does not exists.";
        }
    }


    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($invite_code_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        mysqli_query($mysqli, $updateCode);
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: login.php");
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
    $title = "Register";
    require_once($preheader); 
    ?>
</head>


<body class="d-flex flex-column h-100">
    <!-- Begin page content -->
    <?php require_once($header); ?>

    <div class="container align-middle mt-2">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-4 col-sm-12 box rounded accent my-3">
                <h4 class="text-center">Register</h4>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control form-control-sm">
                        <span class="help-block"><?php echo htmlspecialchars($username_err); ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control form-control-sm">
                        <span class="help-block"><?php echo htmlspecialchars($password_err); ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control form-control-sm">
                        <span class="help-block"><?php echo htmlspecialchars($confirm_password_err); ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($invite_code_err)) ? 'has-error' : ''; ?>">
                        <label>Invite Code</label>
                        <input type="text" name="invite_code" class="form-control form-control-sm">
                        <span class="help-block"><?php echo htmlspecialchars($invite_code_err); ?></span>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-custom px-2 mx-1 w-auto" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once($footer); ?>

</body>

</html>
