<?php
$title = 'Register / update user';
require_once('header.php');

$username = "";
$usersID = null;

// if the user uses the page to update - check the username in the db
if (!empty($_GET['usersID'])) {
    try {
        require_once('db.php');
        $sql = "SELECT username FROM users WHERE userID = :userID";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':userID', $_GET['usersID'], PDO::PARAM_INT);
        $cmd->execute();
        $user = $cmd->fetch();

        $usersID = $_GET['usersID'];
        $username = $user['username'];

    } catch (exception $e) {
        header('location:error.php');
    }
}
?>

<div class="jumbotron">
    <div class="container">
        <form class="form-group" method="post" action="registerUser.php">
            <label for="username">Username: </label>
            <input type="email" name="username" id="username" required placeholder="name@email.com"
                   value="<?php echo $username; ?>"/>
            <br/>
            <label for="password"><?php if (!empty($_GET['usersID'])) {
                    echo 'New';
                    // add the word "new" to the label when updating
                } ?> Password: </label>
            <input type="password" name="password" id="password" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
            <br/>
            <label for="repeatpassword">Retype password: </label>
            <input type="password" name="repeatpassword" id="repeatpassword" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
            <!-- passing the userID to the next page -->
            <input type="hidden" name="userID" id="userID" value="<?php echo $usersID; ?>"/>
            <br/>
            <?php if (empty($_GET['usersID'])) {
                // if updating show the "update" button instead or "register"
                echo '
                      <br />
                      <button class="btn btn-success col-sm-offset-1">Register!</button>
                      ';
            } else {
                echo '
                <br />
                <button class="btn btn-success col-sm-offset-1">Update</button>
            ';
            } ?>
        </form>
    </div>
</div>

<?php require_once('footer.php'); ?>
