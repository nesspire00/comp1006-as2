<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>
<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a href="default.php" class="navbar-brand">COMP1006 - Assignment 2 (CMS)</a></li>

        <?php
        // show buttons depending on if user is logged in or not
        session_start();
        if (empty($_SESSION['userID'])) {
            echo '    
                <li><a href="register.php">Register</a></li>
                <li><a href = "default.php"><button class="btn navbar-btn btn-info">Live Webpage</button></a ></li>';
        } else {
            echo '
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href = "logout.php"><button class="btn navbar-btn btn-danger">Logout</button></a ></li>
                    <li><a href = "cms.php"><button class="btn navbar-btn btn-info">Control Panel</button></a ></li>';
        } ?>
    </ul>
</nav>