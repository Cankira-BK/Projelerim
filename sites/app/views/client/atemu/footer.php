</div>
<div class="row">
    <div class="col-md-12">
        <div class="footer">
            <div class="footer_ust hidden-xs">
                <ul>
                    <li><a href="<?=URI::get_path('download')?>"><?=$lng[0]?></a></li>
                    <li><a href="<?=URI::get_path('ranked/player')?>"><?=$lng[65]?></a></li>
                    <li><a href="<?=URI::get_path('ranked/guild')?>"><?=$lng[66]?></a></li>
                    <li><a href="<?=URI::get_path('privacy')?>"><?=$lng[171]?></a></li>
                    <li><a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>"><?=$lng[146]?></a></li>
                    <li><a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>"><?=$lng[147]?></a></li>
                    <li><a target="_blank" href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>">Facebook</a></li>
                    <li><a target="_blank" href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>"><?=$lng[14]?></a></li>
                    <li><a target="_blank" href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>"><?=$lng[175]?></a></li>
                </ul>
                <div style="clear:both"></div>
            </div>
            <div style="clear:both;"></div>
            <div class="col-md-12">
                <div class="col-md-6 col-md-offset-3">
                    <div class="text-center" style="margin-top: 5px;margin-bottom: 5px;color: #b1b1b1">
                        Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />
                        Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.<br/>
                    </div>
                </div>

            </div>

        </div>
    </div>
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

<div id="yukari" class="yukari_don" data-toggle="tooltip" data-placement="left" title="" data-original-title="Sayfanın başına dönmek için tıklayınız." style="display: none"><i class="glyphicon glyphicon-chevron-up"></i></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?=URI::public_path('assets/js/bootstrap.min.js')?>"></script>
<script src="<?=URI::public_path('assets/js/main.js')?>"></script>
<script src="<?=URL.'data/extra/notify/bootstrap-notify.js'?>"></script>
<script src="<?=URL.'data/extra/notify/ogstudio.js'?>"></script>
<script type="text/javascript" src="<?=URI::public_path('assets/js/fancybox.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var screenSize = $(window).height();
        var compareW = 767;
        if (screenSize > 0 && screenSize < compareW) {
            var fancy_a = 740;
            var fancy_b = 550;
            var fancy_c = "ishopbg-small";
            var fancy_d = "13px";
            var fancy_e = "3px";
            var fancy_f = "13px";
            var fancy_g = 754;
            var fancy_h = 574;
            var fancy_i = 6;
            var fancy_j = 20;
        }
        else
        {
            var fancy_a = 1016;
            var fancy_b = 655;
            var fancy_c = "ishopbg";
            var fancy_d = "16px";
            var fancy_e = "7px";
            var fancy_f = "16px";
            var fancy_g = 1032;
            var fancy_h = 690;
            var fancy_i = 8;
            var fancy_j = 28;
        }
        var fancybox_css = {
            'outer': {'background': null},
            'close': {'background_image': null, 'height': null, 'right': null, 'top': null, 'width': null}
        };
        $('a.itemshop').fancybox({
            'autoDimensions': false,
            'width': fancy_a,
            'height': fancy_b,
            'padding': 0,
            'scrolling': 'yes',
            'overlayColor': '#000',
            'overlayOpacity': 0.8,
            'onStart': function () {
                fancybox_css.outer.background = $('#fancybox-outer').css('background');
                fancybox_css.close.background_image = $('#fancybox-close').css('background-image');
                fancybox_css.close.height = $('#fancybox-close').css('height');
                fancybox_css.close.right = $('#fancybox-close').css('right');
                fancybox_css.close.top = $('#fancybox-close').css('top');
                fancybox_css.close.width = $('#fancybox-close').css('width');
                $('#fancybox-outer').css({'background': 'transparent url("<?=URI::public_path('')?>static/images/'+fancy_c+'.png") center center no-repeat'});
                $('#fancybox-close').css({
                    'background-image': 'none',
                    'cursor': 'pointer',
                    'height': fancy_d,
                    'right': '3px',
                    'top': fancy_e,
                    'width': fancy_f
                });
            },
            'onComplete': function () {
                $('#fancybox-inner').css({'top': fancy_j, 'left': fancy_i});
                $('#fancybox-wrap').css({'width': fancy_g, 'height': fancy_h});
            },
            'onClosed': function () {
                if (null != fancybox_css.outer.background) {
                    $('#fancybox-outer').css('background', fancybox_css.outer.background);
                }
                if (null != fancybox_css.close.background_image) {
                    $('#fancybox-close').css('background-image', fancybox_css.close.background_image);
                }
                if (null != fancybox_css.close.height) {
                    $('#fancybox-close').css('height', fancybox_css.close.height);
                }
                if (null != fancybox_css.close.right) {
                    $('#fancybox-close').css('right', fancybox_css.close.right);
                }
                if (null != fancybox_css.close.top) {
                    $('#fancybox-close').css('top', fancybox_css.close.top);
                }
                if (null != fancybox_css.close.width) {
                    $('#fancybox-close').css('width', fancybox_css.close.width);
                }
            }
        });
    });
