<?php ob_start();

session_start();
require_once('auth.php');

try {
    $usersID = null;

    //check userID
    if (!empty($_GET['usersID'])) {
        if (is_numeric($_GET['usersID'])) {
            $usersID = $_GET['usersID'];
        }
    }

    if (!empty($usersID)) {
        try {
            require_once('db.php');

            $sql = "DELETE FROM users WHERE userID = :usersID";
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':usersID', $usersID, PDO::PARAM_INT);

            $cmd->execute();

            $conn = null;
            header('location:control_panel_user.php');
        } catch (exception $e) {
            header('location:error.php');
        }
    } else {
        //returns an error message if the userID is wrong
        header('location:control_panel_user.php?error=true');
    }
} catch (exception $e) {
    header('location:error.php');
}

ob_flush();