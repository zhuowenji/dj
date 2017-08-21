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

    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>用户</th>
                <th>剩余</th>
                <th>已返</th>
                <th>投</th>
                <th>保本</th>
            </tr>
            <?php foreach ($niuren as $info) {?>
            <tr>
                <td><?php echo substr($info['phone'], 6); ?></td>
                <td><font color="red"><?php echo floor($info['residual_money']); ?></font></td>
                <td><?php echo floor($info['back_money']); ?></td>
                <td><?php echo floor($info['money']); ?></td>
                <td><?php echo floor(($info['money'] - $info['back_money']) * 0.7); ?></td>
            </tr>
            <?php }?>
        </table>
    </div>

</div>
