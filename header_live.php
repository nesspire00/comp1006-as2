<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>
<nav class="navbar navbar-default">
    <ul class="nav navbar-nav">

        <?php
        if(file_exists('logo/logo')) {
            echo '<li><a href="default.php" class="navbar-brand" style="padding: 0;"><img src="logo/logo" width="200" height="50"></a></li>';
        } else {
            echo '<li><a href="default.php" class="navbar-brand">COMP1002 - Assignment 2</a></li>';
        }

            require_once ('db.php');
            $sql = 'SELECT id, page_title FROM pages';
            $cmd = $conn->prepare($sql);
            $cmd -> execute();
            $pages = $cmd -> fetchAll();

            foreach ($pages as $page){
                echo '<li><a href="page.php?id=' . $page['id'] . '">'.$page['page_title'].'</a>';
            }


        ?>

    </ul>
</nav>