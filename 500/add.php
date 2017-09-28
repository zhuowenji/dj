<?php

include '../config.php';
include '../function.php';

$time = date('Y-m-d', time());

$mysqli = connect();

$msg      = '';
$shu_ying = 1;
$amount   = 0;

$sql  = 'select *  from wuwan_jihua order by id desc  limit 1';
$res  = $mysqli->query($sql);
$data = mysqli_fetch_array($res, MYSQLI_ASSOC);

if (isset($_POST['amount']) && !empty($_POST['amount']) && isset($_POST['shu_ying'])) {

    if ($_POST['shu_ying'] == 1) {
        $up_amount = $_POST['amount'];
        $total     = $data['total'] + $up_amount;
    } elseif ($_POST['shu_ying'] == 2) {
        $up_amount = 0 - $_POST['amount'];
        $total     = $data['total'] + $up_amount;
    }

    $status = $_POST['shu_ying'];
    $sql    = 'INSERT INTO `wuwan_jihua` (`id`, `amounts`, `total`, `status`, `time`) VALUES (NULL, ' . $up_amount . ', ' . $total . ', ' . $status . ', "' . $time . '");';
    $up     = $mysqli->query($sql);
    if ($up === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    $msg = '更新完成';
}

include '../tmp/head.php';
include '../tmp/add_500_content.php';
include '../tmp/foot.php';
