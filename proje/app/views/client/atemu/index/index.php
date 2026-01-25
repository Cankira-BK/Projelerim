<div class="col-md-9">

	<div class="col-md-8 no-padding" style="min-height: 1150px;">
		<div class="col-md-12 mobil-nopad">
			<div class="panel panel-buyuk">
				<div class="panel-heading"><?=$lng[62]?></div>
				<div class="panel-body">
					<?php Cache::open('patch');?>
					<?php if (Cache::check('patch')):?>
					<?php foreach ($this->result['patch'] as $row):?>
					<table class="table table-striped table-hover haber-tablo">

						<tr>

							<td><a href="<?=URI::get_path('patch/view/'.$row['id'])?>">
									<?=$row['title'];?> <br>
									<small><?=$row['content2'];?></small></a>
							</td>

							<td style="text-align:right;"><a href="<?=URI::get_path('patch/view/'.$row['id'])?>"><span class="label label-danger"><?=$lng[63]?></span></a></td>
						</tr>

					</table>
						<?php endforeach; ?>
					<?php endif;?>
					<?php Cache::close('patch');?>
				</div>
			</div>
		</div>
		<?php if (\StaticDatabase\StaticDatabase::settings('facebook_status')):?>
		<div class="col-md-12 mobil-nopad">
			<div class="panel panel-buyuk">
				<div class="panel-heading">Facebook</div>
				<div class="panel-body">
                    <div id="fb" class="bg-light">
                        <img src="<?=URI::public_path()?>static/images/loaders/brighter.gif" alt="" id="fbLoading" style="display:block; margin-left: auto;margin-right: auto; margin-top: 224px;margin-bottom: 224px;">
                        <center><div id="fbContent" class="fb-page" data-href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" data-tabs="timeline" data-width="462" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" class="fb-xfbml-parse-ignore" style="display: none;margin-left: 65px;"><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a></blockquote></div></center>
                    </div>

				</div>
			</div>
		</div>
		<?php endif;?>
	</div>

	<div class="col-md-4 no-padding">
		<div class="col-md-12 mobil-nopad" style="padding-right: 0px;padding-left: 15px;">
			<div class="panel panel-buyuk">
				<div class="panel-heading"><?=$lng[15]?>
				</div>
				<div class="panel-body no-padding">

					<div class="panel-body">
						<?php if(\StaticDatabase\StaticDatabase::settings('event_type') == "1"):?>
                            <iframe src="<?=URI::get_path('event')?>" style="border: none;width: 210px;height: 300px;" id="fancybox-frame"></iframe>
						<?php else:?>
                            <iframe src="<?=URI::get_path('event/dynamic')?>" style="border: none;width: 273px; height: 301px;left: 0px;" id="fancybox-frame"></iframe>
						<?php endif;?>
                    </div>
				</div>
			</div>
		</div>


		<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0 || \StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0):?>
		<div class="col-md-12 mobil-nopad" style="padding-right: 0px;padding-left: 15px;">
			<div class="panel panel-buyuk">
				<div class="panel-heading"><?=$lng[2]?></div>
				<div class="panel-body no-padding">

					<div class="panel-body">
						<table class="table table-striped table-hover" style="padding:15px;">
							<?php Cache::open('server_statistics');?>
							<?php if (Cache::check('server_statistics')):?>
							<?php if (\StaticDatabase\StaticDatabase::settings('today_login_status')):?>
							<tr>
								<td><?=$lng[4]?></td>
								<td style="text-align:right;"><span class="label label-success"><?=$getCount['todayLogin']['count'] + \StaticDatabase\StaticDatabase::settings('todaylogin')?></span></td>
							</tr>
							<?php endif;?>
							<?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
                                <tr>
                                    <td><?=$lng[5]?></td>
                                    <td style="text-align:right;"><span class="label label-success"><?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?></span></td>
                                </tr>
							<?php endif;?>
							<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
							<tr>
								<td><?=$lng[6]?></td>
								<td style="text-align:right;"><span class="label label-success"><?=$getCount['totalPlayer']['count'] + \StaticDatabase\StaticDatabase::settings('totalplayer')?></span></td>
							</tr>
							<?php endif;?>
							<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
							<tr>
								<td><?=$lng[7]?></td>
								<td style="text-align:right;"><span class="label label-success"><?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?></span></td>
							</tr>
							<?php endif;?>
							<?php endif;?>
							<?php Cache::close('server_statistics');?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php endif;?>
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
        //some code...
        document.getElementById('facebookLike').style.display = 'none';
    }
</script>