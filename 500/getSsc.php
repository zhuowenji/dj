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

$new  = str_replace(['"', ';'], ['', ''], substr($data[0], -20));
$chai = explode('=', $new);

//数据库操作
$time = date('Y-m-d H:i:s', time());

$mysqli = connect();

$sql = 'select * from ssc  where  number is null and periods = ' . $chai[0];
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
}

//更新下一期
$zuihou = substr($chai[0], -3, 3);
if ($zuihou == '120') {
    $chai[0] = date('ymd', time()) . '001';
} else {
    $chai[0] = $chai[0] + 1;
}

$xia_qi  = 'select * from ssc  where  number is null and periods = ' . $chai[0];
$xia_res = $mysqli->query($xia_qi);
$xia_row = mysqli_fetch_array($xia_res, MYSQLI_ASSOC);
if ($xia_row != null) {
    exit;
}

//获取推荐码
$tuijian_sql = 'select number from ssc where number is not null  order by id desc limit 20';
$tuijian_res = $mysqli->query($tuijian_sql);

$tuijian_unmber = [];
while ($info = $tuijian_res->fetch_array()) {
    $tuijian_unmber[] = $info;
}

$number = '';
foreach ($tuijian_unmber as $info) {
    $number .= substr($info['number'], 0, 3) . ',';
}

//去除最近出现过的一个值
$sub_quchu = substr($number, 0, 3);
$rep_quchu = str_replace(',', '', $sub_quchu);

$suoyou = explode(',', $number);

$tiqu = [];
foreach ($suoyou as $v) {
    if (in_array($v, $tiqu) || count($tiqu) == 8) {
        continue;
    }

    $tiqu[] = $v;
}
sort($tiqu);

$tuijian = '';
foreach ($tiqu as $v) {
    foreach ($tiqu as $s) {
        if ($s != $v) {
            $xuyao = $v . $s;
            if ($xuyao != $rep_quchu) {
                $tuijian .= $xuyao . ',';
            }
        }
    }
}

$sql = "INSERT INTO `ssc` (`id`, `number`, `periods`, `tuijian`, `status`, `time`) VALUES (NULL, NULL,'" . $chai[0] . "', '" . $tuijian . "', '0', '" . $time . "');";
$mysqli->query($sql);