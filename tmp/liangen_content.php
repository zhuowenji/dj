<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>输入您连跟码的数<small></small></h1>
    <p>帮您风险评估</p>
  </div>
</div>

<div class="container">
    <form method="get" action="liangen.php">
        <div class="form-group">
            <label>连跟码数</label>
            <input type="text" class="form-control" id="ms" name="ms" placeholder="60" value="<?php echo isset($_GET['ms']) && !empty($_GET['ms']) ? $_GET['ms'] : ''; ?>">
        </div>
        <div class="form-group">
            <label>赔率</label>
            <input type="text" class="form-control" id="peilv" name="peilv" placeholder="90" value="<?php echo isset($_GET['peilv']) && !empty($_GET['peilv']) ? $_GET['peilv'] : ''; ?>">
        </div>
        <div class="form-group">
            <label>每期赚多少</label>
            <input type="text" class="form-control" id="mqz" name="mqz" placeholder="300" value="<?php echo isset($_GET['mqz']) && !empty($_GET['mqz']) ? $_GET['mqz'] : ''; ?>">
        </div>
        <div class="form-group">
            <label>连续不中期数</label>
            <input type="text" class="form-control" id="qs" name="qs" placeholder="3" value="<?php echo isset($_GET['qs']) && !empty($_GET['qs']) ? $_GET['qs'] : ''; ?>">
        </div>
        <button type="submit" class="btn btn-default">查询</button>
        <button type="button" onclick="ClearTextArea()" class="btn btn-default">清除</button>
    </form>

    <h4>倍投方案</h4>
    <p><blockquote><?php echo $wenzhuan['qs'] > 1 ? '连续' . $wenzhuan['qs'] : $wenzhuan['qs']; ?>期不中,需要打第<?php echo $wenzhuan['qs'] + 1; ?>期。</blockquote></p>
    <table class="table table-bordered">
        <tr>
            <th>期数</th>
            <th>每码(组)</th>
            <th>中</th>
            <th>本</th>
            <th>赚</th>
        </tr>
        <?php foreach ($wenzhuan['info'] as $info) {?>
        <tr>
            <td>
                <?php echo $info['qishu']; ?>
                <?php if ($wenzhuan['qs'] >= $info['qishu']) {?>
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                <?php } else {?>
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                <?php }?>
            </td>
            <td><?php echo $info['djzs']; ?></td>
            <td><?php echo $info['sunshi']; ?></td>
            <td><font color="red"><?php echo $info['ben']; ?></font></td>
            <td><?php echo $info['zhuan']; ?></td>
        </tr>
        <?php }?>
        <tr>
            <td colspan="5">
                <font color="red">
                    总投资需：<?php echo $wenzhuan['ztz']; ?>，
                    赚：<?php echo $wenzhuan['zz']; ?>，
                    胜率：<?php echo $wenzhuan['sl']; ?>即可。
                </font>
            </td>
        </tr>
    </table>

    <h4>最高翻倍2次方案</h4>
    <p><blockquote><?php echo $liangen['qs'] > 1 ? '连续' . $liangen['qs'] : $liangen['qs']; ?>期不中,需连续中<?php echo $liangen['zqs'] - $liangen['qs']; ?>期，共<?php echo $liangen['zqs']; ?>期。</blockquote></p>
    <table class="table table-bordered">
        <tr>
            <th>期数</th>
            <th>每码(组)</th>
            <th>中</th>
            <th>本</th>
            <th>赚</th>
        </tr>
        <?php foreach ($liangen['info'] as $info) {?>
        <tr>
            <td>
                <?php echo $info['qs']; ?>
                <?php if ($liangen['qs'] >= $info['qs']) {?>
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                <?php } else {?>
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                <?php }?>
            </td>
            <td><?php echo $info['mmzs']; ?></td>
            <td><?php echo $info['zhongde']; ?></td>
            <td><font color="red"><?php echo $info['da']; ?></font></td>
            <td><?php echo $info['zhuan']; ?></td>
        </tr>
        <?php }?>
        <tr>
            <td colspan="5">
                <font color="red">
                    总投资需：<?php echo $liangen['ztz']; ?>，
                    赚：<?php echo $liangen['zz']; ?>，
                    胜率：<?php echo $liangen['sl']; ?>即可。
                </font>
            </td>
        </tr>
    </table>
</div>
