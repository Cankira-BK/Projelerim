</div><!-- .container-->

<footer class="footer">
    <div id="toTop">
    </div>
    <ul class="f-menu">
        <li>
            <a href="<?=URI::get_path('index')?>"><?=$lng[8]?></a>
        </li>
		<?php if (isset($_SESSION['aid'])):?>
            <li>
                <a href="<?=URI::get_path('profile')?>"><?=$lng[19]?></a>
            </li>
		<?php else:?>
            <li>
                <a href="<?=URI::get_path('register')?>"><?=$lng[10]?></a>
            </li>
		<?php endif;?>
        <li>
            <a href="<?=URI::get_path('download')?>"><?=$lng[0]?></a>
        </li>
        <li>
            <a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>" target="_blank"><?=$lng[14]?></a>
        </li>
        <li>
            <a href="<?=URL.MUTUAL?>" class="itemshop itemshop-btn iframe"><?=$lng[13]?></a>
        </li>
        <li>
            <a href="<?=URL.SHOP?>" class="itemshop itemshop-btn iframe"><?=$lng[12]?></a>
        </li>
        <li>
            <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>">Facebook</a>
        </li>
        <li>
            <a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>"><?=$lng[184]?></a>
        </li>
    </ul>
    <div class="f-info">
        <div class="copyright">
            <p class="rights">Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>" target="_blank"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a>.</p>
            <p class="copy">Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.</p>
        </div>
        <div class="design">
            <a href="https://www.viphosting.com.tr" target="_blank">
                <img src="<?=URL.'data/upload/logo-white-mini.png'?>" style="display: block;width: 100px;margin-right: auto;margin-left: auto;" alt="Metin2 PVP Sanal Sunucuları">
            </a>
        </div>
    </div>
</footer><!-- .footer -->
</div><!-- .wrapper -->
<script type="text/javascript" src="<?=URI::public_path('assets/js/jquery-2.1.4.min.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('assets/js/slider.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('main/js/fancybox.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('assets/js/main.js')?>"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<div id="loginModal" class="modalDialog">
    <div class="login-modal-content">
        <a href="javascript:void(0)" onclick="closeModal('loginModal')" title="Close" class="close">X</a>
        <h2><?=$lng[21]?></h2>
        <?php if (isset($_SESSION['aid'])):?>
		<?php echo Client::alert('error','Zaten giriş yaptınız!');?>
		<?php elseif ($urlLang[0] == 'register' || $urlLang[0] == 'login' || $urlLang[0] == 'recuperare'):?>
		<?php echo Client::alert('error','Bu sayfadayken bu özelliği kullanamazsınız!');?>
		<?php else:?>
            <form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="POST" class="page_form" autocomplete="off">
                <p>
                    <input type="text" placeholder="<?=$lng[22]?>" name="login" id="logModalLogin" maxlength="16" required>
                </p>
                <p>
                    <input type="password" placeholder="<?=$lng[23]?>" name="password" id="logModalPassword" required>
                </p>
				<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                    <p>
                        <input type="password" placeholder="PIN" name="pin" id="logModalPin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" required>
                    </p>
				<?php endif;?>
                <p>
                    <span id="recaptchaLogin" style="width:100%;transform: scale(0.71);margin-left: 21%;"></span>
                </p>

                <div class="modal-button">
                    <button type="submit"><?=$lng[21]?></button>
                </div>
            </form>
            <br>
            <p>
                <a href="<?=URI::get_path('recuperare/index')?>" style="text-transform: none;">Şifremi unuttum?</a>
            </p>
            <p>
                <a href="<?=URI::get_path('recuperare/account')?>" style="text-transform: none;">Kullanıcı adımı unuttum?</a>
            </p>
			<?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
                <p>
                    <a href="<?=URI::get_path('recuperare/pin')?>" style="text-transform: none;">PIN unuttum?</a>
                </p>
			<?php endif;?>
		<?php endif;?>
    </div>
</div>
<div id="registerModal" class="modalDialog">
    <div class="register-modal-content">
        <a href="javascript:void(0)" onclick="closeModal('registerModal')" title="Close" class="close" style="cursor: pointer">X</a>
        <h2 style="text-align: center;margin-top: 10px;">HIZLI KAYIT</h2>
		<?php if (\StaticDatabase\StaticDatabase::settings('register_status') == "0"):?>
			<?php echo Client::alert('error','Kayıtlarımız şuanda kapalıdır!');?>
		<?php elseif (isset($_SESSION['aid'])):?>
			<?php echo Client::alert('error','Zaten giriş yaptınız!');?>
        <?php elseif ($urlLang[0] == 'register' || $urlLang[0] == 'login' || $urlLang[0] == 'recuperare'):?>
			<?php echo Client::alert('error','Bu sayfadayken bu özelliği kullanamazsınız!');?>
		<?php else:?>
                <form action="<?=URI::get_path('register/control')?>" id="RegisterNotifyOGs" method="POST" class="page_form" autocomplete="off">
                    <p>
                        <input type="text" class="form-control2" name="login" id="regModalLogin" required maxlength="16" placeholder="<?=$lng[22]?>"/>
                    </p>
                    <p>
                        <input type="password" class="form-control2" name="password" id="regModalPassword" placeholder="<?=$lng[23]?>"/>
                    </p>
                    <p>
                        <input type="password" class="form-control2" name="password2" id="regModalPassword2" required placeholder="<?=$lng[94]?>"/>
                    </p>
					<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                        <p>
                            <input type="password" class="form-control2" name="pin" id="regModalPIN" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" onkeypress="return numberOnly(event,this)" placeholder="PIN"/>
                        </p>
					<?php endif;?>
                    <p>
                        <input type="email" class="form-control2" name="email" id="regModalEmail" required placeholder="<?=$lng[78]?>"/>
                    </p>
                    <p>
                        <input id="regModalName" type="text" name="name" class="form-control2" maxlength="30" required placeholder="<?=$lng[95]?>"/>
                    </p>
                    <p>
                        <input id="regModalKSK" type="text" name="ksk" class="form-control2" maxlength="7" onkeypress="return numberOnly(event,this)" required placeholder="<?=$lng[96]?>"/>
                    </p>
                    <p>
                        <input type="text" id="regModalPhone" name="phone" class="form-control2" maxlength="10" onkeypress="return numberOnly(event,this)" placeholder="<?=$lng[97]?>"/>
                    </p>
					<?php if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1"): ?>
						<?php
						$findMeList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM findme_list");
						$findMeList->execute();
						?>
                        <p>
                            <select id="regModalFindMe" name="findme" class="custom-select" style="width: 217px;background: rgba(2, 1, 1, 0.4);height: 35px;">
                                <option value="0" selected>Bizi nerden buldunuz?</option>
								<?php foreach ($findMeList->fetchAll(PDO::FETCH_ASSOC) as $row):?>
                                    <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
								<?php endforeach;?>
                            </select>
                        </p>
					<?php endif;?>
                    <p>
                        <span id="recaptchaRegister" style="width:100%;transform: scale(0.71);margin-left: 22%;"></span>
                    </p>
                    <div class="modal-button">
                        <button type="submit">Kayıt Ol</button>
                    </div>
                </form>
		<?php endif;?>
    </div>
</div>
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
<script src="<?=URI::public_path()?>main/js/notify.js"></script><script src="<?=URL.'data/extra/notify/ogstudio.js'?>"></script>
</body>
</html>