<?php

//此函数可以去掉空格，及换行。
function trimall($str)
{
    $qian = [' ', '\r\n', '\r', '\n', '\'', '\t', '　', '，'];
    $hou  = ['', '', '', '', '', '', '', ','];
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

    $tuijian = '';
    arsort($str);
    foreach ($str as $value) {
        $tuijian .= $value . ',';
    }

    return $tuijian;
}
