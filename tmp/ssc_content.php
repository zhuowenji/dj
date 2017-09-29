<meta http-equiv="refresh" content="40 url=http://fuxiben.com/500/ssc.php" />
<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>重庆时时彩</h1>
    <p></p>
  </div>
</div>

<div class="container">
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>期数</th>
                <th>号码</th>
                <th>码数量</th>
                <th>推荐</th>
            </tr>
            <?php foreach ($res as $info) {?>
            <tr class="<?php echo $win_tr_style[$info['status']]; ?>">
                <td><?php echo $info['periods']; ?></td>
                <td><?php echo $info['number'] ?: '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'; ?></td>
                <td><?php echo substr_count($info['tuijian'], ','); ?></td>
                <td><input type="text" class="form-control" placeholder="休息" value="<?php echo $info['tuijian']; ?>"></td>
            </tr>
            <?php }?>
        </table>
    </div>

    <nav aria-label="Page navigation">
      <ul class="pagination">
        <?php if ($tmp > 1) {?>
        <li>
          <a href="ssc.php?page=<?php echo $tmp - 1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <?php }?>

        <?php for ($i = 1; $i <= $pagenum; $i++) {?>
             <li class="<?php echo $tmp == $i ? 'active' : ''; ?>"><a href="ssc.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php }?>

        <?php if ($tmp < $pagenum) {?>
        <li>
          <a href="ssc.php?page=<?php echo $tmp + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
        <?php }?>
      </ul>
    </nav>
</div>
