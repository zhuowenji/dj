<?php

//获取所有开奖
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

/**
 *   推荐号码
 *   $kj 开的号码
 *   $qian2 去除前2期开过的
 */
function tuijian($kj, $qian)
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
        if ($value >= 9) {
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
        $jian[$tuijian_tou] = $tuijian_tou . '-' . $tuijian[$tuijian_tou];
    }

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
 * 每期稳赚算法
 * @param   $ms     打奖号码
 * @param   $mqz    每期要赚
 * @param   $qs     连打期数
 * @param   $peilv  赔率
 */
function Wenzhuantongji($ms = 40, $mqz = 300, $qs = 5, $peilv = 90)
{
    $list = [];

    $sunshi = 0;
    for ($i = 1; $i <= $qs; $i++) {
        //每码打奖组数
        $djzs = ceil(($sunshi + $mqz) / ($peilv - $ms));
        //花了的本
        $ben = $djzs * $ms;
        //损失
        $sunshi += $ben + $mqz;

        $list[$i]['djzs']   = $djzs;
        $list[$i]['qishu']  = $i;
        $list[$i]['sunshi'] = $sunshi;
        $list[$i]['ben']    = $ben;
        $list[$i]['zhuan']  = $sunshi - $ben;
    }

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

function getInfo($id, $mysqli)
{
    $kai['number'] = '';
    $kai['time']   = '';

    $sql = 'select number,time from kaijiang where id = ' . $id;
    $res = $mysqli->query($sql);
    if ($res === false) {
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
    }

    if ($mysqli->affected_rows) {
        $data          = $res->fetch_array();
        $kai['number'] = substr($data['number'], 0, 1) . '-' . substr($data['number'], 3, 1);
        $kai['time']   = $data['time'];
    }

    return $kai;
}
