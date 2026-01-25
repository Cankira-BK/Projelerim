<div class="clear"></div>
</div>
</div>

<div id="content_bottom">
    <a href="#topHref"><div id="topbtn"></div></a>
    <script>
        $(window).scroll(function(){
            if ($(this).scrollTop() > 100)
                $("#topbtn").fadeIn(500);
            else
                $("#topbtn").fadeOut(500);
        });
        $(document).ready(function(){
            $("#topbtn").click(function(){
                $("html, body").animate({ scrollTop: "0" }, 1000);
                return false;
            });
        });
    </script>
    <div class="inner_content">
        <div class="left"><br>
            Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />
            Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>" style="color: #e5a734;"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.<br/>
            <br>
        </div>
        <div class="right">
            <ul class="subsites">
                <li class="first"><a href="<?=URI::get_path('index')?>"><?=$lng[8]?></a></li>
                <li><a href="<?=URI::get_path('register')?>"><?=$lng[10]?></a></li>
                <li><a href="<?=URI::get_path('register')?>" id="download"><?=$lng[0]?></a></li>
                <li class="first"><a href="<?=URI::get_path('ranked/player')?>"><?=$lng[11]?></a></li>
                <li><a href="<?=URL.MUTUAL?>" class="itemshop itemshop-btn iframe"><?=$lng[13]?></a></li>
                <li><a href="<?=URL.SHOP?>" class="itemshop itemshop-btn iframe"><?=$lng[12]?></a></li>
                <li class="first"><a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>" target="_blank"><?=$lng[14]?></a></li>
            </ul>
        </div>
    </div>			</div>
</div>
</div>

<div id="dim"></div>

<?php if (isset($_SESSION['aid'])):?>
    <div id="loginbox" class="dimhides popupwindow">
        <div class="real_content">
            <div class="headline"><span class="title"><?=$lng[136]?> </span></div>
            <div class="p3px">
                <div class="real_content">

                    <form action="" method="POST">
                        <div align="center">
							<?=$lng[22]?> : <?=Session::get('cLogin')?><br>
							<?=$lng[17]?> :  <?=$getAin[CASH]?> EP<br>
							<?=$lng[18]?> :  <?=$getAin[MILEAGE]?> EM<hr>
                            <a href="<?=URI::get_path('profile')?>"><?=$lng[19]?></a> <br>
                            <a href="<?=URI::get_path('login/logout')?>"><?=$lng[20]?></a>
                            <br>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php else:?>
	<?php if ($urlLang[0] != 'register' && $urlLang[0] != 'login' && $urlLang[0] != 'recuperare'):?>
        <div id="loginbox" class="dimhides popupwindow">
            <div class="real_content">
                <div class="headline"><span class="title"><?=$lng[21]?> </span></div>
                <div class="p3px">
                    <div class="real_content">

                        <form method="POST" action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs">
                            <table>
                                <tr>

                                    <td><input style="width: 95%;" type="text" name="login" id="username" placeholder="<?=$lng[22]?>"></td>
                                </tr>
                                <tr>

                                    <td><input style="width: 95%;" type="password" id="password" name="password" placeholder="<?=$lng[23]?>"></td>
                                </tr>
								<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                                    <tr>
                                        <td><input style="width: 95%;" type="password" id="pin" name="pin" placeholder="PIN" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>"></td>
                                    </tr>
								<?php endif;?>
                                <tr>

                                    <td>
                                        <script src='https://www.google.com/recaptcha/api.js'></script>
                                        <div class="g-recaptcha rc-anchor-dark" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input style="width: 100%;" type="submit" name="submit" value="<?=$lng[21]?>"></td>
                                </tr>
                                <tr>
                                    <td style="text-align: right">
                                        <a href="<?=URI::get_path('recuperare')?>" class="small italic"><?=$lng[25]?></a>
                                        <br />
                                        <a href="<?=URI::get_path('recuperare/account')?>" class="small italic"><?=$lng[26]?></a>
                                    </td>
                                </tr>
                            </table>

                        </form>

                    </div>
                </div>
            </div>
        </div>
	<?php else:?>
        <div id="loginbox" class="dimhides popupwindow">
            <div class="real_content">
                <div class="headline"><span class="title"><?=$lng[21]?> </span></div>
                <div class="p3px">
                    <div class="real_content">

                        <h3 class="small italic"><?=$lng[173]?></h3>
                    </div>
                </div>
            </div>
        </div>
	<?php endif;?>
<?php endif;?>
<?php if (\StaticDatabase\StaticDatabase::settings('discord_status') == "1"):?>
    <style>

        .discord-widget {
            position: fixed;
            bottom: 0;
            z-index:10;
        }


        .discord-widget.active
        {
            right: 20px;
        }
    </style>
    <a class="discord-widget animated bounceInLeft" href="<?php echo \StaticDatabase\StaticDatabase::settings('discord_link')?>" title="Join us on Discord">
        <img src="https://discordapp.com/api/guilds/<?php echo \StaticDatabase\StaticDatabase::settings('discord_id')?>/embed.png?style=<?php echo \StaticDatabase\StaticDatabase::settings('discord_theme')?>">
    </a>
<?php endif;?>
<?php if (\StaticDatabase\StaticDatabase::settings('tawkto_status') == "1"):?>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/'+"<?php echo \StaticDatabase\StaticDatabase::settings('tawkto_id')?>"+'/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
<?php endif;?>
<script src="<?=URI::public_path()?>main/js/notify.js"></script>
<script src="<?=URL.'data/extra/notify/ogstudio.js'?>"></script>
</body>
</html>