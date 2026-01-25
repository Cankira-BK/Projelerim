<aside id="right">
    <div id="slider_bg">
        <div id="slider">
            <a href="#">
                <img src="<?=URI::public_path('asset/slider/1.jpg')?>" style="height: 266px; width: 100%;">
            </a>
            <a href="#">
                <img src="<?=URI::public_path('asset/slider/2.jpg')?>" style="height: 266px; width: 100%;">
            </a>
            <a href="#">
                <img src="<?=URI::public_path('asset/slider/3.jpg')?>" style="height: 266px; width: 100%;">
            </a>
        </div>
    </div>
	<?php if (\StaticDatabase\StaticDatabase::settings('facebook_status')):?>
	<div id="content_ajax">
        <!-- Latest News Header -->
        <div class="news_container">
            <div class="container_left">
				Facebook'ta Biz
            </div>
            <!-- Latest News Header.End -->
        </div>
        <article class="news_article">
            <div class="news_body">
                <div class="news_content facebook">
                    <div id="fb" class="bg-dark">
						<img src="<?=URI::public_path()?>static/images/loaders/brighter.gif" alt="" id="fbLoading" style="display:block; margin-left: auto;margin-right: auto; margin-top: 224px;margin-bottom: 224px;">
						<center><div id="fbContent" class="fb-page" data-href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" data-tabs="timeline" data-width="462" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" class="fb-xfbml-parse-ignore" style="display: none;margin-left: 65px;"><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a></blockquote></div></center>
					</div>
					<script>
						$(document).ready(function () {
						if ($(window).width() < 540) {document.getElementById('fb').style.display = 'none';}else{setTimeout(function () {
						$('#fbLoading').fadeOut(function () {
						$('#fbContent').fadeIn(function () {
						})}); }, 3500);}});
					</script>
                </div>
                <div class="comments"></div>
            </div>
        </article>
    </div>
	<?php endif;?>
    <div id="content_ajax">
        <!-- Latest News Header -->
        <div class="news_container">
            <div class="container_left">
				<?=$lng[62]?>
            </div>
            <!-- Latest News Header.End -->
        </div>
		<?php Cache::open('patch');?>
		<?php if (Cache::check('patch')):?>
		<?php foreach ($this->result['patch'] as $row):?>
        <article class="news_article">
            <h2 class="news_head">
                <a href="<?=URI::get_path('patch/view/'.$row['id'])?>"><?=$row['title'];?></a>
                <span><a href="javascript:void(0)"><?=$lng[64]?> :</a> <?=Functions::zaman($row['tarih'])?> önce</span>
            </h2>
            <div class="news_body">
                <div class="news_content">
                    <p><span style="text-align: center;"><?=$row['content2'];?></span><br></p>
                    <a class="readn_ln" href="<?=URI::get_path('patch/view/'.$row['id'])?>"><?=$lng[63]?></a>
                </div>
                <div class="comments"></div>
            </div>
        </article>
			<?php endforeach; ?>
		<?php endif;?>
		<?php Cache::close('patch');?>
    </div>
</aside>
<?php if (\StaticDatabase\StaticDatabase::settings('facebook_like_status')):?>
    <div class="fbBoard fbBoard2" id="facebookLike">
        <center>

            <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank">
                <div class="facebook-like">
                    <img src="<?=URI::public_path('asset/images/face.png')?>" alt="">
                    <a href="javascript:void(0)" onclick="document.getElementById('facebookLike').style.display='none';" style="display:block;width:23px;height:23px;margin:0px;padding:0px;border:none;background-color:transparent;position:absolute;top:23px;right:70px;-webkit-border-radius: 12px;border-radius: 12px;"></a>

                    <iframe src="https://www.facebook.com/plugins/like.php?href=<?=\StaticDatabase\StaticDatabase::settings('facebook')?>&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=segoe+ui&amp;height=30&amp;appId=515295435153698" scrolling="no" frameborder="0" style="position:absolute;bottom:82px;right:104px;border:none; overflow:hidden; width:98px; height:21px;" allowtransparency="true"></iframe>


                </div>
            </a>
        </center>
    </div>
<?php endif;?>