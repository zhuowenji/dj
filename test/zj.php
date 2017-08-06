<?php

include '../function.php';

$arr = [
    '8月' => [
        '2017-8-01' => '835',
        '2017-8-04' => '400',
        '2017-8-07' => '-750',
    ],
    '7月' => [
        '2017-7-02' => '-600',
        '2017-7-04' => '-600',
        '2017-7-12' => '-1040',
        '2017-7-15' => '2424',
        '2017-7-16' => '-1674',
        '2017-7-18' => '591',
        '2017-7-22' => '-2418',
        '2017-7-23' => '4071',
        '2017-7-25' => '-1116',
        '2017-7-28' => '1710',
        '2017-7-30' => '513',
    ],
    '6月' => [
        '2017-6-18' => '-300',
        '2017-6-20' => '435',
        '2017-6-23' => '187',
        '2017-6-26' => '160',
        '2017-6-30' => '-380',
    ],
];

include '../tmp/head.php';

?>
<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
        <h1>
        战绩
        </h1>
  </div>
</div>

<div class="container">
    <div class="row">
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

<?php

include '../tmp/foot.php';

?>

