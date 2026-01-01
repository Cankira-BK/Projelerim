<?php
class Statistics
{
	/**
	 * @return mixed
	 */
	public static function online()
	{
		$getOnline = \StaticGame\StaticGame::sql("SELECT COUNT(*) as count FROM ".PLAYER_DB_NAME.".player WHERE DATE_SUB(NOW(), INTERVAL 60 MINUTE) < last_play;");
		return $getOnline[0];
	}

	/**
	 * @return mixed
	 */
	public static function player()
	{
		$getPlayer = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM ".PLAYER_DB_NAME.".player");
		return $getPlayer[0];
	}

	/**
	 * @return mixed
	 */
	public static function account()
	{
		$getAccount = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM ".ACCOUNT_DB_NAME.".account WHERE status = ?",['OK']);
		return $getAccount[0];
	}

	/**
	 * @return mixed
	 */
	public static function todayLogin()
	{
		$getTodayLogin = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM ".PLAYER_DB_NAME.".player WHERE last_play LIKE '%" . date("Y-m-d") . "%'");
		return $getTodayLogin[0];
	}

	/**
	 * @return array
	 */
	public static function offlineShop()
	{
		$offlineShopNpc = \StaticDatabase\StaticDatabase::settings('offline_shop_npc');
		$getOfflineShopColumns = \StaticGame\StaticGame::sql("SHOW COLUMNS FROM ".PLAYER_DB_NAME.".$offlineShopNpc");

		if (count($getOfflineShopColumns) <= 0)
			return ["count"=>0];
		else
		{
			$firstColumn = $getOfflineShopColumns[0]['Field'];
			$getOfflineShop = \StaticGame\StaticGame::sql("SELECT COUNT(`$firstColumn`) as count FROM ".PLAYER_DB_NAME.".$offlineShopNpc");
			return $getOfflineShop[0];
		}
	}

	/**
	 * @param int $limit
	 * @return array|bool
	 */
	public static function topPlayer($limit = 5)
	{
		$getTopPlayer = \StaticGame\StaticGame::sql("SELECT player.name,player.level,player.job FROM ".PLAYER_DB_NAME.".player WHERE ".PLAYER_DB_NAME.".player.`name` NOT LIKE ? ORDER BY ".PLAYER_DB_NAME.".player.`level` DESC, ".PLAYER_DB_NAME.".player.playtime DESC, ".PLAYER_DB_NAME.".player.exp DESC LIMIT 0,$limit",["[%]%"]);
		return $getTopPlayer;
	}

	public static function topGuild($limit = 5)
	{
		$getTopGuild = \StaticGame\StaticGame::sql("SELECT * FROM ".PLAYER_DB_NAME.".guild ORDER BY ladder_point DESC LIMIT 0,$limit");
		return $getTopGuild;
	}
	
	public static function getCashAndMileage($accountID)
	{
		$getCashAndMileage = \StaticGame\StaticGame::sql("SELECT ".CASH.",".MILEAGE." FROM ".ACCOUNT_DB_NAME.".account WHERE id = ?",[$accountID]);
		return $getCashAndMileage[0];
	}
}