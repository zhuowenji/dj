<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1><?php echo $first['new']['number']; ?><small>第<?php echo $first['new']['period']; ?>期 <?php echo $first['new']['time']; ?></small></h1>
    <p>
        <small>直码专区</small>
    </p>
  </div>
</div>

<div class="container">
    <div class="bs-callout bs-callout-info" id="callout-tables-striped-ie8">
        <h4>直码千百十个位连续不开期数</h4>
        <p>0表示本期开 未表示今年未开过</p>
    </div>
        <table class="table table-bordered">
            <th></th>
            <?php for ($i = 0; $i <= 9; $i++) {?>
            <th><?php echo $i; ?></th>
            <?php }?>
            <tr>
                <td>千</td>
                <?php for ($i = 0; $i <= 9; $i++) {?>
                    <?php $qian_wz = strpos($year_qian[$year]['number'], (string) $i);?>
                    <?php $qian_mk = $qian_wz === false ? '未' : $qian_wz;?>
                    <td><?php echo ($qian_mk === '未' || $qian_mk > 4) ? '<font color="red">' . $qian_mk . '</font>' : $qian_mk; ?></td>
                <?php }?>
            </tr>
            <tr>
                <td>百</td>
                <?php for ($i = 0; $i <= 9; $i++) {?>
                    <?php $bai_wz = strpos($year_bai[$year]['number'], (string) $i);?>
                    <?php $bai_mk = $bai_wz === false ? '未' : $bai_wz;?>
                    <td><?php echo ($bai_mk === '未' || $bai_mk > 4) ? '<font color="red">' . $bai_mk . '</font>' : $bai_mk; ?></td>
                <?php }?>
            </tr>
            <tr>
                <td>十</td>
                <?php for ($i = 0; $i <= 9; $i++) {?>
                    <?php $shi_wz = strpos($year_shi[$year]['number'], (string) $i);?>
                    <?php $shi_mk = $shi_wz === false ? '未' : $shi_wz;?>
                    <td><?php echo ($shi_mk === '未' || $shi_mk > 4) ? '<font color="red">' . $shi_mk . '</font>' : $shi_mk; ?></td>
                <?php }?>
            </tr>
            <tr>
                <td>个</td>
                <?php for ($i = 0; $i <= 9; $i++) {?>
                    <?php $ge_wz = strpos($year_ge[$year]['number'], (string) $i);?>
                    <?php $ge_mk = $ge_wz === false ? '未' : $ge_wz;?>
                    <td><?php echo ($ge_mk === '未' || $ge_mk > 4) ? '<font color="red">' . $ge_mk . '</font>' : $ge_mk; ?></td>
                <?php }?>
            </tr>
        </table>
</div>
