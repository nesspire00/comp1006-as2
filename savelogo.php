<?php

// IF DELETE
if (!empty($_GET['delete'])) {
    if ($_GET['delete'] == true) {
        unlink('logo/logo');
        header('location:control_panel_logo.php');
    }
}

if (!empty($_FILES['logo']['name'])) {
    $name = $_FILES['logo']['name'];
    // size check
    $size = $_FILES['logo']['size'];
    if ($size > 2048000) {
        echo 'Cover Image must be less than 2 MB<br />';
    }

    // use end() and explode() to get the letters after the last period i.e. the file extension
    $temp = explode('.', $name);
    $arr = end($temp);

    // convert the extension to lower case
    $type = strtolower($arr);
    //echo $type;

    // allow jpg / png / gif / svg
    $fileTypes = ['jpg', 'png', 'gif', 'svg'];

    if (!in_array($type, $fileTypes)) {
        echo 'Invalid Image Type<br />';
        $ok = false;
    }

    // copy to /covers folder
    $tmp_name = $_FILES['logo']['tmp_name'];
    move_uploaded_file($tmp_name, "logo/logo");
    header('location:control_panel_logo.php');
}