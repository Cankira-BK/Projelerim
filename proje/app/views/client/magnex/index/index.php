<div id="content_ajax" class="haberler">
	<?php Cache::open('patch');?>
	<?php if (Cache::check('patch')):?>
	<?php foreach ($this->result['patch'] as $row):?>
            <div class="haber haber-1">
                <div class="panel-heading"><a href="<?=URI::get_path('patch/view/'.$row['id'])?>" style="color: #01a6a9;"><?=$row['title'];?></a></div>
                <div class="panel-body haber-body">
                    <span class="haber-tarih"><i class="fas fa-calendar-alt" aria-hidden="true"></i>&nbsp;&nbsp;   <?=Functions::zaman($row['tarih'])?> </span>
                    <p style="padding: 15px"><?=$row['content2'];?></p>
                    <a class="green-button news-btn" href="<?=URI::get_path('patch/view/'.$row['id'])?>"><?=$lng[63]?></a>
                </div>
            </div>
            <div class="HizmetHataBaslik"></div>
            <div class="HizmetHataIcerik"></div>
            <div class="haber-arasi"></div>
	<?php endforeach; ?>
	<?php endif;?>
	<?php Cache::close('patch');?>
	<?php if (\StaticDatabase\StaticDatabase::settings('facebook_status')):?>
	<div class="haber haber-1">
        <div class="panel-heading">Facebook
        </div>
		<div id="fb" class="facebook">
			<img src="<?=URI::public_path()?>static/images/loaders/brighter.gif" alt="" id="fbLoading" style="display:block; margin-left: auto;margin-right: auto; margin-top: 224px;margin-bottom: 224px;">
			<div id="fbContent" class="fb-page" data-href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" data-tabs="timeline" data-width="462" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" style="display: none;margin-left: 65px;"></div>
		</div>
		<script>
			$(document).ready(function () {
			if ($(window).width() < 540) {
				document.getElementById('fb').style.display = 'none';
			}else{
                setTimeout(function () {
                    document.getElementById('fbLoading').style.display = "none";
                    $('#fbContent').fadeIn();
                },3500)
            }

			});
		</script>
	</div>
	<?php endif;?>
	</div>
<?php if (\StaticDatabase\StaticDatabase::settings('facebook_like_status')):?>
    <div class="fbBoard fbBoard2" id="facebookLike">
        <center>

            <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank">
                <div class="facebook-like">
                    <img src="<?=URI::public_path('main/images/face.png')?>" alt="">
                    <a href="javascript:void(0)" onclick="document.getElementById('facebookLike').style.display='none';" style="display:block;width:23px;height:23px;margin:0px;padding:0px;border:none;background-color:transparent;position:absolute;top:23px;right:70px;-webkit-border-radius: 12px;border-radius: 12px;"></a>

                    <iframe src="https://www.facebook.com/plugins/like.php?href=<?=\StaticDatabase\StaticDatabase::settings('facebook')?>&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=segoe+ui&amp;height=30&amp;appId=515295435153698" scrolling="no" frameborder="0" style="position:absolute;bottom:82px;right:104px;border:none; overflow:hidden; width:98px; height:21px;" allowtransparency="true"></iframe>


                </div>
            </a>
        </center>
    </div>
<?php endif;?>
<script>
    var isMobile = {
        Android: function() {return navigator.userAgent.match(/Android/i);},
        BlackBerry: function() {return navigator.userAgent.match(/BlackBerry/i);},
        iOS: function() {return navigator.userAgent.match(/iPhone|iPad|iPod/i);},
        Opera: function() {return navigator.userAgent.match(/Opera Mini/i);},
        Windows: function() {return navigator.userAgent.match(/IEMobile/i);},
        any: function() {return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());}};
    if(isMobile.any()) {document.getElementById('facebookLike').style.display = 'none';}
</script>