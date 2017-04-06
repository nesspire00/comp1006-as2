<?php
$title = 'Add / Edit a page';
require_once('header_cms.php');

$pagetitle = "";
$pageheading = "";
$pagecontent = "";
$pageid = null;

// if the user uses the page to update - check the username in the db
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
    }
}
?>

<div class="jumbotron">
    <div class="container">
        <form class="form-group" method="post" action="updatepage.php">

            <label for="pagetitle">Page title: </label>
            <input type="text" name="pagetitle" id="pagetitle" required placeholder="Page title" value="<?php echo $pagetitle; ?>"/>
            <br/>
            <label for="pageheading">Page heading: </label>
            <input type="text" name="pageheading" id="pageheading" placeholder="Page heading" value="<?php echo $pageheading; ?>"/>
            <br/>
            <label for="pagecontent">Page content: </label>
            <textarea name="pagecontent" id="pagecontent"><?php echo $pagecontent; ?></textarea>
            <!-- passing the pageID to the next page -->
            <input type="hidden" name="pageid" id="pageid" value="<?php echo $pageid; ?>"/>
            <br/>
            <?php if (empty($_GET['id'])) {
                // if updating show the "update" button instead or "register"
                echo '
                      <br />
                      <button class="btn btn-success col-sm-offset-1">Create page</button>
                      ';
            } else {
                echo '
                <br />
                <button class="btn btn-success col-sm-offset-1">Update page</button>
            ';
            } ?>
        </form>
    </div>
</div>

<?php require_once('footer.php'); ?>
