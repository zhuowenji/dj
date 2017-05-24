<?php

$da = [];
if(isset($_GET['number']) && !empty($_GET['number'])){
    $number = trimall($_GET['number']);
    $da = array_unique(array_filter(explode(',', $number)));
}
 
$kj = all();

//分配好每个年
$all = [];
foreach ($kj as $key => $value) {
    $y         = date('Y', strtotime($value['time']));
    $all[$y][] = $value;
}

$year_tou = repeat($all, 0, 1);
$year_wei = repeat($all, 3, 1);
// var_dump($year_tou['2010']);die;

$data = [];
foreach ($all as $nian => $list) {

    $ljlxbz  = 0;
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
                //累计连续不中最大次数清0
                $ljlxbz  = 0;
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

function all()
{
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'fuxiben');
    //只能用函数来判断是否连接成功
    if (mysqli_connect_errno()) {
        echo mysqli_connect_error();
    }

    $sql = 'select * from kaijiang';
    $res = $mysqli->query($sql);

    if ($res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    mysqli_close($mysqli);

    $kj = [];
    while ($data = $res->fetch_array()) {
        $kj[] = $data;
    }

    return $kj;
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

//此函数可以去掉空格，及换行。
function trimall($str)
{
    $qian = [' ','/r/n','/r','/n','\'','/t','　','，'];
    $hou  = ['','','','','','','',','];
    return str_replace($qian,$hou,$str); 
}

include 'html.php';
