<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h2>保收牛人列表</h2>
    <p><?php echo $_SESSION['username']; ?> </p>
  </div>
</div>

<script type="text/javascript">
    $('#myAlert').on('closed.bs.alert', function () {
  // do something…
   $().alert('close')

})
</script>

<div class="container">

    <a class="btn btn-default" href="niuren_up.php" >更新</a>
    <a class="btn btn-default" href="niuren_add.php" >新增</a>
    <p></p>
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
            <tr class="<?php echo $baoshou_tr_style[$info['status']]; ?>">
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
                <td>
                    <?php if ($info['status'] == 0) {?>
                        <a href="" class="btn btn-primary btn-sm" >追加</a>
                        <a href="" class="btn btn-warning btn-sm" >提取</a>
                        <a href="javascript:if(confirm('确定停止用户：<?php echo $info['name']; ?>')){location='/houtai/niuren.php?del=<?php echo $info['id']; ?>'}" class="btn btn-danger btn-sm ">停止</a>
                    <?php } elseif ($info['status'] == 1) {?>
                        <a href="" class="btn btn-info btn-sm">继续</a>
                    <?php } else {?>
                        <a href="" class="btn btn-success btn-sm">加入</a>
                    <?php }?>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>

</div>
