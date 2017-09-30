<meta http-equiv="refresh" content="40 url=/500/ssc.php" />
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
                <th>42-49组</th>
                <th></th>
                <th>55-56组</th>
            </tr>
            <?php foreach ($res as $info) {?>
            <tr>
                <td><?php echo $info['periods']; ?></td>
                <td><?php echo $info['number'] ?: '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'; ?></td>
                <td class="<?php echo $win_tr_style[$info['status_40']]; ?> form-inline">
                  <input type="text" class="form-control" placeholder="无" value="<?php echo $info['tuijian_40']; ?>">
                  <?php echo empty($info['tuijian_40']) ? '' : substr_count($info['tuijian_40'], ',') + 1; ?>
                  <?php echo $win_style[$info['status_40']]; ?>
                </td>
                <td></td>
                <td class="<?php echo $win_tr_style[$info['status']]; ?> form-inline">
                  <input type="text" class="form-control" placeholder="无" value="<?php echo $info['tuijian']; ?>">
                  <?php echo empty($info['tuijian']) ? '' : substr_count($info['tuijian'], ',') + 1; ?>
                  <?php echo $win_style[$info['status']]; ?>
                </td>
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
