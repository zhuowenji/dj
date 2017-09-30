
<form>

<input type="test" name="ma" value="<?php echo isset($_GET['ma']) ? $_GET['ma'] : ''; ?>">
<button>提交</button>
</form>

<form>

<input type="test" name="tou" value="<?php echo isset($_GET['tou']) ? $_GET['tou'] : ''; ?>">
-
<input type="test" name="wei" value="<?php echo isset($_GET['wei']) ? $_GET['wei'] : ''; ?>">
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

?>
