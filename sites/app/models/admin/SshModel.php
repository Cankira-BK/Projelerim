<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4.02.2017
 * Time: 21:29
 */
use Model\IN_Model;
class SshModel extends IN_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function offshopconfig()
	{
		$maxpazar 		= $_POST['maxpazar'];
		$oneprice 		= $_POST['oneprice'];
		$twoprice 		= $_POST['twoprice'];
		$threeprice 	= $_POST['threeprice'];
		$fourprice 		= $_POST['fourprice'];

		if ($maxpazar == '' || $oneprice == '' || $twoprice == '' || $threeprice == '' || $fourprice == '')
			URI::redirect('ssh/offshop_config');

		SSHConnect::fileWriteSFTP("data/cache/OFFLINE_SHOP_CONFIG.sftp","OFFLINE_SAVE_TIME: 5
OFFLINE_SHOP_RESPAWN: 1
OFFLINE_SHOP_NEED_ITEM: disable 1 50200
OFFLINE_SHOP_TOTAL_COUNT: $maxpazar
ENABLE_OFFLINE_SHOP_SYSTEM: 1
ENABLE_OFFLINE_SHOP_MAP_ALLOW_LIMIT: enable
OFFLINE_SHOP_MAP_ALLOW: 1 21 41
OFFLINE_SHOP_SOCKET_MAX: 4
MIN_LEVEL: enable 1
COINS_FOR_UNLIMITED: 5
EMPIRE_LIMIT: 1
OFFLINE_SHOP_NEED_MONEY: 1 $oneprice
OFFLINESHOP_ONE_PRICE: $oneprice
OFFLINESHOP_TWO_PRICE: $twoprice
OFFLINESHOP_THREE_PRICE: $threeprice
OFFLINESHOP_FOUR_PRICE: $fourprice
","w+");
		SSHConnect::up_file("/usr/game/config","OFFLINE_SHOP_CONFIG");

		URI::redirect('ssh/offshop_config');
	}
	public function systemconfig()
	{
		$baslangiclevel = $_POST['baslangiclevel'];
		$maxlevel 		= $_POST['maxlevel'];
		$maxstatu 		= $_POST['maxstatu'];
		$baslangicskill = $_POST['baslangicskill'];
		$tasorani 		= $_POST['tasorani'];
		$minbagirma 	= $_POST['minbagirma'];
		$metintas 		= $_POST['metintas'];
		$marketurl 		= $_POST['marketurl'];
		$olumbuff 		= $_POST['olumbuff'];
		$evrimsistem 	= $_POST['evrimsistem'];
		$biyolog	 	= $_POST['biyolog'];
		$mana 			= $_POST['mana'];
		$offshop 		= $_POST['offshop'];
		$kenvanter 		= $_POST['kenvanter'];
		$kemer 			= $_POST['kemer'];
		$aura 			= $_POST['aura'];
		$pet 			= $_POST['pet'];
		$simya 			= $_POST['simya'];

		if ($baslangiclevel == '' || $maxlevel == '' || $maxstatu == '' || $baslangicskill == '' || $tasorani == '' || $minbagirma == '' || $metintas == '' || $marketurl == '' || $olumbuff == '' || $evrimsistem == '' || $biyolog == '' || $mana == '' || $offshop == '' || $kenvanter == '' || $kemer == '' || $aura == '' || $pet == '' || $simya == '')
			URI::redirect('ssh/system_config');

		SSHConnect::fileWriteSFTP("data/cache/SYSTEM_CONFIG.sftp","MIN_LEVEL: $baslangiclevel
MAX_LEVEL: $maxlevel
STATU_SINIRI: $maxstatu
BECERI_TAHTASI: $baslangicskill
TAS_EKLEME_ORANI: $tasorani
BAGIRMA_LEVELI_MIN: $minbagirma
METINDEN_04_TAS_DUSME: $metintas

MALL_URL: $marketurl

OLUNCE_BUFF_GITMESIN: $olumbuff
EVRIM_SISTEMI_DURUMU: $evrimsistem
BIYOLOG_BEKLEME: $biyolog
SINIRSIZ_MANA: $mana

OFFLINESHOP_DURUMU: $offshop
K_ENVANTER_DURUMU: $kenvanter
KEMER_DURUMU: $kemer
AURA_DURUMU: $aura
PET_DURUMU: $pet
SIMYA_DURUMU: $simya

MYSQL_OFFLINESHOP_LOG: 0
MYSQL_MARKETEP_LOG: 0
MYSQL_ITEM_LOG: 0
MYSQL_CHAR_LOG: 0
MYSQL_ACCE_LOG: 0
MYSQL_HACK_LOG: 0
MYSQL_CUBE_LOG: 0
MYSQL_GRUP_LOG: 0
MYSQL_BOOT_LOG: 0
MYSQL_FISH_LOG: 0
MYSQL_LOGIN_LOG: 0
MYSQL_SHOUT_LOG: 0
MYSQL_GUILD_LOG: 0
MYSQL_LEVEL_LOG: 0
MYSQL_MONEY_LOG: 0
MYSQL_VCARD_LOG: 0
MYSQL_REFINE_LOG: 0
MYSQL_WHISPER_LOG: 0
MYSQL_GOLDBAR_LOG: 0
MYSQL_HACKCRC_LOG: 0
MYSQL_SPEEDHACK_LOG: 0
MYSQL_CHANGENAME_LOG: 0
MYSQL_HACKSHIELD_LOG: 0
MYSQL_QUESTREWARD_LOG: 0
MYSQL_DETAILLOGIN_LOG: 0
MYSQL_PCBANGLOGIN_LOG: 0
","w+");
		SSHConnect::up_file("/usr/game/config","SYSTEM_CONFIG");

		URI::redirect('ssh/system_config');
	}
	public function notxt()
	{
		$notxt 		= $_POST['notxt'];
		$leveldel 	= $_POST['leveldel'];

		if ($notxt == '' || $leveldel == '')
			URI::redirect('ssh/notxt');

		SSHConnect::fileWriteSFTP("data/cache/conf.txt.sftp",'WELCOME_MSG = "DB Server aciliyor..."

SQL_ACCOUNT = "localhost account oyun sQq8ZuqJzb2M 0"
SQL_COMMON = "localhost common oyun sQq8ZuqJzb2M 0"
SQL_HOTBACKUP = "localhost hotbackup oyun sQq8ZuqJzb2M 0"
SQL_PLAYER = "localhost player oyun sQq8ZuqJzb2M 0"

TABLE_POSTFIX = " "

BIND_PORT               = 11055
DB_SLEEP_MSEC           = 10
CLIENT_HEART_FPS        = 10
HASH_PLAYER_LIFE_SEC    = 600
BACKUP_LIMIT_SEC        = 3600
PLAYER_ID_START = 1
PLAYER_DELETE_LEVEL_LIMIT_LOWER = 1
PLAYER_DELETE_LEVEL_LIMIT = '.$leveldel.'
GUILDWAR_TIME_DIVISOR = 300
DISABLE_HOTBACKUP = 1

ITEM_ID_RANGE = 10000001 1000000000

Block "Y/QSB7omi36awq4ctpUxuiwRARM="

TEST_SERVER = 0
NO_TXT = '.$notxt.'
',"w+");
		SSHConnect::up_file("/usr/game/config","conf.txt");

		URI::redirect('ssh/notxt');
	}
	
	public function server_commands()
	{
		switch ($_POST['action'])
		{
			case 'start1':
				SSHConnect::start_ch1_server();
				URI::redirect('ssh/server');
				break;
			
			case 'start2':
				SSHConnect::start_ch2_server();
				URI::redirect('ssh/server');
				break;
			
			case 'start3':
				SSHConnect::start_ch3_server();
				URI::redirect('ssh/server');
				break;
			
			case 'start4':
				SSHConnect::start_ch4_server();
				URI::redirect('ssh/server');
				break;

			case 'stopauth':
				SSHConnect::stop_auth_server();
				URI::redirect('ssh/server');
				break;

			case 'stopch':
				SSHConnect::stop_game_server();
				URI::redirect('ssh/server');
				break;
				
			case 'stopdb':
				SSHConnect::stop_db_server();
				URI::redirect('ssh/server');
				break;

			case 'reboot':
				SSHConnect::reboot_server();
				break;
		}
	}
	
	public function locale_string()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/locale_string');

		SSHConnect::fileWriteSFTPTranslate("data/cache/locale_string.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey","locale_string.txt");

		URI::redirect('ssh/locale_string');
	}
	public function mob_drop_item()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/mob_drop_item');

		SSHConnect::fileWriteSFTP("data/cache/mob_drop_item.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey","mob_drop_item.txt");
		sleep(1);
		Functions::sendServer("m","RELOAD");

		URI::redirect('ssh/mob_drop_item');
	}
	public function special_item_group()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/special_item_group');

		SSHConnect::fileWriteSFTP("data/cache/special_item_group.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey","special_item_group.txt");
		sleep(1);
		Functions::sendServer("s","RELOAD");

		URI::redirect('ssh/special_item_group');
	}
	public function blend()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/blend');

		SSHConnect::fileWriteSFTPTranslate("data/cache/blend.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey","blend.txt");

		URI::redirect('ssh/blend');
	}
	public function cube()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/cube');

		SSHConnect::fileWriteSFTPTranslate("data/cache/cube.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey","cube.txt");

		URI::redirect('ssh/cube');
	}
	public function dragon_soul_table()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/dragon_soul_table');

		SSHConnect::fileWriteSFTPTranslate("data/cache/dragon_soul_table.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey","dragon_soul_table.txt");

		URI::redirect('ssh/dragon_soul_table');
	}
	public function red1_npc()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/red1_npc');

		SSHConnect::fileWriteSFTPTranslate("data/cache/npc.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_a1","npc.txt");

		URI::redirect('ssh/red1_npc');
	}
	public function red1_regen()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/red1_regen');

		SSHConnect::fileWriteSFTPTranslate("data/cache/regen.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_a1","regen.txt");

		URI::redirect('ssh/red1_regen');
	}
	public function red1_boss()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/red1_boss');

		SSHConnect::fileWriteSFTPTranslate("data/cache/boss.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_a1","boss.txt");

		URI::redirect('ssh/red1_boss');
	}
	public function red1_stone()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/red1_stone');

		SSHConnect::fileWriteSFTPTranslate("data/cache/stone.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_a1","stone.txt");

		URI::redirect('ssh/red1_stone');
	}
	public function red2_npc()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/red2_npc');

		SSHConnect::fileWriteSFTPTranslate("data/cache/npc.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_a3","npc.txt");

		URI::redirect('ssh/red2_npc');
	}
	public function red2_regen()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/red2_regen');

		SSHConnect::fileWriteSFTPTranslate("data/cache/regen.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_a3","regen.txt");

		URI::redirect('ssh/red2_regen');
	}
	public function red2_boss()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/red2_boss');

		SSHConnect::fileWriteSFTPTranslate("data/cache/boss.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_a3","boss.txt");

		URI::redirect('ssh/red2_boss');
	}
	public function red2_stone()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/red2_stone');

		SSHConnect::fileWriteSFTPTranslate("data/cache/stone.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_a3","stone.txt");

		URI::redirect('ssh/red2_stone');
	}
	public function yellow1_npc()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/yellow1_npc');

		SSHConnect::fileWriteSFTPTranslate("data/cache/npc.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_b1","npc.txt");

		URI::redirect('ssh/yellow1_npc');
	}
	public function yellow1_regen()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/yellow1_regen');

		SSHConnect::fileWriteSFTPTranslate("data/cache/regen.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_b1","regen.txt");

		URI::redirect('ssh/yellow1_regen');
	}
	public function yellow1_boss()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/yellow1_boss');

		SSHConnect::fileWriteSFTPTranslate("data/cache/boss.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_b1","boss.txt");

		URI::redirect('ssh/yellow1_boss');
	}
	public function yellow1_stone()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/yellow1_stone');

		SSHConnect::fileWriteSFTPTranslate("data/cache/stone.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_b1","stone.txt");

		URI::redirect('ssh/yellow1_stone');
	}
	public function yellow2_npc()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/yellow2_npc');

		SSHConnect::fileWriteSFTPTranslate("data/cache/npc.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_b3","npc.txt");

		URI::redirect('ssh/yellow2_npc');
	}
	public function yellow2_regen()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/yellow2_regen');

		SSHConnect::fileWriteSFTPTranslate("data/cache/regen.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_b3","regen.txt");

		URI::redirect('ssh/yellow2_regen');
	}
	public function yellow2_boss()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/yellow2_boss');

		SSHConnect::fileWriteSFTPTranslate("data/cache/boss.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_b3","boss.txt");

		URI::redirect('ssh/yellow2_boss');
	}
	public function yellow2_stone()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/yellow2_stone');

		SSHConnect::fileWriteSFTPTranslate("data/cache/stone.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_b3","stone.txt");

		URI::redirect('ssh/yellow2_stone');
	}
	public function blue1_npc()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/blue1_npc');

		SSHConnect::fileWriteSFTPTranslate("data/cache/npc.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_c1","npc.txt");

		URI::redirect('ssh/blue1_npc');
	}
	public function blue1_regen()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/blue1_regen');

		SSHConnect::fileWriteSFTPTranslate("data/cache/regen.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_c1","regen.txt");

		URI::redirect('ssh/blue1_regen');
	}
	public function blue1_boss()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/blue1_boss');

		SSHConnect::fileWriteSFTPTranslate("data/cache/boss.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_c1","boss.txt");

		URI::redirect('ssh/blue1_boss');
	}
	public function blue1_stone()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/blue1_stone');

		SSHConnect::fileWriteSFTPTranslate("data/cache/stone.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_c1","stone.txt");

		URI::redirect('ssh/blue1_stone');
	}
	public function blue2_npc()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/blue2_npc');

		SSHConnect::fileWriteSFTPTranslate("data/cache/npc.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_c3","npc.txt");

		URI::redirect('ssh/blue2_npc');
	}
	public function blue2_regen()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/blue2_regen');

		SSHConnect::fileWriteSFTPTranslate("data/cache/regen.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_c3","regen.txt");

		URI::redirect('ssh/blue2_regen');
	}
	public function blue2_boss()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/blue2_boss');

		SSHConnect::fileWriteSFTPTranslate("data/cache/boss.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_c3","boss.txt");

		URI::redirect('ssh/blue2_boss');
	}
	public function blue2_stone()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/blue2_stone');

		SSHConnect::fileWriteSFTPTranslate("data/cache/stone.txt.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/map/metin2_map_c3","stone.txt");

		URI::redirect('ssh/blue2_stone');
	}
	public function dungeonlib()
	{
		$icerik = $_POST['icerik'];

		if ($icerik == '')
			URI::redirect('ssh/dungeonlib');

		SSHConnect::fileWriteSFTPTranslate("data/cache/dungeonLib.lua.sftp",$icerik,"w+");
		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/quest","dungeonLib.lua");

		URI::redirect('ssh/dungeonlib');
	}
	public function startquest()
	{
		$derece 		= $_POST['derece'];
		$blevel 		= $_POST['blevel'];
		$bparam 		= $_POST['bparam'];
		$alevel 		= $_POST['alevel'];
		$esya_durum 	= $_POST['esya_durum'];
		$efsun_durum 	= $_POST['efsun_durum'];
		$adet 			= $_POST['adet'];

		if ($derece == '' || $blevel == '' || $bparam == '' || $alevel == '' || $esya_durum == '' || $efsun_durum == '' || $_POST["item1"] == '' || $_POST["item2"] == '' || $_POST["item3"] == '' || $_POST["item4"] == '' || $_POST["item5"] == '' || $adet == '')
		{
			Session::set('cError', 'hata');
			URI::redirect('ssh/startquest');
			return false;
		}
		
		$savas = explode(",",$_POST["item1"]);
		$say1 = count($savas);
		$ninja = explode(",",$_POST["item2"]);
		$say2 = count($ninja);
		$sura = explode(",",$_POST["item3"]);
		$say3 = count($sura);
		$saman = explode(",",$_POST["item4"]);
		$say4 = count($saman);
		$ortak = explode(",",$_POST["item5"]);
		$say5 = count($ortak);
		$ozel = explode(",",$_POST["item6"]);
		$say6 = count($ozel);
		
		$dosya = "data/cache/baslangic_ayari.sftp";
		unlink("$dosya");
		$dosyaislem = fopen("$dosya","a");
		
		$baslangic1 = "quest give_basic_weapon begin
	state start begin
		when login with pc.getqf(\"yeni_basladim \") == 0 begin
			at_seviyesi = $alevel
			baslangic_parasi = $bparam
			pc.set_level($blevel)
			pc.changealignment($derece)
			pc.reset_point()";
			fwrite($dosyaislem,$baslangic1);
			if ($esya_durum == 1){
				$savasci1 ="
				if pc.get_job() == 0 then ";
				fwrite($dosyaislem,$savasci1);
				for($sab1 = 0;$sab1 < $say1;$sab1++)
				{
					fwrite($dosyaislem,"
					pc.give_and_equip_item(".$savas[$sab1].",1)");
				}
				$ninja1 ="
				elseif pc.get_job() == 1 then ";
				fwrite($dosyaislem,$ninja1);
				for($sab2 = 0;$sab2 < $say2;$sab2++)
				{
					fwrite($dosyaislem,"
					pc.give_and_equip_item(".$ninja[$sab2].",1)");
				}
				$sura1 ="
				elseif pc.get_job() == 2 then ";
				fwrite($dosyaislem,$sura1);
				for($sab3 = 0;$sab3 < $say3;$sab3++)
				{
					fwrite($dosyaislem,"
					pc.give_and_equip_item(".$sura[$sab3].",1)");
				}
				$saman1 ="
				elseif pc.get_job() == 3 then ";
				fwrite($dosyaislem,$saman1);
				for($sab4 = 0;$sab4 < $say4;$sab4++)
				{
					fwrite($dosyaislem,"
					pc.give_and_equip_item(".$saman[$sab4].",1)");
				}
				$esyabitti = "
				end ";
				fwrite($dosyaislem,$esyabitti);
			}
			else {
				$savasci1 ="
				if pc.get_job() == 0 then ";
				fwrite($dosyaislem,$savasci1);
				for($sab1 = 0;$sab1 < $say1;$sab1++)
				{
					fwrite($dosyaislem,"
					pc.give_item2(".$savas[$sab1].",1)");
				}
				$ninja1 ="
				elseif pc.get_job() == 1 then ";
				fwrite($dosyaislem,$ninja1);
				for($sab2 = 0;$sab2 < $say2;$sab2++)
				{
					fwrite($dosyaislem,"
					pc.give_item2(".$ninja[$sab2].",1)");
				}
				$sura1 ="
				elseif pc.get_job() == 2 then ";
				fwrite($dosyaislem,$sura1);
				for($sab3 = 0;$sab3 < $say3;$sab3++)
				{
					fwrite($dosyaislem,"
					pc.give_item2(".$sura[$sab3].",1)");
				}
				$saman1 ="
				elseif pc.get_job() == 3 then ";
				fwrite($dosyaislem,$saman1);
				for($sab4 = 0;$sab4 < $say4;$sab4++)
				{
					fwrite($dosyaislem,"
					pc.give_item2(".$saman[$sab4].",1)");
				}
				$esyabitti = "
				end ";
				fwrite($dosyaislem,$esyabitti);
			}
			for($sab5 = 0;$sab5 < $say5;$sab5++)
			{
			fwrite($dosyaislem,"
			pc.give_item2(".$ortak[$sab5].",".$adet.")");
			}
			for($sab6 = 0;$sab6 < $say6;$sab6++)
			{
			fwrite($dosyaislem,"
			pc.give_item2(".$ozel[$sab6].",1)");
			}
			if ($efsun_durum == 1 and $esya_durum == 1)
			{
			$icerik5 = "
			pc.give_eqboni()";
			fwrite($dosyaislem,$icerik5);
			}
			$icerik6 ="
			pc_default_skill_perfect()
			horse.set_level(at_seviyesi) 
			pc.give_gold(baslangic_parasi)  
			notice_all(string.format(\"Yeni oyuncumuz %s, %s karakteri ile %s krallığına katıldı. \", pc.get_name(), pc.get_karakter(), pc.get_empire_name()))
			syschat_acik_mavi_duyuru(\"Oyunumuza kayıt olmuş herkes tüm sözleşmeleri kabul etmiş sayılır. \")
			syschat_acik_mavi_duyuru(\"İleride oluşabilecek tüm sorunlara bu sözleşmelere göre işlem yapılacaktır. \")
			pc.setqf(\"yeni_basladim\",1)
		end
	end
end";

		fwrite($dosyaislem,$icerik6);
		fclose($dosyaislem);

		sleep(1);
		SSHConnect::up_file("/usr/game/share/locale/turkey/quest/Gorevler/Python","give_basic_weapon.lua");
		Session::set('cError', 'basarili');
		SSHConnect::get_commands_hide("cd /usr/game/share/locale/turkey/quest && ./qc Gorevler/Python/give_basic_weapon.lua");
		Functions::sendServer("q","RELOAD");
		URI::redirect('ssh/startquest');
	}
	public function questmake()
	{
		$secim = $_POST['secim'];
		$quest = $_POST['quest'];

		if ($secim == '')
			Session::set('cError', 'hata');
		elseif ($secim == '0')
		{
			if ($quest == '')
			{
				Session::set('cError', 'quest');
				URI::redirect('ssh/questmake');
				return false;
			}
			SSHConnect::get_commands_hide("cd /usr/game/share/locale/turkey/quest && ./qc $quest");
			Functions::sendServer("q","RELOAD");
			Session::set('cError', 'basarili1');
		}
		elseif ($secim == '1')
		{
			SSHConnect::get_commands_hide("cd /usr/game/share/locale/turkey/quest && sh make.sh");
			Functions::sendServer("q","RELOAD");
			Session::set('cError', 'basarili2');
		}

		URI::redirect('ssh/questmake');
	}
	public function questedit()
	{
		$action = $_POST['action'];
		$secim = $_POST['quest'];
		$isinlanma_yuzuk = $_POST['isinlanma_yuzuk'];
		$sebnem_tenturu = $_POST['sebnem_tenturu'];
		$cube = $_POST['cube'];
		$oyun_bilgi = $_POST['oyun_bilgi'];
		$np_sistem = $_POST['np_sistem'];
		if ($action == '1')
		{
			if ($secim == '' || $isinlanma_yuzuk == '' || $sebnem_tenturu == '' || $cube == '' || $oyun_bilgi == '' || $np_sistem == '')
				Session::set('cError', 'hata');
			else
			{
				if ($secim = "isinlanma_yuzuk")
					SSHConnect::fileWriteSFTPTranslate("data/quest/$secim.lua",$isinlanma_yuzuk,"w+");
				elseif ($secim = "sebnem_tenturu")
					SSHConnect::fileWriteSFTPTranslate("data/quest/$secim.lua",$sebnem_tenturu,"w+");
				elseif ($secim = "cube")
					SSHConnect::fileWriteSFTPTranslate("data/quest/$secim.lua",$cube,"w+");
				elseif ($secim = "oyun_bilgi")
					SSHConnect::fileWriteSFTPTranslate("data/quest/$secim.lua",$oyun_bilgi,"w+");
				elseif ($secim = "np_sistem")
					SSHConnect::fileWriteSFTPTranslate("data/quest/$secim.lua",$np_sistem,"w+");

				SSHConnect::up_file("/usr/game/share/locale/turkey/quest","$secim.lua");
				SSHConnect::get_commands_hide("cd /usr/game/share/locale/turkey/quest && ./qc $secim.lua");
				Functions::sendServer("q","RELOAD");
				Session::set('cError', 'basarili');
			}
		}
		else
		{
			$zip = new ZipArchive;
			$res = $zip->open("data/quest/geri_yukle_questlerimi.zip");
			if ($res === TRUE) {
				$zip->extractTo("data/quest/");
				$zip->close();
				Session::set('cError', 'geriyukle');
			} else
				Session::set('cError', 'hata');
		}

		URI::redirect('ssh/questedit');
	}
	public function backup()
	{
		$action = $_POST['action'];
		if ($action == '0')
		{
			$now = date("Y-m-d");
			SSHConnect::get_commands_hide("cd /usr/game && sh temizle.sh");
			sleep(1);
			SSHConnect::get_commands_hide("cd /usr && tar cvzf game_$now.tar.gz game");
			sleep(2);
			SSHConnect::get_commands_hide("cd /var/db && tar cvzf db_$now.tar.gz mysql");
			Session::set('cError', 'yedek1');
			URI::redirect('ssh/backup');
		}
		else if ($action == '1')
		{
			$now = date("Y-m-d");
			SSHConnect::down_backup("/usr","game_$now");
			sleep(3);
			SSHConnect::down_backup("/var/db","db_$now");
			sleep(2);
			$zipName = "data/backup/game-mysql_$now-yedek.zip";
			$zip = new ZipArchive;
			$zipCreate = $zip->open($zipName, ZipArchive::CREATE);
			if (!$zipCreate)
				Session::set('cError', 'hatazip');

			$zip->addFile("data/backup/game_$now.tar.gz");
			$zip->addFile("data/backup/db_$now.tar.gz");
			$zip->close();
			sleep(3);
			unlink("data/backup/game_$now.tar.gz");
			unlink("data/backup/db_$now.tar.gz");
			Session::set('cError', 'yedek2');
			URI::redirect('ssh/backup');
		}
		else if ($action == '2')
		{
			URI::redirect('ssh/backup_download');
			Session::set('cError', 'yedek3');
		}
	}
	public function backup_download()
	{
		$now = date("Y-m-d");
		$zipName = "data/backup/game-mysql_$now-yedek.zip";
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
}