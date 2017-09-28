<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h2>更新收益</h2>
  </div>
</div>

<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="amount">time : </label>
            <?php echo $time; ?>
        </div>
        <div class="form-group">
            <label for="amount">amount</label>
            <input type="text" name="amount" class="form-control" id="amount" value="<?php echo $amount; ?>"  >
        </div>
        <div class="form-group">
            <label>vin</label>
            <input type="radio" name="shu_ying" value="1" <?php echo $shu_ying == 1 ? 'checked="cecked"' : ''; ?> />
            &nbsp;&nbsp;&nbsp;
            <label>lose</label>
            <input type="radio" name="shu_ying" value="2" <?php echo $shu_ying == 2 ? 'checked="cecked"' : ''; ?> />
        </div>
        <div class="form-group">
            <label for="msg"><font color="red"><?php echo $msg ?: ''; ?></font></label>
        </div>
          <button type="submit" class="btn btn-default">更 新</button>
    </form>
 </div>
