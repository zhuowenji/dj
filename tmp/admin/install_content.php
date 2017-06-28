<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h2>录入最新码期</h2>
    <p><?php echo $_SESSION['username']; ?> </p>
  </div>
</div>

<div class="container">
    <form method="post">
          <div class="form-group">
            <label for="number">输入号码</label>
            <input type="text" name="number" class="form-control" id="number" placeholder="Number">
          </div>
          <div class="form-group">
            <label for="date">输入时间</label>
            <input type="text" name="date" class="form-control" id="date" placeholder="<?php echo $day; ?>">
          </div>
          <div class="form-group">
            <label for="msg"><font color="red"><?php echo $msg ?: '录入完整七位号码'; ?></font></label>
          </div>
          <button type="submit" class="btn btn-default">添加</button>
    </form>
 </div>
