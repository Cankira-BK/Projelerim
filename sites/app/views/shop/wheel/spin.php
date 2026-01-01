<?php
$wheelCoins = \StaticDatabase\StaticDatabase::settings('wheelcoins');
$randNum = $this->all['random'];
function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
Session::set('gift_key',generateRandomString());
$giftInfo = $this->all['gift_info'];
$createToken = $this->hash->create('md5',Session::get('aId').$giftInfo['id'].$giftInfo['vnum'],$_SESSION['gift_key']);
$giftLink = URI::get_path('wheel/gift/'.$giftInfo['id'].'/'.$createToken);
?>
<link rel="stylesheet" id="gameStyle" href="<?= URI::public_path('css/wheel.min.css') ?>" type="text/css"/>
<script type="text/javascript">
    var dir = zs.data.dir || {};
    var giftURL = '<?=$giftLink?>';
    var giftData = {item_id:"<?=$giftInfo->id?>",token:"<?=$createToken?>"};
</script>
<script type="text/javascript" src="<?= URI::public_path('js/wheel-3.js') ?>"></script>
<div class="content clearfix" id="wt_refpoint">
    <div class="mg-breadcrumb-container row-fluid">
        <h2>
            <ul class="breadcrumb">
                <li>Çark</li>
            </ul>
        </h2>
        <a class="wheel-help minigames-help ttip" href="javascript:void(0)"><i class="icon-book"></i>Yardım ve bilgi</a>
    </div>
    <div id="wheel-game" class=" wheel lvl-1">
        <div id="wheel-container" class="span8">
            <div id="wheel" class="_wl-sprite clockwise">
                <!-- Keys Rendering -->
                <div class="wheel-keys">
                    <i id="key-3" class="key icon-key-wheel _wl-sprite"><i class="before"></i></i>
                    <i id="key-7" class="key icon-key-wheel _wl-sprite"><i class="before"></i></i>
                    <i id="key-11" class="key icon-key-wheel _wl-sprite"><i class="before"></i></i>
                    <i id="key-15" class="key icon-key-wheel _wl-sprite"><i class="before"></i></i>
                </div>
                <!-- Keys Rendering -->
                <div class="wheel-ring _wl-sprite"></div>
                <!-- Before Play  -->
                <div id="spinner-pointer" style="background-position: -872px 0px;">
                    <div id="wheel-spinner" style="background-position: 0px 0px;">
                        <div class="wheel-btn">
                            <a id="spinButton" class="play">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td><span class="pulse2"> Dönüyor... </span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="wheel-items" style="top: 50px;">
                    <script>
                        spin(1, <?=$randNum?>, 10000);
                    </script>
                    <?php foreach ($this->all['items'] as $key => $row):?>
                        <div id="pos<?=$key+1?>" class="reward wheel-item-<?=$key+1?>">
                            <img src="<?=URL.$row['item_image']?>" alt="">
                        </div>
                    <?php endforeach;?>
                </div>
                <a href="<?=URI::get_path('wheel')?>">
                    <div id="again-play-btn" class="again-play-btn" style="display:none;">Geri Dön</div>
                </a>
                <div id="again-play-bg" class="again-play-bg" style="display:none;"></div>
            </div>
        </div>
        <div id="wheel-info" class="span2 small">
            <p>Çark şuanda dönüyor. Pencereyi kapattığınız dönme işlemi sonlanır ve herhangi bir ödül kazanmazsınız !</p>
        </div>
        <div id="fancybox-help" class="fancyboxContentContainer">
            <div id="wheel-help" class="contrast-box">
                <h2><i class="icon-info"></i>&nbsp;Yardım ve bilgi</h2>
                <div class="grey-box ">
                    <h3>Çark nedir?</h3>
                    <p>Kader Çarkı, çarkıfelek gibi işlev görür: Bir kere çevirmek için genelde belirli bir miktar Ejder Parası ödenir (kazanılan Ejderha Markası otomatik olarak hesabına geçirilir). Çarkın ortasındaki "Şimdi çevir" yazılı butona bir kere tıkladığında görüntülenen miktar hesabından çekilir. Mekanizma bu şekilde harekete geçer. Dış alanlarda şimdi kazanabileceğin ödüller görüntülenir ve şansın kadere bırakılır. Çarkın durduğu yerdeki eşya da senin ödülün olur.</p>
                    <h3>Bu kattan çıkılsın mı?</h3>
                    <p>"Bu kattan çıkılsın mı?" butonunu tıklayarak doğrudan 1.kata ışınlanırsın. Ama bir sonraki kata giden kapı kapanır ve tekrar açabilmen için tüm anahtarları yeniden toplaman gerekir.</p>
                </div>
            </div>
        </div>>
    </div>
</div>