<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>头尾神策</title>
        <link href="bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="function.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <div class="container">
            <h1>
                <font color="red"><?php echo $first['new']['number']; ?></font>
                <small>第<?php echo $first['new']['period']; ?>期 <?php echo $first['new']['time']; ?></small>

                <h4>
                <small>上期开<?php echo $first['new']['tou']; ?>头<?php echo $first['new']['wei']; ?>尾时间 <?php echo $first['old']['time']; ?> 中间相隔 <?php echo $first['diff']; ?> 期</small>
                </h4>
            </h1>

            <h3>头尾连续不开期数 <small>0表示本期开 未表示今年未开过</small></h3>
            <table class="table table-bordered">
                <th></th>
                <?php for ($i = 0; $i <= 9; $i++) {?>
                <th><?php echo $i; ?></th>
                <?php }?>

                <tr>
                    <td>头</td>
                    <?php for ($i = 0; $i <= 9; $i++) {?>
                        <?php $tou_wz = strpos($year_tou[$year]['number'], (string) $i);?>
                        <?php $tou_mk = $tou_wz === false ? '未' : $tou_wz;?>
                        <td><?php echo ($tou_mk === '未' || $tou_mk > 4) ? '<font color="red">' . $tou_mk . '</font>' : $tou_mk; ?></td>
                    <?php }?>
                </tr>
                <tr>
                    <td>尾</td>
                    <?php for ($i = 0; $i <= 9; $i++) {?>
                        <?php $wei_wz = strpos($year_wei[$year]['number'], (string) $i);?>
                        <?php $wei_mk = $wei_wz === false ? '未' : $wei_wz;?>
                        <td><?php echo ($wei_mk === '未' || $wei_mk > 4) ? '<font color="red">' . $wei_mk . '</font>' : $wei_mk; ?></td>
                    <?php }?>
                </tr>
            </table>

            <textarea  id="fztj"><?php echo $tuijian; ?></textarea>
            <h3>推荐60组头尾
                <small>
                    <a href="index.php?number=<?php echo $tuijian; ?>">点此查看概率</a>
                </small>

            </h3>
            <blockquote><p id="fz"><?php echo $tuijian; ?></p></blockquote>

            <h3>输入头尾号码</h3>
            <h5><small>3头5,6头7 单组模式：3-5,6-7,头尾模式：36-57</small></h5>
            <form method="get" action="index.php">
              <div class="form-group">
                <textarea id="textarea" class="form-control" rows="3" name="number"><?php echo isset($_GET['number']) && !empty($_GET['number']) ? $_GET['number'] : '3-5,6-7'; ?></textarea>
              </div>
              <button type="submit" class="btn btn-default">查询</button>
              <button type="button" onclick="ClearTextArea()" class="btn btn-default">清除</button>
            </form>

            <h3>查询结果 <small><?php echo count($da); ?> 组头尾</small></h3>

            <?php if (count($da) > 0) {?>
            <blockquote><p><?php echo implode(',', $da); ?></p></blockquote>
            <?php } else {?>
            <blockquote><font color="red">查询输入有误,请重新输入</font></blockquote>
            <?php }?>

            <h4></h4>
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
                        <?php echo $info['ljlxbz'] > 1 ? "连续 {$info['buzhong']} 期不中出现过 {$info['ljlxbz']} 次数" : ''; ?>
                    </td>
                </tr>
                <?php }?>
            </table>

            <h3>微信讨论群<small>手机端长按识别二维码</small></h3>
            <img src="sc.jpg" class="img-responsive" alt="Responsive image" />

            <h3> 近5年头尾各重复出现次数、比例(占比超全年10%以上标红) </h3>
            <table class="table table-bordered">
                <tr>
                    <th></th>
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
