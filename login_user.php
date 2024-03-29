<?php ob_start();

$username = $_POST['username'];
$password = $_POST['password'];
try {
    require_once('db.php');

    $sql = "SELECT userID, password FROM users WHERE username = :username";

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();

    $user = $cmd->fetch();
} catch (exception $e) {
    header('location:error.php');
    mail('nesspire00@gmail.com', 'Crash on the website', $e);
}
//verify users password, if it doesnt match - send them to the login screen with an error message
if (password_verify($password, $user['password'])) {

    session_start();
    $_SESSION['userID'] = $user['userID'];
    $_SESSION['username'] = $username;
    header('location:cms.php');
} else {

    header('location:login.php?invalid=true');
    exit();
}

 $conn = null;

ob_flush();