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
        header('location:control_panel_logo.php?error=true');
    }

    // get extension
    $temp = explode('.', $name);
    $arr = end($temp);
    $type = strtolower($arr);

    // allow jpg / png / gif / svg
    $fileTypes = ['jpg', 'png', 'gif', 'svg'];

    if (!in_array($type, $fileTypes)) {
        header('location:control_panel_logo.php?error=true');
    }

    // save file
    $tmp_name = $_FILES['logo']['tmp_name'];
    move_uploaded_file($tmp_name, "logo/logo");
    header('location:control_panel_logo.php');
}