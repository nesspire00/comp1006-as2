<?php ob_start();

session_start();
require_once('auth.php');

try {
    $id = null;

    //check userID
    if (!empty($_GET['id'])) {
        if (is_numeric($_GET['id'])) {
            $id = $_GET['id'];
        }
    }

    if (!empty($id)) {
        try {
            require_once('db.php');

            $sql = "DELETE FROM pages WHERE id = :id";
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':id', $id, PDO::PARAM_INT);

            $cmd->execute();

            $conn = null;
            header('location:control_panel_pages.php');
        } catch (exception $e) {
            header('location:error.php');
        }
    } else {
        //returns an error message if the userID is wrong
        header('location:control_panel_pages.php?error=true');
    }
} catch (exception $e) {
    header('location:error.php');
}

ob_flush();