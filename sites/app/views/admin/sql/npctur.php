<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"90") == true):?>
<?php 
$info = $this->info;
$account = $info['account'];
?>
	<div class="row">
		<div class="col-md-9">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red">
                        <i class="icon-list font-red"></i>
                        <span class="caption-subject bold uppercase">NPC Tür Değiştir</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
					<form id="newsEditForm" action="<?=URI::get_path('sql/npctur')?>" role="form" autocomplete="off" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" value="<?=Functions::npc_type($account['npc_type']);?>" disabled>
								<label class="control-label col-md-3">Mevcut NPC Türü</label>
							</div>
							<div class="form-group form-md-line-input">
								<select class="form-control edited" name="shop_type">
									<option value="0">Yang Market</option>
									<option value="1">EP Market</option>
									<option value="2">EM Market</option>
									<option value="3">Derece Market</option>
									<option value="4">Won Market</option>
									<option value="5">Eşya Market</option>
									<option value="6">Metin Gaya Market</option>
									<option value="7">Boss Gaya Market</option>
								</select>
								<label class="control-label col-md-3">Yeni NPC Türü</label>
							</div>
							<input type="hidden" class="form-control" name="shop_vnum" value="<?=$account['vnum'];?>" required>
						</div>
					</form>
                </div>
            </div>
		</div>
	</div>
<?php endif;?>