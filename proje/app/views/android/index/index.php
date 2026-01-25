<div class="slider-container material-box full-bottom">
<img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" class="responsive-image">
<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0 || \StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0):?>
<table class="table no" style="padding:15px;">
	<?php Cache::open('server_statistics_android');?>
	<?php if (Cache::check('server_statistics_android')):?>
	<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status')):?>
	<tr>
		<td><?=$lng[22]?></td>
		<td style="text-align:right;"><span class="label label-success"><?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></span></td>
	</tr>
	<?php endif;?>
	<?php if (\StaticDatabase\StaticDatabase::settings('today_login_status')):?>
	<tr>
		<td><?=$lng[23]?></td>
		<td style="text-align:right;"><span class="label label-success"><?=$getCount['todayLogin']['count'] + \StaticDatabase\StaticDatabase::settings('todaylogin')?></span></td>
	</tr>
	<?php endif;?>
	<?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
        <tr>
            <td><?=$lng[24]?></td>
            <td style="text-align:right;"><span class="label label-success"><?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?></span></td>
        </tr>
	<?php endif;?>
	<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
	<tr>
		<td><?=$lng[25]?></td>
		<td style="text-align:right;"><span class="label label-success"><?=$getCount['totalPlayer']['count'] + \StaticDatabase\StaticDatabase::settings('totalplayer')?></span></td>
	</tr>
	<?php endif;?>
	<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
	<tr>
		<td><?=$lng[26]?></td>
		<td style="text-align:right;"><span class="label label-success"><?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?></span></td>
	</tr>
	<?php endif;?>
	<?php endif;?>
	<?php Cache::close('server_statistics_android');?>
</table>
<?php endif;?>
</div>

<div class="container material-box">
<h2><?=$lng[27]?></h2>
<p class="no-bottom">
<div class="decoration"></div>
<?php Cache::open('patch_android');?>
<?php if (Cache::check('patch_android')):?>
<?php foreach ($this->result['patch'] as $row):?>
<h3 class="center-text"><?=$row['title'];?></h3>
<p class="center-text">
<?=$row['content2'];?>
<div class="more">
<a class="more-link" href="<?=URI::get_path('patch/view/'.$row['id'])?>"><?=$lng[28]?></a>
</div>
</p>
<div class="decoration"></div>
<?php endforeach; ?>
<?php endif;?>
<?php Cache::close('patch_android');?>
</p>
</div>

<?php if (\StaticDatabase\StaticDatabase::settings('facebook_status')):?>
<div class="container material-box">
<h2>Facebook</h2>
<p class="no-bottom">
<div class="decoration"></div>
<p class="center-text">
<div id="facebooks">
    <img src="<?=URI::public_path()?>images/brighter.gif" alt="" id="fbLoading" style="display:block; margin-left: auto;margin-right: auto; margin-top: 224px;margin-bottom: 224px;">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v2.8";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
	</script>
    <center><div class="fb-page" id="fbContent" data-href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" data-tabs="timeline" data-width="462" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" style="display: none;"></div></center>
</div>
<script>
	$(document).ready(function () {
		if ($(window).width() < 540) {
			document.getElementById('facebooks').style.display = 'none';
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
</p>
</p>
</div>
<?php endif;?>

<?php if(\StaticDatabase\StaticDatabase::settings('event_type') == "2"):?>
<div class="container material-box">
<h2><?=$lng[29]?></h2>
<p class="no-bottom">
<div class="container material-box">
<table cellspacing='0' class="table no">
<tr>
<th class="table-title"><?=$lng[30]?></th>
<th class="table-title"><?=$lng[31]?></th>
<th class="table-title"><?=$lng[32]?></th>
</tr>
<?php Cache::open('events_android');?>
<?php if (Cache::check('events_android')):?>
<?php foreach ($this->result['events'] as $EventList):?>
<tr>
<td class="table-sub-title"> <?=$EventList["day"]?></td>
<td><?=$EventList["name"]?></td>
<td><?=$EventList["time"]?></td>
</tr>
<?php endforeach;?>
<?php endif;?>
<?php Cache::close('events_android');?>
</table>
</div>
</p>
</div>
<?php endif;?>
