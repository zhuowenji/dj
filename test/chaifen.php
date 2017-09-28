
<form>

<input type="test" name="ma" value="<?php echo isset($_GET['ma']) ? $_GET['ma'] : ''; ?>">
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

echo substr($c, 0, -1);
?>
