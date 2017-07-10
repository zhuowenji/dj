<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>号码概率统计<small></small></h1>
    <p>支持格式：3头5,3-5,36-567</p>
  </div>
</div>

<div class="container">
<!--     <form method="get" action="search.php">
        <div class="form-group">
            <textarea id="textarea" class="form-control" rows="3" name="number" placeholder="3-5,6-7,"><?php echo isset($_GET['number']) && !empty($_GET['number']) ? $_GET['number'] : ''; ?></textarea>
        </div>
        <button type="submit" class="btn btn-default">查询</button>
        <button type="button" onclick="ClearTextArea()" class="btn btn-default">清除</button>
    </form> -->
    <?php if (count($da) > 0) {?>
        <div class="bs-callout bs-callout-danger" id="callout-tables-striped-ie8">
            <p><?php echo implode(',', $da); ?></p>
        </div>
    <?php } else {?>
        <div class="bs-callout bs-callout-danger" id="callout-tables-striped-ie8">
            <h4>查询输入有误,请重新输入</h4>
        </div>
    <?php }?>
    <h4>查询结果 <small><?php echo count($da); ?> 组头尾</small></h4>

    <table class="table table-bordered">
        <tr>
            <th>年份</th>
            <th>开次数</th>
            <th>中次数</th>
            <th>概率</th>
            <th>最大连续不中</th>
        </tr>
        <?php foreach ($data as $info) {?>
        <tr>
            <td><?php echo $info['year']; ?></td>
            <td><?php echo $info['kai']; ?></td>
            <td><?php echo $info['zhong']; ?></td>
            <td><?php echo sprintf('%.2f', $info['gailv'] * 100); ?>%</td>
            <td>
                <?php echo $info['buzhong'] . '期'; ?> <br/>
                <?php echo $info['bzsj']; ?><br/>
                <?php echo $info['ljlxbz'] > 1 ? "共出现过 {$info['ljlxbz']} 次" : ''; ?>
            </td>
        </tr>
        <?php }?>
    </table>
</div>
