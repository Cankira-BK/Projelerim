<div class="content content-last">
	<div class="content-bg">
		<div class="content-bg-bottom">
			<div class="administration-inner-content">
				<div class="input-data-box2">
					<h2>NUYA2 - Kayıt Ol</h2>

					<?php
					// 1) DB bağlantısı EN ÜSTE
					require_once("user/config.php");

					// POST yoksa geri dön
					if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
						echo "<strong>Geçersiz istek.</strong> <a class='btn' href='?s=register'>Geri</a>";
						exit;
					}

					// account DB seç
					if (!mysqli_select_db($sqlServ, "account")) {
						die("DB seçilemedi: " . mysqli_error($sqlServ));
					}

					// Charset (config.php’de set ediyorsun; burada tekrar etmek sorun değil)
					@mysqli_set_charset($sqlServ, "utf8");

					// 2) Inputları al
					$UserID     = trim($_POST["UserID"]     ?? '');
					$Password   = trim($_POST["Password"]   ?? '');
					$Password2  = trim($_POST["Password2"]  ?? '');
					$Email      = trim($_POST["Email"]      ?? '');
					$UserName   = trim($_POST["UserName"]   ?? '');
					$DeleteCode = trim($_POST["DeleteCode"] ?? '');

					$error = "";

					// 3) Validasyon (min 5 yaptım; istersen 4'e çekebiliriz)
					if (strlen($UserID) < 5 || strlen($UserID) > 16 || !ctype_alnum($UserID)) {
						$error .= "Kullanıcı adı hatalı!<br />En fazla 16 karakter olabilir, en az 5.<br />";
					}
					if (strlen($Password) < 5 || strlen($Password) > 16 || !ctype_alnum($Password)) {
						$error .= "<br />Şifre hatalı!<br />En fazla 16 karakter olabilir, en az 5.<br />";
					}
					if (strlen($Email) < 5 || strlen($Email) > 25 || !filter_var($Email, FILTER_VALIDATE_EMAIL)) {
						$error .= "<br />E-posta adresi hatalı!<br />En fazla 25 karakter olabilir, en az 5.<br />";
					}
					if (strlen($UserName) < 4 || strlen($UserName) > 25) {
						$error .= "<br />İsim hatalı!<br />En fazla 25 karakter olabilir, en az 4.<br />";
					}
					if (strlen($DeleteCode) != 7 || !ctype_alnum($DeleteCode)) {
						$error .= "<br />Karakter silme kodu 7 karakter olmalıdır!<br />";
					}
					if ($Password !== $Password2) {
						$error .= "Şifreler eşleşmiyor!<br />";
					}

					if ($error !== "") {
						echo "<strong>$error</strong><a class='btn' href=\"javascript:history.back();\">Geri</a><br />";
						exit;
					}

					// 4) Kullanıcı adı var mı? (prepared)
					$stmt = mysqli_prepare($sqlServ, "SELECT 1 FROM account WHERE Login = ? LIMIT 1");
					if (!$stmt) {
						die("Sorgu hazırlanamadı: " . mysqli_error($sqlServ));
					}
					mysqli_stmt_bind_param($stmt, "s", $UserID);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);

					if (mysqli_stmt_num_rows($stmt) > 0) {
						mysqli_stmt_close($stmt);
						echo "<strong>Kullanıcı adı zaten kullanımda!</strong><a class='btn' href=\"javascript:history.back();\">Geri</a><br />";
						exit;
					}
					mysqli_stmt_close($stmt);

					// 5) Insert (MySQL 5.5'te PASSWORD() mevcut - Metin2 için genelde gerekli)
					$ins = mysqli_prepare(
						$sqlServ,
						"INSERT INTO account (Login, Password, Real_name, Email, social_id)
						 VALUES (?, PASSWORD(?), ?, ?, ?)"
					);

					if (!$ins) {
						die("Insert hazırlanamadı: " . mysqli_error($sqlServ));
					}

					mysqli_stmt_bind_param($ins, "sssss", $UserID, $Password, $UserName, $Email, $DeleteCode);

					if (!mysqli_stmt_execute($ins)) {
						$err = mysqli_stmt_error($ins);
						mysqli_stmt_close($ins);
						die("Kayıt hatası: " . $err);
					}

					mysqli_stmt_close($ins);
					?>

					<br /><h4 style="font-size: 16px">Kayıt başarılı!</h4>
					<ul>
						<li>Kullanıcı adı: <?php echo htmlspecialchars($UserID, ENT_QUOTES, 'UTF-8'); ?></li>
						<li>Şifre: <?php echo htmlspecialchars($Password, ENT_QUOTES, 'UTF-8'); ?></li>
						<li>E-posta: <?php echo htmlspecialchars($Email, ENT_QUOTES, 'UTF-8'); ?></li>
						<li>Gerçek Ad: <?php echo htmlspecialchars($UserName, ENT_QUOTES, 'UTF-8'); ?></li>
						<li>Karakter silme kodu: <?php echo htmlspecialchars($DeleteCode, ENT_QUOTES, 'UTF-8'); ?></li>
					</ul>
					<div class="administration-box"><a href="?s=download" class="btn">İndir</a></div>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="shadow">&nbsp;</div>