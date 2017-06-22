<?php

$arr = [
    '6月' => [
        '2017-6-18' => '-300',
        '2017-6-20' => '435',
    ],
];

?>

<style type="text/css">

tr { padding:20px;}

</style>

<html>
    <div class="container">
        <div class="row">
            <link href="style/css/bootstrap.css" rel="stylesheet">
            <?php $zong = 0;?>
            <?php foreach ($arr as $time => $info) {?>
                <?php $count = array_sum($info);?>
                <div class="col-md-3">
                    <table class="table table-bordered">
                        <tr>
                            <th>场次</th>
                            <th>时间</th>
                            <th>成绩</th>
                        </tr>

                        <?php $a     = 0;?>
                        <?php $sheng = 0;?>

                        <?php foreach ($info as $key => $value) {?>
                        <?php $a++;?>
                        <tr>
                            <td><?php echo $a; ?></td>
                            <td><?php echo date('Y年m月d日', strtotime($key)); ?></td>
                            <td><?php echo $value; ?></td>
                        </tr>
                        <?php $value > 0 ? $sheng++ : '';?>
                        <?php }?>
                        <tr>
                            <td><?php echo $time; ?>总</td>
                            <td colspan="2"><font color="red"><b><?php echo $count . ' - ' . number_format($sheng / $a * 100, 2, '.', '') . '%'; ?></b></font></td>
                        </tr>
                    </table>
                </div>
                <?php $zong += $count;?>
            <?php }?>
        </div>

        <div class="col-md-12">
                <h3><pre>总战绩：<?php echo $zong; ?></pre></h3>
        </div>
    </div>
</html>
