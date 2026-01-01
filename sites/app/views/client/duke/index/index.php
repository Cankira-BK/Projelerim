<main class="content">
    <div class="news-block">
        <div class="news-top-block">
            <div class="top-news" style="background-image: url(<?=URI::public_path('assets/images/news-img-1.jpg')?>);">
                <div class="top-news-title">
                    <a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>">Oyun Rehberi</a>
                </div>
                <div class="top-news-info">
                    Serverimiza yeni mi başlıyorsun ? Oyun rehberi ile serverimizdaki özellikleri görüntüleyebilirsin. </div>
                <div class="top-news-read-more">
                    <i class="nav-icon"></i>
                    <a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>" target="_blank">Rehbere git</a>
                </div>
            </div>
            <div class="top-news" style="background-image: url(<?=URI::public_path('assets/images/news-img-2.jpg')?>);">
                <div class="top-news-title">
                    <a href="<?=\StaticDatabase\StaticDatabase::settings('youtube')?>">Tanıtım Videoları</a>
                </div>
                <div class="top-news-info">
                    Serverimiz hakkında bilgi mi edinmek istiyorsun ? Youtube kanalımızdaki videoları izleyerek bilgilenebilirsin. </div>
                <div class="top-news-read-more">
                    <i class="nav-icon"></i>
                    <a href="<?=\StaticDatabase\StaticDatabase::settings('youtube')?>" target="_blank">Videolara Gözat</a>
                </div>
            </div>
            <div class="top-news" style="background-image: url(<?=URI::public_path('assets/images/news-img-3.jpg')?>);">
                <div class="top-news-title">
                    <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>">Sosyal Medya</a>
                </div>
                <div class="top-news-info">
                    Server hakkında güncellemeler, etkinlikler vb gibi faaliyetlerden haber almak için takipte kalın. </div>
                <div class="top-news-read-more">
                    <i class="nav-icon"></i>
                    <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank">Facebook'a Git</a>
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
                                                    <p><small><?=Functions::prettyDateTime1($row['tarih'])?></small></p>
                                                </div>
                                            </div>
                                            <div class="news-item-content">
                                                <div class="news-warp-txt">
                                                    <div class="news-left">
                                                        <img src="<?=URL.$row['image']?>" alt="">
                                                    </div>
                                                    <div class="news-right">
                                                        <p><?=$row['content2'];?></p>
                                                        <p style="background-color:black; color:white;">
                                                            <a href="<?=URI::get_path('patch/view/'.$row['id'])?>">Devamı..</a>
                                                        </p>
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
	<?php if (\StaticDatabase\StaticDatabase::settings('facebook_status')):?>
        <div class="news-tab-area">
            <div class="tbas-title-warp">
                <div class="tabs-title">
                    <h4>Facebook</h4>
                </div>
            </div>
            <br>
            <div class="haber haber-1">

                <div id="fb" class="bg-light">
                    <img src="<?=URI::public_path()?>static/images/loaders/brighter.gif" alt="" id="fbLoading" style="display:block; margin-left: auto;margin-right: auto; margin-top: 224px;margin-bottom: 224px;">
                    <center>
                        <div id="fbContent" class="fb-page" data-href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" data-tabs="timeline" data-width="462" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" class="fb-xfbml-parse-ignore" style="display: none;margin-left: 65px;"><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a></blockquote></div>
                    </center>
                </div>
            </div>
        </div>
        <script>
            setTimeout(function () {
                document.getElementById('fbLoading').style.display = "none";
                $('#fbContent').fadeIn();
            },3500);
        </script>
	<?php endif;?>

	<?php if (\StaticDatabase\StaticDatabase::settings('facebook_like_status')):?>
        <div class="fbBoard fbBoard2" id="facebookLike">
            <center>
                <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank">
                    <div class="facebook-like">
                        <img src="<?=URI::public_path('main/images/like-background.png')?>" alt="">
                        <a href="javascript:void(0)" onclick="document.getElementById('facebookLike').style.display='none';" style="display:block;width:23px;height:23px;margin:0px;padding:0px;border:none;background-color:transparent;position:absolute;top:23px;right:70px;-webkit-border-radius: 12px;border-radius: 12px;"></a>
                        <iframe src="https://www.facebook.com/plugins/like.php?href=<?=\StaticDatabase\StaticDatabase::settings('facebook')?>&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=segoe+ui&amp;height=30&amp;appId=515295435153698" scrolling="no" frameborder="0" style="position:absolute;bottom:82px;right:104px;border:none; overflow:hidden; width:98px; height:21px;" allowtransparency="true"></iframe>
                    </div>
                </a>
            </center>
        </div>
        <script>
            var isMobile = {
                Android: function() {
                    return navigator.userAgent.match(/Android/i);
                },
                BlackBerry: function() {
                    return navigator.userAgent.match(/BlackBerry/i);
                },
                iOS: function() {
                    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
                },
                Opera: function() {
                    return navigator.userAgent.match(/Opera Mini/i);
                },
                Windows: function() {
                    return navigator.userAgent.match(/IEMobile/i);
                },
                any: function() {
                    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
                }
            };
            if(isMobile.any()) {
                document.getElementById('facebookLike').style.display = 'none';
            }
        </script>
	<?php endif;?>
</main>