<?php
use Model\IN_Model;
class ManagementModel extends IN_Model
{
	public function db()
	{
		$licenceKey = isset($_POST['licence_key']) ? $this->filter->mainFilter($_POST['licence_key']) : null;
		$licenceSecret = isset($_POST['licence_secret']) ? $this->filter->mainFilter($_POST['licence_secret']) : null;
		$licenceHash = isset($_POST['licence_hash']) ? $this->filter->mainFilter($_POST['licence_hash']) : null;
		$ip = isset($_POST['ip']) ? $_POST['ip'] : null;
		$user = isset($_POST['user']) ? $_POST['user'] : null;
		$password = isset($_POST['password']) ? $_POST['password'] : null;
		$db = isset($_POST['db']) ? $_POST['db'] : null;
		$type = isset($_POST['db']) ? $_POST['type'] : null;
		if ($licenceKey === null || $licenceSecret === null || $licenceHash === null || $ip === null || $user === null || $password === null)
			$result = ["result"=>false,"message"=>"Eksik veri girdiniz!"];
		elseif ($licenceKey === false || $licenceSecret === false || $licenceHash === false || $ip === false || $user === false)
			$result = ["result"=>false,"message"=>"Lütfen bilgileri kontrol ediniz!"];
		elseif ($licenceKey === "" || $licenceSecret === "" || $licenceHash === "" || $ip === "" || $user === "" || $password === "")
			$result = ["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"];
		elseif ($licenceKey !== \StaticDatabase\StaticDatabase::settings('licence_key') || $licenceSecret !== \StaticDatabase\StaticDatabase::settings('licence_secret'))
			$result = ["result"=>false,"message"=>"Lisans anahtarları hatalı!"];
		elseif ($licenceHash !== md5(\StaticDatabase\StaticDatabase::settings('licence_key').\StaticDatabase\StaticDatabase::settings('licence_secret')))
			$result = ["result"=>false,"message"=>"Hash hatalı!"];
		else
		{
			$this->db->update('settings',array('deger'=>$ip),array('anahtar'=>'ip'));
			$this->db->update('settings',array('deger'=>$user),array('anahtar'=>'user'));
			$this->db->update('settings',array('deger'=>$password),array('anahtar'=>'password'));
			$this->db->update('settings',array('deger'=>''),array('anahtar'=>'db'));
			$this->db->update('settings',array('deger'=>$hashType),array('anahtar'=>'type'));
		}
		echo json_encode($result);
	}

	public function licence()
	{
		$licenceKey = \StaticDatabase\StaticDatabase::settings('licence_key');
		$licenceSecret = \StaticDatabase\StaticDatabase::settings('licence_secret');

		$versionData = [
			"licence_key" => $licenceKey,
			"licence_secret" => $licenceSecret
		];

		$curl = $this->curl("https://lisans.ogstudio.net/checked",$versionData);

		if (!$curl["state"])
			return ["result"=>false,"message"=>"Update manager not working!"];

		$jsonDecode = json_decode($curl["return"]);

		if (!$jsonDecode->result)
			return ["result"=>false,"message"=>$jsonDecode->message];

		return ["result"=>true,"data"=>$jsonDecode->data->time];
	}
	
	public function shop_backup()
	{

	}

