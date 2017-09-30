<?php

include '../config.php';
include '../function.php';

$mysqli = connect();

//----分页----//

$sql_all = 'select *  from ssc';
$tj_all  = $mysqli->query($sql_all);

$info_res = [];
while ($info = $tj_all->fetch_array()) {
    $info_res[] = $info;
}

//总行数
$totalnums = count($info_res);

// 页数常量
$tmp = 1;
if (isset($_GET['page']) && $_GET['page'] > 0) {
    $tmp = $_GET['page'];
}

//每页显示条数
$fnum = 120;

//计算分页起始值
if ($tmp == '') {
    $num = 0;
} else {
    $num = ($tmp - 1) * $fnum;
}

//翻页数
$pagenum = ceil($totalnums / $fnum);

//记录
$sql = 'select * from ssc order by id desc limit ' . $num . ',' . $fnum;
$res = $mysqli->query($sql);

$win_tr_style = [
    0 => '',
    1 => 'success',
    2 => 'danger',
];

$win_style = [
    0 => '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>',
    1 => '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>',
    2 => '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
];

include '../tmp/head.php';
include '../tmp/ssc_content.php';
include '../tmp/foot.php';
