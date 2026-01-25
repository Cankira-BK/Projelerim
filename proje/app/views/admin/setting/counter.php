<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"24") == true):?>
<?php
$captchaStatus = ['0'=>'Pasif','1'=>'Aktif'];
$SevilmeyenTablo = array("affect","banword","guild","guild_comment","guild_grade","guild_history","guild_member","guild_statistics","guild_tournement","guild_war","guild_war_bet","guild_war_info","guild_war_reservation","horse_name","item","item_attr","item_attr_rare","item_award","item_rent","item_proto","land","lonca_gecmisi","lonca_lider","lotto_list","mailbox","mailbox_items","marriage","messenger_list","mob_proto","monarch","monarch_candidacy","monarch_election","myshop_pricelist","new_petsystem","object","object_proto","pcbang_ip","pet","pet_upgrade_proto","player","player_gift","player_deleted","player_index","quest","refine_proto","rent_event","safebox","shop","shop_class","shop_cost","shop_item","shop_limit","skill_color","skill_proto","status","string","yayinci_liste","youtuber","offlineshop_auction_offers","offlineshop_auctions","offlineshop_logs","offlineshop_offers","offlineshop_safebox_items","offlineshop_safebox_valutes","itemshop_categories","itemshop_editors","itemshop_items","offline_shop_price",);
?>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-users font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Online Sayacı </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="onlineedit" role="form" action="<?=URI::get_path('setting/onlineedit');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="status">
								<?php foreach ($captchaStatus as $key=>$row):?>
									<?php if ($key == \StaticDatabase\StaticDatabase::settings('total_online_status')):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Online Sayaç Durumu </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="counter" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('online')?>">
							<label for="form_control_1">Şaşırtma </label>
							<span class="help-block">Lütfen artırmak istediğiniz miktarı giriniz</span>
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
							<span class="ladda-label">Güncelle</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    $('#onlineedit').submit(function (eve) {
        eve.preventDefault();
        var url = $(this).attr('action');
        var data = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.result === true)
                    notify('success','Güncelleme Başarılı');
                else
                    notify('error','Bir Hata Oluştu');
            }
        });
    });
</script>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-users font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Bugün Girenler Sayacı </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="todayedit" role="form" action="<?=URI::get_path('setting/todayedit');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="status">
								<?php foreach ($captchaStatus as $key=>$row):?>
									<?php if ($key == \StaticDatabase\StaticDatabase::settings('today_login_status')):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Bugün Girenler Sayaç Durumu </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="counter" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('todaylogin')?>">
							<label for="form_control_1">Şaşırtma </label>
							<span class="help-block">Lütfen artırmak istediğiniz miktarı giriniz</span>
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
							<span class="ladda-label">Güncelle</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    $('#todayedit').submit(function (eve) {
        eve.preventDefault();
        var url = $(this).attr('action');
        var data = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.result === true)
                    notify('success','Güncelleme Başarılı');
                else
                    notify('error','Bir Hata Oluştu');
            }
        });
    });
</script>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-users font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Toplam Hesap Sayacı </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="accountedit" role="form" action="<?=URI::get_path('setting/accountedit');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="status">
								<?php foreach ($captchaStatus as $key=>$row):?>
									<?php if ($key == \StaticDatabase\StaticDatabase::settings('total_account_status')):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Toplam Hesap Sayaç Durumu </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="counter" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('totalaccount')?>">
							<label for="form_control_1">Şaşırtma </label>
							<span class="help-block">Lütfen artırmak istediğiniz miktarı giriniz</span>
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
							<span class="ladda-label">Güncelle</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    $('#accountedit').submit(function (eve) {
        eve.preventDefault();
        var url = $(this).attr('action');
        var data = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.result === true)
                    notify('success','Güncelleme Başarılı');
                else
                    notify('error','Bir Hata Oluştu');
            }
        });
    });
</script>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-users font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Toplam Karakter Sayacı </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="playeredit" role="form" action="<?=URI::get_path('setting/playeredit');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="status">
								<?php foreach ($captchaStatus as $key=>$row):?>
									<?php if ($key == \StaticDatabase\StaticDatabase::settings('total_player_status')):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Toplam Karakter Sayaç Durumu </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="counter" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('totalplayer')?>">
							<label for="form_control_1">Şaşırtma </label>
							<span class="help-block">Lütfen artırmak istediğiniz miktarı giriniz</span>
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
							<span class="ladda-label">Güncelle</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    $('#playeredit').submit(function (eve) {
        eve.preventDefault();
        var url = $(this).attr('action');
        var data = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.result === true)
                    notify('success','Güncelleme Başarılı');
                else
                    notify('error','Bir Hata Oluştu');
            }
        });
    });
</script>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-users font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Aktif Pazar Sayacı </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="pazaredit" role="form" action="<?=URI::get_path('setting/pazaredit');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="status">
								<?php foreach ($captchaStatus as $key=>$row):?>
									<?php if ($key == \StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Aktif Pazar Sayaç Durumu </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="counter" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('activepazar')?>">
							<label for="form_control_1">Şaşırtma </label>
							<span class="help-block">Lütfen artırmak istediğiniz miktarı giriniz</span>
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
							<span class="ladda-label">Güncelle</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    $('#pazaredit').submit(function (eve) {
        eve.preventDefault();
        var url = $(this).attr('action');
        var data = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.result === true)
                    notify('success','Güncelleme Başarılı');
                else
                    notify('error','Bir Hata Oluştu');
            }
        });
    });
</script>
    <div class="row">
        <div class="col-md-9">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-users font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Offline Pazar Tablosu </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="pazaredit2" role="form" action="<?=URI::get_path('setting/pazaredit2');?>" method="post">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="offline_shop_npc">
									<?php foreach ($this->counter['data'] as $npcTable):?>
									<?php if(!in_array($npcTable['TABLE_NAME'], $SevilmeyenTablo)):?>
										<?php if ($npcTable['TABLE_NAME'] == \StaticDatabase\StaticDatabase::settings('offline_shop_npc')):?>
                                            <option value="<?=$npcTable['TABLE_NAME']?>" selected><?=$npcTable['TABLE_NAME']?></option>
										<?php else:?>
                                            <option value="<?=$npcTable['TABLE_NAME']?>"><?=$npcTable['TABLE_NAME']?></option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Offline_Shop_Npc </label>
                                <span class="help-block">offline_shop_npc</span>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="offline_shop_item">
									<?php foreach ($this->counter['data'] as $npcTable):?>
									<?php if(!in_array($npcTable['TABLE_NAME'], $SevilmeyenTablo)):?>
										<?php if ($npcTable['TABLE_NAME'] == \StaticDatabase\StaticDatabase::settings('offline_shop_item')):?>
                                            <option value="<?=$npcTable['TABLE_NAME']?>" selected><?=$npcTable['TABLE_NAME']?></option>
										<?php else:?>
                                            <option value="<?=$npcTable['TABLE_NAME']?>"><?=$npcTable['TABLE_NAME']?></option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Offline_Shop_Item </label>
                                <span class="help-block">offline_shop_item</span>
                            </div>
                        </div>
                        <div class="form-actions noborder">
                            <button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                                <span class="ladda-label">Güncelle</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#pazaredit2').submit(function (eve) {
            eve.preventDefault();
            var url = $(this).attr('action');
            var data = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                    if (result.result === true)
                        notify('success','Güncelleme Başarılı');
                    else
                        notify('error','Bir Hata Oluştu');
                }
            });
        });
    </script>
<?php endif;?>