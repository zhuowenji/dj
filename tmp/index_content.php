<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1><?php echo $first['new']['number']; ?><small>第<?php echo $first['new']['period']; ?>期 <?php echo $first['new']['time']; ?></small></h1>
    <p>
        <small>上期开<?php echo $first['new']['tou']; ?>头<?php echo $first['new']['wei']; ?>尾时间 <?php echo $first['old']['time']; ?> 相隔 <?php echo $first['diff']; ?> 期</small>
    </p>
  </div>
</div>

<div class="container">
    <div class="bs-callout bs-callout-info" id="callout-tables-striped-ie8">
        <h4>头尾连续不开期数</h4>
        <p>0表示本期开 未表示今年未开过</p>
    </div>
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

    <h3><?php echo $year; ?>年记录 <small>今年剩余<?php echo $year_number; ?>次</small></h3>
    <table class="table table-bordered">
        <tr>
            <th>期数</th>
            <th>时间</th>
            <th>头-尾</th>
            <th>大码</th>
        </tr>
        <?php foreach ($all[$year] as $info) {?>
            <tr>
                <td><?php echo $info['period']; ?></td>
                <td><?php echo $info['time']; ?></td>
                <td><?php echo substr($info['number'], 0, 1) . '-' . substr($info['number'], 3, 1); ?></td>
                <td><?php echo substr($info['number'], 0, 4); ?></td>
            </tr>
        <?php }?>
    </table>

<!--
    <h3> 近5年头尾各重复出现次数 </h3>
    <table class="table table-bordered">
        <tr>
            <th></th>
            <th>年份／头次数</th>
            <th>年份／尾次数</th>
        </tr>
        <?php for ($i = 0; $i <= 9; $i++) {?>
        <tr>
            <td><?php echo $i; ?></td>
            <td>
                <?php for ($start_year = 2013; $start_year <= $year; $start_year++) {?>
                    <?php $tou = $year_tou[$start_year][$i];?>
                    <?php echo $start_year . '／' . $tou; ?>
                    <br/>
                <?php }?>
            </td>
            <td>
                <?php for ($start_year = 2013; $start_year <= $year; $start_year++) {?>
                    <?php $wei = $year_wei[$start_year][$i];?>
                    <?php echo $start_year . '／' . $wei; ?>
                    <br/>
                <?php }?>
            </td>
        </tr>
        <?php }?>
    </table>
-->
</div>
