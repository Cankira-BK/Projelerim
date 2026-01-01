<?php
 
use Model\IN_Model;
class IndexModel extends IN_Model
{
	public function dashboard()
	{
		Functions::scanCSX();
		
		if (!function_exists('cal_days_in_month'))
		{
			if (!defined('CAL_GREGORIAN'))
				define('CAL_GREGORIAN', 1);
			function cal_days_in_month($calendar, $month, $year)
			{
				return date('t', mktime(0, 0, 0, $month, 1, $year));
			}
		}

		$yilveay = date("Y-m");
		$gunver = cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));;

		if (Cache::check('admin_player_statistic')) {
			//Player Count Statistic
			$getCount['totalAccount'] = $this->gdb->sql("SELECT COUNT(id) as count FROM ".ACCOUNT_DB_NAME.".account")[0];
			$getCount['countActive'] = $this->gdb->sql("SELECT COUNT(id) as count FROM ".ACCOUNT_DB_NAME.".account WHERE status='OK' ")[0];
			$getCount['countBanned'] = $this->gdb->sql("SELECT COUNT(id) as count FROM ".ACCOUNT_DB_NAME.".account WHERE status!='OK' ")[0];
			$getCount['countBannedHwid'] = $this->gdb->sql("SELECT COUNT(hwid) as count FROM ".ACCOUNT_DB_NAME.".".SECURITYPCTABLE2."")[0];
			$getCount['countCharacter'] = $this->gdb->sql("SELECT COUNT(id) as count FROM ".PLAYER_DB_NAME.".player")[0];
			$getCount['countOfflineShop'] = Statistics::offlineShop();
			$getCount['countToday'] = $this->gdb->sql("SELECT COUNT(id) as count FROM ".ACCOUNT_DB_NAME.".account WHERE create_time LIKE '%" . date("Y-m-d") . "%'  ")[0];
			$getCount['countTodayLogin'] = $this->gdb->sql("SELECT COUNT(id) as count FROM ".PLAYER_DB_NAME.".player WHERE last_play LIKE '%" . date("Y-m-d") . "%' ")[0];
			$getCount['countGuild'] = $this->gdb->sql("SELECT COUNT(id) as count FROM ".PLAYER_DB_NAME.".guild")[0];
		}
		
		$getCount['countOnlinePlayer'] = $this->gdb->sql("SELECT COUNT(id) as count FROM ".PLAYER_DB_NAME.".player WHERE DATE_SUB(NOW(), INTERVAL 60 MINUTE) < last_play;")[0];
		
		//Player Diagram Statistic
		$getCount['countRed'] = $this->gdb->sql("SELECT COUNT(".PLAYER_DB_NAME.".player.id) as count FROM ".PLAYER_DB_NAME.".player INNER JOIN ".PLAYER_DB_NAME.".player_index ON ".PLAYER_DB_NAME.".player.account_id = ".PLAYER_DB_NAME.".player_index.id WHERE ".PLAYER_DB_NAME.".player_index.empire=1")[0];
		$getCount['countYellow'] = $this->gdb->sql("SELECT COUNT(".PLAYER_DB_NAME.".player.id) as count FROM ".PLAYER_DB_NAME.".player INNER JOIN ".PLAYER_DB_NAME.".player_index ON ".PLAYER_DB_NAME.".player.account_id = ".PLAYER_DB_NAME.".player_index.id WHERE ".PLAYER_DB_NAME.".player_index.empire=2")[0];
		$getCount['countBlue'] = $this->gdb->sql("SELECT COUNT(".PLAYER_DB_NAME.".player.id) as count FROM ".PLAYER_DB_NAME.".player INNER JOIN ".PLAYER_DB_NAME.".player_index ON ".PLAYER_DB_NAME.".player.account_id = ".PLAYER_DB_NAME.".player_index.id WHERE ".PLAYER_DB_NAME.".player_index.empire=3")[0];

		//Flag Diagram Statistic
		$getCount['countWarrior'] = $this->gdb->sql("SELECT COUNT(".PLAYER_DB_NAME.".player.id) as count FROM ".PLAYER_DB_NAME.".player WHERE ".PLAYER_DB_NAME.".player.job = 0 OR ".PLAYER_DB_NAME.".player.job = 4")[0];
		$getCount['countNinja'] = $this->gdb->sql("SELECT COUNT(".PLAYER_DB_NAME.".player.id) as count FROM ".PLAYER_DB_NAME.".player WHERE ".PLAYER_DB_NAME.".player.job = 1 OR ".PLAYER_DB_NAME.".player.job = 5")[0];
		$getCount['countSura'] = $this->gdb->sql("SELECT COUNT(".PLAYER_DB_NAME.".player.id) as count FROM ".PLAYER_DB_NAME.".player WHERE ".PLAYER_DB_NAME.".player.job = 2 OR ".PLAYER_DB_NAME.".player.job = 6")[0];
		$getCount['countShaman'] = $this->gdb->sql("SELECT COUNT(".PLAYER_DB_NAME.".player.id) as count FROM ".PLAYER_DB_NAME.".player WHERE ".PLAYER_DB_NAME.".player.job = 3 OR ".PLAYER_DB_NAME.".player.job = 7")[0];
		$getCount['countLycan'] = $this->gdb->sql("SELECT COUNT(".PLAYER_DB_NAME.".player.id) as count FROM ".PLAYER_DB_NAME.".player WHERE ".PLAYER_DB_NAME.".player.job = 8")[0];

		//Game BootLog
		$getCount['coreLog'] = $this->gdb->sql("SELECT * FROM ".LOG_DB_NAME.".bootlog ORDER BY time DESC LIMIT 10");
		$getCount['commandLog'] = $this->gdb->sql("SELECT userid,ip,port,username,command,date FROM ".LOG_DB_NAME.".command_log ORDER BY date DESC LIMIT 10");

		//Gain Statistic
		$getCount['countPaywant'] = $this->db->sql("SELECT SUM(NetKazanc) AS gain FROM api_paywant WHERE DATE(`Tarih`) = CURDATE()")[0]['gain'];
		$getCount['countKasaGame'] = $this->db->sql("SELECT SUM(Fiyat) AS gain FROM api_kasagame WHERE Durum ='OK' AND DATE(`Tarih`) = CURDATE()")[0]['gain'];
		$getCount['countPayreks'] = $this->db->sql("SELECT SUM(net_price) AS gain FROM payreks_log WHERE DATE(`date_time`) = CURDATE()")[0]['gain'];
		$getCount['countEpin'] = $this->db->sql("SELECT ep AS gain FROM kuponlar WHERE DATE(`use_date`) = CURDATE() AND `status` = ?",['1']);
		
		$getCount['epPrice'] = $this->db->sql("SELECT * FROM ep_price");
		$getCount['ItemciPrice'] = $this->db->sql("SELECT * FROM itemci_price");
		
		$getCount['getMonthPaywant'] = $this->db->sql("SELECT SUM(NetKazanc) AS gain FROM api_paywant WHERE Tarih BETWEEN '".$yilveay."-01 00:00:00' AND '".$yilveay."-".$gunver." 23:59:59'")[0]['gain'];
		$getCount['getMonthKasaGame'] = $this->db->sql("SELECT SUM(Fiyat) AS gain FROM api_kasagame WHERE Durum ='OK' AND Tarih BETWEEN '".$yilveay."-01 00:00:00' AND '".$yilveay."-".$gunver." 23:59:59'")[0]['gain'];
		$getCount['getMonthPayreks'] = $this->db->sql("SELECT SUM(net_price) AS gain FROM payreks_log WHERE date_time BETWEEN '".$yilveay."-01 00:00:00' AND '".$yilveay."-".$gunver." 23:59:59'")[0]['gain'];
		$getCount['getMonthEpin'] = $this->db->sql("SELECT ep AS gain FROM kuponlar WHERE `status` = 1 AND use_date BETWEEN '".$yilveay."-01 00:00:00' AND '".$yilveay."-".$gunver." 23:59:59'");
		
		$getCount['getTotalPaywant'] = $this->db->sql("SELECT SUM(NetKazanc) AS gain FROM api_paywant")[0]['gain'];
		$getCount['getTotalKasaGame'] = $this->db->sql("SELECT SUM(Fiyat) AS gain FROM api_kasagame WHERE Durum ='OK'")[0]['gain'];
		$getCount['getTotalPayreks'] = $this->db->sql("SELECT SUM(net_price) AS gain FROM payreks_log")[0]['gain'];
		$getCount['getTotalEpin'] = $this->db->sql("SELECT ep AS gain FROM kuponlar WHERE `status` = 1");

		return $getCount;
	}
}