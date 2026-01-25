<?php
$guild = $this->guild['info'];
    function portrait($level)
    {
        if ($level < 26){
            return '1';
        }elseif ($level < 34){
            return '26';
        }elseif ($level < 42){
            return '34';
        }elseif ($level < 48){
            return '42';
        }elseif ($level < 54){
            return '48';
        }elseif ($level < 61){
            return '54';
        }elseif ($level < 70){
            return '61';
        }elseif ($level < 90){
            return '70';
        }elseif ($level >= 90){
            return '90';
        }
    }
    function jobName($value){
        if ($value == 0 || $value == 4){
            return 'Savascı';
        }elseif ($value == 1 || $value == 5){
            return 'Ninja';
        }elseif ($value == 2 || $value == 6){
            return 'Sura';
        }elseif ($value == 3 || $value == 7){
            return 'Şaman';
        }elseif ($value == 8){
            return 'Lycan';
        }
    }
    function gifName($value){
        if ($value == 0 || $value == 4){
            return 'barbarian';
        }elseif ($value == 1 || $value == 5){
            return 'crusader';
        }elseif ($value == 2 || $value == 6){
            return 'witch-doctor';
        }elseif ($value == 3 || $value == 7){
            return 'wizard';
        }
    }
    function playerStat($date){
        $now = date( 'Y-m-d H:i:s', strtotime('-30 minutes'));
        if ($now > $date){
            return 'off';
        }elseif ($now <= $date){
            return 'on';
        }
    }
?>
<main class="content">
  <section class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <div class="box registration-form">
            <?php Cache::open($guild['name']);?>
			<?php if (Cache::check($guild['name'])):?>
			<h2><?=$guild['name']?> <?=$lng[43]?></h2>
            <table class="table" height="30" cellspacing="5" cellpadding="5">
              <tbody>
                <tr>
                  <th><?=$lng[46]?>:</th>
                  <td><?=$guild['name']?></td>
                </tr>
                <tr>
                  <th><?=$lng[44]?>:</th>
                  <td><a href="<?=URI::get_path('detail/player/'.$guild['baskan'])?>"><?=$guild['baskan']?></a></td>
                </tr>
                <tr>
                  <th><?=$lng[48]?></th>
                  <td><img src="<?=URL.'data/flags/'.$guild['empire'].'.png';?>" style="width:30px;" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>"></td>
                </tr>
                <tr>
                  <th><?=$lng[47]?></th>
                  <td><?=$guild['ladder_point']?></td>
                </tr>
                <tr>
                  <th><?=$lng[49]?></th>
                  <td><?=$guild['win']?></td>
                </tr>
                <tr>
                  <th><?=$lng[51]?></th>
                  <td><?=$guild['loss']?></td>
                </tr>
				<tr>
                  <th><?=$lng[50]?></th>
                  <td><?=$guild['draw']?></td>
                </tr>
              </tbody>
            </table>
			<?php endif;?>
			<?php Cache::close($guild['name']);?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>