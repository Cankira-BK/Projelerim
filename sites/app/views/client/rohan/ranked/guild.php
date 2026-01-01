<?php
    function jobName($value){
        if ($value == 0 || $value == 4){
            return 'Savaşçı';
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
    function playerStat($date){
        $now = date( 'Y-m-d H:i:s', strtotime('-30 minutes'));
        if ($now > $date){
            return false;
        }elseif ($now <= $date){
            return true;
        }
    }

?>
<style>
    .label {color: #191616;}
</style>

<main class="content">
  <div class="panel panel-buyuk">
    <br>
    <div class="row">
      <div class="col-lg-offset-2 col-lg-4">
        <a class="btn btn-danger btn-block" style="color:#fec16a;background:#85141E;" href="<?=URI::get_path('ranked/guild')?>"><?=$lng[66]?></a>
      </div>
      <div class="col-lg-4">
        <a class="btn btn-danger btn-block" style="color:#fff;background:#85141E;" href="<?=URI::get_path('ranked/player')?>"><?=$lng[65]?></a>
      </div>
    </div>
    <br>
        <?php if (\StaticDatabase\StaticDatabase::settings('guild_rank_status') == "0"):?>
			<?php  echo Client::alert('error',"Lonca sıralaması şuanda kapalı!");?>
		<?php else:?>
		<table class="table rankings-table table-red-heading table-striped">
          <thead>
            <tr>
              <td class="text-left">#</td>
              <td class="text-left"><?=$lng[67]?></td>
              <td class="text-left"><?=$lng[71]?></td>
              <td class="text-left"><?=$lng[48]?></td>
              <td class="text-left"><?=$lng[44]?></td>
              <td class="text-left"><?=$lng[72]?></td>
            </tr>
          </thead>
          <tbody>
              <?php Cache::open('guilds');?>
              <?php if (Cache::check('guilds')):?>
              <?php foreach ($this->views['data'] as $key=>$row):?>
			  <tr>
                <td><?=($key+1)?></td>
                <td><a href="<?=URI::get_path('detail/guild/'.$row['lonca'])?>"><?=$row['lonca']?></a></td>
                <td><?=$row['ladder_point']?></td>
                <td class="hidden-xs"><img src="<?=URL.'data/flags/'.$row['bayrak'].'.png'?>" alt=""></td>
                <td class="hidden-xs"><a href="<?=URI::get_path('detail/player/'.$row['baskan'])?>"><?=$row['baskan'];?></a></td>
                <td class="hidden-xs"><span class="label label-green"><?=$row['win']?></span> | <span class="label label-draw"><?=$row['draw']?></span> | <span class="label label-red"><?=$row['loss']?></span></td>
              </tr>
			  <?php endforeach;?>
			  <?php endif;?>
			  <?php Cache::close('guilds');?>
                      </tbody>
        </table>
		<?php endif;?>
            </div>
</main>