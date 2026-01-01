<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"100") == true):?>
<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-lock font-dark"></i>
                    <span class="caption-subject bold uppercase"> Make İşlemleri</span>
                </div>
            </div>
            <div class="portlet-body form">
				<?php
						$cError = Session::get('cError');
						if($cError == 'basarili1'){
							echo Functions::alert_admin('success',"Seçtiğiniz görev başarıyla yenilenmiştir.");
							Session::set('cError',false);
						}elseif($cError == 'basarili2'){
							echo Functions::alert_admin('success',"Tüm görevler başarıyla yenilenmiştir.");
							Session::set('cError',false);
						}elseif($cError == 'hata'){
							echo Functions::alert_admin('warning',"İşlem sırasında hata oluştu, tekrar deneyiniz.");
							Session::set('cError',false);
						}elseif($cError == 'quest'){
							echo Functions::alert_admin('warning',"Lütfen quest adı giriniz.");
							Session::set('cError',false);
						}elseif($cError == 'ssh2logout'){
							echo Functions::alert_admin('error',"SSH2 Bağlantısı başarısız, şifre hatalı olabilir lütfen kontrol ediniz!");
							Session::set('cError',false);
						}
						?>
                <form role="form" id="freeSellForm" action="<?=URI::get_path('ssh/questmake')?>" method="post" >
					<div class="form-group form-md-line-input form-md-floating-label">
						<input type="text" name="quest" class="form-control" id="quest">
						<label for="quest">Make Yapılacak Quest Adını Giriniz </label>
						<span class="help-block">Örn Kullanım: give_basic_weapon.lua</span>
					</div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn dark btn-block mt-ladda-btn ladda-button" name="secim" value="0">
                            <span class="ladda-label">Sadece seçili olanı işle</span>
                        </button><br>
						<button type="submit" class="btn dark btn-block mt-ladda-btn ladda-button" name="secim" value="1">
                            <span class="ladda-label">Tüm görevleri işle</span>
                        </button><br>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<?php endif;?>