<?php
include 'config.php';
include 'function.php';


//稳赚倍投算法

//码组数
$ms = 60;
if (isset($_GET['ms']) && $_GET['ms']) {
    $ms = $_GET['ms'];
}

//赔率
$peilv = 90;
if (isset($_GET['peilv']) && $_GET['peilv']) {
    $peilv = $_GET['peilv'];
}

//每100反水 
$shui = 7;
if (isset($_GET['shui'])) {
    $shui = $_GET['shui'];
}

$dzs = 0;
if (isset($_GET['dzs']) && $_GET['dzs']) {
    $dzs = $_GET['dzs'];
}

$shu_ying = 1;
if (isset($_GET['shu_ying']) && $_GET['shu_ying']) {
    $shu_ying = $_GET['shu_ying'];
}

//本
$ben = $ms * $dzs;
//水
$shui_de = $ben / 100 * $shui;

if($shu_ying == 1){
	//中得
	$zhong = $dzs * $peilv;
	//赚
	$zhuan = $zhong - $ben + $shui_de;
}else{
	$zhuan = $ben - $shui_de;
}

include 'tmp/head.php';
include 'tmp/jisuan_content.php';
include 'tmp/foot.php';
