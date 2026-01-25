<footer class="footer">
<div class="soc-block">
<div class="social">
Bizi Takip Edin :
<a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" class="fb" target="_blank"></a>
<a href="<?=\StaticDatabase\StaticDatabase::settings('instagram')?>" class="inst" target="_blank"></a>
</div>
<div class="lang-block-bottom">
<div id="dropdown-block-b" class="dropdown-block-b" tabindex="1">
<div>
<?php foreach ($languagesS as $languages):?>
<?php if ($languages['code'] === $_SESSION['language']):?>
<span class="lang"><?=$languages['name'];?></span>
<?php endif;?>
<?php endforeach;?>
</div>
<ul class="dropdown">
<?php foreach ($languagesS as $languages):?>
<?php if ($languages['code'] !== $_SESSION['language']):?>
<li class="goLang"><a href="<?=URI::get_path('languages/select/'.$languages['code'])?>"><span class="lang"><?=$languages['name'];?></span></a></li>
<?php endif;?>
<?php endforeach;?>
</ul>
</div>
</div>
</div>
<div class="footer-logo">
<img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" width="200px">
</div>
<br>
<br>
<div class="footer-menu">
<ul>
<li><a href="index">Anasayfa</a></li>
<li><a href="download">Oyunu İndir</a></li>
<li><a href="recuperare">Şifremi Unuttum</a></li>
<li><a href="privacy">Üyelik Sözleşmesi</a></li>
<li><a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>">Tanıtım</a></li>
<li><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>">Facebook</a></li>
<li><a href="<?=\StaticDatabase\StaticDatabase::settings('instagram')?>">İnstagram</a></li>
</ul>
</div>
<div class="copyright">
Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />
Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.<br />
</div>
</footer>
</div>

<script src="<?=URI::public_path()?>assets/ThemeOne/js/jquery-2.1.4.min.js" type="2ca87e552edeffc354c42b71-text/javascript"></script>
<script src="<?=URI::public_path()?>assets/ThemeOne/js/modalx.js" type="2ca87e552edeffc354c42b71-text/javascript"></script>
<script src="<?=URI::public_path()?>assets/ThemeOne/js/slider.js" type="2ca87e552edeffc354c42b71-text/javascript"></script>
<script src="<?=URI::public_path()?>assets/ThemeOne/js/mask.js" type="2ca87e552edeffc354c42b71-text/javascript"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8" type="2ca87e552edeffc354c42b71-text/javascript"></script>
<script src="<?=URI::public_path()?>assets/js/fancybox.js" type="2ca87e552edeffc354c42b71-text/javascript"></script>
<script src="<?=URI::public_path()?>assets/js/ajax.js" type="2ca87e552edeffc354c42b71-text/javascript"></script>
<script src="<?=URI::public_path()?>assets/ThemeOne/js/main.js" type="2ca87e552edeffc354c42b71-text/javascript"></script>
<script src="<?=URI::public_path()?>main/js/notify.js"></script>
<script src="<?=URL.'data/extra/notify/ogstudio.js'?>"></script>
<script type="text/javascript">
function DropDown(el) {
  this.dd = el;
  this.placeholder = this.dd.children('div');
  this.opts = this.dd.find('ul.dropdown > li');
  this.val = '';
  this.index = -1;
  this.initEvents();
}
DropDown.prototype = {
  initEvents : function() {
    var obj = this;
    obj.dd.on('click', function(event){
      $(this).toggleClass('active');
      return false;
    });
    obj.opts.on('click',function(){
      var opt = $(this);
      obj.val = opt.find('a').html();
      obj.index = opt.index();
      obj.placeholder.html(obj.val);
    });
  },
  getValue : function() {
    return this.val;
  },
  getIndex : function() {
    return this.index;
  }
}
$(function() {
  var dd = new DropDown( $('#dropdown-block') );
  $(document).click(function() {
    $('.dropdown-block').removeClass('active');
  });
});
$('.goLang a').on('click',function(){
  window.location.href = $(this).attr('href');
});
$(function() {
  var dd = new DropDown( $('#dropdown-block-b') );
  $(document).click(function() {
    $('.dropdown-block-b').removeClass('active');
  });
});
</script>
</body>
</html>
