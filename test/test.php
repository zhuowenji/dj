<?php

include 'config.php';
include 'function.php';

//连接获取数据
$mysqli = connect();
$sql    = 'select * from kaijiang order by id desc';
$res    = $mysqli->query($sql);
if ($res === false) {
    var_dump($mysqli->errno);
    var_dump($mysqli->error);
}

$kj = [];
while ($data = $res->fetch_array()) {
    $kj[] = $data;
}

$all = [];
foreach ($kj as $key => $value) {
    $tou   = substr($value['number'], 0, 1);
    $wei   = substr($value['number'], 3, 1);
    $all[] = $tou . '-' . $wei;
}

$unique = array_unique($all);

$count = [];
foreach ($unique as $unique_val) {
    $i = 0;
    foreach ($all as $value) {
        if ($unique_val == $value) {
            $i++;
        }
    }
    $count[$unique_val] = $i;
}

arsort($count);
$str = [];
foreach ($count as $key => $value) {
    if ($value > 10) {
        $str[] = $key;
    }
}

arsort($str);
$tuijian = [];
for ($i = 0; $i <= 9; $i++) {
    $tuijian[$i] = '';
}

$jian = [];
foreach ($str as $value) {
    $tuijian_tou = substr($value, 0, 1);
    $tuijian_wei = substr($value, 2, 1);

    $tuijian[$tuijian_tou] .= $tuijian_wei;
    $jian[$tuijian_tou] = $tuijian_tou . '-' . $tuijian[$tuijian_tou];
}

$tj = '';
foreach ($jian as $value) {
    $tj .= $value . ',';
}
echo $tj;