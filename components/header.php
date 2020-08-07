


<nav class="navbar navbar-expand-lg navbar-dark box accent">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

        <div class="container">
            <a class="navbar-brand" href="<?php echo('http://'.$_SERVER['SERVER_NAME']);?>"><?php echo ($site); ?></a>
        </div>

        <div class="navbar-nav">
            <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) { ?>
                <a class="nav-item nav-link" href="login.php">Login</a>
                <a class="nav-item nav-link" href="register.php">Register</a>
            <?php } else if (!isset($_SESSION["admin"]) || $_SESSION["admin"] == 1) { ?>
                <a class="nav-item nav-link" href="index.php">Home</a>
                <a class="nav-item nav-link" href="admin.php">Admin</a>
                <a class="nav-item nav-link" href="users.php">Users</a>
                <a class="nav-item nav-link" href="profile.php">Profile</a>
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            <?php } else { ?>
                <a class="nav-item nav-link" href="index.php">Home</a>
                <a class="nav-item nav-link" href="users.php">Users</a>
                <a class="nav-item nav-link" href="profile.php">Profile</a>
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            <?php } ?>
        </div>
        
    </div>
    
</nav>


<div class="scroll">

<main role="main" class="flex-shrink-0">