<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>
        <?php echo $number; ?>专区记录
    </h1>
    <p>
    <small></small>
    </p>
  </div>
</div>
<div class="container">
    <h3>
        <?php echo $win; ?>胜<?php echo $loss; ?>负
    </h3>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>期数</th>
                <th>时间</th>
                <th>开</th>
                <th>码组数</th>
                <th>结果</th>
            </tr>
            <?php foreach ($tj_new as $info) {?>
            <?php $kai = getInfo($info['period'], $mysqli);?>
            <tr class="<?php echo isset($win_tr_style[$info['win']]) ? $win_tr_style[$info['win']] : ''; ?>">
                <td><?php echo $info['period_actual']; ?></td>
                <td><?php echo date('Y-m-d', $info['open_time']); ?></td>
                <td><?php echo $kai['number'] ?: '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'; ?></td>
                <td>
                    <a href="60.php?tj=<?php echo $info['period']; ?>" ?>
                    <?php echo $info['count']; ?>
                    </a>
                </td>
                <td><?php echo isset($win_style[$info['win']]) ? $win_style[$info['win']] : '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'; ?></td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>
