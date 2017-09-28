<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h2>替换微信二维码</h2>
    <p><?php echo $_SESSION['username']; ?> </p>
  </div>
</div>

<div class="container">
    <form method="post"  enctype="multipart/form-data">
        <div class="form-group">
          <label for="exampleInputFile">选择二维码图片</label>
          <input type="file" id="exampleInputFile" name="file">
          <p class="help-block"><?php echo $msg; ?></p>
        </div>

        <button type="submit" class="btn btn-default">提 交</button>
    </form>
 </div>
