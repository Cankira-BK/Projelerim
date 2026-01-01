<?php
$sId = Session::get('sId');
$urlLang = isset($_GET['url']) ? $_GET['url'] : null;
$urlLang = rtrim($urlLang,'/');
$urlLang = filter_var($urlLang,FILTER_SANITIZE_URL);
$urlLang = explode('/', $urlLang);
if($sId == null){
	Session::set('sId','site');
}
$aid = isset($_SESSION['aid']) ? $_SESSION['aid'] : null;
if (isset($aid)){
	$avatar = isset($playerInfo[0]['job']) ? $playerInfo[0]['job'] : null;
	$getAin = \StaticGame\StaticGame::sql("SELECT ".CASH.",".MILEAGE." FROM account WHERE id = ?",[$aid])[0];
}

if (Cache::check('server_statistics')){
	if (\StaticDatabase\StaticDatabase::settings('total_online_status')){
		$getCount['totalOnline'] = Statistics::online();
	}

	if (\StaticDatabase\StaticDatabase::settings('total_player_status')){
		$getCount['totalPlayer'] = Statistics::player();
	}

	if (\StaticDatabase\StaticDatabase::settings('total_account_status')){
		$getCount['totalAccount'] = Statistics::account();
	}

	if (\StaticDatabase\StaticDatabase::settings('today_login_status')){
		$getCount['todayLogin'] = Statistics::todayLogin();
	}

	if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')){
		$getCount['activePazar'] = Statistics::offlineShop();
	}
}

