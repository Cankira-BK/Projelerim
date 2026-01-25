<?php
class Plugins
{
	public static function getRealIPAddress()
	{
		$ipAddress = null;
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipAddress = $_SERVER['HTTP_CLIENT_IP'];
		else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_X_FORWARDED']))
			$ipAddress = $_SERVER['HTTP_X_FORWARDED'];
		else if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
			$ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
		else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_FORWARDED']))
			$ipAddress = $_SERVER['HTTP_FORWARDED'];
		else if (isset($_SERVER['REMOTE_ADDR']))
			$ipAddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipAddress = 'UNKNOWN';
		return ($ipAddress !== "::1") ? $ipAddress : "185.118.143.141";
	}
	public static function urlParse()
	{
		$urlPath = isset($_GET['url']) ? filter_var($_GET['url'],FILTER_SANITIZE_URL) : null;
		$urlPath = rtrim($urlPath, '/');
		$urlPath = filter_var($urlPath, FILTER_SANITIZE_URL);
		return explode('/', $urlPath);
	}
	public static function reCaptcha($response)
	{
		if (\StaticDatabase\StaticDatabase::settings('recaptcha') === "0" || \StaticDatabase\StaticDatabase::settings('recaptcha') === "2")
			return true;
		$curl = new Curl\Curl();
		$curlData = [
			"secret" => \StaticDatabase\StaticDatabase::settings('secretkey'),
			"response" => $response,
			"remoteip" => self::getRealIPAddress()
		];		
		$curl->setOpt(CURLOPT_SSL_VERIFYPEER, 0);
		$curl->setOpt(CURLOPT_REFERER, URL);
		$curl->setOpt(CURLOPT_CONNECTTIMEOUT, 0);
		$curl->setOpt(CURLOPT_TIMEOUT, 60);
		$curl->get("https://www.google.com/recaptcha/api/siteverify", $curlData);
		if ($curl->error)
			return true;
		else
		{
			if ($curl->response->success)
				return true;
			else
				return false;
		}
	}		public static function hCaptcha($response)	{		if (\StaticDatabase\StaticDatabase::settings('recaptcha') === "0" || \StaticDatabase\StaticDatabase::settings('recaptcha') === "1")			return true;		$curl = new Curl\Curl();		$curlData = [			"secret" => \StaticDatabase\StaticDatabase::settings('secretkey'),			"response" => $response		];				$curl->setOpt(CURLOPT_SSL_VERIFYPEER, 0);		$curl->setOpt(CURLOPT_REFERER, URL);		$curl->setOpt(CURLOPT_CONNECTTIMEOUT, 0);		$curl->setOpt(CURLOPT_TIMEOUT, 60);		$curl->get("https://hcaptcha.com/siteverify", $curlData);		if ($curl->error)			return true;		else		{			if ($curl->response->success)				return true;			else				return false;		}	}
	public static function reCaptchaShop($response)
	{
		if (\StaticDatabase\StaticDatabase::settings('shop_recaptcha_status') === "0")
			return true;
		$curl = new Curl\Curl();
		$curlData = [
			"secret" => \StaticDatabase\StaticDatabase::settings('secretkey'),
			"response" => $response,
			"remoteip" => self::getRealIPAddress()
		];		
		$curl->setOpt(CURLOPT_SSL_VERIFYPEER, 0);
		$curl->setOpt(CURLOPT_REFERER, URL);
		$curl->setOpt(CURLOPT_CONNECTTIMEOUT, 0);
		$curl->setOpt(CURLOPT_TIMEOUT, 60);
		$curl->get("https://www.google.com/recaptcha/api/siteverify", $curlData);
		if ($curl->error)
			return true;
		else
		{
			if ($curl->response->success)
				return true;
			else
				return false;
		}
	}		public static function VirusTotalOGs($type,$file,$userinfo)	{		date_default_timezone_set('Asia/Bahrain');		$now = date('Y-m-d H:i:s');				if ($type == "sendfile")		{			$api = new VirusTotalAPIV2(\StaticDatabase\StaticDatabase::settings('virustotal_api'));			$result = $api->scanFile($file);			$scanId = $api->getScanID($result);			$scanurl = $api->getReportPermalink($result,true);			#$api->displayResult($result);			print('Sonuç: <b>' . $api->GetVerboseMessage($result) . '</b><br>');			$api->makeComment($scanId, "Bu dosya tarama isteği $userinfo tarafından OGsPanel aracılığı ile gönderilmiştir.");						$setLog = \StaticDatabase\StaticDatabase::init()->prepare("INSERT INTO log_virustotal (User,ScanType,ScanID,ScanURL,Date) VALUES (?,?,?,?,?)");			$setLog->execute(array($userinfo, "Dosya", $scanId, $scanurl, $now));					}		else if ($type == "sendurl")		{			$api = new VirusTotalAPIV2(\StaticDatabase\StaticDatabase::settings('virustotal_api'));			$result = $api->scanURL($file);			$scanId = $api->getScanID($result);			$scanurl = $api->getReportPermalink($result,true);			#$api->displayResult($result);			print('Sonuç: <b>' . $api->GetVerboseMessage($result) . '</b><br>');			$api->makeComment($file, "Bu Link tarama isteği $userinfo tarafından OGsPanel aracılığı ile gönderilmiştir.");									$setLog = \StaticDatabase\StaticDatabase::init()->prepare("INSERT INTO log_virustotal (User,ScanType,ScanID,ScanURL,Date) VALUES (?,?,?,?,?)");			$setLog->execute(array($userinfo, "URL/Link", $scanId, $scanurl, $now));		}		else if ($type == "filereport")		{			$api = new VirusTotalAPIV2(\StaticDatabase\StaticDatabase::settings('virustotal_api'));			$report = $api->getFileReport($file);			#$api->displayResult($report);			print('İşlem Zamanı: <b>' . $api->getSubmissionDate($report) . '</b><br>');			print('Tarama Sayısı: <font color="blue">' . $api->getTotalNumberOfChecks($report) . '</font><br>');			print('Tehtit Sayısı: <font color="red"><b>' . $api->getNumberHits($report) . '</b></font><br>');			print('<a href="' . $api->getReportPermalink($report, true) . '" target="_blank">VirusTotal URL</a><br>');		}		else if ($type == "urlreport")		{			$api = new VirusTotalAPIV2(\StaticDatabase\StaticDatabase::settings('virustotal_api'));			$report = $api->getURLReport($file);			print('İşlem Zamanı: <b>' . $api->getSubmissionDate($report) . '</b><br>');			print('Tarama Sayısı: <font color="blue">' . $api->getTotalNumberOfChecks($report) . '</font><br>');			print('Tehtit Sayısı: <font color="red"><b>' . $api->getNumberHits($report) . '</b></font><br>');			print('<a href="' . $api->getReportPermalink($report, true) . '" target="_blank">VirusTotal URL</a><br>');		}	}
}