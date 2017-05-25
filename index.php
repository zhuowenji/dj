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

foreach ($kj as $key => $value) {
    $y         = date('Y', strtotime($value['time']));
    $all[$y][] = $value;
}

//搜索处理
$da = ['3-5', '6-7'];
if (isset($_GET['number']) && !empty($_GET['number'])) {
    $number = trimall($_GET['number']);
    $da     = array_unique(array_filter(explode(',', $number)));

    //纪录查询记录
    $ip     = $_SERVER['REMOTE_ADDR'];
    $da_log = json_encode($da);
    $sql    = "INSERT INTO `search_log` (`id`, `content`, `ip`, `time`) VALUES (NULL, ' " . $da_log . "', '" . $ip . "', CURRENT_TIMESTAMP);";
    $mysqli->query($sql);
}

$year_tou = repeat($all, 0, 1);
$year_wei = repeat($all, 3, 1);

$data = [];
foreach ($all as $nian => $list) {

    $ljlxbz  = 1;
    $lxbz    = 0;
    $buzhong = 0;
    $zhong   = [];
    foreach ($list as $key => $value) {
        $tou     = substr($value['number'], 0, 1);
        $wei     = substr($value['number'], 3, 1);
        $dajiang = substr($value['number'], 0, 4);

        $touwei = $tou . '-' . $wei;

        if (!in_array($touwei, $da)) {
            //计算最长连续不中
            $lxbz = $lxbz + 1;
            if ($lxbz > $buzhong) {
                //累计连续不中最大次数重置
                $ljlxbz  = 1;
                $buzhong = $lxbz;
                $bzsj    = $value['time'];
            } elseif ($lxbz == $buzhong) {
                $ljlxbz++;
            }
        } else {
            //已中奖，重置连续中奖值
            $lxbz                  = 0;
            $zhong[$value['time']] = ['period' => $value['period'], 'number' => $dajiang];
        }
    }

    $data[$nian]['year']    = $nian;
    $data[$nian]['buzhong'] = $buzhong;
    $data[$nian]['bzsj']    = $bzsj;
    $data[$nian]['ljlxbz']  = $ljlxbz;
    $data[$nian]['kai']     = count($list);
    $data[$nian]['zhong']   = count($zhong);
    $data[$nian]['gailv']   = count($zhong) / count($list);
}

function repeat($kj, $start, $stop)
{
    $year = date('Y', time());

    $year_all = [];
    for ($i = 2010; $i <= $year; $i++) {
        $all = '';
        foreach ($kj[$i] as $info) {
            $tou = substr($info['number'], $start, $stop);
            $all .= $tou;
        }
        $year_all[$i] = $all;
    }

    $res = [];
    foreach ($year_all as $year => $number) {

        for ($i = 0; $i <= 9; $i++) {
            $res[$year][$i] = substr_count($number, $i);
        }
        $res[$year]['count'] = strlen($number);
    }

    return $res;
}

include 'html.php';
