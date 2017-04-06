<?php ob_start();
require_once ('auth.php');

//get the variables
$pagetitle = $_POST['pagetitle'];
$pageheading = $_POST['pageheading'];
$pagecontent = $_POST['pagecontent'];
$pageid = null;
$ok = true;

//validation
if (empty($pagetitle)) {
    echo 'username is empty';
    $ok = false;
}

//check if user is authorized to edit user information
session_start();
if (empty($_SESSION['userID']) && !empty($_POST['userID'])) {
    echo 'You don`t have permission to perform this action';
    $ok = false;
}

try {
    if ($ok) {

        //check if inserting or deleting
        if (empty($_POST['pageid'])) {
            $sql = "INSERT INTO pages (page_title, heading, content) VALUES (:page_title, :heading, :content)";
        } else {
            $sql = "UPDATE pages SET page_title = :page_title, heading = :heading, content = :content WHERE id = :id";
        }

        require_once ('db.php');
        $cmd = $conn->prepare($sql);

        $cmd->bindParam(':page_title', $pagetitle, PDO::PARAM_STR, 100);
        $cmd->bindParam(':heading', $pageheading, PDO::PARAM_STR, 150);
        $cmd->bindParam(':content', $pagecontent, PDO::PARAM_STR, 1000);

        // this bind parameter is needed only when updating
        if (!empty($_POST['pageid'])) {
            $cmd->bindParam(':id', $_POST['pageid'], PDO::PARAM_INT);
        }

        $cmd->execute();

        $conn = null;

        header('location:control_panel_pages.php');
    } else {
        echo '<br /> Go back to the add/edit pages page: <a href="control_panel_pages.php">Click here</a>';
    }
} catch
(exception $e) {
    header('location:error.php');
    mail('nesspire00@gmail.com', 'Crash on the website', $e);
}

ob_flush();
