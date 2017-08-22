<?php

include '../config.php';
include '../function.php';

include 'base.php';

//连接获取数据
$mysqli = connect();
$niuren = getNiuren($mysqli);

include '../tmp/admin/head.php';
include '../tmp/admin/niuren_content.php';