	public function shop_export()
	{
		//Get Database Info
		$mysqlHostname = DB_HOST;
		$mysqlUsername = DB_USER;
		$mysqlPassword = DB_PASS;
		$mysqlDbName = DB_NAME;
		$mysqlCharset = "utf8";

		$mysqli = new mysqli($mysqlHostname,$mysqlUsername,$mysqlPassword,$mysqlDbName);
		$mysqli->select_db($mysqlDbName);
		$mysqli->query("SET NAMES '".$mysqlCharset."'");

		$queryTables    = $mysqli->query('SHOW TABLES');
		while($row = $queryTables->fetch_row())
		{
			if ($row[0] === "items" || $row[0] === "shop_menu")
				$target_tables[] = $row[0];
		}

		$now = date("Y-m-d");
		$content = "/*
OGStudio Shop Backup

Source Host           : $mysqlHostname:3306
Source Database       : $mysqlDbName
Target Server Type    : MYSQL

Date: $now
*/\n";
		foreach($target_tables as $table)
		{
			$result         =   $mysqli->query('SELECT * FROM '.$table);
			$fields_amount  =   $result->field_count;
			$rows_num=$mysqli->affected_rows;
			$res            =   $mysqli->query('SHOW CREATE TABLE '.$table);
			$TableMLine     =   $res->fetch_row();
			$commentTable 	=   "-- ----------------------------\n-- Table structure for $table\n-- ----------------------------";
			$content        = (!isset($content) ?  '' : $content) . "\n$commentTable\n".$TableMLine[1].";\n";

			for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0)
			{
				while($row = $result->fetch_row())
				{ //when started (and every after 100 command cycle):
					if ($st_counter%100 == 0 || $st_counter == 0 )
					{
						$content .= "\n-- ----------------------------\n-- Records of $table\n-- ----------------------------\nINSERT INTO ".$table." VALUES";
					}
					$content .= "\n(";
					for($j=0; $j<$fields_amount; $j++)
					{
						$row[$j] = str_replace("\n","\\n", addslashes($row[$j]) );
						if (isset($row[$j]))
						{
							$content .= '"'.$row[$j].'"' ;
						}
						else
						{
							$content .= '""';
						}
						if ($j<($fields_amount-1))
						{
							$content.= ',';
						}
					}
					$content .=")";
					//every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
					if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num)
					{
						$content .= ";";
					}
					else
					{
						$content .= ",";
					}
					$st_counter=$st_counter+1;
				}
			} $content .="\n\n";
		}

		//File State
		$backup_name = "ogstudio_shop_backup";
		$backUPFile = fopen($backup_name.".sql", "w");
		fwrite($backUPFile, $content);
		fclose($backUPFile);

		//Zip State
		$zipName = $backup_name.".zip";
		$zip = new ZipArchive;
		$zipCreate = $zip->open($zipName, ZipArchive::CREATE);

		if (!$zipCreate)
			die(json_encode(["result"=>false,"message"=>"Zip dosyası oluşturulamadı!"]));

		$zip->addFile($backup_name.".sql");

		$pathdir = "data/upload/";
		$dir = opendir($pathdir);
		while($file = readdir($dir)) {
			if(is_file($pathdir.$file)) {
				$zip->addFile($pathdir.$file, $pathdir.$file);
			}

		}
		$zip->close();
		unlink($backup_name.".sql");

		die(json_encode(["result"=>true,"message"=>"Market yedek oluşturuldu!","data"=>URI::get_path('management/shop_download')]));
	}

	public function shop_download()
	{
		$backup_name = "ogstudio_shop_backup";
		$zipName = $backup_name.".zip";
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$zipName);
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($zipName));
		ob_clean();
		flush();
		readfile($zipName);
		unlink($zipName);
	}

	public function shop_import()
	{
		$reCaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
		if ($reCaptcha == 1) {
			Session::init();
			$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
			$ip = $_SERVER['REMOTE_ADDR'];
			$captcha = filter_var($_POST['g-recaptcha-response'], FILTER_SANITIZE_STRING);
			$rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
			$captchaRes = json_decode($rsp, true);
			date_default_timezone_set('Europe/Istanbul');
			if (!$captchaRes['success']) {
				Session::set('error_status', 'true');
				Session::set('error_message', 'Lütfen robot olmadığınızı kanıtlayın!');
				URI::redirect('management/shop_backup');
				exit();
			}
		}
		if ($reCaptcha == 2)
		{
			Session::init();
			$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
			$ip = $_SERVER['REMOTE_ADDR'];
			$captcha = $_POST['h-captcha-response'];
			date_default_timezone_set('Europe/Istanbul');
			$data = array('secret' => $secret,'response' => $captcha);
			$verify = curl_init();
			curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
			curl_setopt($verify, CURLOPT_POST, true);
			curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
			$verifyResponse = curl_exec($verify);
			$responseData = json_decode($verifyResponse);
			if (!$responseData->success) 
			{
				Session::set('error_status', 'true');
				Session::set('error_message', 'Lütfen robot olmadığınızı kanıtlayın!');
				URI::redirect('management/shop_backup');
				exit;
			}
		}

		$shopBackup = $_FILES["shop_backup"];

		move_uploaded_file($shopBackup["tmp_name"],$shopBackup["name"]);

		$zip = new ZipArchive;
		$isZip = $zip->open($shopBackup["name"]);

		if ($isZip !== true)
		{
			unlink($shopBackup["name"]);
			Session::set('error_status', 'true');
			Session::set('error_message', 'Bu dosya yüklenemez!');
			URI::redirect('management/shop_backup');
			exit;
		}

		$extractZip = $zip->extractTo(".");

		if ($extractZip !== true)
		{
			unlink($shopBackup["name"]);
			Session::set('error_status', 'true');
			Session::set('error_message', 'Bu dosya yüklenemez!');
			URI::redirect('management/shop_backup');
			exit;
		}

		$zip->close();

		if (!file_exists("ogstudio_shop_backup.sql"))
		{
			unlink($shopBackup["name"]);
			Session::set('error_status', 'true');
			Session::set('error_message', 'Yedek dosyası uygun değil!');
			URI::redirect('management/shop_backup');
			exit;
		}

		unlink($shopBackup["name"]);

		$fOpenSql = fopen("ogstudio_shop_backup.sql", "r");

		if ($fOpenSql === false)
		{
			unlink($shopBackup["name"]);
			Session::set('error_status', 'true');
			Session::set('error_message', 'Market yedek sql dosyası uyuşmuyor!');
			URI::redirect('management/shop_backup');
			exit;
		}

		$sql = fread($fOpenSql,filesize("ogstudio_shop_backup.sql"));
		fclose($fOpenSql);

		try {
			$server  =  DB_HOST;
			$username   = DB_USER;
			$password   = DB_PASS;
			$database = DB_NAME;

			$db = new PDO("mysql:host=".$server.";dbname=".$database.";charset=utf8", $username, $password);
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$db->exec("set names utf8");
		} catch ( PDOException $e ){
			Session::set('error_status', 'true');
			Session::set('error_message', $e->getMessage());
			URI::redirect('management/shop_backup');
			exit;
		}

		$itemsTable = $db->prepare("SHOW TABLES LIKE 'items'");
		$itemsTable->execute();

		if ($itemsTable->fetch() !== false)
		{
			$db->exec("DROP TABLE items");
		}

		$menuTable = $db->prepare("SHOW TABLES LIKE 'shop_menu'");
		$menuTable->execute();

		if ($menuTable->fetch() !== false)
		{
			$db->exec("DROP TABLE shop_menu");
		}

		$importSQL = $db->exec($sql);

		if ($importSQL !== 0)
		{
			Session::set('error_status', 'true');
			Session::set('error_message', "SQL dosyası yüklenemedi!");
			URI::redirect('management/shop_backup');
			exit;
		}

		unlink("ogstudio_shop_backup.sql");
		Session::set('error_status', 'OK');
		Session::set('error_message', "Yedek yüklendi!");
		URI::redirect('management/shop_backup');
		exit;
	}
	
	
	public function chequewonedit()
	{
		$status = $_POST['won_durum'];
		$value1 = $_POST['won_sutun'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('systems',['deger'=>$status],['anahtar'=>'won_durum']);
		if ($status == 0)
			$this->db->update('systems',['deger'=>'cheque'],['anahtar'=>'won_sutun']);
		else
			$this->db->update('systems',['deger'=>$value1],['anahtar'=>'won_sutun']);
		die(json_encode(["result"=>true,"message"=>"Won ayarları güncellendi!"]));
	}
	public function metingayaedit()
	{
		$status = $_POST['metingaya_durum'];
		$value1 = $_POST['metingaya_sutun'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('systems',['deger'=>$status],['anahtar'=>'metingaya_durum']);
		if ($status == 0)
			$this->db->update('systems',['deger'=>'gaya'],['anahtar'=>'metingaya_sutun']);
		else
			$this->db->update('systems',['deger'=>$value1],['anahtar'=>'metingaya_sutun']);
		die(json_encode(["result"=>true,"message"=>"Metin Gaya ayarları güncellendi!"]));
	}
	public function bossgayaedit()
	{
		$status = $_POST['bossgaya_durum'];
		$value1 = $_POST['bossgaya_sutun'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('systems',['deger'=>$status],['anahtar'=>'bossgaya_durum']);
		if ($status == 0)
			$this->db->update('systems',['deger'=>'gaya1'],['anahtar'=>'bossgaya_sutun']);
		else
			$this->db->update('systems',['deger'=>$value1],['anahtar'=>'bossgaya_sutun']);
		die(json_encode(["result"=>true,"message"=>"Metin Gaya ayarları güncellendi!"]));
	}
	public function npedit()
	{
		$status = $_POST['np_durum'];
		$value1 = $_POST['np_sutun'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('systems',['deger'=>$status],['anahtar'=>'np_durum']);
		if ($status == 0)
			$this->db->update('systems',['deger'=>'np'],['anahtar'=>'np_sutun']);
		else
			$this->db->update('systems',['deger'=>$value1],['anahtar'=>'np_sutun']);
		die(json_encode(["result"=>true,"message"=>"Metin Gaya ayarları güncellendi!"]));
	}
	public function rebirthedit()
	{
		$status = $_POST['rebirth_durum'];
		$value1 = $_POST['rebirth_sutun'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('systems',['deger'=>$status],['anahtar'=>'rebirth_durum']);
		if ($status == 0)
			$this->db->update('systems',['deger'=>'rebirth'],['anahtar'=>'rebirth_sutun']);
		else
			$this->db->update('systems',['deger'=>$value1],['anahtar'=>'rebirth_sutun']);
		die(json_encode(["result"=>true,"message"=>"Metin Gaya ayarları güncellendi!"]));
	}
	public function rutbeedit()
	{
		$status = $_POST['rutbe_durum'];
		$value1 = $_POST['rutbe_sutun'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('systems',['deger'=>$status],['anahtar'=>'rutbe_durum']);
		if ($status == 0)
			$this->db->update('systems',['deger'=>'prestige'],['anahtar'=>'rutbe_sutun']);
		else
			$this->db->update('systems',['deger'=>$value1],['anahtar'=>'rutbe_sutun']);
		die(json_encode(["result"=>true,"message"=>"Metin Gaya ayarları güncellendi!"]));
	}

	private function curl($url,$data)
	{
		$_ch = curl_init($url);
		curl_setopt($_ch, CURLOPT_CUSTOMREQUEST, "POST");
		if (is_array($data))
			curl_setopt($_ch, CURLOPT_POSTFIELDS, http_build_query($data));

		$agent = "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/534.7 (KHTML, like Gecko) Chrome/7.0.517.44 Safari/534.7";
		curl_setopt($_ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($_ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($_ch,CURLOPT_USERAGENT,$agent);
		curl_setopt($_ch, CURLOPT_REFERER, $_SERVER["SERVER_NAME"]);
		curl_setopt($_ch,CURLOPT_CONNECTTIMEOUT, 0);
		curl_setopt($_ch,CURLOPT_TIMEOUT, 30);
		$exec = curl_exec($_ch);
		if(curl_errno($_ch))
			$result = ["state"=>false,"return"=>curl_error($_ch)];
		else
			$result = ["state"=>true,"return"=>$exec];
		curl_close($_ch);

		return $result;
	}

	private function downloadAndExtract($file,$url)
	{
		$path = dirname(".");
		$zipFile = "$file.zip";
		$fullFile = $path.'/'.$zipFile;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
		$fileRaw = curl_exec($ch);
		curl_close ($ch);
		if(file_exists($fullFile)){
			unlink($fullFile);
		}
		$fp = fopen($fullFile,'x');
		fwrite($fp, $fileRaw);
		fclose($fp);
		$zip = new ZipArchive;
		$res = $zip->open($zipFile);
		if ($res === TRUE) {
			$zip->extractTo($path);
			$zip->close();
			unlink($zipFile);
			return true;
		} else
			return false;
	}
}