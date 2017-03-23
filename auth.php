<?php
if (empty($_SESSION['userID'])) {
    header('location:login.php');
    exit();
}
