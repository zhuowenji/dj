<?php

include '../config.php';
include '../function.php';

include 'base.php';

$msg = '';
if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {

    $dir = $_SERVER[DOCUMENT_ROOT] . '/style/img/upload/sc.jpeg';
    if (move_uploaded_file($_FILES['file']['tmp_name'], $dir)) {
        $msg = '上传成功';
    } else {
        $msg = '上传失败';
    }

}

include '../tmp/admin/head.php';
include '../tmp/admin/erweima_content.php';
