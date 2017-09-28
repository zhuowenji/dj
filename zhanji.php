<?php
include 'config.php';
include 'function.php';

$mysqli = connect();

if (!isset($_GET['number']) || empty($_GET['number'])) {
    echo '非法操作';exit;
}

$number = $_GET['number'];

$sql_all = 'select *  from tj where type = ' . $number;
$tj_all  = $mysqli->query($sql_all);

//获取胜负
$win      = 0;
$loss     = 0;
$info_res = [];
while ($info = $tj_all->fetch_array()) {

    if ($info['win'] == 1) {
        $win++;
    }

    if ($info['win'] == 2) {
        $loss++;
    }
    $info_res[] = $info;
}

//----分页----//

//总行数
$totalnums = count($info_res);

// 页数常量
$tmp = 1;
if (isset($_GET['page']) && $_GET['page'] > 0) {
    $tmp = $_GET['page'];
}

//每页显示条数
$fnum = 15;

//计算分页起始值
if ($tmp == '') {
    $num = 0;
} else {
    $num = ($tmp - 1) * $fnum;
}

//翻页数
$pagenum = ceil($totalnums / $fnum);

//记录
$tj_sql = 'select * from tj where type = ' . $number . ' order by id desc limit ' . $num . ',' . $fnum;
$tj_res = $mysqli->query($tj_sql);

//获取最新一期推荐
$tj_new = [];

while ($info = $tj_res->fetch_array()) {
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
