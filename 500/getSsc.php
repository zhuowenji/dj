<?php

include '/project/fuxiben/config.php';
include '/project/fuxiben/function.php';

//获取号码
$url = 'http://buy.cqcp.net/trend/ssc/scchart_11.aspx';
$get = file_get_contents($url);

$content = iconv('UTF-8', 'GB2312//IGNORE', $get);

$dian = '.';
for ($i = 1; $i < 1002; $i++) {
    $dian .= '.';
}

$preg = '/var Con_BonusCode ' . $dian . '/i';
preg_match($preg, $content, $data);

$new = str_replace(['"', ';'], ['', ''], substr($data[0], -20));

$chai = explode('=', $new);

//数据库操作
$time = date('Y-m-d H:i:s', time());

$mysqli = connect();

$sql = 'select * from ssc  where periods = ' . $chai[0];
$res = $mysqli->query($sql);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
if ($row != null) {
    //存在推荐号码才去更新状态
    $status = 0;
    if (!empty($row['tuijian'])) {
        $kai = explode(',', $chai[1]);

        $wan_qian = $kai[0] . $kai[1];

        $tuijian = explode(',', $row['tuijian']);
        if (in_array($wan_qian, $tuijian)) {
            $status = 1;
        } else {
            $status = 2;
        }
    }
    $up_sql = 'UPDATE `ssc` SET `status` = ' . $status . ',`number` = "' . $chai[1] . '" WHERE `ssc`.`periods` = ' . $chai[0];
    $mysqli->query($up_sql);
} else {
    $sql = "INSERT INTO `ssc` (`id`, `number`, `periods`, `tuijian`, `status`, `time`) VALUES (NULL, '" . $chai[1] . "','" . $chai[0] . "', NULL, '0', '" . $time . "');";
    $mysqli->query($sql);
}

//更新下一期
$zuihou = substr($chai[0], -3, 3);
if ($zuihou == '120') {
    $chai[0] = date('ymd', time() + 86400) . '001';
} else {
    $chai[0] = $chai[0] + 1;
}

$xia_qi  = 'select * from ssc  where  number is null and periods = ' . $chai[0];
$xia_res = $mysqli->query($xia_qi);
$xia_row = mysqli_fetch_array($xia_res, MYSQLI_ASSOC);
if ($xia_row != null) {
    exit;
}
//这时候要加入号码
$tuijian = '01,02,03,04,05,06,08,09,10,11,12,14,16,17,19,20,21,22,23,24,25,29,30,31,32,33,35,36,37,38,40,41,42,43,44,47,48,50,51,53,56,58,59,60,61,62,63,64,68,69,70,71,72,73,74,75,76,79,80,81,82,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99';

$sql = "INSERT INTO `ssc` (`id`, `number`, `periods`, `tuijian`, `status`, `time`) VALUES (NULL, NULL,'" . $chai[0] . "', '" . $tuijian . "', '0', '" . $time . "');";
$mysqli->query($sql);
