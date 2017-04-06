<?php
$title = 'Login';
require_once('header_cms.php');

//show error message if the user failed to log in the previous time
if (!empty($_GET['invalid'])) {
    if ($_GET['invalid']) {
        echo '<div class="bg-danger"><p>Your username or password is incorrect</p></div>';
    }
}
?>

<div class="jumbotron">
    <div class="container">
        <h1>Log in</h1>
        <br/>
        <form class="form-group col-sm-5" method="post" action="login_user.php">
            <label for="username">Username: </label>
            <input class="form-control" type="text" name="username" id="username" class="col-sm-offset-1" placeholder="name@email.com"/>
            <label for="password">Password: </label>
            <input class="form-control" type="password" name="password" id="password" class="col-sm-offset-1"/>
            <br/>
            <button class="btn btn-success">Log in!</button>
        </form>
    </div>
</div>

<?php require_once('footer.php') ?>
