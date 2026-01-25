<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 29.01.2017
     * Time: 11:43
     */

    if (\StaticDatabase\StaticDatabase::settings('shop_status') == 0)
		URI::redirect('errors');
    else
    {
		$pid = isset($_GET['pid']) ? filter_var($_GET['pid'],FILTER_SANITIZE_URL) : null;
		$sas = isset($_GET['sas']) ? filter_var($_GET['sas'],FILTER_SANITIZE_URL) : null;
		$sid = isset($_GET['sid']) ? filter_var($_GET['sid'],FILTER_SANITIZE_URL) : null;
		$sId = isset($_SESSION['sId']) ? filter_var($_SESSION['sId'],FILTER_SANITIZE_URL) : null;
		$aid = isset($_SESSION['aid']) ? filter_var($_SESSION['aid'],FILTER_SANITIZE_URL) : null;
		$cLogin = isset($_SESSION['cLogin']) ? filter_var($_SESSION['cLogin'],FILTER_SANITIZE_STRING) : null;
		$shopLogin = isset($_SESSION['shopLogin']) ? $_SESSION['shopLogin'] : false;

		//GAME LOGIN
		if ($pid !== null && $sas !== null && $sid !== null && $sid === '0')
		{
			$getPlayerInfo = \StaticGame\StaticGame::sql("SELECT id,account_id FROM ".PLAYER_DB_NAME.".player WHERE id = ?",[$pid]);
			if (count($getPlayerInfo) <= 0)
			{
				echo '<script>window.location = "'.URI::get_path('errors/index').'";</script>';
				die;
			}
			else
			{
				$playerInfo = $getPlayerInfo[0];
				$aid = $playerInfo['account_id'];
				$gameKey = \StaticDatabase\StaticDatabase::settings('gamekey');
				$cSas = md5($pid.$aid.$gameKey);
				if($cSas != $sas){
					echo '<script>window.location = "'.URI::get_path('errors/index').'";</script>';
				}else{
					if ($shopLogin === false)
					{
						$getLogin = StaticGame\StaticGame::sql("SELECT login FROM ".ACCOUNT_DB_NAME.".account WHERE id = ?",[$aid])[0]['login'];
						Session::set('cLogin',$getLogin);
						Session::set('aId',$playerInfo['account_id']);
						Session::set('pId',$playerInfo['id']);
						Session::set('shopLogin',true);
						URI::redirect('index');
					}
				}
			}
		}

		//SITE LOGIN
		elseif ($aid !== null && $cLogin !== null && $sId !== null && $sId === 'site')
		{
			$getPlayerInfo = \StaticGame\StaticGame::sql("SELECT id,account_id FROM ".PLAYER_DB_NAME.".player WHERE account_id = ?",[$aid]);
			if (count($getPlayerInfo) <= 0)
			{
				URI::redirect('errors');
				die;
			}
			else
			{
				if ($shopLogin === false)
				{
					$playerInfo = $getPlayerInfo[0];
					Session::set('aId',$playerInfo['account_id']);
					Session::set('pId',$playerInfo['id']);
					Session::set('shopLogin',true);
					URI::redirect('index');
				}
			}
		}

		//LOGIN TRUE
		elseif ($shopLogin == true && isset($_SESSION['aId']) && isset($_SESSION['pId']))
		{
			return true;
		}

		//NO LOGIN
		else
		{
			$urlParse = Plugins::urlParse();
			$urlParse[1] = isset($urlParse[1]) ? $urlParse[1] : null;
			if ($urlParse[1] != 'login')
				URI::redirect('login');
		}
	}
