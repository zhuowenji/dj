<?php

include '../config.php';
include '../function.php';

//计划开始时间
$start_time = ceil((time() - strtotime('2017-9-12 00:00:01')) / 86400);

$mysqli = connect();

//----分页----//

$sql_all = 'select *  from wuwan_jihua';
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
$fnum = 10;

//计算分页起始值
if ($tmp == '') {
    $num = 0;
} else {
    $num = ($tmp - 1) * $fnum;
}

//翻页数
$pagenum = ceil($totalnums / $fnum);

//记录
$sql = 'select * from wuwan_jihua order by id desc limit ' . $num . ',' . $fnum;
$res = $mysqli->query($sql);

$win_tr_style = [
    1 => 'success',
    2 => 'danger',
];

include '../tmp/head.php';
include '../tmp/500_ying_content.php';
include '../tmp/foot.php';
