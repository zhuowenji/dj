<?php
include 'config.php';
include 'function.php';

//获取所有数据
$mysqli = connect();
$kj     = getAll($mysqli);

foreach ($kj as $key => $value) {
    $y         = date('Y', strtotime($value['time']));
    $all[$y][] = $value;
}

//稳赚倍投算法
$ms = 40;
if (isset($_GET['ms']) && $_GET['ms']) {
    $ms = $_GET['ms'];
}

$mqz = 500;
if (isset($_GET['mqz']) && $_GET['mqz']) {
    $mqz = $_GET['mqz'];
}

//连续期数不中
$qs = 5;
if (isset($_GET['qs']) && $_GET['qs']) {
    $qs = $_GET['qs'];
}

$wenzhuan = BeiTou($ms, $mqz, $qs);

include 'tmp/head.php';
include 'tmp/liangen_content.php';
include 'tmp/foot.php';
