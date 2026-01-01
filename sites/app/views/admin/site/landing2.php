<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"80") == true):?>
<style type="text/css">
  .numara{
  width: 100px;
  margin-left: 20px;
  }
</style>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-link font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Biyolog Yönetimi </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="linkedit" role="form" action="<?=URI::get_path('site/landing2');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="ork" class="form-control" id="ork" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","ork","ayar_id")?>">
							<label for="ork">Ork Dişi Süresi <img src="https://i.hizliresim.com/367Wmj.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Ork Dişi Görevinin süresini giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="orksayi" class="form-control" id="orksayi" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","orksayi","ayar_id")?>">
							<label for="orksayi">Ork Dişi Adeti <img src="https://i.hizliresim.com/367Wmj.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Ork Dişi Görevinin adetini giriniz...</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="lanet" class="form-control" id="lanet" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","lanet","ayar_id")?>">
							<label for="lanet">Lanet Kitabı Süresi <img src="https://i.hizliresim.com/y6EJBM.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Lanet Kitabı Görevinin süresini giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="lanetsayi" class="form-control" id="lanetsayi" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","lanetsayi","ayar_id")?>">
							<label for="lanetsayi">Lanet Kitabı Adeti <img src="https://i.hizliresim.com/y6EJBM.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Lanet Kitabı Görevinin adetini giriniz...</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="seytan" class="form-control" id="seytan" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","seytan","ayar_id")?>">
							<label for="seytan">Şeytan Hatırası Süresi <img src="https://i.hizliresim.com/Rr08Wo.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Şeytan Hatırası Görevinin süresini giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="seytansayi" class="form-control" id="seytansayi" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","seytansayi","ayar_id")?>">
							<label for="seytansayi">Şeytan Hatırası Adeti <img src="https://i.hizliresim.com/Rr08Wo.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Şeytan Hatırası Görevinin adetini giriniz...</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="buz" class="form-control" id="buz" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","buz","ayar_id")?>">
							<label for="buz">Buz Topu Süresi <img src="https://i.hizliresim.com/Ov08G3.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Buz Topu Görevinin süresini giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="buzsayi" class="form-control" id="buzsayi" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","buzsayi","ayar_id")?>">
							<label for="buzsayi">Buz Topu Adeti <img src="https://i.hizliresim.com/Ov08G3.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Buz Topu Görevinin adetini giriniz...</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="zelkova" class="form-control" id="zelkova" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","zelkova","ayar_id")?>">
							<label for="zelkova">Zelkova Dalı Süresi <img src="https://i.hizliresim.com/Nnp8zk.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Zelkova Dalı Görevinin süresini giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="zelkovasayi" class="form-control" id="zelkovasayi" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","zelkovasayi","ayar_id")?>">
							<label for="zelkovasayi">Zelkova Dalı Adeti <img src="https://i.hizliresim.com/Nnp8zk.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Zelkova Dalı Görevinin adetini giriniz...</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="tug" class="form-control" id="tug" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","tug","ayar_id")?>">
							<label for="tug">Tugyis Tabelası Süresi <img src="https://i.hizliresim.com/pb0Mdz.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Tugyis Tabelası Görevinin süresini giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="tugsayi" class="form-control" id="tugsayi" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","tugsayi","ayar_id")?>">
							<label for="tugsayi">Tugyis Tabelası Adeti <img src="https://i.hizliresim.com/pb0Mdz.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Tugyis Tabelası Görevinin adetini giriniz...</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="krm" class="form-control" id="krm" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","krm","ayar_id")?>">
							<label for="krm">Krm. Hayalet Ağaç Dalı Süresi <img src="https://i.hizliresim.com/zj3O6g.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Krm. Hayalet Ağaç Dalı Görevinin süresini giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="krmsayi" class="form-control" id="krmsayi" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","krmsayi","ayar_id")?>">
							<label for="krmsayi">Krm. Hayalet Ağaç Dalı Adeti <img src="https://i.hizliresim.com/zj3O6g.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Krm. Hayalet Ağaç Dalı Görevinin adetini giriniz...</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="lider" class="form-control" id="lider" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","lider","ayar_id")?>">
							<label for="lider">Liderin Notları Süresi <img src="https://i.hizliresim.com/6a9pok.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Liderin Notları Görevinin süresini giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="lidersayi" class="form-control" id="lidersayi" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","lidersayi","ayar_id")?>">
							<label for="lidersayi">Liderin Notları Adeti <img src="https://i.hizliresim.com/6a9pok.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Liderin Notları Görevinin adetini giriniz...</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="kem" class="form-control" id="kem" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","kem","ayar_id")?>">
							<label for="kem">Kemgöz Mücevheri Süresi <img src="https://i.hizliresim.com/GmBWdv.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Kemgöz Mücevheri Görevinin süresini giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="kemsayi" class="form-control" id="kemsayi" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","kemsayi","ayar_id")?>">
							<label for="kemsayi">Kemgöz Mücevheri Adeti <img src="https://i.hizliresim.com/GmBWdv.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Kemgöz Mücevheri Görevinin adetini giriniz...</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="bilge" class="form-control" id="bilge" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","bilge","ayar_id")?>">
							<label for="bilge">Bilgelik Mücevheri Süresi <img src="https://i.hizliresim.com/alL8Vd.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Bilgelik Mücevheri Görevinin süresini giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="number" name="bilgesayi" class="form-control" id="bilgesayi" value="<?=\StaticDatabase\StaticDatabase::gettable("index_biyolog","bilgesayi","ayar_id")?>">
							<label for="bilgesayi">Bilgelik Mücevheri Adeti <img src="https://i.hizliresim.com/alL8Vd.png" class="Biyolo-Item-Img" /></label>
							<span class="help-block">Bilgelik Mücevheri Görevinin adetini giriniz...</span>
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

<?php endif;?>