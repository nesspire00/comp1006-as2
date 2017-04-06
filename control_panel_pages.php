<?php ob_start();
$title = 'Manage Pages';
require_once('header_cms.php');
require_once('auth.php');

// shows the error message if there was an error while deleting the user
if (!empty($_GET['error'])) {
    if ($_GET['error']) {
        echo '<div class="bg-danger"><p>There was an error while deleting the page!</p></div>';
    }
}
?>
<div class="container">
    <h1>Manage pages</h1>
    <a href="editpage.php"><button class="btn btn-success">Add a new page</button></a><br/><br/>
    <table class="table table-striped table-hover">
        <tr>
            <th>Page title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        try {
            require_once('db.php');

            $sql = "SELECT id, page_title FROM pages";
            $cmd = $conn->prepare($sql);
            $cmd->execute();
            $pages = $cmd->fetchAll();

            //List users in the table with the buttons to control them
            foreach ($pages as $page) {
                echo '<tr><td>' . $page['page_title'] . '</td>
                    <td>' . '<a href="editpage.php?id=' . $page['id'] . '" class="btn btn-primary">Edit</a>' . '</td>
                    <td>' . '<a href="deletepage.php?id=' . $page['id'] . '" class="btn btn-danger confirmation">Delete</a>' . '</td></tr>';
            }
        } catch (exception $e) {
            header('location:error.php');
        }
        ?>

</div>

<?php require_once('footer.php');
ob_flush(); ?>
