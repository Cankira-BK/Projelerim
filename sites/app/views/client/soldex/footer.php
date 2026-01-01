<footer class="footer">
    <div class="block-top">
        <div id="toTop"></div>
    </div>
    <center>
        <div class="footer-info">
            <div class="f-menu">
                <ul>
                    <li><a href="<?=URI::get_path('index')?>"><?=$lng[8]?></a></li>
					<?php if (isset($_SESSION['aid'])):?>
                        <li><a href="<?=URI::get_path('profile')?>"><?=$lng[19]?></a></li>
					<?php else:?>
                        <li><a href="<?=URI::get_path('register')?>"><?=$lng[10]?></a></li>
					<?php endif;?>
                    <li><a href="<?=URI::get_path('download')?>" id="download"><?=$lng[0]?></a></li>
                    <li><a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>" target="_blank"><?=$lng[14]?></a></li>
                    <li><a href="<?=URI::get_path('ranked/player')?>" target="_blank">Sıralama</a></li>
                    <li><a href="<?=URL.MUTUAL?>" class="itemshop itemshop-btn iframe"><?=$lng[13]?></a></li>
                    <li><a href="<?=URL.SHOP?>" class="itemshop itemshop-btn iframe"><?=$lng[12]?></a></li>
                    <li><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank">Facebook</a></li>
                    <li><a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>" id="download">Tanıtım</a></li>
                </ul>
            </div>
        </div>

        <div class="f-logo">
            Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />
            Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.<br />
            <a href="https://www.viphosting.com.tr" target="_blank"><img src="<?=URL.'data/upload/logo-white-mini.png'?>" style="display: block;width: 100px;margin-right: auto;margin-left: auto;" alt="Metin2 PVP Sanal Sunucuları"></a>
        </div>
    </center>
</footer>
<!-- .footer -->
</div>
<script src="<?=URI::public_path()?>asset/js/jed.js"></script>
<script src="<?=URI::public_path()?>asset/js/jquery.leanModal.min.js"></script>
<script src="<?=URI::public_path()?>asset/js/jquery.tooltip.js"></script>
<script src="<?=URI::public_path()?>asset/js/ejs.js"></script>
<script src="<?=URI::public_path()?>asset/js/helpers.js"></script>
<script src="<?=URI::public_path()?>asset/js/app.js"></script>
<script src="<?=URI::public_path()?>asset/js/global.js"></script>
<script src="<?=URI::public_path()?>asset/js/slick.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>main/js/notify.js"></script>
<script src="<?=URL.'data/extra/notify/ogstudio.js'?>"></script>
<script>
    $('.YoutubeSliders').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
    });

    $('.gaya-magazasi-icerik').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
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
</body>
</html>