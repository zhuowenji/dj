<?php
include 'config.php';
include 'function.php';

$mysqli = connect();

//推荐号码
$tj_sql = 'select * from tj order by id desc limit 10';
$tj_res = $mysqli->query($tj_sql);

$tj_new = [];
while ($info = $tj_res->fetch_array()) {
    $tj_new[] = $info;
}

$tuijian    = current($tj_new);
$ex_tuijian = explode(',', $tuijian['number']);
$sixty      = [];
foreach (array_filter($ex_tuijian) as $info) {
    $num            = explode('-', $info);
    $sixty[$num[0]] = $num[1];
}

$style = [
    1 => 'info',
    3 => 'success',
    5 => 'warning',
    7 => 'danger',
    9 => 'active',
];

$win_style = [
    1 => '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 中',
    2 => '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> 错',
];

$win_tr_style = [
    1 => 'success',
    2 => 'danger',
];

include 'tmp/head.php';
include 'tmp/60_content.php';
include 'tmp/foot.php';
