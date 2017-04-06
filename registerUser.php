<?php ob_start();

//get the variables
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['repeatpassword'];
$userID = null;
$ok = true;

//validation
if (empty($username)) {
    echo 'username is empty';
    $ok = false;
}

//check the email format
if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    echo 'username is not an email address';
    $ok = false;
}

//check if user is authorized to edit user information
session_start();
if (empty($_SESSION['userID']) && !empty($_POST['userID'])) {
    echo 'You don`t have permission to perform this action';
    $ok = false;
}
try {
    //check if exists
    require_once('db.php');
    $sql = "SELECT username FROM users";
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $usernames = $cmd->fetchAll();
    foreach ($usernames as $user) {
        if ($user['username'] == $username) {
            echo 'Already exists';
            $ok = false;
        }
    }

    if (empty($password) || strlen($password) < 8) {
        echo 'password invalid';
        $ok = false;
    }

    if ($password != $confirm) {
        echo 'passwords do not match';
        $ok = false;
    }

//if everything is fine
    if ($ok) {

        $password = password_hash($password, PASSWORD_DEFAULT);

        //check if inserting or deleting
        if (empty($_POST['userID'])) {
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        } else {
            $sql = "UPDATE users SET username = :username, password = :password WHERE userID = :usersID";
        }
        $cmd = $conn->prepare($sql);

        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);

        // this bind parameter is needed only when updating
        if (!empty($_POST['userID'])) {
            $cmd->bindParam(':usersID', $_POST['userID'], PDO::PARAM_INT);
        }

        $cmd->execute();

        $conn = null;

        header('location:login.php');
    } else {
        echo '<br /> Go back to the registration page: <a href="register.php">Click here</a>';
    }
} catch
(exception $e) {
    header('location:error.php');
    mail('nesspire00@gmail.com', 'Crash on the website', $e);
}

ob_flush();
