<?php

include 'config.php';
include 'function.php';

//获取所有牛人数据
$mysqli = connect();
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo '非法操作!';
    die;
}

$niuren = getNiurenInstallments($mysqli, $_GET['id']);

$niuren_info = getNiurenInfo($mysqli, $_GET['id']);

$win_tr_style = [
    1 => 'success',
    2 => 'danger',
];

$status_style = [
    0 => 'success',
    1 => 'warning',
    2 => 'danger',
];

$status = [
    '0' => '继续',
    '1' => '停止',
    '2' => '退出',
];

include 'tmp/head.php';
include 'tmp/baoshou_info_content.php';
include 'tmp/foot.php';
