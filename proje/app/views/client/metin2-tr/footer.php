<footer role="contentinfo">
	<div class="container">
		<!-- age -->
		<a class="pegi" href="http://www.pegi.info/tr/" target="_blank">
			<img style="width: 46px;" src="//gf1.geo.gfsrv.net/cdn95/e338bdbd2fe912366fbf0d507d85a3.png" alt="PEGI 12"/>
			<img src="//gf2.geo.gfsrv.net/cdnae/259a306a748760a35edd45b9290a2a.png" alt="Online"/>
			<img src="//gf3.geo.gfsrv.net/cdnee/38712bcd24152058ca1e41da984f26.png" alt="Gewalt"/>
		</a>
		<a class="usk" href="http://www.usk.de/en/" target="_blank">
			<img src="//gf1.geo.gfsrv.net/cdn07/a3b20580853004c9d483a205857635.png" alt="USK 12"/>
		</a>
		<a class="safeplay" href="https://corporate.gameforge.com/games/?lang=en#safe-play" target="_blank">
			<img src="//gf1.geo.gfsrv.net/cdn38/6d622f73816910cab615070ef575b8.png" alt="safeplay"/>
		</a>

		<!-- copyrights -->
		<p>
            Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />
            Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>" style="color: white;"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.</p>
            <a href="https://www.viphosting.com.tr" target="_blank"><img src="<?=URL.'data/upload/logo-white-mini.png'?>" style="display: block;width: 100px;margin-right: auto;margin-left: auto;" alt="Metin2 PVP Sanal Sunucuları"></a>
    </div>
</footer>
<?php if (\StaticDatabase\StaticDatabase::settings('discord_status') == "1"):?>
    <style>

        .discord-widget {
            position: fixed;
            bottom: 0;
            z-index:9999;
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