<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>
        <?php echo $tuijian['count']; ?>组头尾
        <small><?php echo isset($win_style[$tuijian['win']]) ? $win_style[$tuijian['win']] : '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'; ?></small>
    </h1>
    <p>
        <?php if (!empty($tuijian['win'])) {?>
        <small>
            <?php $lishi = getInfo($tuijian['period'], $mysqli);?>
            <?php echo '开 ' . $lishi['number'] . ' 时间 ' . $lishi['time'] . ' 第' . $lishi['period'] . '期'; ?>
        </small>
        <?php } else {?>
            <small>待开</small>
        <?php }?>
    </p>
  </div>
</div>
<div class="container">
    <div class="bs-callout bs-callout-danger" id="callout-tables-striped-ie8">
        <h4><a href="search.php?number=<?php echo $tuijian['number']; ?>">点此查看概率</a></h4>
        <p id="fz"><?php echo $tuijian['number']; ?></p>
    </div>

	<div class="table-responsive">
		<table class="table">
			<tr>
				<th>头</th>
				<th>尾</th>
				<th>组数</th>
			</tr>
			<?php foreach ($sixty as $key => $info) {?>
			<tr class="<?php echo isset($style[$key]) ? $style[$key] : ''; ?>">
				<td><?php echo $key; ?></td>
				<td><?php echo $info; ?></td>
				<td><?php echo strlen($info); ?></td>
			</tr>
			<?php }?>
		</table>
	</div>

    <h3>
        <?php echo $win; ?>胜<?php echo $loss; ?>负
        <small>查看更多</small>
    </h3>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>期数</th>
                <th>时间</th>
                <th>开</th>
                <th>码组数</th>
                <th>结果</th>
            </tr>
            <?php $tj_new = array_slice($tj_new, 0, 11);?>
            <?php foreach ($tj_new as $info) {?>
            <?php $kai = getInfo($info['period'], $mysqli);?>
            <tr class="<?php echo isset($win_tr_style[$info['win']]) ? $win_tr_style[$info['win']] : ''; ?>">
                <td><?php echo $kai['period'] ?: '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'; ?></td>
                <td><?php echo $kai['time'] ?: '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'; ?></td>
                <td><?php echo $kai['number'] ?: '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'; ?></td>
                <td>
                    <a href="60.php?tj=<?php echo $info['period']; ?>" ?>
                    <?php echo $info['count']; ?>
                    </a>
                </td>
                <td><?php echo isset($win_style[$info['win']]) ? $win_style[$info['win']] : '<span class="glyphicon glyphicon-time" aria-hidden="true"></span>'; ?></td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>
