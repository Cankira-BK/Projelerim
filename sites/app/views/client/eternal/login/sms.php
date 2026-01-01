<aside id="right">
	<div id="content_ajax">
		<article class="page_article">
			<h2 class="head"><?=$lng[21]?></h2>
			<div class="body">
				<div class="error-holder">
					<div class="container_3 red wide fading-notification" align="left">
						<?php
						$cError = Session::get('cError');
						if($cError == 'recaptcha'){
							echo Functions::alert('error','Captcha yanlış işlem yaptınız. Lütfen tekrar deneyiniz.');
							Session::set('cError',false);
						}elseif($cError == 'filter'){
							echo Functions::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
							Session::set('cError',false);
						}elseif($cError == 'empty'){
							echo Functions::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
							Session::set('cError',false);
						} elseif($cError == 'error'){
							echo Functions::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
							Session::set('cError',false);
						} elseif ($cError == 'code') {
							echo Functions::alert('error','Hatalı Kod Girdiniz!');
							Session::set('cError',false);
						} elseif ($cError == 'OK') {
							echo Functions::alert('success','Kayıt işlemi başarılı. Lütfen giriş yapınız!');
							Session::set('cError',false);
						}
						?>
					</div>
				</div>
				<form action="<?=URI::get_path('login/control2')?>" method="post" accept-charset="utf-8" class="page_form">
					<table style="width:500px;">
						<tr>
							<td><label for="account_id">Kod :</label></td>
							<td>
								<span class="warfg_input" style=""><input type="text" name="code" value="" placeholder="Kod"></span>

							</td>
						</tr>
						<tr>
							<td><label for="account_password"><?=$lng[24]?> :</label></td>
							<td>
								<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 0) {echo $this->captcha->simple()->call(); echo '<br><input name="captcha" type="password">';}?>
								<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {echo $this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
								<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {echo $this->captcha->hcaptcha(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<span class="warfg_btn"><input type="submit" name="login_submit" value="<?=$lng[21]?>"></span>
							</td>
						</tr>
					</table>
				</form>

			</div>
		</article>
	</div>
</aside>