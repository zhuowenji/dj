<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>本期<?php echo $tuijian['count']; ?>组头尾</h1>
    <p>
        <small>最近连续中9次</small>
    </p>
  </div>
</div>
<div class="container">
    <blockquote><p id="fz"><?php echo $tuijian['number']; ?></p></blockquote>
    <h3>
        <small><a href="search.php?number=<?php echo $tuijian['number']; ?>">点此查看概率</a></small>
    </h3>

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
        最近10期命中情况
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
            <?php foreach ($tj_new as $info) {?>
            <?php $kai = getInfo($info['period'], $mysqli);?>
            <tr class="<?php echo isset($win_tr_style[$info['win']]) ? $win_tr_style[$info['win']] : ''; ?>">
                <td><?php echo $info['period']; ?></td>
                <th><?php echo $kai['time'] ?: '<span class="glyphicon glyphicon-time" aria-hidden="true"></span> 待开'; ?></th>
                <th><?php echo $kai['number'] ?: '<span class="glyphicon glyphicon-time" aria-hidden="true"></span> 待开'; ?></th>
                <td><?php echo $info['count']; ?></td>
                <td><?php echo isset($win_style[$info['win']]) ? $win_style[$info['win']] : '<span class="glyphicon glyphicon-time" aria-hidden="true"></span> 待开'; ?></td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>
