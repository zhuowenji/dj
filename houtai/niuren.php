<?php

include '../config.php';
include '../function.php';

include 'base.php';

//连接获取数据
$mysqli = connect();
$niuren = getNiuren($mysqli, 'status, id ');

//返回url
$rebak_url = '/houtai/niuren.php';

$msg = '';

$status = [
    '0' => '继续',
    '1' => '停止',
    '2' => '退出',
];

//停止
if (isset($_GET['stop']) && !empty($_GET['stop'])) {
    $sql = "UPDATE `niuren` SET `status` = '1' WHERE `niuren`.`id` = " . $_GET['stop'];
    $res = $mysqli->query($sql);
    if ($res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    //获取当前用户信息
    $niuren_info = getNiurenInfo($mysqli, $_GET['stop']);

    //记录更新日志
    $installments     = 'INSERT INTO `niuren_installments` ( `niuren_id`, `period`, `tj_period`, `mashu`, `dazushu`, `peilv`, `win`, `money`, `residual_money`, `status`, `ctime`) VALUES (' . $_GET['stop'] . ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' . $niuren_info['residual_money'] . ", '1', " . time() . ');';
    $installments_res = $mysqli->query($installments);
    if ($installments_res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    $msg = '用户停止成功';
}

//继续
if (isset($_GET['jixu']) && !empty($_GET['jixu'])) {
    $sql = "UPDATE `niuren` SET `status` = '0' WHERE `niuren`.`id` = " . $_GET['jixu'];
    $res = $mysqli->query($sql);
    if ($res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    //获取当前用户信息
    $niuren_info = getNiurenInfo($mysqli, $_GET['jixu']);

    //记录更新日志
    $installments     = 'INSERT INTO `niuren_installments` ( `niuren_id`, `period`, `tj_period`, `mashu`, `dazushu`, `peilv`, `win`, `money`, `residual_money`, `status`, `ctime`) VALUES (' . $_GET['jixu'] . ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' . $niuren_info['residual_money'] . ", '0', " . time() . ');';
    $installments_res = $mysqli->query($installments);
    if ($installments_res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    $msg = '用户启动成功';
}

//退出
if (isset($_GET['out']) && !empty($_GET['out'])) {
    $sql = "UPDATE `niuren` SET `status` = '2' WHERE `niuren`.`id` = " . $_GET['out'];
    $res = $mysqli->query($sql);
    if ($res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    //获取当前用户信息
    $niuren_info = getNiurenInfo($mysqli, $_GET['out']);

    //记录更新日志
    $installments     = 'INSERT INTO `niuren_installments` ( `niuren_id`, `period`, `tj_period`, `mashu`, `dazushu`, `peilv`, `win`, `money`, `residual_money`, `status`, `ctime`) VALUES (' . $_GET['out'] . ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' . $niuren_info['residual_money'] . ", '2', " . time() . ');';
    $installments_res = $mysqli->query($installments);
    if ($installments_res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    $msg = '用户退出成功';
}

if (!empty($msg)) {
    $location = $rebak_url . '?msg=' . $msg;
    header("location:$location");
}

include '../tmp/admin/head.php';
include '../tmp/admin/niuren_content.php';
