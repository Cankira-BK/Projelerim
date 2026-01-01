<div class="col-md-9 no-padding-left">
    <div class="list-group news">
        <div id="blog-articles">
            <div class="col-md-12 no-padding-all">
                <center><h3><?=$lng[62]?></h3></center>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
				<?php if (\StaticDatabase\StaticDatabase::settings('facebook_status')):?>
                    <!--Facebook Haber Start-->
                    <div id="fb" class="bg-light" style="margin-bottom: 50px;">
                        <img src="<?=URI::public_path()?>static/images/loaders/brighter.gif" alt="" id="fbLoading" style="display:block; margin-left: auto;margin-right: auto; margin-top: 224px;margin-bottom: 224px;">
                        <center><div class="fb-page" id="fbContent" data-href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" data-tabs="timeline" data-width="462" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" style="display: none;width: 462px!important;"></div></center>
                    </div>
                    <!--Facebook Haber End-->
				<?php endif;?>
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
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12 no-padding-all">
				<?php Cache::open('patch');?>
				<?php if (Cache::check('patch')):?>
				    <?php foreach ($this->result['patch'] as $row):?>
                        <div class="col-md-12">
                            <h2 class="header-2" style="text-align: center;text-shadow: 0 0 3px #c17373;padding-bottom: 2px;background: url(<?=URI::public_path()?>media/images/calc-divider.jpg) 50% 100% no-repeat;"></h2>
                        </div>
                        <div class="col-md-6">
                            <a href="<?=URI::get_path('patch/view/'.$row['id'])?>" class="list-group-item">
                                <div class="col-md-12 image"
                                     style="background-image:url(<?=URL.$row['image']?>);"></div>
                                <p class="list-group-item-text text-left">
                                </p>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <h3 class="header-2" style="margin-bottom: 20px;">
                                <span class="article-title" itemprop="headline" style="color: wheat;"><?=$row['title'];?></span>
                            </h3>
                            <div class="article-summary" itemprop="description" style="margin-bottom: 20px;">
								<?=$row['content2'];?>
                            </div>
                            <div class="article-meta">
                                <span class="publish-date" title="2017-12-05 19:30:54" style="color: wheat"><?=$lng[64]?> : <?=Functions::zaman($row['tarih'])?></span>
                                <a href="<?=URI::get_path('patch/view/'.$row['id'])?>" class="comments-link"><?=$lng[63]?></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
				<?php endif;?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php if (\StaticDatabase\StaticDatabase::settings('facebook_like_status')):?>
    <div class="fbBoard fbBoard2" id="facebookLike">
        <center>

            <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank">
                <div class="facebook-like">
                    <img src="<?=URI::public_path('media/images/koddostu-face.png')?>" alt="">
                    <a href="javascript:void(0)" onclick="document.getElementById('facebookLike').style.display='none';" style="display:block;width:23px;height:23px;margin:0px;padding:0px;border:none;background-color:transparent;position:absolute;top:23px;right:70px;-webkit-border-radius: 12px;border-radius: 12px;"></a>

                    <iframe src="https://www.facebook.com/plugins/like.php?href=<?=\StaticDatabase\StaticDatabase::settings('facebook')?>&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=segoe+ui&amp;height=30&amp;appId=515295435153698" scrolling="no" frameborder="0" style="position:absolute;bottom:82px;right:104px;border:none; overflow:hidden; width:98px; height:21px;" allowtransparency="true"></iframe>


                </div>
            </a>
        </center>
    </div>
<?php endif;?>
<script>
    $('#load-mores').click(function () {
        var url = "http://localhost/tema2-backup/index/patch2";
        var data = $('#patchCount').text();
        var newsCount = "1";
        $.post(url, {data: data}, function (result) {
            if (result.data == "") {
                $('#load-more-container').remove();
                return false;
            } else {
                $('#blog-articles').append(result.data);
                $('#patchCount').text(result.count)
            }
        }, "json");
    });
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