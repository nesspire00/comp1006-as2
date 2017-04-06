<?php ob_start();
$title = 'Website logo';
require_once('header_cms.php');
require_once('auth.php');

// shows the error message if there was an error while deleting the user
if (!empty($_GET['error'])) {
    if ($_GET['error']) {
        echo '<div class="bg-danger"><p>There was an error while changing/uploading the logo!</p></div>';
    }
}
?>
<div class="container">
    <form action="savelogo.php" method="post" enctype="multipart/form-data">
        <label for="logo">Logo: </label>
        <input type="file" name="logo" id="logo"/>
        <br/>
        <button class="btn btn-success">Save changes</button>
    </form>
    <?php
    if (file_exists('logo/logo')) {
        echo '<img src="logo/logo" width="200" height="50">
<br/>
<a href="savelogo.php?delete=true"><button class="btn btn-danger">Delete logo</button></a>';
    }
    ?>
</div>