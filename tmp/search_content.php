<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>输入头尾号码<small></small></h1>
    <p>3头5,6头7 单组模式：3-5,6-7</p>
    <p>3头5,6头7 头尾模式：36-57</p>
  </div>
</div>

<div class="container">
    <form method="get" action="search.php">
        <div class="form-group">
            <textarea id="textarea" class="form-control" rows="3" name="number" placeholder="3-5,6-7,"><?php echo isset($_GET['number']) && !empty($_GET['number']) ? $_GET['number'] : ''; ?></textarea>
        </div>
        <button type="submit" class="btn btn-default">查询</button>
        <button type="button" onclick="ClearTextArea()" class="btn btn-default">清除</button>
    </form>

    <h3>查询结果 <small><?php echo count($da); ?> 组头尾</small></h3>

    <?php if (count($da) > 0) {?>
    <blockquote><p><?php echo implode(',', $da); ?></p></blockquote>
    <?php } else {?>
    <blockquote><font color="red">查询输入有误,请重新输入</font></blockquote>
    <?php }?>

    <table class="table table-bordered">
        <tr>
            <th>年份时间</th>
            <th>开码次数</th>
            <th>中码次数</th>
            <th>中码概率</th>
            <th>最大连续不中次数</th>
        </tr>
        <?php foreach ($data as $info) {?>
        <tr>
            <td><?php echo $info['year']; ?></td>
            <td><?php echo $info['kai']; ?></td>
            <td><?php echo $info['zhong']; ?></td>
            <td><?php echo sprintf('%.2f', $info['gailv'] * 100); ?>%</td>
            <td>
                <?php echo $info['buzhong']; ?><br/>
                时间： <?php echo $info['bzsj']; ?><br/>
                <?php echo $info['ljlxbz'] > 1 ? "连续 {$info['buzhong']} 期不中出现过 {$info['ljlxbz']} 次数" : ''; ?>
            </td>
        </tr>
        <?php }?>
    </table>
</div>