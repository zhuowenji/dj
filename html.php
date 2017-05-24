<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link href="bootstrap.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <div class="container">

            <h3>输入头尾号码：<small>（如要搜索3头5尾请输入3-5，要搜索3头5,6头7两组号码请输入 3-5,6-7）</small></h3>
            <form method="get" action="index.php">
              <div class="form-group">
                <textarea class="form-control" rows="3" name="number"><?php echo isset($_GET['number']) && !empty($_GET['number']) ? $_GET['number'] : '3-5,6-7'; ?></textarea>
              </div>
              <button type="submit" class="btn btn-default">查询</button>
            </form>

            <h3>查询结果：</h3>
            <table class="table table-bordered">
                <tr>
                    <th>年份时间</th>
                    <th>开奖期数</th>
                    <th>中奖期数</th>
                    <th>中奖概率</th>
                    <th>连续不中期数</th>
                    <th>连续不中时间</th>
                    <th>连续不中期期数出现次数</th>
                    <th>打奖组数</th>
                </tr>
                <?php foreach ($data as $info) {?>
                <tr>
                    <td><?php echo $info['year']; ?></td>
                    <td><?php echo $info['kai']; ?></td>
                    <td><?php echo $info['zhong']; ?></td>
                    <td><?php echo sprintf('%.2f', $info['gailv'] * 100); ?>%</td>
                    <td><?php echo $info['buzhong']; ?></td>
                    <td><?php echo $info['bzsj']; ?></td>
                    <td><?php echo $info['ljlxbz']; ?></td>
                    <td><?php echo count($da); ?></td>
                </tr>
                <?php }?>
            </table>

            <h3> 头尾各重复出现次数(占比超全年10%以上标红) </h3>
            <table class="table table-bordered">
                <tr>
                    <th>码\年份</th>
                    <?php $year = date('Y', time());?>

                    <?php for ($i = 2010; $i <= $year; $i++) {?>
                    <th><?php echo $i; ?>(次数-比例)</th>
                    <?php }?>
                </tr>
                <?php for ($i = 0; $i <= 9; $i++) {?>
                <tr>
                    <td><?php echo $i; ?>(头,尾)</td>
                    <?php for ($start_year = 2010; $start_year <= $year; $start_year++) {?>
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
