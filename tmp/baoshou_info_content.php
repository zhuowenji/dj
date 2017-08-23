<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>
        牛人榜
    </h1>
    <p>
    <small>牛人专享，保本70%，每月结算</small>
    </p>
  </div>
</div>
<div class="container">
    <h3><?php echo substr($niuren_info['phone'], 6); ?>记录 <small>剩余 <?php echo floatval($niuren_info['residual_money']); ?></small></h3>
    <table class="table">
        <tr>
            <th>期数</th>
            <th>打</th>
            <th>赔率</th>
            <th>收益</th>
            <th>剩余</th>
            <th>时间</th>
        </tr>
        <?php foreach ($niuren as $info) {?>
        <tr class="<?php echo $win_tr_style[$info['win']]; ?>">
            <?php if (empty($info['period'])) {?>
                <td colspan='3'><?php echo $info['money'] < 0 ? '结算' : '追加'; ?></td>
            <?php } else {?>
                <td><a href="/50.php?tj=<?php echo $info['tj_period']; ?>"><?php echo $info['period']; ?></td>
                <td><?php echo $info['mashu'] ? $info['mashu'] . '*' . $info['dazushu'] : ''; ?></td>
                <td><?php echo $info['peilv']; ?></td>
            <?php }?>
            <td><?php echo $info['money']; ?></td>
            <td><?php echo $info['residual_money']; ?></td>
            <td><?php echo date('y/m/d', $info['ctime']); ?></td>
        </tr>
        <?php }?>
    </table>
</div>
