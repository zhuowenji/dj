<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h2>更新牛人收益</h2>
    <p><?php echo $_SESSION['username']; ?> </p>
  </div>
</div>

<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="mashu">码组数</label>
            <input type="text" name="mashu" class="form-control" id="mashu" value="<?php echo $mashu; ?>"  >
        </div>
        <div class="form-group">
            <label for="peilv">赔率</label>
            <input type="text" name="peilv" class="form-control" id="peilv" placeholder="95">
        </div>
        <div class="form-group">
            <label for="date">输入时间</label>
            <input type="text" name="date" class="form-control" id="date" placeholder="<?php echo $day; ?>">
        </div>
        <div class="form-group">
            <label for="dazushu">打组数</label>
            <input type="text" name="dazushu" class="form-control" id="dazushu" value="<?php echo $dazushu; ?>"  >
        </div>
        <div class="form-group">
            <label>中</label>
            <input type="radio" name="shu_ying" value="1" <?php echo $shu_ying == 1 ? 'checked="cecked"' : ''; ?> />
            &nbsp;&nbsp;&nbsp;
            <label>不中</label>
            <input type="radio" name="shu_ying" value="2" <?php echo $shu_ying == 2 ? 'checked="cecked"' : ''; ?> />
        </div>
        <div class="form-group">
            <label for="msg"><font color="red"><?php echo $msg ?: ''; ?></font></label>
        </div>

          <button type="submit" class="btn btn-default">更 新</button>
    </form>
 </div>
