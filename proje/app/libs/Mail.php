<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.12.2016
 * Time: 10:54
 */

use StaticDatabase\StaticDatabase;

class Mail extends StaticDatabase
{
	public function send($title, $toWho, $message)
	{
		$phpMailer = new \PHPMailer();
		$phpMailer->SMTPAuth = true;
		$phpMailer->IsSMTP();
		$phpMailer->Host = StaticDatabase::settings('smtp_host'); // duzenlenecek
		$phpMailer->SMTPSecure = StaticDatabase::settings('smtp_secure'); // duzenlenecek
		$phpMailer->Port = StaticDatabase::settings('smtp_port'); // duzenlenecek
		$phpMailer->Username = StaticDatabase::settings('admin_mail'); // duzenlenecek
		$phpMailer->Password = StaticDatabase::settings('smtp_password'); // duzenlenecek
		$phpMailer->SMTPDebug  = StaticDatabase::settings('smtp_debug');
		$phpMailer->setFrom(StaticDatabase::settings('admin_mail'), StaticDatabase::settings('smtp_from'));
		$phpMailer->AddAddress($toWho, StaticDatabase::settings('smtp_from')); // duzenlenecek
		$phpMailer->CharSet = 'UTF-8';
		$phpMailer->Subject = $title;
		$phpMailer->MsgHTML($message);

		//mail gönderilme işlemi
		return @$phpMailer->Send();
	}
	public function sendTest($title, $toWho, $message)
	{
		$phpMailer = new \PHPMailer();
		$phpMailer->SMTPAuth = true;
		$phpMailer->IsSMTP();
		$phpMailer->Host = StaticDatabase::settings('smtp_host'); // duzenlenecek
		$phpMailer->SMTPSecure = StaticDatabase::settings('smtp_secure'); // duzenlenecek
		$phpMailer->Port = StaticDatabase::settings('smtp_port'); // duzenlenecek
		$phpMailer->Username = StaticDatabase::settings('admin_mail'); // duzenlenecek
		$phpMailer->Password = StaticDatabase::settings('smtp_password'); // duzenlenecek
		$phpMailer->SMTPDebug  = StaticDatabase::settings('smtp_debug');
		$phpMailer->setFrom(StaticDatabase::settings('admin_mail'), StaticDatabase::settings('smtp_from'));
		$phpMailer->AddAddress($toWho, StaticDatabase::settings('smtp_from')); // duzenlenecek
		$phpMailer->CharSet = 'UTF-8';
		$phpMailer->Subject = $title;
		$phpMailer->MsgHTML($message);

		//mail gönderilme işlemi
		$sent = @$phpMailer->Send();
		if (!$sent)
			return ["result"=>false,"error"=>$phpMailer->ErrorInfo];
		else
			return ["result"=>true];
	}
}