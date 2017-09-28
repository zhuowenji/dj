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
$ms = 60;
if (isset($_GET['ms']) && $_GET['ms']) {
    $ms = $_GET['ms'];
}

$peilv = 90;
if (isset($_GET['peilv']) && $_GET['peilv']) {
    $peilv = $_GET['peilv'];
}

$mqz = 300;
if (isset($_GET['mqz']) && $_GET['mqz']) {
    $mqz = $_GET['mqz'];
}

//连续期数不中
$qs = 3;
if (isset($_GET['qs']) && $_GET['qs']) {
    $qs = $_GET['qs'];
}

$wenzhuan = beiTou($ms, $mqz, $qs, $peilv);
$liangen  = lianGen($ms, $mqz, $qs, $peilv);

include 'tmp/head.php';
include 'tmp/liangen_content.php';
include 'tmp/foot.php';
