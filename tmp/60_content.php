<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>推荐60组头尾</h1>
    <p>
        <small>最近连续中9次</small>
    </p>
  </div>
</div>
<div class="container">
    <blockquote><p id="fz"><?php echo $tuijian; ?></p></blockquote>
    <h3>
        <small><a href="search.php?number=<?php echo $tuijian; ?>">点此查看概率</a></small>
    </h3>

	<div class="table-responsive">
		<table class="table">
			<tr>
				<th>头</th>
				<th>尾</th>
				<th>组数</th>
			</tr>
			<?php foreach ($sixty as $key => $info) { ?>
			<tr class="<?php echo isset($style[$key]) ? $style[$key] : '' ?>">
				<td><?php echo $key ?></td>
				<td><?php echo $info ?></td>
				<td><?php echo strlen($info) ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>