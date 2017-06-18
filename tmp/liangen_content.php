<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>输入您连跟码的数<small></small></h1>
    <p>帮您风险评估</p>
  </div>
</div>

<div class="container">
    <form method="get" action="liangen.php">
        <div class="form-group">
            <label>连根码数</label>
            <input type="text" class="form-control" id="ms" name="ms" placeholder="40" value="<?php echo isset($_GET['ms']) && !empty($_GET['ms']) ? $_GET['ms'] : ''; ?>">
        </div>
        <div class="form-group">
            <label>每期赚多少</label>
            <input type="text" class="form-control" id="mqz" name="mqz" placeholder="500" value="<?php echo isset($_GET['mqz']) && !empty($_GET['mqz']) ? $_GET['mqz'] : ''; ?>">
        </div>
        <div class="form-group">
            <label>连打多少期</label>
            <input type="text" class="form-control" id="qs" name="qs" placeholder="5" value="<?php echo isset($_GET['qs']) && !empty($_GET['qs']) ? $_GET['qs'] : ''; ?>">
        </div>
        <button type="submit" class="btn btn-default">查询</button>
        <button type="button" onclick="ClearTextArea()" class="btn btn-default">清除</button>
    </form>

    <h3>查询结果</h3>
    <table class="table table-bordered">
        <tr>
            <th>连跟期数(期)</th>
            <th>每码需打(组)</th>
            <th>中了得到</th>
            <th>需投资(本)</th>
            <th>赚</th>
        </tr>
        <?php foreach ($wenzhuan as $info) {?>
        <tr>
            <td><?php echo $info['qishu']; ?></td>
            <td><?php echo $info['djzs']; ?></td>
            <td><?php echo $info['sunshi']; ?></td>
            <td><font color="red"><?php echo $info['ben']; ?></font></td>
            <td><?php echo $info['zhuan']; ?></td>
        </tr>
        <?php }?>
    </table>
</div>