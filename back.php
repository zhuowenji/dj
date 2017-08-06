    <h3> 近5年头尾各重复出现次数 </h3>
    <table class="table table-bordered">
        <tr>
            <th></th>
            <th>年份／头次数</th>
            <th>年份／尾次数</th>
        </tr>
        <?php for ($i = 0; $i <= 9; $i++) {?>
        <tr>
            <td><?php echo $i; ?></td>
            <td>
                <?php for ($start_year = 2013; $start_year <= $year; $start_year++) {?>
                    <?php $tou = $year_tou[$start_year][$i];?>
                    <?php echo $start_year . '／' . $tou; ?>
                    <br/>
                <?php }?>
            </td>
            <td>
                <?php for ($start_year = 2013; $start_year <= $year; $start_year++) {?>
                    <?php $wei = $year_wei[$start_year][$i];?>
                    <?php echo $start_year . '／' . $wei; ?>
                    <br/>
                <?php }?>
            </td>
        </tr>
        <?php }?>
    </table>