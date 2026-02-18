<?php
if (!isset($_SESSION['id'])) {
	header("location: ?s=home");
	exit;
}
?>
<div id="register">
	<div class="content content-last">
		<div class="content-bg">
			<div class="content-bg-bottom">
				<h2>NUYA2 - Bilgileri Değiştir</h2>
				<div class="inner-form-border">
					<div class="inner-form-box">
						<div class="trenner"></div>
						<div class="center">
							<form action="?s=pwchange" method="post">
								<div class="form-item">
									<label for="password">Eski şifre:</label>
									<input type="password" name="oldpw" size="16" required><br />
								</div>
								<div class="form-item">
									<label for="newpw">Yeni şifre:</label>
									<input type="password" name="newpw" size="16" required><br />
								</div>
								<div class="form-item">
									<label for="newpw2">Yeni şifre tekrar:</label>
									<input type="password" name="newpw2" size="16" required><br />
								</div>
								<div class="form-item">
									<label for="lcold">Eski karakter silme kodu:</label>
									<input type="text" name="lcold" size="7" required><br />
								</div>
								<div class="form-item">
									<label for="lcnew">Yeni karakter silme kodu:</label>
									<input type="text" name="lcnew" size="7" required><br /><br />
								</div>
								<input id="submitBtn" class="btn-big" type="submit" name="change" value="Değiştir" />
							</form>
						</div>
						<?php
							if(isset($_POST['change']) && $_POST['change'] == 'Değiştir') {
								mysqli_select_db($sqlServ, 'account');
								$oldpw = mysqli_real_escape_string($sqlServ, $_POST['oldpw']);
								$newpw = mysqli_real_escape_string($sqlServ, $_POST['newpw']);
								$newpw2 = mysqli_real_escape_string($sqlServ, $_POST['newpw2']);
								$lcold = mysqli_real_escape_string($sqlServ, $_POST['lcold']);
								$lcnew = mysqli_real_escape_string($sqlServ, $_POST['lcnew']);
								if($newpw == $newpw2 && strlen($newpw) >= 3 && strlen($newpw) <= 16 && strlen($lcnew) == 7 && ctype_alnum($newpw) && ctype_alnum($lcnew)) {
									$change = "UPDATE account set password = PASSWORD('" . $newpw . "'), social_id = '" . $lcnew . "' where login = '" . $_SESSION['id'] . "' and password = PASSWORD('" . $oldpw . "') and social_id = '" . $lcold . "'";
									$query = mysqli_query($sqlServ, $change);
									if($query && mysqli_affected_rows($sqlServ) > 0) {
										$_SESSION['social_id'] = $lcnew;
										echo "<font color='green' style='font-size:16px'><strong>Bilgiler başarıyla güncellendi!</strong></font>";
									} else {
										echo "<font color='darkred' style='font-size:16px'><strong>İşlem başarısız, tekrar dene!</strong></font>";
									}
								} else {
									echo "<font color='darkred' style='font-size:16px'><strong>Lütfen girdiğin bilgileri kontrol et!</strong></font>";
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="shadow">&nbsp;</div>
</div>