</script>
<script>
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100)
            $("#yukari").fadeIn(500);
        else
            $("#yukari").fadeOut(500);
    });
    $(document).ready(function(){
        $("#yukari").click(function(){
            $("html, body").animate({ scrollTop: "0" }, 1000);
            return false;
        });
    });
</script>
<script>
    $(document).ready(function () {
        if ($(window).width() < 540) {
            document.getElementById('fb').style.display = 'none';
        }else{
            setTimeout(function () {
                $('#fbLoading').fadeOut(function () {
                    $('#fbContent').fadeIn(function () {

                    })
                });
            }, 3500);
        }
    });
</script>
<script>
    function textonly(e,id){
        var code;
        if (!e) var e = window.event;
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        var character = String.fromCharCode(code);
//alert('Character was ' + character);
        //alert(code);
        //if (code == 8) return true;
        var AllowRegex  = /^[\ba-zA-Z0-9\s-]$/;
        if (AllowRegex.test(character)){
            return true;
        }else{
            $(id).notify(
                "Sadece harf ve rakam",
                { position:"right" }
            );
            return false;
        }
    }
    $('#pass2').change(function () {
        var pass = $('#pass').val();
        var pass2 = $(this).val();
        if(pass != pass2){
            document.getElementById('passOk').style.display = "none";
            document.getElementById('passNo').style.display = "";
            $('#pass2').notify(
                "Şifreler uyuşmuyor !",
                { position:"right" }
            );
        }else{
            document.getElementById('passNo').style.display = "none";
            document.getElementById('passOk').style.display = "";
        }
    });
    $('#pass').change(function () {
        var pass = $('#pass2').val();
        var pass2 = $(this).val();
        if(pass != ''){
            if(pass != pass2){
                document.getElementById('passOk').style.display = "none";
                document.getElementById('passNo').style.display = "";
                $('#pass2').notify(
                    "Şifreler uyuşmuyor !",
                    { position:"right" }
                );
            }else{
                document.getElementById('passNo').style.display = "none";
                document.getElementById('passOk').style.display = "";
            }
        }
    });
    function textonly2(e,id){
        var code;
        if (!e) var e = window.event;
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        var character = String.fromCharCode(code);
//alert('Character was ' + character);
        //alert(code);
        //if (code == 8) return true;
        var AllowRegex  = /^[\ba-z-A-ZÇİĞÖŞÜçığöşü\s-]$/;
        if (AllowRegex.test(character)){
            return true;
        }else{
            $(id).notify(
                "Sadece harf !",
                { position:"right" }
            );
            return false;
        }
    }
    function numberonly(e,id){
        var code;
        if (!e) var e = window.event;
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        var character = String.fromCharCode(code);
//alert('Character was ' + character);
        //alert(code);
        //if (code == 8) return true;
        var AllowRegex  = /^[\b0-9\s-]$/;
        if (AllowRegex.test(character)){
            return true;
        }else{
            $(id).notify(
                "Sadece rakam !",
                { position:"right" }
            );
            return false;
        }
    }
    $('#question').mouseover(function () {
        document.getElementById('question2').style.display="";
    });
    $('#question').mouseout(function () {
        document.getElementById('question2').style.display="none";
    });
</script>
</body>
</html>