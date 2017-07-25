<?php
include 'config.php';
include 'function.php';

$mysqli = connect();

if (!isset($_GET['number']) || empty($_GET['number'])) {
    echo '非法操作';exit;
}

$number = $_GET['number'];

//推荐号码
$tj_sql = 'select * from tj where type = ' . $number . ' order by id desc';
$tj_res = $mysqli->query($tj_sql);

//获取最新一期推荐
$tj_new = [];

//获取胜负
$win  = 0;
$loss = 0;
while ($info = $tj_res->fetch_array()) {

    if ($info['win'] == 1) {
        $win++;
    }

    if ($info['win'] == 2) {
        $loss++;
    }

    $tj_new[$info['period']] = $info;
}

$style = [
    1 => 'info',
    3 => 'success',
    5 => 'warning',
    7 => 'danger',
    9 => 'active',
];

$win_style = [
    1 => '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>',
    2 => '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
];

$win_tr_style = [
    1 => 'success',
    2 => 'danger',
];

include 'tmp/head.php';
include 'tmp/zhanji_content.php';
include 'tmp/foot.php';
