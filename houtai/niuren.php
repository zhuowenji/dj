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

//停止
if (isset($_GET['stop']) && !empty($_GET['stop'])) {
    $sql = "UPDATE `niuren` SET `status` = '1' WHERE `niuren`.`id` = " . $_GET['stop'];
    $res = $mysqli->query($sql);
    if ($res === false) {
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
    $msg = '用户启动成功';
}

//退出
if (isset($_GET['out']) && !empty($_GET['out'])) {
    $sql = "UPDATE `niuren` SET `status` = '2' WHERE `niuren`.`id` = " . $_GET['out'];
    $msg = '用户退出成功';
    $res = $mysqli->query($sql);
    if ($res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }
}

if (!empty($msg)) {
    $location = $rebak_url . '?msg=' . $msg;
    header("location:$location");
}

include '../tmp/admin/head.php';
include '../tmp/admin/niuren_content.php';
