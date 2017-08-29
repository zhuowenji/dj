<?php

include '../config.php';
include '../function.php';

include 'base.php';

//连接获取数据
$mysqli = connect();
$niuren = getNiuren($mysqli, 'status, id ');

if (isset($_GET['del']) && !empty($_GET['del'])) {
    echo '111';die;
}

include '../tmp/admin/head.php';
include '../tmp/admin/niuren_content.php';
