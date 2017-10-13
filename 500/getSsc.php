<?php

date_default_timezone_set('PRC');
$hous    = date('H', time());
$zx_time = ['02', '03', '04', '05', '06', '07', '08', '09'];

if (in_array($hous, $zx_time)) {
    echo '时间未到';
    die;
}

$end_time = strtotime(date('Y-m-d 2:00', time()));
$now_time = time();

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
    $status    = 0;
    $status_40 = 0;

    $kai      = explode(',', $chai[1]);
    $wan_qian = $kai[0] . $kai[1];

    //更新默认55组
    if (!empty($row['tuijian'])) {
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
$tuijian_sql = 'select number from ssc where number is not null  order by id desc limit 15';
$tuijian_res = $mysqli->query($tuijian_sql);

$tuijian_unmber = [];
while ($info = $tuijian_res->fetch_array()) {
    $tuijian_unmber[] = $info;
}

$number = '';
$wan    = '';
$qian   = '';
foreach ($tuijian_unmber as $info) {
    //混合
    $number .= substr($info['number'], 0, 3) . ',';
}

//去除最近出现过的一个值
$sub_quchu = substr($number, 0, 3);
$rep_quchu = str_replace(',', '', $sub_quchu);

//混合
$suoyou = explode(',', $number);

$tiqu = [];
// $qian6 = [];
// $hou4  = [];
// foreach ($suoyou as $v) {
//     if (!in_array($v, $qian6) && count($qian6) < 6) {
//         $qian6[] = $v;
//     } elseif (!in_array($v, $qian6) && !in_array($v, $hou4)) {
//         $hou4[] = $v;
//     }
// }

// $hou4 = array_slice($hou4, -3, 3);
// $tiqu = array_merge($qian6, $hou4);
//
// sort($tiqu);
// unset($tiqu[0]);

foreach ($suoyou as $v) {
    if (!in_array($v, $tiqu) && count($tiqu) < 8) {
        $tiqu[] = $v;
    }
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

$tuijian = substr($tuijian, 0, -1);

if ($chai[0] > 1) {
    $sql = "INSERT INTO `ssc` (`id`, `number`, `periods`, `tuijian`,`status`,`time`) VALUES (NULL, NULL,'" . $chai[0] . "', '" . $tuijian . "','0','" . $time . "');";
    $mysqli->query($sql);
}
