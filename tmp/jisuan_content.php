<div class="bs-docs-header" id="content" tabindex="-1">
  <div class="container">
    <h1>胜负收益计算</h1>
  </div>
</div>

<div class="container">
    <form method="get" action="jisuan.php">
        <div class="form-group">
            <label>码组数</label>
            <input type="text" class="form-control"  name="ms"  value="<?php echo isset($_GET['ms']) && !empty($_GET['ms']) ? $_GET['ms'] : $ms; ?>">
        </div>
        <div class="form-group">
            <label>赔率</label>
            <input type="text" class="form-control" name="peilv"  value="<?php echo isset($_GET['peilv']) && !empty($_GET['peilv']) ? $_GET['peilv'] : $peilv; ?>">
        </div>
        <div class="form-group">
            <label>每100反水</label>
            <input type="text" class="form-control"  name="shui"  value="<?php echo isset($_GET['shui']) && !empty($_GET['shui']) ? $_GET['shui'] : $shui; ?>">
        </div>
        <div class="form-group">
            <label>打组数</label>
            <input type="text" class="form-control"  name="dzs"  value="<?php echo isset($_GET['dzs']) && !empty($_GET['dzs']) ? $_GET['dzs'] : $dzs; ?>">
        </div>

        <div class="form-group">
            <label>中</label>
            <input type="radio" name="shu_ying" value="1" <?php echo $shu_ying == 1 ? 'checked="cecked"':'';?> />
            &nbsp;&nbsp;&nbsp;
            <label>不中</label>
            <input type="radio" name="shu_ying" value="2" <?php echo $shu_ying == 2 ? 'checked="cecked"':'';?> />
        </div>

        <button type="submit" class="btn btn-default">查询</button>
    </form>
    <p></p>

    <div class="bs-callout bs-callout-danger" id="callout-type-dl-truncate">
        <h4>收益</h4>
    </div>

    <table class="table table-condensed">
         <tr>
          <td>
            <?php echo $dzs .' X '.$ms. ' = '. $ben ?> (打)<br/>
            <?php echo $ben.' X '.($shui / 100).' = '. $shui_de ?> (水)<br/>

            <?php if($shu_ying == 1){ ?>
                <?php echo $dzs.' X '.$peilv.' = '.$zhong ?> (中)<br/>
                <?php echo $zhong.' - '.$ben.' + '. $shui_de.' = '.$zhuan ?> (得)<br/>
            <?php } ?>

            <?php if($shu_ying == 2){ ?>
                <?php echo $ben .' - '.$shui_de.' = '.$zhuan ?> (给) 
            <?php } ?>

          </td>
          <td>
            打组数 X 码组数  = 打<br/>
            本 X <?php echo $shui / 100 ?> = 水<br/>

            <?php if($shu_ying == 1){ ?>
                码组数 X 赔率 = 中 <br/>
                中 - 本 + 水 = 得 <br/>
            <?php } ?>

            <?php if($shu_ying == 2){ ?>
                本 - 水 = 给
            <?php } ?>
          </td>
        </tr>
    </table>
</div>
