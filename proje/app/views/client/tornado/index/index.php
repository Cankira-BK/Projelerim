<div class="news-block">
    <br>
    <div class="title">
		<?=$lng[62];?>
    </div>
	<?php Cache::open('patch');?>
	<?php if (Cache::check('patch')):?>
		<?php foreach ($this->result['patch'] as $row):?>
            <div class="news">
                <div class="news-img" style="background-image: url(<?=$row['image']?>);">
                </div>
                <div class="news-info">
                    <div class="news-title">
                        <h2><a href="<?=URI::get_path('patch/view/'.$row['id'])?>"><?=$row['title'];?></a></h2> <span><?=Functions::prettyDateTime1($row['tarih'])?></span>
                    </div>
                    <div class="news-text">
						<?=$row['content2'];?>
                    </div>
                    <div class="news-b">
                        <div class="news-more">
                            <a href="<?=URI::get_path('patch/view/'.$row['id'])?>" class="button small"><?=$lng[63]?></a>
                        </div>
                    </div>
                </div>
            </div>
		<?php endforeach; ?>
	<?php endif;?>
	<?php Cache::close('patch');?>

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
</div>
