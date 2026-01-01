<?php
/**
 * Created by PhpStorm.
 * User: m2-di
 * Date: 2.03.2017
 * Time: 03:10
 */

use Model\IN_Model;

class RankedModel extends IN_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function rankeds()
	{
		$plimit = \StaticDatabase\StaticDatabase::settings('player_rank');
		$glimit = \StaticDatabase\StaticDatabase::settings('guild_rank');
		if (Cache::check('players_android')) 
		{
			$data['player'] = $this->gdb->sql("SELECT player.id,player.name,player.job,player.level,player.playtime,player.last_play,player_index.empire,guild.name AS guild_name
                FROM ".PLAYER_DB_NAME.".player 
                LEFT JOIN ".PLAYER_DB_NAME.".player_index ON ".PLAYER_DB_NAME.".player.account_id = ".PLAYER_DB_NAME.".player_index.id 
                LEFT JOIN ".PLAYER_DB_NAME.".guild_member ON guild_member.pid=player.id 
                LEFT JOIN ".PLAYER_DB_NAME.".guild ON guild.id=guild_member.guild_id
                LEFT JOIN ".ACCOUNT_DB_NAME.".account ON account.id=player.account_id
                WHERE ".PLAYER_DB_NAME.".player.`name` NOT LIKE '[%]%' ORDER BY ".PLAYER_DB_NAME.".player.`level` DESC,".PLAYER_DB_NAME.".player.playtime DESC,".PLAYER_DB_NAME.".player.exp DESC LIMIT 0,$plimit");		
		}
		if (Cache::check('guilds_android')) 
		{
			$data['guild'] = $this->gdb->sql("SELECT ".PLAYER_DB_NAME.".guild.`name` as lonca,".PLAYER_DB_NAME.".guild.win,".PLAYER_DB_NAME.".guild.draw,".PLAYER_DB_NAME.".guild.loss,".PLAYER_DB_NAME.".guild.ladder_point,".PLAYER_DB_NAME.".player.`name` as baskan,".PLAYER_DB_NAME.".player_index.empire as bayrak FROM ".PLAYER_DB_NAME.".guild LEFT JOIN ".PLAYER_DB_NAME.".player ON ".PLAYER_DB_NAME.".guild.`master` = ".PLAYER_DB_NAME.".player.id LEFT JOIN ".PLAYER_DB_NAME.".player_index ON ".PLAYER_DB_NAME.".player.account_id = ".PLAYER_DB_NAME.".player_index.id ORDER BY ".PLAYER_DB_NAME.".guild.ladder_point DESC LIMIT 0,$glimit");
		}
		
		$data['empty'] = "Empty";
		return $data;
	}
}