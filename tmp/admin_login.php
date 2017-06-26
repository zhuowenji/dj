<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>后台登陆</h1>
  </div>
</div>

<div class="container">
    <form method="post">
      <div class="form-group">
        <label for="username">用户名</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required="required" >
      </div>
      <div class="form-group">
        <label for="password">密码</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required">
      </div>
      <div class="form-group">
        <label for="exampleInputFile"><font color="red"><?php echo $msg ?: ''; ?></font></label>
      </div>
      <button type="submit" class="btn btn-default">登 录</button>
    </form>
</div>
