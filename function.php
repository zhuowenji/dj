<?php

//baoshou
$baoshou_tr_style = [
    1 => 'warning',
    2 => 'danger',
];

//获取所有牛人
function getNiuren($mysqli, $orderBy = 'id')
{

    $sql = 'select * from niuren order by ' . $orderBy;
    $res = $mysqli->query($sql);
    if ($res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    $niuren = [];
    while ($data = $res->fetch_array()) {
        $niuren[] = $data;
    }

    return $niuren;
}

//通过ID获取用户信息
function getNiurenInfo($mysqli, $id)
{
    $sql = 'select * from niuren where id = ' . $id;
    $res = $mysqli->query($sql);
    if ($res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    return $res->fetch_array();
}

//获取所有牛人明细
function getNiurenInstallments($mysqli, $id)
{
    $sql = 'select * from niuren_installments where niuren_id = ' . $id . ' order by id desc';
    $res = $mysqli->query($sql);
    if ($res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    $niuren = [];
    while ($data = $res->fetch_array()) {
        $niuren[] = $data;
    }

    return $niuren;
}

//获取所有开码
function getAll($mysqli)
{
    $sql = 'select * from kaijiang order by id desc';
    $res = $mysqli->query($sql);
    if ($res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    $kj = [];
    while ($data = $res->fetch_array()) {
        $kj[] = $data;
    }

    return $kj;
}

//此函数可以去掉空格，及换行。
function trimall($str)
{
    $qian = [' ', '\'', '\t', '　', '，', PHP_EOL];
    $hou  = ['', '', '', '', ',', ''];
    return str_replace($qian, $hou, $str);
}

//把头字替换成-
function trimTou($str)
{
    return str_replace('头', '-', $str);
}

/**
 *   推荐60码
 *   $kj 开的号码
 *   $qian2 去除前2期开过的
 */
function SixtyTuijian($kj, $qian)
{
    $all = [];
    foreach ($kj as $key => $value) {
        $tou   = substr($value['number'], 0, 1);
        $wei   = substr($value['number'], 3, 1);
        $all[] = $tou . '-' . $wei;
    }

    $qcq = [];
    foreach ($qian as $key => $value) {
        $tou   = substr($value['number'], 0, 1);
        $wei   = substr($value['number'], 3, 1);
        $qcq[] = $tou . '-' . $wei;
    }

    $unique = array_unique($all);
    $new_kj = array_diff($unique, $qcq);

    $count = [];
    foreach ($new_kj as $unique_val) {
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
        if ($value > 11) {
            $str[] = $key;
        }
    }

    //统计个数
    $number_count = (count($str));

    arsort($str);
    $tuijian = [];
    for ($i = 0; $i <= 10; $i++) {
        $tuijian[$i] = '';
    }

    $jian = [];
    foreach ($str as $value) {
        $tuijian_tou = substr($value, 0, 1);
        $tuijian_wei = substr($value, 2, 1);

        $tuijian[$tuijian_tou] .= $tuijian_wei;
        $t = str_split($tuijian[$tuijian_tou]);
        sort($t);
        $jian[$tuijian_tou] = $tuijian_tou . '-' . join('', $t);
    }

    ksort($jian);
    $tj = '';
    foreach ($jian as $value) {
        $tj .= $value . ',';
    }

    return ['number' => $tj, 'number_count' => $number_count];
}

/**
 *   推荐40码
 *   $kj 开的号码
 *   $qian2 去除前2期开过的
 */
function fortyTuijian($kj, $qian)
{
    $all = [];
    foreach ($kj as $key => $value) {
        $tou   = substr($value['number'], 0, 1);
        $wei   = substr($value['number'], 3, 1);
        $all[] = $tou . '-' . $wei;
    }

    $qcq = [];
    foreach ($qian as $key => $value) {
        $tou   = substr($value['number'], 0, 1);
        $wei   = substr($value['number'], 3, 1);
        $qcq[] = $tou . '-' . $wei;
    }

    $unique = array_unique($all);
    $new_kj = array_diff($unique, $qcq);

    $count = [];
    foreach ($new_kj as $unique_val) {
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
        if ($value > 11) {
            $str[] = $key;
        }
    }

    //统计个数
    $number_count = (count($str));

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
        $t = str_split($tuijian[$tuijian_tou]);
        sort($t);
        $jian[$tuijian_tou] = $tuijian_tou . '-' . join('', $t);
    }

    ksort($jian);
    $tj = '';
    foreach ($jian as $value) {
        $tj .= $value . ',';
    }

    return ['number' => $tj, 'number_count' => $number_count];
}

//取最新一期的号码，和上一次时间
function getFirstInfo($kj)
{
    $kai['new'] = [];
    $i          = 0;

    foreach ($kj as $value) {

        if (!isset($kai['new']['id'])) {
            $kai['new']['id']     = $value['id'];
            $kai['new']['period'] = $value['period'];
            $kai['new']['time']   = $value['time'];
            $kai['new']['number'] = substr($value['number'], 0, 4);
            $kai['new']['tou']    = substr($value['number'], 0, 1);
            $kai['new']['wei']    = substr($value['number'], 3, 1);
        } elseif (!isset($kai['old']) && $kai['new']['tou'] == substr($value['number'], 0, 1) && $kai['new']['wei'] == substr($value['number'], 3, 1)) {
            $kai['old']['id']     = $value['id'];
            $kai['old']['period'] = $value['period'];
            $kai['old']['time']   = $value['time'];
            $kai['old']['number'] = substr($value['number'], 0, 4);
            $kai['old']['tou']    = substr($value['number'], 0, 1);
            $kai['old']['wei']    = substr($value['number'], 3, 1);

            $kai['diff'] = $i;
        } else {
            $i++;
        }
    }

    return $kai;
}

/**
 * 每期倍投稳赚算法
 * @param   $ms     打奖号码
 * @param   $mqz    每期要赚
 * @param   $qs     连打期数
 * @param   $peilv  赔率
 */
function beiTou($ms = 60, $mqz = 300, $qs = 3, $peilv = 90)
{
    $list   = [];
    $sunshi = 0;
    $ztz    = 0;
    for ($i = 1; $i <= $qs + 1; $i++) {
        //每码打奖组数
        $djzs = ceil(($sunshi + $mqz) / ($peilv - $ms));
        //花了的本
        $ben = $djzs * $ms;
        //损失
        $sunshi += $ben + $mqz;

        $list['info'][$i]['djzs']   = $djzs;
        $list['info'][$i]['qishu']  = $i;
        $list['info'][$i]['sunshi'] = $sunshi;
        $list['info'][$i]['ben']    = $ben;
        $list['info'][$i]['zhuan']  = $sunshi - $ben;

        $ztz += $ben;
    }

    $list['qs']  = $qs;
    $list['ztz'] = $ztz;
    $list['zz']  = ($qs + 1) * $mqz;
    $list['sl']  = round(1 / ($qs + 1) * 100, 2) . '%';

    return $list;
}

/**
 * 每期不倍投稳赚算法
 * @param   $ms     打奖号码
 * @param   $mqz    每期要赚
 * @param   $qs     连打期数
 * @param   $peilv  赔率
 */
function lianGen($ms = 60, $mqz = 300, $qs = 3, $peilv = 90)
{
    //第一期
    $one = ceil($mqz / ($peilv - $ms)) * $ms;

    //第二期
    $two = $one * 2;

    if ($qs > 1) {
        //之后
        $after = $two * 2;

        //除了第一期之后还多少期没中
        $hai = $qs - 2;

        //剩余不中金额
        $sy_je = $hai * $after;

        //加上需要赚的
        $kui = $one + $two + $sy_je + ($qs * $mqz);

        //后面每期赚多少
        $mq_zhuan = $after / $ms * $peilv - $after;

    } else {

        $sy_je    = 0;
        $after    = 0;
        $kui      = $one + ($qs * $mqz);
        $mq_zhuan = $two / $ms * $peilv - $two;
    }

    //算出需要多少期持平之前的损失
    $qs_bu = ceil($kui / ($mq_zhuan - $mqz));

    //总期数
    $zqs = $qs + $qs_bu;

    $list = [];
    for ($i = 1; $i <= $zqs; $i++) {

        $list['info'][$i]['qs'] = $i;
        if ($i == 1) {
            $list['info'][$i]['da']      = $one;
            $list['info'][$i]['mmzs']    = $one / $ms;
            $list['info'][$i]['zhongde'] = $one / $ms * $peilv;
            $list['info'][$i]['zhuan']   = $mqz;
        } elseif ($i == 2 || $qs == 1) {
            $list['info'][$i]['da']      = $two;
            $list['info'][$i]['mmzs']    = $two / $ms;
            $list['info'][$i]['zhongde'] = $two / $ms * $peilv;
            $list['info'][$i]['zhuan']   = $mqz * 2;
        } else {
            $list['info'][$i]['da']      = $after;
            $list['info'][$i]['mmzs']    = $after / $ms;
            $list['info'][$i]['zhongde'] = $after / $ms * $peilv;
            $list['info'][$i]['zhuan']   = $mq_zhuan;
        }
    }

    $list['qs']  = $qs;
    $list['zqs'] = $zqs;
    $list['zz']  = $zqs * $mqz;
    $list['ztz'] = $one + $two + $after + $sy_je;
    $list['sl']  = round(($zqs - $qs) / $zqs * 100, 2) . '%';

    return $list;
}

function repeat($kj, $start, $stop, $year)
{
    $year_all = [];
    for ($i = 2011; $i <= $year; $i++) {
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

        $res[$year]['number'] = $number;
        $res[$year]['count']  = strlen($number);
    }

    return $res;
}

// 获取单条开码记录
function getInfo($id, $mysqli)
{
    $kai['number'] = '';
    $kai['time']   = '';
    $kai['period'] = '';

    $sql = 'select number,time,period from kaijiang where id = ' . $id;
    $res = $mysqli->query($sql);
    if ($res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    if ($mysqli->affected_rows) {
        $data          = $res->fetch_array();
        $kai['number'] = substr($data['number'], 0, 1) . '-' . substr($data['number'], 3, 1);
        $kai['time']   = $data['time'];
        $kai['period'] = $data['period'];
    }

    return $kai;
}

// 获取网站安全运行时间
function runtime()
{
    $time = (time() - strtotime('2017-5-25')) / 86400;

    return ceil($time);
}

// 获取一年的开次数
function yearNumber()
{
    $year = date('Y', time());
    $day  = 0;
    for ($i = 1; $i <= 12; $i++) {
        $now_month = $year . '-' . $i . '-01';
        $day += date('t', strtotime($now_month));
    }

    $for_day = $day - 1;
    $number  = 0;
    $kj      = [2, 5, 7];
    for ($i = 0; $i <= $for_day; $i++) {
        $year_one = strtotime($year . '-01-01 00:00:00');
        $year_day = $year_one + ($i * 86400);

        if (in_array(date('N', $year_day), $kj)) {
            $number++;
        }
    }

    return $number;
}
