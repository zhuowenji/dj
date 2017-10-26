<?php

date_default_timezone_set('PRC');
include '/project/fuxiben/config.php';
include '/project/fuxiben/function.php';

//获取号码
$url = 'http://caipiao.163.com/award/qxc/';
$get = file_get_contents($url);

//获取号码

$url = 'http://f.apiplus.net/qxc-1.json';
$ch  = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$res = curl_exec($ch);
$qxc = json_decode($res, true);

$day    = date('Y-m-d', $qxc['data'][0]['opentimestamp']);
$expect = substr($qxc['data'][0]['expect'], 2);
$number = str_replace(',', '', $qxc['data'][0]['opencode']);
//最新一期期数

$mysqli = connect();

$last = 'select period from kaijiang order by id desc limit 1';
$res  = $mysqli->query($last);
if ($res === false) {
    var_dump($mysqli->errno);
    var_dump($mysqli->error);
}

while ($data = $res->fetch_assoc()) {
    $period = $data['period'];
}

if ($expect == $period) {
    echo '无更新';
    die;
}

$new_period = $period + 1;

$sql = 'INSERT INTO `kaijiang` (`id`, `time`, `period`, `number`) VALUES (NULL, ' . "'" . $day . "'" . ", $new_period, $number)";
if ($mysqli->query($sql) === false) {
    var_dump($mysqli->errno);
    var_dump($mysqli->error);
    echo $sql;
    die;
} else {
    include '/project/fuxiben/houtai/task/50_task.php';
}
