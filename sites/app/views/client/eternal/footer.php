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
            s1.src='https://embed.tawk.to/<?php echo \StaticDatabase\StaticDatabase::settings('tawkto_id')?>/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
<?php endif;?>
<div class="clear"></div>
<!-- BODY Content end here -->
</div>
</div>
<footer id="footer">
    <span> Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.<br/></span>
</footer>
<?php if ($urlLang[0] != 'register' && $urlLang[0] != 'login' && $urlLang[0] != 'recuperare' && $urlLang[0] != 'profile'):?>
    <div id="login-box-container">
        <div class="login-box-holder">
            <div class="login-box">
                <form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="post" accept-charset="utf-8">
                    <span class="warfg_input" style=""><input type="text" name="login" id="login_username" value="" placeholder="Kullanıcı adı" autocomplete="off" class="styled-input"></span><br>
                    <span class="warfg_input" style=""><input type="password" name="password" id="login_password" value="" placeholder="Şifre" autocomplete="off" class="styled-input"></span><br>
                    <?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') == 1) {?><span class="warfg_input" style=""><input type="password" name="pin" id="login_pin" value="" placeholder="Pin Kodu" autocomplete="off" class="styled-input"></span><br><?php }?>
                    <?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {?>
                        <script src='https://www.google.com/recaptcha/api.js'></script>
                        <div class="g-recaptcha rc-anchor-dark" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
					<?php }?>
					<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {?>
						<script src='https://hcaptcha.com/1/api.js'></script>
						<div class="h-captcha rc-anchor-dark" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
					<?php }?>
                    <div class="login-box-row">
                        <span class="warfg_btn" style=""><input type="submit" name="login_submit" value="Giriş" class="styled-input"></span>
                        <div class="login-box-options">
                            <a href="<?=URI::get_path('recuperare')?>" data-hasevent="1">Şifremi Unuttum?</a><br>
                            <a href="<?=URI::get_path('recuperare/account')?>" data-hasevent="1">Hesap Adımı Unuttum?</a><br>
                        </div>
                    </div>
                    <div class="clear"></div>
                </form>
            </div>
            <a href="#" class="close_btn" onclick="CustomJS.toggleLogin(event, this)"></a>
        </div>
    </div>
<?php endif;?>
<!-- Login Form.End -->
<script src="<?=URI::public_path()?>main/js/notify.js"></script>
<script src="<?=URL.'data/extra/notify/ogstudio.js'?>"></script>
<script type="text/javascript">
    function toggleLogin(event, element) {
        if(typeof CustomJS !== 'undefined')
            CustomJS.toggleLogin(event, element);
        else
            document.location.replace('login.html');
    };
</script>
</body>
</html>