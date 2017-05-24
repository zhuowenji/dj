<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>

<style type="text/css">
tr { padding:20px;}
p { height:150px; width:430px; border:2px solid red;padding: 10px;}
</style>

<body>

    <p>
    头尾：<b color="red"><?php echo implode(',', $da); ?></b>
    </p>

    <table border="1">
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
--------------------------头尾各重复出现次数(占比超全年10%以上标红)---------------------------------
    <table border="1">
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
</body>
</html>
