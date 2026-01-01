<?php
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
            <?php Cache::open($this->player['name']);?>
			<?php if (Cache::check($this->player['name'])):?>
			<h2><?=$this->player['name']?> <?=$lng[32]?></h2>
            <table class="table" height="30" cellspacing="5" cellpadding="5">
              <tbody>
                <tr>
                  <th><?=$lng[35]?>:</th>
                  <td><?=$this->player['name']?></td>
                </tr>
                <tr>
                  <th><?=$lng[68]?>:</th>
                  <td><?=$this->player['level']?></td>
                </tr>
                <tr>
                  <th><?=$lng[37]?></th>
                  <td><?=Functions::flagName($this->player['empire'])[1]?></td>
                </tr>
                <tr>
                  <th><?=$lng[40]?></th>
                  <td><?=$this->player['playtime']?> <?=$lng[42]?></td>
                </tr>
                <tr>
                  <th><?=$lng[38]?></th>
                  <td><a href="javascript:void(0)"><?php if ($this->player['lonca'] == null){echo 'Yok';}else{echo $this->player['lonca'];}?></a></td>
                </tr>
                <tr>
                  <th><?=$lng[39]?></th>
                  <td><?=Functions::zaman($this->player['last_play'])?></td>
                </tr>
              </tbody>
            </table>
			<?php endif;?>
			<?php Cache::close($this->player['name']);?>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
