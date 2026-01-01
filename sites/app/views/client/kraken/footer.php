</div>
<!-- /main -->
</div>
<!-- /container -->
</div>
<!-- /content -->
<div id="footer">
    <div class="container">
        <a class="social-fb" href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank"></a>
        <div class="footer-content">
            Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />
            Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.<br />
            <a href="https://www.viphosting.com.tr" target="_blank"><img src="<?=URL.'data/upload/logo-white-mini.png'?>" style="display: block;width: 100px;margin-right: auto;margin-left: auto;" alt="Metin2 PVP Sanal Sunucuları"></a>
        </div>
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