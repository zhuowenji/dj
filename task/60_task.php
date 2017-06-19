<?php

include 'config.php';
include 'function.php';

$mysqli = connect();

//获取所有数据
$kj       = getAll($mysqli);
$kj_first = current($kj);
$kj_id    = $kj_first['id'];

//获取推荐的数据
$tj_sql = 'select * from tj order by id desc limit 1';
$tj_res = $mysqli->query($tj_sql);
if ($mysqli->affected_rows) {

    $tj = $tj_res->fetch_array();
    if ($kj_id == $tj['period']) {

        //获取本期开的头尾
        $kai = substr($kj_first['number'], 0, 1) . '-' . substr($kj_first['number'], 3, 1);

        //获取本期打的头尾
        $da = array_unique(array_filter(explode(',', $tj['number'])));
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

        //对比是否命中
        if (in_array($kai, $da)) {
            $win = 1; //命中
        } else {
            $win = 2; //不中
        }

        $up_sql = 'UPDATE `tj` SET `win` = ' . $win . ' WHERE `period` = ' . $tj['period'] . ';';
        $tj_up  = $mysqli->query($up_sql);
        if ($tj_up === false) {
            var_dump($mysqli->errno);
            var_dump($mysqli->error);
        }
    }
}

//推荐号码
$qian       = array_splice($kj, 0, 3);
$tuijian    = tuijian($kj, $qian);
$new_period = $kj_id + 1;

$tj_install = 'INSERT INTO `tj` (`number`, `count`, `period`, `win`, `create_time`) VALUES ("' . $tuijian['number'] . '", ' . $tuijian['number_count'] . ', ' . $new_period . ', NULL, ' . time() . ');';
$install    = $mysqli->query($tj_install);
if ($install === false) {
    var_dump($mysqli->errno);
    var_dump($mysqli->error);
}
