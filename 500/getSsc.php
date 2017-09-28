<?php

include '/project/fuxiben/config.php';
include '/project/fuxiben/function.php';

//获取号码
$url = 'http://buy.cqcp.net/trend/ssc/scchart_11.aspx';
$get = file_get_contents($url);

$content = iconv('UTF-8', 'GB2312//IGNORE', $get);

$dian = '.';
for ($i = 1; $i < 1003; $i++) {
    $dian .= '.';
}

$preg = '/var Con_BonusCode ' . $dian . '/i';
preg_match($preg, $content, $data);

$new = substr($data[0], -20);
var_dump($new);die;
$chai = explode('=', $new);

//数据库操作
$time = date('Y-m-d H:i:s', time());

$mysqli = connect();

$sql = 'select * from ssc  where periods = ' . $chai[0];

$res = $mysqli->query($sql);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

//不存在则插入一条
if ($row != null) {
    exit;
}

$sql = "INSERT INTO `ssc` (`id`, `number`, `periods`, `tuijian`, `status`, `time`) VALUES (NULL, '" . $chai[1] . "', " . $chai[0] . ", NULL, '0', '" . $time . "');";
$mysqli->query($sql);

$zuihou = substr($chai[0], -3, 3);
if ($zuihou == '001') {
    $chai[0] = date('ymd', time() - 86400) . '120';
} else {
    $chai[0] = $chai[0] - 1;
}

$sql_shang = 'select * from ssc where status = 0 and periods = ' . $chai[0];
$shang     = $mysqli->query($sql_shang);
$shang_row = mysqli_fetch_array($shang, MYSQLI_ASSOC);
if ($shang_row == null) {
    exit;
}

//更新上一期
$kai      = explode(',', $chai[1]);
$wan_qian = $kai[0] . $kai[1];

$tuijian = explode(',', $shang_row['tuijian']);
if (in_array($wan_qian, $tuijian)) {
    $status = 1;
} else {
    $status = 2;
}

$up_sql = 'UPDATE `ssc` SET `status` = ' . $status . ' WHERE `ssc`.`periods` = ' . $chai[0];
$mysqli->query($up_sql);
