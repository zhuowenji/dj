<?php

include 'config.php';
include 'function.php';

//获取所有牛人数据
$mysqli = connect();
$niuren = getNiuren($mysqli, 'status ,back_money desc ,money desc');

include 'tmp/head.php';
include 'tmp/baoshou_content.php';
include 'tmp/foot.php';
