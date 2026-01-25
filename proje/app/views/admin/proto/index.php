<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-blue">
					<i class="fa fa-search font-blue"></i>
					<span class="caption-subject bold uppercase"> Eşya Ara </span>
				</div>
			</div>
			<div class="portlet-body form">
				Arama yapmak için eşya listesini açtıktan sonra aradığınız eşyanın ilk harflerini yazarsanız daha hızlı şekilde bulabilirsiniz.
				<form role="form" action="<?=URI::get_path('proto/search');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="vnum">
								<?php foreach ($this->all as $row):?>
										<option value="<?=$row['vnum']?>"><?=Functions::utf8($row['locale_name'])?></option>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Eşya Listesi </label>
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
							<span class="ladda-label">Ara</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
