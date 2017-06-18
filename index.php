<?php

include 'config.php';
include 'function.php';

//获取所有数据
$mysqli = connect();
$kj = getAll($mysqli);

//取最新一期
$first = getFirstInfo($kj);

foreach ($kj as $key => $value) {
    $y         = date('Y', strtotime($value['time']));
    $all[$y][] = $value;
}

//当前年份
$year = date('Y', time());

$year_tou = repeat($all, 0, 1, $year);
$year_wei = repeat($all, 3, 1, $year);

include 'tmp/head.php';
include 'tmp/index_content.php';
include 'tmp/foot.php';
