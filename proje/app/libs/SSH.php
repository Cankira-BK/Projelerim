<?php

class SSHConnect
{
	private static function replaceSpace($string)
	{
		$string = preg_replace("/\s+/", " ", $string);
		$string = trim($string);
		return $string;
	}
	
	public static function explode_line($dosyaadi,$cekname)
	{
		if ($file = fopen("data/cache/$dosyaadi.sftp", "r")) {
			$itemVnum = null;
			while (!feof($file)) {
				$line = fgets($file);
				$exp = explode(':', $line);
				if ($exp[0] === $cekname)
					return self::replaceSpace($exp[1]);
			}
		}
	}
	
	public static function explode_line2($dosyaadi,$cekname)
	{
		if ($file = fopen("data/cache/$dosyaadi.sftp", "r")) {
			$itemVnum = null;
			while (!feof($file)) {
				$line = fgets($file);
				$exp = explode(' = ', $line);
				if ($exp[0] === $cekname)
					return self::replaceSpace($exp[1]);
			}
		}
	}
	
	public static function fileWriteSFTP($file,$content,$permission = "a+")
	{
		$filePath = dirname(dirname(dirname(__FILE__))) . '/' . $file;
		$fOpen = fopen($filePath,$permission);
		if (fwrite($fOpen,$content))
			$return = true;
		else
			$return = false;
		fclose($fOpen);
		return $return;
	}
	
	public static function fileWriteSFTPTranslate($file,$content,$permission = "a+")
	{
		$filePath = dirname(dirname(dirname(__FILE__))) . '/' . $file;
		$fOpen = fopen($filePath,$permission);
		if (fwrite($fOpen,Functions::latin1($content)))
			$return = true;
		else
			$return = false;
		fclose($fOpen);
		return $return;
	}
	
	public static function fileReadSTFP($file)
	{
		$filePath = dirname(dirname(dirname(__FILE__))) . '/' . $file;
		$fOpen = fopen($filePath,"r");
		$return = fread($fOpen, filesize($filePath));
		return Functions::utf8($return);
	}
	
	public static function fileReadSTFP2($file)
	{
		$filePath = dirname(dirname(dirname(__FILE__))) . '/' . $file;
		$fOpen = fopen($filePath,"r");
		$return = fread($fOpen, filesize($filePath));
		return $return;
	}
	
	public static function FileDeleteTemp($fileName)
	{
		if (file_exists('data/cache/'.$fileName))
			unlink('data/cache/'.$fileName);
	}
	
