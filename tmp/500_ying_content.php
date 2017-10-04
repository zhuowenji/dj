<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>剩余50000</h1>
    <p>
        <small>计划执行 <?php echo $start_time; ?> 天</small>
    </p>
  </div>
</div>

<div class="container">
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>日期</th>
                <th>当日金额</th>
                <th>总共</th>
            </tr>
            <?php foreach ($res as $info) {?>
            <tr class="<?php echo $win_tr_style[$info['status']]; ?>">
                <td><?php echo $info['time']; ?></td>
                <td><?php echo $info['amounts']; ?></td>
                <td><?php echo $info['total']; ?></td>
            </tr>
            <?php }?>
        </table>
    </div>

    <nav aria-label="Page navigation">
      <ul class="pagination">
        <?php if ($tmp > 1) {?>
        <li>
          <a href="ying.php?page=<?php echo $tmp - 1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <?php }?>

        <?php for ($i = 1; $i <= $pagenum; $i++) {?>
             <li class="<?php echo $tmp == $i ? 'active' : ''; ?>"><a href="ying.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php }?>

        <?php if ($tmp < $pagenum) {?>
        <li>
          <a href="ying.php?page=<?php echo $tmp + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
        <?php }?>
      </ul>
    </nav>
</div>
