<?php

include '../config.php';
include '../function.php';

include 'base.php';

//连接获取数据
$mysqli = connect();

//获取开码时间
$day = date('Y-m-d', time());
if (isset($_POST['date']) && !empty($_POST['date'])) {
    $day = $_POST['date'];
}

//错误信息
$msg = '';

//赔率
$peilv = 95;
if (isset($_POST['peilv']) && $_POST['peilv']) {
    $peilv = $_POST['peilv'];
}

//获取码组数
$last = 'select period from kaijiang order by id desc limit 1';
$res  = $mysqli->query($last);
if ($res === false) {
    $msg = $mysqli->errno . ',' . $mysqli->error;
}

while ($data = $res->fetch_assoc()) {
    $period = $data['period'];
}

$zhong = 'select count,period,win from tj where  type = 50 and period_actual = ' . $period;
$res   = $mysqli->query($zhong);
if ($res === false) {
    $msg = $mysqli->errno . ',' . $mysqli->error;
}

while ($data = $res->fetch_assoc()) {
    $win       = $data['win'];
    $tj_period = $data['period'];
    $mashu     = $data['count'];
}

if (isset($_POST['mashu']) && !empty($_POST['mashu'])) {
    $mashu = $_POST['mashu'];
} elseif (isset($_POST['mashu']) && empty($_POST['mashu'])) {
    $msg = '码组数不能为空';
}

//打组数
$dazushu = '';
if (isset($_POST['dazushu']) && !empty($_POST['dazushu'])) {
    $dazushu = $_POST['dazushu'];
} elseif (isset($_POST['dazushu']) && empty($_POST['dazushu'])) {
    $msg = '打组数不能为空';
}

$shu_ying = 1;
if (isset($_POST['shu_ying']) && $_POST['shu_ying']) {
    $shu_ying = $_POST['shu_ying'];

    if ($shu_ying !== $win) {
        $msg = '结果不一致，请纠正';
    }

    $res = 'ok';
}

$up_res = '';
if ($msg == '' && $res == 'ok') {
    //获取所有牛人
    $niuren = getNiuren($mysqli);
    foreach ($niuren as $info) {
        $zhuan = $shu_ying == 1 ? ($peilv * $dazushu) - ($mashu * $dazushu) : 0 - ($mashu * $dazushu);

        $ben_zhuan = $info['money'] / 1000 * $zhuan;

        $up_residual_money = $info['residual_money'] + $ben_zhuan;
        $up_sql            = 'UPDATE `niuren` SET `residual_money` = ' . $up_residual_money . ' WHERE `id` = ' . $info['id'];

        if ($info['status'] == 0) {
            $query_sql = $mysqli->query($up_sql);
            //记录错误日志
            if ($res === false) {
                $up_err_log = $mysqli->errno . '-' . $mysqli->error;
                $err_log    = 'INSERT INTO `niuren_up_log` ( `niuren_id`, `periods`, `msg`, `ctime`) VALUES ( ' . $info['id'] . ", $period, '" . $up_err_log . "', " . time() . ')';
                $mysqli->query($err_log);
            }
        }

        //记录明细
        $installments = 'INSERT INTO `niuren_installments` ( `niuren_id`, `period`, `tj_period`, `mashu`, `dazushu`, `peilv`, `win`, `money`, `residual_money`, `ctime`) VALUES ( ' . $info['id'] . ", $period, $tj_period, $mashu, $dazushu, $peilv, $win, $ben_zhuan, $up_residual_money," . time() . ')';
        $query        = $mysqli->query($installments);
    }

    $up_res = '更新完成';
}

include '../tmp/admin/head.php';
include '../tmp/admin/niuren_up_content.php';
