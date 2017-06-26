<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>后台登陆</h1>
    <small>禁地勿乱闯</small>
  </div>
</div>

<div class="container">
    <form method="post">
      <div class="form-group">
        <label for="username"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 用户名</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required="required" >
      </div>
      <div class="form-group">
        <label for="password"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 密&nbsp;&nbsp;&nbsp;码</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required">
      </div>
      <div class="form-group">
        <label for="exampleInputFile"><font color="red"><?php echo $msg ?: '不要随意尝试，后果很严重'; ?></font></label>
      </div>
      <button type="submit" class="btn btn-default">登 录</button>
    </form>
</div>
