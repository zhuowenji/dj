<?php

include '../config.php';
include '../function.php';

$mysqli = connect();

//----分页----//

$where      = '';
$page_where = '';
if (isset($_GET['date_start']) || isset($_GET['date_end'])) {

    //分页url使用
    $page_where = '&date_start=' . $_GET['date_start'] . '&date_end=' . $_GET['date_end'];

    $date_start = str_replace('-', '', $_GET['date_start']);
    $date_end   = str_replace('-', '', $_GET['date_end']);

    $start = $date_start ? substr($date_start, 2) . '001' : 0;
    $end   = substr($date_end, 2) . '120';

    $where = 'where periods >= ' . $start . ' and periods <= ' . $end;
}

if (isset($_GET['time']) && !empty($_GET['time'])) {

    if ($_GET['time'] == 'today') {
        $date = date('ymd', time());
    }

    if ($_GET['time'] == 'tomorrow') {
        $date = date('ymd', time() - 86400);
    }

    $start = $date . '001';
    $end   = $date . '120';
    $where = 'where periods >= ' . $start . ' and periods <= ' . $end;
}

$sql_all = 'select *  from ssc ' . $where;
$tj_all  = $mysqli->query($sql_all);

$info_res = [];
$win      = 0;
$loss     = 0;
while ($info = $tj_all->fetch_array()) {
    $info_res[] = $info;

    if ($info['status'] == 1) {
        $win++;
    }

    if ($info['status'] == 2) {
        $loss++;
    }
}

//总行数
$totalnums = count($info_res);

// 页数常量
$tmp = 1;
if (isset($_GET['page']) && $_GET['page'] > 0) {
    $tmp = $_GET['page'];
}

//每页显示条数
$fnum = 12000;

//计算分页起始值
if ($tmp == '') {
    $num = 0;
} else {
    $num = ($tmp - 1) * $fnum;
}

//翻页数
$pagenum = ceil($totalnums / $fnum);

//记录
$sql = 'select * from ssc ' . $where . ' order by id desc limit ' . $num . ',' . $fnum;
$res = $mysqli->query($sql);

$win_tr_style = [
    0 => '',
    1 => 'background-color:#dff0d8',
    2 => 'background-color:#f2dede',
];

$win_style = [
    0 => '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>',
    1 => '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>',
    2 => '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>',
];

include '../tmp/head.php';
include '../tmp/ssc_content.php';
include '../tmp/foot.php';
