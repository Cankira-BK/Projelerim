<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"100") == true):?>
<?php $durumlar = ['0'=>'Pasif','1'=>'Aktif']; $evrim = ['0'=>'Pasif','1'=>'Otlu Evrim Sistemi','2'=>'Otsuz Evrim Sistemi'];?>
<div class="row">
	<div class="col-lg-12 col-md-4 col-sm-6 col-xs-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-key font-red-sunglo"></i>
					<span class="caption-subject bold uppercase">Başlangıç Düzenle</span>
				</div>
			</div>
			<div class="portlet-body form">
				<?php
						$cError = Session::get('cError');
						if($cError == 'basarili'){
							echo Functions::alert_admin('success',"Başlangıç düzenlemesi başarıyla yapılmıştır, oyuna güncelleme verilmiştir.");
							Session::set('cError',false);
						}elseif($cError == 'hata'){
							echo Functions::alert_admin('warning',"İşlem sırasında hata oluştu, tekrar deneyiniz.");
							Session::set('cError',false);
						}elseif($cError == 'ssh2logout'){
							echo Functions::alert_admin('error',"SSH2 Bağlantısı başarısız, şifre hatalı olabilir lütfen kontrol ediniz!");
							Session::set('cError',false);
						}
						?>
				<form id="captchaedit" role="form" action="<?=URI::get_path('ssh/startquest');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="derece">
								<option value="0">Tarafsız</option>
								<option value="20000">Kahraman</option>
								<option value="8000">Soylu</option>
								<option value="4000">İyi</option>
								<option value="1000">Arkadaşça</option>
								<option value="-1000">Agresif</option>
								<option value="-4000">Hileci</option>
								<option value="-8000">Kötü Niyetli</option>
								<option value="-20000">Zalim</option>
							</select>
							<label for="form_control_1">Başlangıç Derecesi </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="blevel" class="form-control" id="blevel">
							<label for="blevel">Başlangıç Seviyesi </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="bparam" class="form-control" id="bparam">
							<label for="bparam">Başlangıç Parası </label>
							<span class="help-block">Örn Kullanım: 10000000</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="alevel" class="form-control" id="alevel">
							<label for="alevel">At Seviyesi </label>
							<span class="help-block">En Fazla '21' Değerini Yazınız.</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="esya_durum">
								<option value="0">Envanterde Olsun</option>
								<option value="1">Giyili Olsun</option>
							</select>
							<label for="esya_durum">Eşya Durumu </label>
							<span class="help-block">Eğer üzerinde giyili olmasını istiyorsanız karakter eşyalarında 1 silah yazmalısınız. 2 silah yazarsanız hata olabilir</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="efsun_durum">
								<option value="0">Efsunsuz Olsun</option>
								<option value="1">Efsunlu Olsun</option>
							</select>
							<label for="efsun_durum">Eşya Efsun Durumu </label>
							<span class="help-block">Bu seçeneği aktif etmeden önce eşya durumun üzerinde giyili olarak başlatmalısınız.</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="item1" class="form-control" id="item1">
							<label for="item1">Savaşçı İtemleri </label>
							<span class="help-block">Örneğin 149,19,279,289</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="item2" class="form-control" id="item2">
							<label for="item2">Ninja İtemleri </label>
							<span class="help-block">Örneğin 1039,1049,1069,1079</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="item3" class="form-control" id="item3">
							<label for="item3">Sura İtemleri </label>
							<span class="help-block">Örneğin 149,19,279,289</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="item4" class="form-control" id="item4">
							<label for="item4">Şaman İtemleri </label>
							<span class="help-block">Örneğin 5019,5029,5039,5049</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="item5" class="form-control" id="item5">
							<label for="item5">Ortak İtemler </label>
							<span class="help-block">Örneğin 27001,27002,27003,27004</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="adet" class="form-control" id="adet">
							<label for="adet">Ortak İtem Adetleri </label>
							<span class="help-block">Örneğin 200</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="item6" class="form-control" id="item6">
							<label for="item6">Özel İtemler </label>
							<span class="help-block">Örneğin 70038,53066,52142,50053<br>Buraya gireceğiniz eşyalar 1 adet olarak verilecektir.</span>
						</div>
					</div><br><br>
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