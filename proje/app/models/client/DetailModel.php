<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 2.03.2017
     * Time: 14:47
     */
    use Model\IN_Model;

    class DetailModel extends IN_Model
    {
        public function player($arg)
        {
            $playerName = filter_var($arg,FILTER_SANITIZE_STRING);
            if ($playerName == false){
                return false;
            }else{
                $control = $this->gdb->select('id')->table(''.PLAYER_DB_NAME.'.player')->where(array('name'=>$arg))->count();
                if ($control <= 0){
                    return false;
                }elseif ($control > 0){
                	if (Cache::check($arg."_player")){
						return $this->gdb->sql("SELECT guild.`name` as lonca,player.`name`,player.playtime,player.last_play,player_index.empire,player.`level`,player.map_index,player.exp,player.skill_group,player.job
FROM ".PLAYER_DB_NAME.".player 
LEFT JOIN ".PLAYER_DB_NAME.".guild_member ON guild_member.pid = player.id 
LEFT JOIN ".PLAYER_DB_NAME.".guild ON guild.id = guild_member.guild_id
INNER JOIN ".PLAYER_DB_NAME.".player_index ON player_index.id = player.account_id
WHERE player.`name` = ?",[$arg])[0];
					}else
						return $this->gdb->sql("SELECT player.`name` FROM ".PLAYER_DB_NAME.".player WHERE player.`name` = ?",[$arg])[0];
                }
            }
        }
        public function guild($arg)
        {
            $guildName = filter_var($arg,FILTER_SANITIZE_STRING);
            if ($guildName == false){
                return false;
            }else{
                $control = $this->gdb->select('id')->table(''.PLAYER_DB_NAME.'.guild')->where(array('name'=>$guildName))->count();
                if ($control <= 0){
                    return false;
                }elseif($control > 0){
                	if (Cache::check($arg."_guild"))
                	{
						$sth =  $this->gdb->sql("SELECT ".PLAYER_DB_NAME.".guild.id,".PLAYER_DB_NAME.".guild.`name`,".PLAYER_DB_NAME.".guild.`level`,".PLAYER_DB_NAME.".guild.ladder_point,".PLAYER_DB_NAME.".guild.exp,".PLAYER_DB_NAME.".player_index.empire,".PLAYER_DB_NAME.".player.`name` as baskan,".PLAYER_DB_NAME.".guild.win,".PLAYER_DB_NAME.".guild.draw,".PLAYER_DB_NAME.".guild.loss,".PLAYER_DB_NAME.".player.job,".PLAYER_DB_NAME.".player.`level` as seviye 
FROM ".PLAYER_DB_NAME.".guild
LEFT JOIN ".PLAYER_DB_NAME.".player_index ON ".PLAYER_DB_NAME.".player_index.pid1 = ".PLAYER_DB_NAME.".guild.`master` 
OR ".PLAYER_DB_NAME.".player_index.pid2 = ".PLAYER_DB_NAME.".guild.`master`
OR ".PLAYER_DB_NAME.".player_index.pid3 = ".PLAYER_DB_NAME.".guild.`master`
OR ".PLAYER_DB_NAME.".player_index.pid4 = ".PLAYER_DB_NAME.".guild.`master`
OR ".PLAYER_DB_NAME.".player_index.pid4 = ".PLAYER_DB_NAME.".guild.`master`
LEFT JOIN ".PLAYER_DB_NAME.".player ON ".PLAYER_DB_NAME.".player.id = ".PLAYER_DB_NAME.".guild.`master`
WHERE ".PLAYER_DB_NAME.".guild.`name` = ?",[$guildName]);
						$result["info"] = ($sth[0]);
						$guildId = $result['info']['id'];
						$getRes2 = $this->gdb->select('pid')->table(''.PLAYER_DB_NAME.'.guild_member')->where(array('guild_id'=>$guildId))->count();
						$result['count'] = $getRes2;
					}
					else
					{
						$result["info"] =  $this->gdb->sql("SELECT ".PLAYER_DB_NAME.".guild.id,".PLAYER_DB_NAME.".guild.`name` FROM ".PLAYER_DB_NAME.".guild WHERE ".PLAYER_DB_NAME.".guild.`name` = ?",[$guildName])[0];
					}
                    return $result;
                }
            }
        }
    }