<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"100") == true):?>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-files-o font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Kırmızı 2. Köy NPC Düzenle </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="newsCreate" role="form" action="<?=URI::get_path('ssh/red2_npc');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<textarea name='icerik' cols='90' rows='40'><?php echo "".SSHConnect::fileReadSTFP("data/cache/npc.txt.sftp")."";?></textarea>
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
							<span class="ladda-label">Kaydet</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php endif;?>