<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"5") == true):?>
	<?php $rowCount = $this->view['count']; ?>
	<div id="roro" style="display: none"><?= $rowCount;?></div>
	<div id="rorox" style="display: none">0</div>

	<div class="clearfix"></div>

	<div class="portlet light bordered">
		<div class="search-bar" style="position: fixed!important; display: inline-block; z-index:1">
			<div class="row">
				<div class="col-md-3" style="float: right;">
					<div class="input-group" style="float: right;margin-top: -93px;">
                    <span class="input-group-btn">
                        <a id="roroc" class="btn dark uppercase bold" style="float: right;" > <?= $rowCount;?></a>
                    </span>
					</div>
				</div>
			</div>
		</div>
		<div class="portlet-title">
			<div class="caption">
				<i class="glyphicon glyphicon-shopping-cart font-red"></i>
				<span class="caption-subject font-red sbold">Nesne Markete Eşya Ekle</span>
			</div>
		</div>
		<div class="portlet-body">
			<div class="search-bar" style="margin-top: 30px;">
				<div class="row">
					<div class="col-md-12">
						<div class="input-group">
							<select class="form-control edited" id="itemList">
								<?php foreach ($this->view['list'] as $row):?>
									<?php if ($row['vnum'] > 2):?>
										<option value="<?=$row['vnum']?>"><?=Functions::utf8($row['locale_name'])?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<span class="input-group-btn">
                            <a id="itemListHref" href="<?=URI::get_path('product/wheel_item/10')?>" class="btn blue uppercase bold">Git</a>
                        </span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" charset="utf-8">
        $('#itemList').change(function () {
            var data = $(this).val();
            $('#itemListHref').attr('href',"<?=URI::get_path('product/wheel_item/')?>" + data);
        });
	</script>
<?php endif;?>