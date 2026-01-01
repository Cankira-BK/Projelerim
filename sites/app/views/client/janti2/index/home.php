
<main class="content">
<div class="news-block">
<div class="news-top-block">
<div class="top-news" style="background-image: url(https://web.janti2.com/assets/ThemeOne/images/news-img-1.jpg);">
<div class="top-news-title">
<a href="#">Oyun Rehberi</a>
</div>
<div class="top-news-info">
Serverimiza yeni mi başlıyorsun ? Oyun rehberi ile serverimizdaki özellikleri görüntüleyebilirsin. </div>
<div class="top-news-read-more">
<i class="nav-icon"></i><a href="https://www.janti2.com/">Rehbere git</a>
</div>
</div>
<div class="top-news" style="background-image: url(https://web.janti2.com/assets/ThemeOne/images/news-img-2.jpg);">
<div class="top-news-title">
<a href="#">Tanıtım Videoları</a>
</div>
<div class="top-news-info">
Serverimiz hakkında bilgi mi edinmek istiyorsun ? Youtube kanalımızdaki videoları izleyerek bilgilenebilirsin. </div>
<div class="top-news-read-more">
<i class="nav-icon"></i><a href="https://web.janti2.com/YoutubeVideos">Videolara Gözat</a>
</div>
</div>
<div class="top-news" style="background-image: url(https://web.janti2.com/assets/ThemeOne/images/news-img-3.jpg);">
<div class="top-news-title">
<a href="#">Sosyal Medya</a>
</div>
<div class="top-news-info">
Server hakkında yapılan çalışmalar,güncellemeler, etkinlikler vb gibi faaliyetlerden haber almak için facebook sayfamızı takip edin. </div>
<div class="top-news-read-more">
<i class="nav-icon"></i><a href="https://www.facebook.com/janti2official/">Facebook'a Git</a>
</div>
</div>
</div>
</div>




<div class="news-tab-area">
	<div class="tbas-title-warp">
		<div class="tabs-title">
			<h4>Haberler</h4>
		</div>
	</div>
	<br>
		<?php Cache::open('patch');?>
	<?php if (Cache::check('patch')):?>
	<?php foreach ($this->result['patch'] as $row):?>
	<div class="tab-text">
		<div id="London" style="display:block" class="tabcontent">
			<div class="last-news-content">
				<div class="last-news-warpp">
				<!-- Cache display startup -->
						<div class="last-news-content">
				<div class="last-news-warpp">
				<!-- Cache display startup -->
						<div class="sngle-news-itm">
							<div class="news-itm-title">
								<div class="t-txt">
									<h4><?=$row['title'];?></h4>
									<p><small><?=Functions::zaman($row['tarih'])?></small></p>
								</div>
							</div>
							<div class="news-item-content">
								<div class="news-warp-txt">
									<div class="news-left">
										<img src="https://www.rache2.com/assets/img/n1.jpg" alt="">
									</div>
									<div class="news-right">
										<p><?=$row['content2'];?></p> <p stlye="backround-color:black; color:white;"><a href="<?=URI::get_path('patch/view/'.$row['id'])?>">Devamı..</a></p>
									</div>
								</div>
							</div>
						</div>
											
				</div>
			</div>
											
				</div>
			</div>
		</div>
	</div>
		<?php endforeach; ?>
	<?php endif;?>
	<?php Cache::close('patch');?>
</div>
<div class="news-tab-area">
	<div class="tbas-title-warp">
		<div class="tabs-title">
			<h4>Facebook</h4>
		</div>
	</div>
	<br>
	<?php if (\StaticDatabase\StaticDatabase::settings('facebook_status')):?>
	<div class="haber haber-1">

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



<style>
    .news-itm-title p span {
    color: #fff;
}

    .tabs-title {
	display: inline-block;
	float: left;
	margin-right: 25px;
}
.tabs-title h4 {
	font-size: 15px;
	text-transform: uppercase;
	color: #fff;
    font-weight: 600;
    padding-top: 5px;
}
    .tbas-title-warp {
	display: inline-block;
	width: 100%;
	border-bottom: 1px solid #323c5b;
	padding-bottom: 15px;
}
.news-itm-title {
    background: #11182d;
    width: 100%;
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}
.news-itm-title p {
    display: inline-block;
    color: #626c89;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: .5px;
}
.news-itm-title p span {
    color: #fff;
}
.news-itm-title h4 {
    font-size: 22px;
    display: inline-block;
}
.t-txt {
    width: 100%;
    padding: 5px 15px;
    display: flex;
    justify-content: space-between;
}
.news-left {
    width: 40%;
    float: left;
}
.news-right {
    width: 60%;
    float: left;
    
}
.news-left img {
    width: 100%;
}
.news-right p {
    font-size: 13px;
    line-height: 17px;
    padding-left: 15px;
    margin-top: -4px;
}
.sngle-news-itm {
    display: inline-block;
    width: 100%;
    margin-bottom: 20px;
}
    .tbas-title-warp {
	display: inline-block;
	width: 100%;
	border-bottom: 1px solid #323c5b;
	padding-bottom: 15px;
}
.news-itm-title {
    background: #11182d;
    width: 100%;
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}
.news-itm-title p {
    display: inline-block;
    color: #626c89;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: .5px;
}
.news-itm-title p span {
    color: #fff;
}


.news-left {
    width: 40%;
    float: left;
}
.news-right {
    width: 60%;
    float: left;
    
}
.news-left img {
    width: 100%;
}
.news-right p {
    font-size: 13px;
    line-height: 17px;
    padding-left: 15px;
    margin-top: -4px;
}
.sngle-news-itm {
    display: inline-block;
    width: 100%;
    margin-bottom: 20px;
}
.pagination {
    text-align: center;
    margin-top: 30px;
}
    .news-tab-area {
	padding: 20px;
}
.news-tab-area {
	padding: 15px;
}
.tabs-title-right {
    float: right;
    display: inline-block;
    padding-top: 5px;
}
.tabs-title-right a {
	color: #6679b5;
	text-decoration: none;
    font-size: 14px;
    
}
.tabbs-list {
	display: inline-block;
	float: left;
}
.tabbs-list button {
	background: transparent;
	color: #424a62;
	border: none;
	text-transform: uppercase;
	font-size: 14px;
	letter-spacing: .5px;
	font-weight: 500;
	padding: 5px 15px;
}


    </style>
	</main>