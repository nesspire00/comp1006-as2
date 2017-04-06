<?php ob_start();
$title = 'Manage Users';
require_once('header_cms.php');
require_once('auth.php');

// shows the error message if there was an error while deleting the user
if (!empty($_GET['error'])) {
    if ($_GET['error']) {
        echo '<div class="bg-danger"><p>There was an error while deleting the user!</p></div>';
    }
}
?>
<div class="container">
    <h1>Manage admins</h1>
    <table class="table table-striped table-hover">
        <tr>
            <th>Username</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        try {
            require_once('db.php');

            $sql = "SELECT userID, username FROM users";
            $cmd = $conn->prepare($sql);
            $cmd->execute();
            $users = $cmd->fetchAll();

            //List users in the table with the buttons to control them
            foreach ($users as $user) {
                echo '<tr><td>' . $user['username'] . '</td>
                    <td>' . '<a href="register.php?usersID=' . $user['userID'] . '" class="btn btn-primary">Edit</a>' . '</td>
                    <td>' . '<a href="deleteUser.php?usersID=' . $user['userID'] . '" class="btn btn-danger confirmation">Delete</a>' . '</td></tr>';
            }
        } catch (exception $e) {
            header('location:error.php');
        }
        ?>

</div>

<?php require_once('footer.php');
ob_flush(); ?>
