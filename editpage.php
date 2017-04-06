<?php
$title = 'Add / Edit a page';
require_once('header_cms.php');
require_once ('auth.php');

$pagetitle = "";
$pageheading = "";
$pagecontent = "";
$pageid = null;

// if the user uses the page to edit - check the values in the db
if (!empty($_GET['id'])) {
    try {
        require_once('db.php');
        $sql = "SELECT page_title, heading, content FROM pages WHERE id = :id";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $cmd->execute();
        $page = $cmd->fetch();

        $pageid = $_GET['id'];
        $pagetitle = $page['page_title'];
        $pageheading = $page['heading'];
        $pagecontent = $page['content'];

    } catch (exception $e) {
        header('location:error.php');
        mail('nesspire00@gmail.com', 'Crash on the website', $e);
    }
}
?>

<div class="jumbotron">
    <div class="container">
        <?php if (empty($_GET['id'])) {
            // if editing show the "edit" text instead or "add"
            echo '
                      
                      <h1>Add a page</h1>
                      ';
        } else {
            echo '
                <h1>Edit the page</h1>
            ';
        } ?>
        <form class="form-group" method="post" action="updatepage.php">

            <label for="pagetitle">Page title: </label>
            <input class="form-control" type="text" name="pagetitle" id="pagetitle" required placeholder="Page title" value="<?php echo $pagetitle; ?>"/>
            <br/>
            <label for="pageheading">Page heading: </label>
            <input class="form-control" type="text" name="pageheading" id="pageheading" placeholder="Page heading" value="<?php echo $pageheading; ?>"/>
            <br/>
            <label for="pagecontent">Page content: </label>
            <textarea class="form-control" name="pagecontent" id="pagecontent"><?php echo $pagecontent; ?></textarea>
            <!-- passing the pageID to the next page -->
            <input type="hidden" name="pageid" id="pageid" value="<?php echo $pageid; ?>"/>
            <br/>
            <?php if (empty($_GET['id'])) {
                // if updating show the "update" button instead or "create"
                echo '
                      <br />
                      <button class="btn btn-success">Create page</button>
                      ';
            } else {
                echo '
                <br />
                <button class="btn btn-success">Update page</button>
            ';
            } ?>
        </form>
    </div>
</div>

<?php require_once('footer.php'); ?>
