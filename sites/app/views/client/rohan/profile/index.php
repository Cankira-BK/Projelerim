<?php
$account = $this->players['account'];
$status = $account['status'];
$availDt = strtotime($account['availDt']);
$now = time();
$fark = $availDt - $now;
    function find_url($string){
//"www."
        $pattern_preg1 = '#(^|\s)(www|WWW)\.([^\s<>\.]+)\.([^\s\n<>]+)#sm';
        $replace_preg1 = '\\1<a href="http://\\2.\\3.\\4" target="_blank" class="link">\\2.\\3.\\4</a>';

//"http://"
        $pattern_preg2 = '#(^|[^\"=\]]{1})(http|HTTP|ftp)(s|S)?://([^\s<>\.]+)\.([^\s<>]+)#sm';
        $replace_preg2 = '\\1<a href="\\2\\3://\\4.\\5" target="_blank" class="link">\\2\\3://\\4.\\5</a>';

        $string = preg_replace($pattern_preg1, $replace_preg1, $string);
        $string = preg_replace($pattern_preg2, $replace_preg2, $string);

        return $string;
    }

?>
<main class="content">
  <section class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <div class="box registration-form">
            <h2><?=$lng[136]?></h2>
            <?php if ($status == 'BLOCK'):?>
				<?=Client::alert('warning',$lng[137]); ?>
                <h3><?=$lng[149]?></h3>
                <center><h4><?=$this->players['ban']['why']?></h4></center><br>
				<?php if ($this->players['ban']['evidence'] != ''):?>
                <h3><?=$lng[150]?></h3>
                <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
			<?php endif;?>
			<?php elseif ($availDt > $now):?>
				<?=Client::alert('warning',$lng[138]); ?>
                <h3><?=$lng[149]?></h3>
                <center><h4><?=$this->players['ban']['why']?></h4></center><br>
			<?php if ($this->players['ban']['evidence'] != ''):?>
                <h3><?=$lng[150]?></h3>
                <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
			<?php endif;?>
			<div class="bg-light item-container">
                    <center><span id="say" style="font-weight: bold;font-size: 45px;"><?=$fark?></span><br> <?=$lng[139]?></center>
                </div>
                <script type="text/javascript">
                    var saniye = <?=$fark+1?>;
                    function bak()
                    {
                        if(saniye != 0)
                        {
                            saniye = saniye - 1;
                            document.getElementById("say").innerHTML = saniye;
                            setTimeout(bak, 1000);
                        }
                    }
                    window.onload=bak;
                </script>
			<?php endif;?>
			<table class="table" height="30" cellspacing="5" cellpadding="5">
              <tbody>
                <tr>
                  <th width="184"><?=$lng[23]?>:</th>
                  <td width="495"><?=$this->players['account']['login'];?></td>
                </tr>
                <tr>
                  <th width="184"><?=$lng[152]?>:</th>
                  <td width="495"><?=$this->players['account']['email'];?></td>
                </tr>
                <tr>
                  <th width="184"><?=$lng[17]?>:</th>
                  <td width="495"><?=$this->players['account'][CASH];?></td>
                </tr>
                                  <tr>
                    <th width="184"><?=$lng[18]?>:</th>
                    <td width="495"><?=$this->players['account'][MILEAGE];?></td>
                  </tr>
                                <tr>
                  <th width="184"><?=$lng[97]?>:</th>
                  <td width="495"><?=$this->players['account']['phone1'];?></td>
                </tr>
                              </tbody>
            </table>
              <a class="btn btn-primary itemshop iframe" style="margin-bottom: 10px;width:100%;" href="<?=URL.SHOP?>"><?=$lng[147]?></a>
              <a class="btn btn-primary itemshop iframe" style="margin-bottom: 10px;width:100%;" href="<?=URL.MUTUAL?>"><?=$lng[146]?></a>
              <a class="btn btn-danger" style="margin-bottom: 10px;width:100%;" href="<?=URI::get_path('profile/password')?>"><?=$lng[141]?></a>
              <a class="btn btn-danger" style="margin-bottom: 10px;width:100%;" href="<?=URI::get_path('profile/email')?>"><?=$lng[142]?></a>
              <a class="btn btn-danger" style="margin-bottom: 10px;width:100%;" href="<?=URI::get_path('profile/depo')?>"><?=$lng[143]?></a>
              <a class="btn btn-danger" style="margin-bottom: 10px;width:100%;" href="<?=URI::get_path('profile/ksk')?>"><?=$lng[144]?></a>
              <a class="btn btn-danger" style="margin-bottom: 10px;width:100%;" href="<?=URI::get_path('profile/save')?>"><?=$lng[145]?></a>
              <?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/pin')?>" class="btn btn-danger" style="margin-bottom: 10px;width:100%;">Pin Değiştir</a>
              <?php endif;?>
              <?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/iks')?>" class="btn btn-danger" style="margin-bottom: 10px;width:100%;">İtem Kilit Değiştir</a>
              <?php endif;?>
              <?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/hgs')?>" class="btn btn-danger" style="margin-bottom: 10px;width:100%;">Hesap Kilit Değiştir</a>
              <?php endif;?>
              <?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/kgs')?>" class="btn btn-danger" style="margin-bottom: 10px;width:100%;">Karakter Kilit Değiştir</a>
              <?php endif;?>
              <?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/gpc')?>" class="btn btn-danger" style="margin-bottom: 10px;width:100%;">GüvenliPC Pasifleştir</a>
              <?php endif;?>
              <a class="btn btn-danger" style="margin-bottom: 10px;width:100%;" href="<?=URI::get_path('login/logout')?>"><?=$lng[148]?></a>
		  </div>
        </div>
      </div>
    </div>
  </section>
</main>
