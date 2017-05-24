<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link href="bootstrap.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <div class="container">

            <h3>输入头尾号码：<small>（搜索3头5,6头7 输入格式 3-5,6-7）</small></h3>
            <form method="get" action="index.php">
              <div class="form-group">
                <textarea class="form-control" rows="3" name="number"><?php echo isset($_GET['number']) && !empty($_GET['number']) ? $_GET['number'] : '3-5,6-7'; ?></textarea>
              </div>
              <button type="submit" class="btn btn-default">查询</button>
            </form>

            <h3>查询结果：<small>（<?php echo count($da) ?> 组头尾）</small></h3>
            <table class="table table-bordered">
                <tr>
                    <th>年份时间</th>
                    <th>开奖次数</th>
                    <th>中奖次数</th>
                    <th>中奖概率</th>
                    <th>最大连续不中次数</th>
                </tr>
                <?php foreach ($data as $info) {?>
                <tr>
                    <td><?php echo $info['year']; ?></td>
                    <td><?php echo $info['kai']; ?></td>
                    <td><?php echo $info['zhong']; ?></td>
                    <td><?php echo sprintf('%.2f', $info['gailv'] * 100); ?>%</td>
                    <td>
                        <?php echo $info['buzhong']; ?><br/>
                        时间： <?php echo $info['bzsj']; ?><br/>
                        <?php echo $info['ljlxbz'] > 1 ? "连续 {$info['buzhong']} 期不中出现过 {$info['ljlxbz']} 次数" : ""?>
                    </td>
                </tr>
                <?php }?>
            </table>

            <h3> 近5年头尾各重复出现次数、比例(占比超全年10%以上标红) </h3>
            <table class="table table-bordered">
                <tr>
                    <th>\</th>
                    <?php $year = date('Y', time());?>

                    <?php for ($i = 2013; $i <= $year; $i++) {?>
                    <th><?php echo $i; ?></th>
                    <?php }?>
                </tr>
                <?php for ($i = 0; $i <= 9; $i++) {?>
                <tr>
                    <td><?php echo $i; ?>(头,尾)</td>
                    <?php for ($start_year = 2013; $start_year <= $year; $start_year++) {?>
                    <td>
                        <?php $tou       = $year_tou[$start_year][$i];?>
                        <?php $tou_gailv = sprintf('%.2f', $tou / $year_tou[$start_year]['count'] * 100);?>

                        <?php echo $tou_gailv > 10 ? '<font color="red">' . $tou . '-' . $tou_gailv . '%</font>' : $tou . '-' . $tou_gailv . '%'; ?>
                        <br/>
                        <?php $wei       = $year_wei[$start_year][$i];?>
                        <?php $wei_gailv = sprintf('%.2f', $wei / $year_tou[$start_year]['count'] * 100);?>

                       <?php echo $wei_gailv > 10 ? '<font color="red">' . $wei . '-' . $wei_gailv . '%</font>' : $wei . '-' . $wei_gailv . '%'; ?>
                        <br/>
                    </td>
                    <?php }?>
                </tr>
                <?php }?>
            </table>

        </dev>
    </body>
</html>
