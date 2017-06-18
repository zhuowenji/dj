<?php

include 'config.php';
include 'function.php';

//连接获取数据
$mysqli = connect();
$sql    = 'select * from kaijiang order by id desc';
$res    = $mysqli->query($sql);
if ($res === false) {
    var_dump($mysqli->errno);
    var_dump($mysqli->error);
}

$kj = [];
while ($data = $res->fetch_array()) {
    $kj[] = $data;
}

//推荐号码
$tuijian = tuijian($kj);

$ex_tuijian = explode(',', $tuijian);
$sixty = [];
foreach (array_filter($ex_tuijian) as $info) {
	$num = explode('-', $info);
	$sixty[$num[0]] = $num[1]; 
}

$style = [
	1 => 'info',
	3 => 'success',
	5 => 'warning',
	7 => 'danger',
	9 => 'active',
];

include 'tmp/head.php';
include 'tmp/60_content.php';
include 'tmp/foot.php';