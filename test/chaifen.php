
<form>
单 模 式
<input type="test" name="ma" value="<?php echo isset($_GET['ma']) ? $_GET['ma'] : ''; ?>">
<button>提交</button>
</form>

<form>
头尾模式
<input type="test" name="tou" value="<?php echo isset($_GET['tou']) ? $_GET['tou'] : ''; ?>">
-
<input type="test" name="wei" value="<?php echo isset($_GET['wei']) ? $_GET['wei'] : ''; ?>">
<button>提交</button>
</form>


<form>
差异
<input type="test" name="chayi" value="<?php echo isset($_GET['chayi']) ? $_GET['chayi'] : ''; ?>">
<button>提交</button>
</form>


<?php

$chai = '';

if (isset($_GET['ma'])) {
    $chai = $_GET['ma'];
}

$ma = str_split($chai, 1);

$c = '';
foreach ($ma as $v) {
    foreach ($ma as $s) {
        if ($s != $v) {
            $c .= $v . $s . ',';
        }
    }
}

echo $c;
//-----------------------
//
//
$tou = '';
$wei = '';

if (isset($_GET['tou']) && isset($_GET['wei'])) {
    $tou = $_GET['tou'];
    $wei = $_GET['wei'];
}

$tou_ma = array_unique(str_split($tou));
$wei_ma = array_unique(str_split($wei));

sort($tou_ma);
sort($wei_ma);

$tou_wei = '';
foreach ($tou_ma as $v) {
    foreach ($wei_ma as $s) {
        if ($s != $v) {
            $tou_wei .= $v . $s . ',';
        }
    }
}

echo substr($tou_wei, 0, -1);

//------------
//
$fan = '';

$all     = '01,02,03,04,05,06,07,08,09,10,12,13,14,15,16,17,18,19,20,21,23,24,25,26,27,28,29,30,31,32,34,35,36,37,38,39,40,41,42,43,45,46,47,48,49,50,51,52,53,54,56,57,58,59,60,61,62,63,64,65,67,68,69,70,71,72,73,74,75,76,78,79,80,81,82,83,84,85,86,87,89,90,91,92,93,94,95,96,97,98,00,11,22,33,44,55,66,77,88,99';
$arr_all = explode(',', $all);

$chayi = [];
if (isset($_GET['chayi'])) {
    $chayi = explode(',', $_GET['chayi']);
    $fan   = array_diff($arr_all, $chayi);
    echo implode(',', $fan);
}

?>
