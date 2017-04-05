<?php

//Test the id variable to pull up the page
try {
    require_once('db.php');
    $sql = 'SELECT * FROM pages WHERE id = ' . $_GET['id'] . ';';
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $webpage = $cmd->fetch();
} catch (exception $e) {
    header('location:error.php');
}
// if the id value returned nothing (meaning page with this id doesnt exist) redirect user to 404 page
if (empty($webpage)) {
    header('location:404.php');
}

$title = $webpage['page_title'];
$heading = $webpage['heading'];
$paragraph = $webpage['content'];

require_once('header_live.php');

$conn = null;

?>

<div class="jumbotron">
    <div class="container">
        <h1><?php echo $heading; ?></h1>
        <p><?php echo $paragraph; ?></p>
    </div>
</div>

<?php require_once('footer.php'); ?>
