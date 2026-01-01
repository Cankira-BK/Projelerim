<footer class="main">
    <div class="container">
        <div class="row">
            <div class="footer-nav col-md-3">
                <h4><span class="glyphicon glyphicon-tower"></span> Menu</h4>
                <ul class="list-unstyled">
                    <li><a href="<?=URI::get_path('index')?>"><?=$lng[8]?></a></li>
                    <li><a href="<?=URI::get_path('download/index');?>"><?=$lng[0]?></a></li>
                    <li><a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>"><?=$lng[12]?></a></li>
                    <li><a href="<?=URI::get_path('ranked/player')?>"><?=$lng[65]?></a></li>
                    <li><a href="<?=URI::get_path('ranked/guild')?>"><?=$lng[66]?></a></li>
                </ul>
            </div>
            <div class="footer-nav col-md-3">
                <h4><span class="glyphicon glyphicon-user"></span> <?=$lng[9]?></h4>
                <ul class="list-unstyled">
                    <?php if (isset($_SESSION['aid'])):?>
                        <li><a href="<?=URI::get_path('profile/index');?>"><?=$lng[9]?></a></li>
                        <li><a href="<?=URI::get_path('login/logout');?>"><?=$lng[20]?></a></li>
                    <?php else:?>
                        <li><a href="<?=URI::get_path('login/index');?>"><?=$lng[21]?></a></li>
                        <li><a href="<?=URI::get_path('register/step1');?>"><?=$lng[10]?></a></li>
                        <li><a href="<?=URI::get_path('recuperare/index');?>"><?=$lng[25]?></a></li>
                    <?php endif;?>
                </ul>
            </div>
            <div class="footer-nav col-md-3">
                <h4><span class="glyphicon glyphicon-globe"></span> <?=$lng[175]?></h4>
                <ul class="list-unstyled">
                    <li><a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>" target="_blank">Forum</a>
                    </li>
                    <li><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank">Facebook</a>
                    </li>
                    <li><a href="<?=\StaticDatabase\StaticDatabase::settings('youtube')?>" target="_blank">Youtube</a>
                    </li>
                </ul>
            </div>
            <div class="footer-nav col-md-3">
                <h4><span class="glyphicon glyphicon-cog"></span> <?=$lng[13]?></h4>
                <ul class="list-unstyled">
                    <li><a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>"><?=$lng[13]?></a></li>
                    <li><a href="<?=URI::get_path('privacy/index')?>"><?=$lng[171]?></a></li>
                </ul>
            </div>
        </div>
        <div class="row footer-text">
            <div class="col-md-12 text-center">
                <p>
                    Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />
                    Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.<br/>
                    <a href="https://www.viphosting.com.tr" target="_blank"><img src="<?=URL.'data/upload/logo-white-mini.png'?>" style="display: block;width: 100px;margin-right: auto;margin-left: auto;" alt="Metin2 PVP Sanal Sunucuları"></a>
                </p>
            </div>
        </div>
    </div>
</footer>
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