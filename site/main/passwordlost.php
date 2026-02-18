<div id="pwLost">
	<div class="content content-last">
		<div class="content-bg">
			<div class="content-bg-bottom">
				<h2>Şifrenizi mi unuttunuz?</h2>
				<div class="inner-form-border">
					<div class="inner-form-box">
						<h3><a id="toLogin" href="?s=login" title="Giriş Yap">Giriş Yap</a>Şifreyi Email ile gönder:</h3>
						<div class="trenner"></div>
						<form name="pwlostForm" id="pwlostForm" method="post" action="?s=passwordlost">
							<div>
								<label for="username">Kullanıcı Adı: *</label>
								<input type="text" class="validate[required,custom[noSpecialCharacters],length[5,16]]" id="username" name="username" title="" value="" maxlength="16" required />
							</div>
							<div>
								<label for="email">Email: *</label>
								<input type="text" class="validate[required,custom[email]]" id="email" name="email" title="" value="" maxlength="64" required />
							</div>
							<input id="submitBtn" type="submit" name="SubmitPasswordLostForm" value="Yeni şifre talep et" class="btn-big" />
						</form>
						<p id="regLegend">* zorunlu alan</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="shadow">&nbsp;</div>
</div>
<?php
	//To do...
	if(isset($_POST['SubmitPasswordLostForm']) && $_POST['SubmitPasswordLostForm'] == 'Yeni şifre talep et') {
		echo "<script>alert('Şu anda kullanılamıyor!')</script>";
	}
?>