if (Cache::check('player_ranking')){
	$result['topplayer'] = Statistics::topPlayer(5);
	$result['topguild'] =  Statistics::topGuild(5);
}
?>
<body><!-- Load Facebook SDK for JavaScript --><div id="fb-root"></div><script async defer crossorigin="anonymous" src="https://connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v9.0" nonce="ISXzHwuQ"></script>
<?php if (\StaticDatabase\StaticDatabase::settings('multi_languages')):?>    <style>.languagepicker{background-color: #FFF; margin: 60px 0 0 0; display: inline-block; padding: 0; height: 40px; overflow: hidden; transition: all .3s ease; vertical-align: top; float: left; position: fixed; right: 0px; z-index: 999;}.languagepicker:hover{/* don't forget the 1px border */ height: 81px;}.languagepicker a{color: #000; text-decoration: none;}.languagepicker li{display: block; padding: 0px 10px; line-height: 40px; border-top: 1px solid #EEE;}.languagepicker li:hover{background-color: #EEE;}.languagepicker a:first-child li{border: none; background: #FFF !important;}.languagepicker li img{margin-top: 7px;}.roundborders{-webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;}.large:hover{height: <?=Translate::translateButton("count")*45?>px;}</style>    <ul class="languagepicker roundborders large"><?=Translate::translateButton("html")?></ul><?php endif;?>
<style>
    .logo-header .logo
    {
        display: block;
        margin-right: auto;
        margin-left: auto;
        width: <?=\StaticDatabase\StaticDatabase::settings('logo_width')?>;
        left: <?=\StaticDatabase\StaticDatabase::settings('logo_position_x')?>;
        right: 0;
        position: absolute;
        filter: <?=\StaticDatabase\StaticDatabase::settings('logo_filter')?>;
        margin-top: <?=\StaticDatabase\StaticDatabase::settings('logo_position_y')?>;
    }

    .logo:hover
    {
        filter: <?=\StaticDatabase\StaticDatabase::settings('logo_hover')?>;
    }
</style>
<!-- Header -->
<div id="header">
    <div class="container">
        <a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim');?>">
            <div class="server">
                <div>
                    <img src="<?=URI::public_path()?>layout/assets/images/button_page.png" alt="" />
                </div>
            </div>
        </a>
        <a href="<?=URI::get_path('download')?>">
            <div class="server" style="float: right;margin-top: -102px;background: none;margin-right: 120px;">
                <button type="submit" class="btn-login animated infinite pulse" name="login-submit"><span><?=$lng[0]?></span>
                </button>
            </div>
        </a>
        <a href="<?=URI::get_path('index')?>">
            <div class="logo-header">
                <img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" class="logo">
            </div>
        </a>
    </div>
</div>
<!-- /header -->

<!-- Content -->
<div id="content">

    <!-- Play -->
    <div id="nowButton" class="btn-begin">
        <div id="nowButton2" class="bg"></div>
        <a id="nowButton3" href="<?=URI::get_path('register')?>">
            <img src="<?=URI::public_path()?>layout/assets/images/now.png" alt="" />
        </a>
        <div class="bg-hover"></div>
    </div>
    <!-- /play -->

    <!-- Mobile menu -->
    <div class="mobile-menu">
        <div id="mobile-panel-player" class="mobile-menu-item"><a href="<?=URI::get_path('login')?>"><h2>Giriş Yap</h2></a></div>
        <div id="mobile-panel-player" class="mobile-menu-item"><a href="<?=URI::get_path('register')?>"><h2>Kayıt Ol</h2></a></div>
    </div>
    <!-- /mobile menu -->

    <!-- Container -->
    <div class="container">

        <!-- Left sidebar -->
        <div class="sidebar sidebar-left">
            <div id="panel-menu" class="panel">
                <div class="panel-header">
                    <h2><?=$lng[1]?></h2><span class="close-panel">&larr;</span>
                </div>
                <div class="panel-content">
                    <div class="panel-inner">
                        <ul class="menu">
                            <?php Cache::open('server_statistics');?>
                            <?php if (Cache::check('server_statistics')):?>
                            <?php if (\StaticDatabase\StaticDatabase::settings('total_online_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0 || \StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0):?>
                            <div id="l2_statistics_title"><?=$lng[2]?></div>
                            <div id="l2_statistic_box">
                                <?php if (\StaticDatabase\StaticDatabase::settings('total_online_status')):?>
                                <div>
                                    <div class="l2_statistic_key_title"><?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></div>
                                    <div class="l2_statistic_key_value"><?=$lng[3]?></div>
                                </div>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('today_login_status')):?>
                                <div>
                                    <div class="l2_statistic_key_title"><?=$getCount['todayLogin']['count'] + \StaticDatabase\StaticDatabase::settings('todaylogin')?></div>
                                    <div class="l2_statistic_key_value"><?=$lng[4]?></div>
                                </div>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
                                <div>
                                    <div class="l2_statistic_key_title"><?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?></div>
                                    <div class="l2_statistic_key_value"><?=$lng[5]?></div>
                                </div>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
                                <div>
                                    <div class="l2_statistic_key_title"><?=$getCount['totalPlayer']['count'] + \StaticDatabase\StaticDatabase::settings('totalplayer')?></div>
                                    <div class="l2_statistic_key_value"><?=$lng[6]?></div>
                                </div>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
                                <div>
                                    <div class="l2_statistic_key_title"><?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?></div>
                                    <div class="l2_statistic_key_value"><?=$lng[7]?></div>
                                </div>
								<?php endif;?>
                           </div>
								<?php endif;?>
							<?php endif;?>
                            <?php Cache::close('server_statistics');?>
                            <li><a href="<?=URI::get_path('index')?>"><?=$lng[8]?><br /></a></li>
                            <li><a href="<?=URI::get_path('download')?>"><?=$lng[0]?><br /></a></li>
                            <?php if (isset($_SESSION['aid'])):?>
                                <li><a href="<?=URI::get_path('profile/index')?>"><?=$lng[9]?><br /></a></li>
                            <?php else:?>
                                <li><a href="<?=URI::get_path('register')?>"><?=$lng[10]?><br /></a></li>
                            <?php endif;?>
                            <li><a href="<?=URI::get_path('ranked/player')?>"><?=$lng[11]?><br /></a></li>
                            <li><a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>"><?=$lng[12]?><br /></a></li>
                            <li><a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>"><?=$lng[13]?><br /></a></li>
                            <li><a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>" target="_blank"><?=$lng[14]?><br /></a>
                        </ul>
                    </div>
                </div>
            </div>

            <?php if (\StaticDatabase\StaticDatabase::settings('event_type') != "3"):?>
                <!-- Rank -->
                <div id="panel-rank" class="panel">
                    <div class="panel-header"><h2><?=$lng[15]?></h2><span class="close-panel">&rarr;</span></div>
                    <div class="panel-content">
                        <div class="panel-inner">
							<?php if(\StaticDatabase\StaticDatabase::settings('event_type') == "1"):?>
                                <iframe src="<?=URI::get_path('event')?>" style="border: none;width: 210px;height: 300px;" id="fancybox-frame"></iframe>
							<?php else:?>
                                <iframe src="<?=URI::get_path('event/dynamic')?>" style="border: none;width: 273px; height: 301px;left: 0px;" id="fancybox-frame"></iframe>
							<?php endif;?>
                        </div>
                        <script>
                            $("#fancybox-frame").load(function(){
                                $(this).contents().find("#container").css("margin-left", "-60px");
                            });
                        </script>
                    </div>
                    <!-- /rank -->
                </div>
            <?php endif;?>
        </div>
        <!-- /left sidebar -->

        <!-- Right sidebar -->
        <div class="sidebar sidebar-right">
            <?php if (isset($_SESSION['aid'])):?>
                <div id="panel-login" class="panel panel-login">
                    <div class="panel-header"><h2><?=$lng[16]?></h2><span class="close-panel">&rarr;</span></div>
                    <div class="panel-content">
                        <div class="panel-inner">
                            <div class="player-card">
                                <h3><?=$_SESSION['cLogin'];?></h3>
                                <img src="<?=URL.'data/chrs/medium/'.$avatar.'.png'?>" onerror="this.src='<?=URL.'data/chrs/medium/0.png'?>';" class="player-img" style="padding: 0px;"><br>
                            </div>
                                <div class="player-row">
                                    <strong> <?=$lng[17]?> : </strong>
                                    <span> <?=$getAin[CASH]?> EP</span>
                                </div>
                                <div class="player-row">
                                    <strong> <?=$lng[18]?> : </strong>
                                    <span> <?=$getAin[MILEAGE]?> EM</span>
                                </div>
                        </div>
                        <a class="btn" href="<?=URI::get_path('profile/index')?>" style="margin-bottom: 5px;"><?=$lng[19]?></a>
                        <a class="btn" href="<?=URI::get_path('login/logout')?>"><?=$lng[20]?></a>
                    </div>
                </div>
            <?php else:?>
                <?php if ($urlLang[0] != 'register' && $urlLang[0] != 'login' && $urlLang[0] != 'recuperare'):?>
                <div id="panel-login" class="panel panel-login">
                    <div class="panel-header"><h2><?=$lng[21]?></h2><span class="close-panel">&rarr;</span></div>
                    <div class="panel-content">
                        <div class="panel-inner">
                            <form method="POST" action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" autocomplete="off">
                                <label for="login"><?=$lng[22]?></label>
                                <div class="input input-rich">
                                    <input type="text" name="login" id="login" placeholder="<?=$lng[22]?>" />
                                </div>

                                <label for="password"><?=$lng[23]?></label>
                                <div class="input input-rich">
                                    <input type="password" name="password" id="password" placeholder="<?=$lng[23]?>" />
                                </div>

				                <?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                                <label for="password">PIN</label>
                                <div class="input input-rich">
                                    <input type="password" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" placeholder="PIN" />
                                </div>
				                <?php endif;?>

                                <label for="pin"><?=$lng[24]?></label>
                                <script src='https://www.google.com/recaptcha/api.js'></script>
                                <div class="g-recaptcha rc-anchor-dark" style="transform:scale(0.68);margin-left: 3px;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
                                <button type="submit" class="btn-login" name="login-submit"><span><?=$lng[21]?></span></button>
                            </form>
                        </div>
                        <center>
                            <a href="<?=URI::get_path('recuperare')?>"><h4><i class="icon-lock position-left"></i> <?=$lng[25]?></h4></a>
                        </center>
                        <br>
                        <center>
                            <a href="<?=URI::get_path('recuperare/account')?>"><h4><i class="icon-user position-left"></i><?=$lng[26]?></h4></a>
                        </center>
                        <br>
                        <?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
                            <center>
                                <a href="<?=URI::get_path('recuperare/account')?>"><h4><i class="icon-lock position-left"></i>PIN Unuttum</h4></a>
                            </center>
                        <?php endif;?>
                    </div>
                </div>
                <script>
                    $("#loginForm").on('submit', function (event) {
                        event.preventDefault();

                        var url = $(this).attr("action");
                        var data = $(this).serialize();

                        $.ajax({
                            url : url,
                            type : 'POST',
                            data : data,
                            dataType : 'json',
                            success : function (response) {
                                if (response.result)
                                    window.location.href = response.redirect;
                                else
                                {
                                    errorNotify(response.message);
                                    grecaptcha.reset();
                                }
                            }
                        });
                    });
                </script>
                <?php endif;?>
            <?php endif;?>

			<?php Cache::open('player_ranking');?>
            <?php if (Cache::check('player_ranking')):?>
            <!-- Rank -->
            <div id="panel-rank" class="panel">
                <div class="panel-header panel-header-rank"><h2><?=$lng[27]?></h2><span class="close-panel">&rarr;</span></div>
                <div class="panel-content">
                    <div class="panel-inner">
                        <?php if (count($result['topplayer']) != 0):?>
                        <table class="rank-table">
                            <tbody>
                            <?php foreach ($result['topplayer'] as $key=>$row):?>
                            <tr>
                                <td><img src="<?=URI::public_path()?>layout/assets/images/<?=$key+1?>.png" alt="<?=$key+1?>" /></td>
                                <td><a href="<?=URI::get_path('detail/player/'.$row['name'])?>"><?=$row['name']?></a></td>
                                <td><?=$row['level']?></td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php else:?>
							<?=$lng[28]?>
                        <?php endif;?>
                    </div>
                    <?php if (count($result['topplayer']) != 0):?>
                    <a class="btn" href="<?=URI::get_path('ranked/player')?>"><?=$lng[29]?></a>
                    <?php endif;?>
                </div>
                <!-- /rank -->
            </div>
            <div id="panel-rank" class="panel">
                <div class="panel-header panel-header-rank"><h2><?=$lng[30]?></h2><span class="close-panel">&rarr;</span></div>
                <div class="panel-content">
                    <div class="panel-inner">
                        <?php if (count($result['topguild']) != 0):?>
                            <table class="rank-table">
                                <tbody>
                                <?php foreach ($result['topguild'] as $key=>$row):?>
                                    <tr>
                                        <td><img src="<?=URI::public_path()?>layout/assets/images/<?=$key+1?>.png" alt="<?=$key+1?>" /></td>
                                        <td><a href="<?=URI::get_path('detail/guild/'.$row['name'])?>"><?=$row['name']?></a></td>
                                        <td><?=$row['ladder_point']?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        <?php else:?>
							<?=$lng[31]?>
                        <?php endif;?>
                    </div>
                    <?php if (count($result['topguild']) != 0):?>
                        <a class="btn" href="<?=URI::get_path('ranked/guild')?>"><?=$lng[29]?></a>
                    <?php endif;?>
                </div>
                <!-- /rank -->
            </div>
            <?php endif;?>
        <?php Cache::close('player_ranking')?>

        </div>
        <!-- /right sidebar -->
        <!-- Main -->
        <div class="main">