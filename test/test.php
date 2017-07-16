<?php

ini_set('date.timezone','Asia/Shanghai');

$time = strtotime('2017-07-16');
$num =  date("N",$time);
if($num == '7' || $num == '5'){
    $time  += 172800;
}elseif($num == '2'){
    $time  += 259200;
}

echo date('Y-m-d',$time);
