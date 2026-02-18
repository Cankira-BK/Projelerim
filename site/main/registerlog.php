<div class="content content-last">
	<div class="content-bg">
		<div class="content-bg-bottom">
			<div class="administration-inner-content">
				<div class="input-data-box2">
					<h2>NUYA2 - Kayıt Ol</h2>
					<?php
					// session_start();
					$UserID=mysqli_real_escape_string($sqlServ, $_POST["UserID"]);
					$Password=mysqli_real_escape_string($sqlServ, $_POST["Password"]);
					$Password2=mysqli_real_escape_string($sqlServ, $_POST["Password2"]);
					$Email=mysqli_real_escape_string($sqlServ, $_POST["Email"]);
					$UserName=mysqli_real_escape_string($sqlServ, $_POST["UserName"]);
					$DeleteCode=mysqli_real_escape_string($sqlServ, $_POST["DeleteCode"]);
					$error = "";
					//setlocale(LC_ALL, 'tr_TR');
					if (strlen($UserID) < 4 || strlen($UserID) > 16 || !ctype_alnum($UserID)) { $error=$error."Kullanıcı adı hatalı!<br />En fazla 16 karakter olabilir, en az 5.<br />"; }
					if (strlen($Password) < 4 || strlen($Password) > 16 || !ctype_alnum($Password)) { $error=$error."<br />Şifre hatalı!<br />En fazla 16 karakter olabilir, en az 5.</br>"; }
					if (strlen($Email) < 4 || strlen($Email) > 25 || !filter_var($Email, FILTER_VALIDATE_EMAIL)) { $error=$error."<br />E-posta adresi hatalı!<br />En fazla 25 karakter olabilir, en az 5.</br>"; }
					if (strlen($UserName) < 4 || strlen($UserName) > 25 /* || !ctype_alnum(trim(str_replace(' ','',$UserName)))*/ ) { $error=$error."<br />İsim hatalı!<br />En fazla 16 karakter olabilir, en az 5.</br>"; }
					if (strlen($DeleteCode) != 7 || !ctype_alnum($DeleteCode)) { $error=$error."<br />Karakter silme kodu 7 karakter olmalıdır!</br>"; }
					if ($Password != $Password2) { $error=$error."Şifreler eşleşmiyor!<br />"; }
					if (strlen($error) > 0) {
						echo "<strong>$error</strong><a class='btn' href=\"javascript:history.back();\">Geri</a><br />";
						exit;
					} else {
						require_once("user/config.php");
						mysqli_select_db($sqlServ, "account");
						$exec="select * from account where Login='$UserID'";
						$result=mysqli_query($sqlServ, $exec);
						$rs=mysqli_fetch_object($result);
						if($rs){
							echo"<strong>Kullanıcı adı zaten kullanımda!</strong><a class='btn' href=\"javascript:history.back();\">Geri</a><br />";
							exit;
						}else{
							$exec="insert into account (Login,Password,Real_name,Email,social_id)  values('$UserID',password('$Password'),'$UserName','$Email','$DeleteCode')";
							mysqli_query($sqlServ, "set names big5 ");
							mysqli_query($sqlServ, "set CHARACTER big5 ");
							mysqli_query($sqlServ, $exec);
					?>
					<br /><h4 style="font-size: 16px">Kayıt başarılı!</h4>
					<ul>
						<li>Kullanıcı adı:		<?php echo $UserID?></li>
						<li>Şifre:		<?php echo $Password?></li>
						<li>E-posta:		<?php echo $Email?></li>
						<li>Gerçek Ad:		<?php echo $UserName?></li>
						<li>Karakter silme kodu:		<?php echo $DeleteCode?></li>
					</ul>
					<div class="administration-box"><a href="?s=download" class="btn">İndir</a></div>
					<?php
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="shadow">&nbsp;</div>
