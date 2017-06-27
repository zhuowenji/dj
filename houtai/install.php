<?php

include '../config.php';
include '../function.php';

include 'base.php';

//连接获取数据
$mysqli = connect();

//获取开奖时间
$day = date('Y-m-d', time());
if (isset($_POST['date']) && !empty($_POST['date'])) {
    $day = $_POST['date'];
}

//最新一期期数
$last = 'select period from kaijiang order by id desc limit 1';
$res  = $mysqli->query($last);
if ($res === false) {
    var_dump($mysqli->errno);
    var_dump($mysqli->error);
}

while ($data = $res->fetch_assoc()) {
    $period = $data['period'];
}

$new_period = $period + 1;

$msg = '';
if (isset($_POST['number']) && !empty($_POST['number']) && is_numeric($_POST['number'])) {
    $number = $_POST['number'];
    $sql    = 'INSERT INTO `kaijiang` (`id`, `time`, `period`, `number`) VALUES (NULL, ' . "'" . $day . "'" . ", $new_period, $number)";

    if ($mysqli->query($sql) === false) {
        $msg = '添加失败';
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
        echo $sql;
        die;
    } else {
        $msg = '添加成功、';
        include 'task/60_task.php';
        include 'task/40_task.php';
    }
}

include '../tmp/admin/head.php';
include '../tmp/admin/install_content.php';
