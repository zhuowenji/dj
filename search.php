<?php
include 'config.php';
include 'function.php';

//获取所有数据
$mysqli = connect();
$kj     = getAll($mysqli);

foreach ($kj as $key => $value) {
    $y         = date('Y', strtotime($value['time']));
    $all[$y][] = $value;
}

//搜索处理
$da = ['3-5', '6-7'];
if (isset($_GET['put_tou']) && is_numeric($_GET['put_tou']) && isset($_GET['put_wei']) && is_numeric($_GET['put_wei'])) {
    $put[] = $_GET['put_tou'] . '-' . $_GET['put_wei'];
}

if (isset($_GET['number']) && !empty($_GET['number']) || isset($put)) {
    $is_tou = trimTou($_GET['number']);
    $number = trimall($is_tou);

    $da_arr = array_filter(explode(',', $number));
    $da     = isset($put) ? array_unique(array_merge($da_arr, $put)) : array_unique($da_arr);

    $re = [];
    foreach ($da as $value) {
        $tou_wei = explode('-', trim($value));
        if (count($tou_wei) == 1) {
            continue;
        }

        $tou = $tou_wei[0];
        $wei = $tou_wei[1];

        for ($i = 0; $i < strlen($tou); $i++) {
            $str_tou = substr($tou, $i, 1);
            if (is_numeric($str_tou)) {
                for ($w = 0; $w < strlen($wei); $w++) {
                    $str_wei = substr($wei, $w, 1);
                    if (is_numeric($str_wei)) {
                        $re[] = $str_tou . '-' . $str_wei;
                    }
                }
            }
        }
    }
    $da = array_unique($re);

    //纪录查询记录
    $ip     = $_SERVER['REMOTE_ADDR'];
    $da_log = json_encode($da);
    $sql    = "INSERT INTO `search_log` (`id`, `content`, `ip`, `time`) VALUES (NULL, ' " . $da_log . "', '" . $ip . "', CURRENT_TIMESTAMP);";
    $res    = $mysqli->query($sql);
    if ($res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }
}

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

include 'tmp/head.php';
include 'tmp/search_content.php';
include 'tmp/foot.php';
