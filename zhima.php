<?php

include 'config.php';
include 'function.php';

//获取所有数据
$mysqli = connect();
$kj     = getAll($mysqli);

//取最新一期
$first = getFirstInfo($kj);

//当前年份
$year = date('Y', time());

$qian = [];
$bai  = [];
$shi  = [];
$ge   = [];

foreach ($kj as $key => $value) {

    $qian[] = substr($value['number'], 0, 1);
    $bai[]  = substr($value['number'], 1, 1);
    $shi[]  = substr($value['number'], 2, 1);
    $ge[]   = substr($value['number'], 3, 1);

    $y         = date('Y', strtotime($value['time']));
    $all[$y][] = $value;
}

//每码距离当前多少期不开
$year_qian = repeat($all, 0, 1, $year);
$year_bai  = repeat($all, 1, 1, $year);
$year_shi  = repeat($all, 2, 1, $year);
$year_ge   = repeat($all, 3, 1, $year);

//直码计算
$sha_liu = [];
if ($qian['0'] == $qian['1']) {
    $sha_liu['sha_qian'] = $qian['0'];
} else {
    $sha_liu['liu_qian'] = $qian['0'];
}

if ($bai['0'] == $bai['1']) {
    $sha_liu['sha_bai'] = $bai['0'];
} else {
    $sha_liu['liu_bai'] = $bai['0'];
}

if ($shi['0'] == $shi['1']) {
    $sha_liu['sha_shi'] = $shi['0'];
} else {
    $sha_liu['liu_shi'] = $shi['0'];
}

if ($ge['0'] == $ge['1']) {
    $sha_liu['sha_ge'] = $ge['0'];
} else {
    $sha_liu['liu_ge'] = $ge['0'];
}

$zhima         = [];
$zhima['qian'] = array_count_values($qian);
$zhima['bai']  = array_count_values($bai);
$zhima['shi']  = array_count_values($shi);
$zhima['ge']   = array_count_values($ge);

$dama = zhima($zhima, $sha_liu);

function zhima($zhima, $sha_liu, $number = 4)
{

    arsort($zhima['qian']);
    arsort($zhima['bai']);
    arsort($zhima['shi']);
    arsort($zhima['ge']);

    if (isset($sha_liu['sha_qian'])) {
        unset($zhima['qian'][$sha_liu['sha_qian']]);
    }

    if (isset($sha_liu['sha_bai'])) {
        unset($zhima['bai'][$sha_liu['sha_bai']]);
    }

    if (isset($sha_liu['sha_shi'])) {
        unset($zhima['shi'][$sha_liu['sha_qian']]);
    }

    if (isset($sha_liu['sha_ge'])) {
        unset($zhima['ge'][$sha_liu['sha_qian']]);
    }

    $qian = array_slice(array_keys($zhima['qian']), 0, $number);
    $bai  = array_slice(array_keys($zhima['bai']), 0, $number);
    $shi  = array_slice(array_keys($zhima['shi']), 0, $number);
    $ge   = array_slice(array_keys($zhima['ge']), 0, $number);

    asort($qian);
    asort($bai);
    asort($shi);
    asort($ge);

    $dama         = [];
    $dama['qian'] = implode('', $qian);
    $dama['bai']  = implode('', $bai);
    $dama['shi']  = implode('', $shi);
    $dama['ge']   = implode('', $ge);

    var_dump($dama);
    return $dama;
}

include 'tmp/head.php';
include 'tmp/zhima_content.php';
include 'tmp/foot.php';
