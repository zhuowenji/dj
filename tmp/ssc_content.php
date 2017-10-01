<meta http-equiv="refresh" content="400000 url=/500/ssc.php" />
<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>重庆时时彩</h1>
    <p></p>
  </div>
</div>

<div class="container">

    <div class="bs-callout bs-callout-danger" id="callout-tables-striped-ie8">
        <form class="form-inline">
          <div class="form-group">
            <label for="datetimepicker">时间</label>
            <input class="form-control" type="text" value="" id="date_start" name="date_start" readonly="readonly">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail2">-</label>
            <input class="form-control" type="text" value="<?php echo date('Y-m-d', time()); ?>" id="date_end" name="date_end" id="datetimepicker2" readonly="readonly">
          </div>
          <button type="submit" class="btn btn-default">查看</button>
        </form>
    </div>

    <h3>
        <?php echo $win; ?>胜<?php echo $loss; ?>负
    </h3>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>期数</th>
                <th>号码</th>
                <th>55-56个号</th>
            </tr>
            <?php foreach ($res as $info) {?>
            <tr>
                <td><?php echo $info['periods']; ?></td>
                <td><?php echo $info['number'] ?: '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'; ?></td>
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
          <a href="ssc.php?page=<?php echo ($tmp - 1) . $page_where; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <?php }?>

        <?php for ($i = 1; $i <= $pagenum; $i++) {?>
             <li class="<?php echo $tmp == $i ? 'active' : ''; ?>"><a href="ssc.php?page=<?php echo $i . $page_where; ?>"><?php echo $i; ?></a></li>
        <?php }?>

        <?php if ($tmp < $pagenum) {?>
        <li>
          <a href="ssc.php?page=<?php echo ($tmp + 1) . $page_where; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
        <?php }?>
      </ul>
    </nav>
</div>

<script type="text/javascript">
  $('#date_start').datetimepicker({
            language:  'zh-CN',
            format: 'yyyy-mm-dd',
            startView: 2,
            minView: 2,
  });

  $('#date_end').datetimepicker({
            language:  'zh-CN',
            format: 'yyyy-mm-dd',
            startView: 2,
            minView: 2,
  });
</script>