	public static function topscreen() 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			exit('SSH2 Bağlantısı başarısız, şifre hatalı olabilir lütfen kontrol ediniz!');
		}
		$ansi = new File_ANSI();
		$ansi->appendString($ssh->read('username@username:~$'));
		$ssh->write("top\n");
		$ssh->setTimeout(5);
		$ansi->appendString($ssh->read());
		echo $ansi->getScreen();
	}
	
	public static function get_commands($komut) 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			Session::set('cError', 'ssh2logout');
			return false;
		}
		
		$ssh->exec($komut);
		Session::set('cError', 'basarili');
	}
	
	public static function get_commands_hide($komut) 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			Session::set('cError', 'ssh2logout');
			return false;
		}
		
		$ssh->exec($komut);
	}
	
	public static function get_cpu_info() 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			Session::set('cError', 'ssh2logout');
			return false;
		}
		
		$detay = $ssh->exec("sysctl hw.model hw.machine hw.ncpu | awk '{print $3,$4,$5,$6,$7,$8}'");
		$ssh->setTimeout(2);
		return $detay;
	}
	
	public static function get_ram_info() 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			Session::set('cError', 'ssh2logout');
			return false;
		}
		
		$detay = $ssh->exec("grep memory /var/run/dmesg.boot | awk '{print $5,$6}'");
		$ssh->setTimeout(2);
		return substr($detay,"1","7");
	}
	
	public static function start_ch1_server() 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			Session::set('cError', 'ssh2logout');
			return false;
		}
		$ansi = new File_ANSI();
		$ansi->appendString($ssh->read('username@username:~$'));
		$ssh->write("cd /usr/game/channel/g1/db && ./db & sleep 3 && cd /usr/game/channel/g1/auth && ./auth & sleep 3 && cd /usr/game/channel/channel1/core1 && ./game1_core1 & sleep 3 && cd /usr/game/channel/channel1/core2 && ./game1_core2 & sleep 3 && cd /usr/game/channel/channel1/core3 && ./game1_core3 & sleep 3 && cd /usr/game/channel/channel1/core4 && ./game1_core4 & sleep 3 && cd /usr/game/channel/game99/core1 && ./game99_core1 & sleep 3 && cd /usr/game/channel/game99/core2 && ./game99_core2 & sleep 3\n");
		$ssh->setTimeout(5);
		$ansi->appendString($ssh->read());
		Session::set('cError', 'ch1');
	}
	
	public static function start_ch2_server() 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			Session::set('cError', 'ssh2logout');
			return false;
		}
		$ansi = new File_ANSI();
		$ansi->appendString($ssh->read('username@username:~$'));
		$ssh->write("cd /usr/game/channel/g1/db && ./db & sleep 3 && cd /usr/game/channel/g1/auth && ./auth & sleep 3 && cd /usr/game/channel/channel1/core1 && ./game1_core1 & sleep 3 && cd /usr/game/channel/channel1/core2 && ./game1_core2 & sleep 3 && cd /usr/game/channel/channel1/core3 && ./game1_core3 & sleep 3 && cd /usr/game/channel/channel1/core4 && ./game1_core4 & sleep 3 && cd /usr/game/channel/channel2/core1 && ./game2_core1 & sleep 3 && cd /usr/game/channel/channel2/core2 && ./game2_core2 & sleep 3 && cd /usr/game/channel/channel2/core3 && ./game2_core3 & sleep 3 && cd /usr/game/channel/channel2/core4 && ./game2_core4 & sleep 3 && cd /usr/game/channel/game99/core1 && ./game99_core1 & sleep 3 && cd /usr/game/channel/game99/core2 && ./game99_core2 & sleep 3\n");
		$ssh->setTimeout(5);
		$ansi->appendString($ssh->read());
		Session::set('cError', 'ch2');
	}
	
	public static function start_ch3_server() 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			Session::set('cError', 'ssh2logout');
			return false;
		}
		$ansi = new File_ANSI();
		$ansi->appendString($ssh->read('username@username:~$'));
		$ssh->write("cd /usr/game/channel/g1/db && ./db & sleep 3 && cd /usr/game/channel/g1/auth && ./auth & sleep 3 && cd /usr/game/channel/channel1/core1 && ./game1_core1 & sleep 3 && cd /usr/game/channel/channel1/core2 && ./game1_core2 & sleep 3 && cd /usr/game/channel/channel1/core3 && ./game1_core3 & sleep 3 && cd /usr/game/channel/channel1/core4 && ./game1_core4 & sleep 3 && cd /usr/game/channel/channel2/core1 && ./game2_core1 & sleep 3 && cd /usr/game/channel/channel2/core2 && ./game2_core2 & sleep 3 && cd /usr/game/channel/channel2/core3 && ./game2_core3 & sleep 3 && cd /usr/game/channel/channel2/core4 && ./game2_core4 & sleep 3 && cd /usr/game/channel/channel3/core1 && ./game3_core1 & sleep 3 && cd /usr/game/channel/channel3/core2 && ./game3_core2 & sleep 3 && cd /usr/game/channel/channel3/core3 && ./game3_core3 & sleep 3 && cd /usr/game/channel/channel3/core4 && ./game3_core4 & sleep 3 && cd /usr/game/channel/game99/core1 && ./game99_core1 & sleep 3 && cd /usr/game/channel/game99/core2 && ./game99_core2 & sleep 3\n");
		$ssh->setTimeout(5);
		$ansi->appendString($ssh->read());
		Session::set('cError', 'ch3');
	}
	
	public static function start_ch4_server() 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			Session::set('cError', 'ssh2logout');
			return false;
		}

		$ansi = new File_ANSI();
		$ansi->appendString($ssh->read('username@username:~$'));
		$ssh->write("cd /usr/game/channel/g1/db && ./db & sleep 3 && cd /usr/game/channel/g1/auth && ./auth & sleep 3 && cd /usr/game/channel/channel1/core1 && ./game1_core1 & sleep 3 && cd /usr/game/channel/channel1/core2 && ./game1_core2 & sleep 3 && cd /usr/game/channel/channel1/core3 && ./game1_core3 & sleep 3 && cd /usr/game/channel/channel1/core4 && ./game1_core4 & sleep 3 && cd /usr/game/channel/channel2/core1 && ./game2_core1 & sleep 3 && cd /usr/game/channel/channel2/core2 && ./game2_core2 & sleep 3 && cd /usr/game/channel/channel2/core3 && ./game2_core3 & sleep 3 && cd /usr/game/channel/channel2/core4 && ./game2_core4 & sleep 3 && cd /usr/game/channel/channel3/core1 && ./game3_core1 & sleep 3 && cd /usr/game/channel/channel3/core2 && ./game3_core2 & sleep 3 && cd /usr/game/channel/channel3/core3 && ./game3_core3 & sleep 3 && cd /usr/game/channel/channel3/core4 && ./game3_core4 & sleep 3 && cd /usr/game/channel/channel4/core1 && ./game4_core1 & sleep 3 && cd /usr/game/channel/channel4/core2 && ./game4_core2 & sleep 3 && cd /usr/game/channel/channel4/core3 && ./game4_core3 & sleep 3 && cd /usr/game/channel/channel4/core4 && ./game4_core4 & sleep 3 && cd /usr/game/channel/game99/core1 && ./game99_core1 & sleep 3 && cd /usr/game/channel/game99/core2 && ./game99_core2 & sleep 3\n");
		$ssh->setTimeout(5);
		$ansi->appendString($ssh->read());
		Session::set('cError', 'ch4');
	}
	
	public static function stop_auth_server() 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			Session::set('cError', 'ssh2logout');
			return false;
		}
		
		$ssh->exec("killall -9 auth vrunner");
		Session::set('cError', 'stopauth');
	}
	
	public static function stop_game_server() 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			Session::set('cError', 'ssh2logout');
			return false;
		}
		
		$ssh->exec("killall -9 game vrunner");
		Session::set('cError', 'stopch');
	}
	
	public static function stop_db_server() 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			Session::set('cError', 'ssh2logout');
			return false;
		}
		
		$ssh->exec("killall -9 db");
		Session::set('cError', 'stopdb');
	}
	
	public static function reboot_server() 
	{
		$ssh = new Net_SSH2(GAME_DB_HOST);
		if (!$ssh->login('root', GAME_SSH_PASS)) {
			Session::set('cError', 'ssh2logout');
			return false;
		}
		
		$ssh->exec("reboot");
	}
	
	public static function down_file($dosyadizin,$dosyaadi) 
	{
		$sftp = new Net_SFTP(GAME_DB_HOST);
		if (!$sftp->login('root', GAME_SSH_PASS)) {
			exit('SFTP Bağlantısı başarısız, şifre hatalı olabilir lütfen kontrol ediniz!');
		}
		echo $sftp->get("$dosyadizin/$dosyaadi","data/cache/$dosyaadi.sftp");
	}
	
	public static function up_file($dosyadizin,$dosyaadi) 
	{
		$sftp = new Net_SFTP(GAME_DB_HOST);
		if (!$sftp->login('root', GAME_SSH_PASS)) {
			exit('SFTP Bağlantısı başarısız, şifre hatalı olabilir lütfen kontrol ediniz!');
		}
		echo $sftp->put("$dosyadizin/$dosyaadi","data/cache/$dosyaadi.sftp", NET_SFTP_LOCAL_FILE);
	}
	
	public static function down_backup($dosyadizin,$dosyaadi) 
	{
		$sftp = new Net_SFTP(GAME_DB_HOST);
		if (!$sftp->login('root', GAME_SSH_PASS)) {
			exit('SFTP Bağlantısı başarısız, şifre hatalı olabilir lütfen kontrol ediniz!');
		}
		echo $sftp->get("$dosyadizin/$dosyaadi.tar.gz","data/backup/$dosyaadi.tar.gz");
	}
}