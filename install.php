<?php

include 'config.php';
include 'function.php';

//连接获取数据
$mysqli = connect();

//获取开奖时间
$day = date('Y-m-d', time());
if (isset($_POST['date']) && !empty($_POST['date'])) {
    $day = $_POST['date'];
}

//最新一期期数
$last = 'select period from kaijiang order by id desc limit 1';
$res  = $mysqli->query($last);
if ($res === false) {
    var_dump($mysqli->errno);
    var_dump($mysqli->error);
}

while ($data = $res->fetch_assoc()) {
    $period = $data['period'];
}

$new_period = $period + 1;

if (isset($_POST['number']) && !empty($_POST['number']) && is_numeric($_POST['number'])) {
    $number = $_POST['number'];
    $sql    = 'INSERT INTO `kaijiang` (`id`, `time`, `period`, `number`) VALUES (1136, ' . "'" . $day . "'" . ", $new_period, $number)";

    if ($mysqli->query($sql) === false) {
        $msg = '添加失败';
        var_dump($mysqli->errno);
        var_dump($mysqli->error);
        echo $sql;
    } else {
        $msg = '添加成功';
        include 'task/60_task.php';
        include 'task/40_task.php';
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>头尾神策</title>
        <link href="bootstrap.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
	<body>
	    <div class="container">
	   		<h1>头尾神策-add</h1>
	   		<?php echo isset($msg) ? '<h3>' . $msg . '</h3>' : ''; ?>
			<form method="post">
				  <div class="form-group">
				    <label for="exampleInputEmail1">输入号码</label>
				    <input type="text" name="number" class="form-control" id="exampleInputEmail1" placeholder="Number">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">输入时间</label>
				    <input type="text" name="date" class="form-control" id="exampleInputEmail1" placeholder="<?php echo $day; ?>">
				  </div>
				  <button type="submit" class="btn btn-default">添加</button>
			</form>
		 </div>
	</body>
</html>
