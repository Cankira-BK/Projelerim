</div>

<div style="text-align: center">
	<div class="footer" style="margin-top: 30px;">
        <div style="margin-top: 85px;font-size: 10px;">
            Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />
            Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.<br>
        </div>
    </div>
</div>
</div>
<div class="wopac"></div>
<?php if (!isset($_SESSION['aid'])):?>

<div class="registerArea">
	<form method="post" action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs">
		<div class="row2" style="margin-top: 0;">
			<label><?=$lng[22]?> :</label>
			<input type="text" name="login"/>
		</div>
		<div class="sperator"></div>
		<div class="row2">
			<label><?=$lng[23]?> :</label>
			<input type="password" name="password"/>
		</div>
		<div class="sperator"></div>
		<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
            <div class="row2">
                <label>PIN :</label>
                <input type="password" name="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>"/>
            </div>
            <div class="sperator"></div>
		<?php endif;?>
	<?php if ($urlLang[0] != 'register' && $urlLang[0] != 'login' && $urlLang[0] != 'recuperare'):?>
		<div class="row2">
			<label><?=$lng[24]?> :</label>
            <script src='https://www.google.com/recaptcha/api.js'></script>
            <div class="g-recaptcha rc-anchor-dark" style="margin-left: 3px;margin-top: 15px;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
		</div>
	<?php endif;?>
		<div class="row" style="text-align: left;">
			<input type="submit" class="loginbt" value="<?=$lng[21]?>" />
			<div class="registerBottom">
				<a href="<?=URI::get_path('recuperare')?>"><?=$lng[25]?></a>
				<a style="float: right;" href="<?=URI::get_path('recuperare/account')?>"><?=$lng[26]?></a>
			</div>
		</div>
	</form>
</div>
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
<script type="text/javascript" src="<?=URI::public_path()?>assets/js/wowslider.js"></script>
<script type="text/javascript" src="<?=URI::public_path()?>assets/js/brick.js"></script>
<script src="<?=URI::public_path()?>main/js/notify.js"></script>
<script src="<?=URL.'data/extra/notify/ogstudio.js'?>"></script>

<script type="text/javascript">
    var nowItemNum = 0;


    function witemHandler() {
        $("div[data-item-info]").unbind("mouseenter");
        $("div[data-item-info]").mouseenter(function () {
            var itemNum = $(this).attr("data-num");
            var itemInfo = $(this).attr("data-item-info");
            if (itemNum != nowItemNum) {
                nowItemNum = itemNum;
                $("#wtooltip").html(itemInfo);
            }
            $("#wtooltip").show();
        });

        $("div[data-item-info]").unbind("mousemove");
        $("div[data-item-info]").mousemove(function (e) {
            var width = $("#wtooltip").css("width");
            try {
                width = width.replace("px", "") / 2;
            } catch (e) { }

            var screenWidth = $(window).width();
            var screenHeight = $(window).height();

            var X = e.pageX - width;
            var Y = e.pageY + 25;


            if (X + $("#wtooltip").width() > screenWidth)
                X -= (X + $("#wtooltip").width()) - screenWidth + 25;

            $("#wtooltip").css("left", X).css("top", Y);
        });

        $("div[data-item-info]").unbind("mouseleave");
        $("div[data-item-info]").mouseleave(function () {
            $("#wtooltip").hide();
        });

    }

    witemHandler();

</script>
</body>
</html>