<div class="content_wrapper left">
	<div class="real_content">
		<h2 class="headline_news"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></span></h2>
		<div class="p4px">
			<div class="real_content">
				<div class="inner_content news_content">
					<div align="center">
						<h2><?=$lng[62]?></h2>
						<div class="haberler">
							<?php Cache::open('patch');?>
							<?php if (Cache::check('patch')):?>
							<?php foreach ($this->result['patch'] as $row):?>
                            <div style="border: 1px solid;padding-bottom: 20px;">
                                <h4 style="display: block;margin-left: 15px;text-align: initial;">
                                    <a href="<?=URI::get_path('patch/view/'.$row['id'])?>">» <?=$row['title'];?></a><span style="float: right;margin-right: 15px;"> <?=$lng[64]?> : <?=Functions::zaman($row['tarih'])?> </span>
                                </h4>
                                <h5 style="display: block;margin-left: 15px;text-align: initial;">
									<?=$row['content2'];?>
                                </h5>
                            </div>
							<?php endforeach; ?>
							<?php endif;?>
							<?php Cache::close('patch');?>
							<br />
							<div class="clear"></div>
						</div>
                        <div class="facebook">
                            <h2>Facebook</h2>

                            <div class="inout">
								<?php if (\StaticDatabase\StaticDatabase::settings('facebook_status')):?>
                                    <!--Facebook Haber Start-->
                                    <div id="fb" class="bg-light">
                                        <img src="<?=URI::public_path()?>static/images/loaders/brighter.gif" alt="" id="fbLoading" style="display:block; margin-left: auto;margin-right: auto; margin-top: 224px;margin-bottom: 224px;">
                                        <div id="fbContent" class="fb-page" data-href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" data-tabs="timeline" data-width="462" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" class="fb-xfbml-parse-ignore" style="display: none;margin-left: 65px;"><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a></blockquote></div>
                                    </div>
                                    <!--Facebook Haber End-->
								<?php endif;?>
                            </div>
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
                            <br>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if (\StaticDatabase\StaticDatabase::settings('facebook_like_status')):?>
    <div class="fbBoard fbBoard2" id="facebookLike">
        <center>

            <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank">
                <div class="facebook-like">
                    <img src="<?=URI::public_path('images/koddostu-face.png')?>" alt="">
                    <a href="javascript:void(0)" onclick="document.getElementById('facebookLike').style.display='none';" style="display:block;width:23px;height:23px;margin:0px;padding:0px;border:none;background-color:transparent;position:absolute;top:23px;right:70px;-webkit-border-radius: 12px;border-radius: 12px;"></a>

                    <iframe src="https://www.facebook.com/plugins/like.php?href=<?=\StaticDatabase\StaticDatabase::settings('facebook')?>&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=segoe+ui&amp;height=30&amp;appId=515295435153698" scrolling="no" frameborder="0" style="position:absolute;bottom:82px;right:104px;border:none; overflow:hidden; width:98px; height:21px;" allowtransparency="true"></iframe>


                </div>
            </a>
        </center>
    </div>
<?php endif;?>
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
        //some code...
        document.getElementById('facebookLike').style.display = 'none';
    }
</script>