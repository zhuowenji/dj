<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>
        头尾神策 fuxiben.com
    </title>
    <script type="text/javascript" src="/style/js/function.js"></script>
    <script type="text/javascript" src="/style/js/jquery.js"></script>
    <script type="text/javascript" src="/style/js/bootstrap.js"></script>
    <link href="/style/css/bootstrap.css" rel="stylesheet">
    <link href="/style/css/docs.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="/favicon.ico">
  </head>

  <body>
    <!-- Docs master nav -->
    <header class="navbar navbar-fixed-top  bs-docs-nav" id="top">
        <div class="container">
            <div class="navbar-header ">
              <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a href="/" class="navbar-brand">首页</a>
              <?php if (isset($_SESSION['username'])) {?>
              <a href="/houtai/install.php" class="active navbar-brand">录码</a>
              <?php }?>
            </div>
            <?php if (isset($_SESSION['username'])) {?>
            <nav id="bs-navbar" class="collapse navbar-collapse" aria-expanded="false">
                  <ul class="nav navbar-nav"></ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="/houtai/index.php?logout=true">退出账号</a></li>
                  </ul>
            </nav>
            <?php }?>
        </div>
    </header>
