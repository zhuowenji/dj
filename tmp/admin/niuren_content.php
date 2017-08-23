<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h2>保收牛人列表</h2>
    <p><?php echo $_SESSION['username']; ?> </p>
  </div>
</div>

<div class="container">

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Id</th>
                <th>姓名</th>
                <th>手机</th>
                <th>剩余</th>
                <th>已返</th>
                <th>投</th>
                <th>保本</th>
                <th>时间</th>
                <th>操作</th>
            </tr>
            <?php foreach ($niuren as $info) {?>
            <tr>
                <td><?php echo $info['id']; ?></td>
                <td><?php echo $info['name']; ?></td>
                <td><?php echo $info['phone']; ?></td>
                <td><font color="red"><?php echo floor($info['residual_money']); ?></font></td>
                <td><?php echo floor($info['back_money']); ?></td>
                <td><?php echo floor($info['money']); ?></td>
                <td>
                <?php $yifan = $info['money'] - $info['back_money'];?>
                <?php echo $yifan > 0 ? floor($yifan) * 0.7 : 0; ?>
                </td>
                <td><?php echo date('Y-m-d', $info['ctime']); ?></td>
                <td>追加 提取 停止</td>
            </tr>
            <?php }?>
        </table>
    </div>

</div>
