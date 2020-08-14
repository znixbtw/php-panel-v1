<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// Include config file
require_once('server/db_connect.php');
require_once('components/include.php');

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE username = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {

                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {

                    // Bind result variables
                    $stmt->bind_result($id, $username, $hash_password, $admin, $hwid, $active, $banned, $created_at, $inject, $ip);
                    if ($stmt->fetch()) {
                        //$decode = base64_decode($base64_password);
                        if (password_verify($password, $hash_password)) {

                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["admin"] = $admin;
                            $_SESSION["hwid"] = $hwid;
                            $_SESSION["active"] = $active;
                            $_SESSION["banned"] = $banned;
                            $_SESSION["created_at"] = $created_at;
                            $_SESSION["inject"] = $inject;
                            $_SESSION["ip"] = $ip;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
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
    $title = "Login";
    require_once($preheader); 
    ?>
</head>

<body class="d-flex flex-column h-100">

    <?php require_once($header); ?>

    <div class="container align-middle mt-2">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-4 col-sm-12 box rounded accent my-3">
                <h4 class="text-center">Login</h4>

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

                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-custom px-2 mx-1 w-auto" value="Login">
                    </div>

                </form>
            </div>
        </div>
    </div>

    <?php require_once($footer); ?>

</body>
</html>
