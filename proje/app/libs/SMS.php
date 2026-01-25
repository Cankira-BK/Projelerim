<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.12.2016
 * Time: 10:54
 */

use StaticDatabase\StaticDatabase;

class SMS extends StaticDatabase
{
	public static function MASGSM($Url, $body = null)
	{
		$API_KEY = "uaIyXScFjXolF3NlZHqYz6iZSWEjNure9b32UpDy5qbM";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"Authorization: Key {$API_KEY}"));
		if($body):
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
		endif;
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
	public static function send_sms($Baslik,$Metin,$Numara)
	{
		$body = [
		"originator"=>$Baslik,
		"message"=>$Metin,
		"to"=>[$Numara],
		"encoding"=>"default"
		];
		$json = MASGSM('http://api.v2.masgsm.com.tr/v2/sms/basic',$body)
	}
}