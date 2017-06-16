<?php

//此函数可以去掉空格，及换行。
function trimall($str)
{
    $qian = [' ', '\'', '\t', '　', '，', PHP_EOL];
    $hou  = ['', '', '', '', ',', ''];
    return str_replace($qian, $hou, $str);
}

//推荐号码
function tuijian($kj)
{
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

    return $tj;
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
 * @param   $da     打奖号码
 * @param   $mqz    每期要赚
 * @param   $qs     连打期数
 * @param   $peilv  赔率
 */
function Wenzhuantongji($da, $mqz = 300, $qs = 5, $peilv = 90)
{
    $list = [];

    //码组数
    $mzs = count($da);

    $sunshi = 0;
    for ($i = 1; $i <= $qs; $i++) {
        //每码打奖组数
        $djzs = ceil(($sunshi + $mqz) / ($peilv - $mzs));
        //花了的本
        $ben = $djzs * $mzs;
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
