<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 30.01.2017
     * Time: 16:20
     */
    use Model\IN_Model;

    class WheelModel extends IN_Model
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index()
		{
			$aId = Session::get('aId');
			$data['coins'] = $this->gdb->select(CASH)->table(''.ACCOUNT_DB_NAME.'.account')->where(['id'=>$aId])->get()[0][CASH];
			$data['items'] = $this->db->sql("SELECT * FROM wheel_items");
			return $data;
		}
		public function spin($arg)
		{
			$arg = filter_var($arg,FILTER_SANITIZE_STRING);
			$play_wheel = isset($_SESSION['play_wheel']) ? $_SESSION['play_wheel'] : null;
			if ($play_wheel === null)
				$data['result'] = false;
			else
			{
				$aId = Session::get('aId');
				$cLogin = Session::get('cLogin');
				$getCoins = $this->gdb->select(CASH)->table(''.ACCOUNT_DB_NAME.'.account')->where(['id'=>$aId])->get()[0][CASH];
				$token = $this->hash->create('md5',$aId.$cLogin.$getCoins,$play_wheel);
				unset($_SESSION['play_wheel']);
				if ($arg !== $token)
					$data['result'] = false;
				elseif ($getCoins < \StaticDatabase\StaticDatabase::settings('wheelcoins'))
					$data['result'] = false;
				else
				{
					$data['result'] = true;
					$data['items'] = $this->db->sql("SELECT id,vnum,item_name,item_image FROM wheel_items ORDER BY RAND() LIMIT 16");
					$data['random'] = rand(49,64);
					$data['gift_info'] = $data['items'][$data['random'] - 49];
				}
			}
			return $data;
		}
		public function gift($arg,$arg1)
		{
			$arg = filter_var($arg,FILTER_SANITIZE_STRING);
			$arg1 = filter_var($arg1,FILTER_SANITIZE_STRING);
			$giftKey = isset($_SESSION['gift_key']) ? $_SESSION['gift_key'] : null;
			if ($giftKey === null)
				$data['result'] = false;
			else
			{
				$aId = Session::get('aId');
				$getItem = $this->db->select()->table('wheel_items')->where(['id'=>$arg])->get()[0];
				$getCoins = $this->gdb->select(CASH.','.MILEAGE)->table(''.ACCOUNT_DB_NAME.'.account')->where(['id'=>$aId])->get()[0];
				$token = $this->hash->create('md5',$aId.$arg.$getItem['vnum'],$giftKey);
				unset($_SESSION['gift_key']);
				if ($token !== $arg1)
					$data['result'] = false;
				elseif($getCoins[CASH] < \StaticDatabase\StaticDatabase::settings('wheelcoins'))
					$data['result'] = false;
				else
				{
					$Pos = $this->gdb->sql("SELECT pos FROM ".PLAYER_DB_NAME.".item WHERE owner_id = ? and window = ? ORDER BY pos DESC", [$aId, 'MALL']);
					$getPos = (count($Pos) > 0) ? $Pos[0]['pos'] : -1;
					if ($getPos >= '34')
						$data['result'] = false;
					else
					{
						$randId = rand(1000000000,2147483640);
						$controlId = $this->gdb->select('id')->table(''.PLAYER_DB_NAME.'.item')->where(['id'=>$randId])->get();
						if (count($controlId) > 0)
							$data['result'] = false;
						else
						{
							$newCoins = $getCoins[CASH] - \StaticDatabase\StaticDatabase::settings('wheelcoins');
							$newEm =  $getCoins[MILEAGE] + \StaticDatabase\StaticDatabase::settings('wheelcoins');
							$this->gdb->update('account', array(CASH => $newCoins, MILEAGE => $newEm), array('id' => $aId));
							$owner_id = $aId;
							$window = 'MALL';
							$pos = $this->setPos($getPos);
							$item_name = $getItem['item_name'];
							$item_image = $getItem['item_image'];
							$count = $getItem['count'];
							$vnum = $getItem['vnum'];
							$socket0 = $getItem['socket0'];
							$socket1 = $getItem['socket1'];
							$socket2 = $getItem['socket2'];
							$attrtype0 = $getItem['attrtype0'];
							$attrtype1 = $getItem['attrtype1'];
							$attrtype2 = $getItem['attrtype2'];
							$attrtype3 = $getItem['attrtype3'];
							$attrtype4 = $getItem['attrtype4'];
							$attrtype5 = $getItem['attrtype5'];
							$attrtype6 = $getItem['attrtype6'];
							$attrvalue0 = $getItem['attrvalue0'];
							$attrvalue1 = $getItem['attrvalue1'];
							$attrvalue2 = $getItem['attrvalue2'];
							$attrvalue3 = $getItem['attrvalue3'];
							$attrvalue4 = $getItem['attrvalue4'];
							$attrvalue5 = $getItem['attrvalue5'];
							$attrvalue6 = $getItem['attrvalue6'];
							$date = date("Y-m-d H:i:s");
							if ($getItem['item_time'] == '1') {
								$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,UNIX_TIMESTAMP(NOW())+?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, $vnum, $socket0, $socket1, $socket2, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
								$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '3', 'coins' => \StaticDatabase\StaticDatabase::settings('wheelcoins'), 'adet' => $count, 'tarih' => $date];
								$this->db->insert('items_log', $insertLog);
							} elseif ($getItem['item_time'] == '0') {
								$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, $vnum, $socket0, $socket1, $socket2, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
								$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '3', 'coins' => \StaticDatabase\StaticDatabase::settings('wheelcoins'), 'adet' => $count, 'tarih' => $date];
								$this->db->insert('items_log', $insertLog);
							}
							$data = ["result"=>true,"data"=>[$item_name, $item_image, $newCoins, $newEm]];
						}
					}
				}
			}
			return $data;
		}
        public function result($arg){
            Session::init();
            $wheelToken = Session::get('whellToken');
            $sId = Session::get('sId');
            if(strtolower($arg) != $wheelToken){
                echo '<script>window.location = "'.URI::get_path('error/index').'";</script>';
            }else{
                if($sId == 'site'){
                    echo '<script>window.location = "'.URI::get_path('error/index').'";</script>';
                }else{
                    Session::set('whellToken',"false");
                    $aId = Session::get('aId');
                    $getCoins = $this->gdb->select('coins')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$aId))->get()[0]['coins'];
                    $getWheelCoins = \StaticDatabase\StaticDatabase::settings('wheelcoins');
                    if($getCoins < $getWheelCoins){
                        echo '<script>window.location = "'.URI::get_path('error/index').'";</script>';
                    }else{
                        $rand = rand(1,8);
                        $getItem = $this->db->select()->table('wheel')->where(array('id'=>$rand))->get()[0];
                        $Pos = $this->gdb->prepare("SELECT * FROM ".PLAYER_DB_NAME.".item WHERE owner_id='$aId' and window='MALL' ORDER BY pos DESC");
                        $Pos->execute();
                        if($Pos->rowCount() > 0){
                            $Pos->setFetchMode(PDO::FETCH_ASSOC);
                            $getPos = $Pos->fetchAll()[0]['pos'];
                        }else{
                            $getPos = -1;
                        }
                        if($getPos >= '34'){
                            echo '<script>window.location = "'.URI::get_path('error/index').'";</script>';
                        }else{
                            $newCoins = $getCoins - $getWheelCoins;
                            $this->gdb->update('account',array('coins'=>$newCoins),array('id'=>$aId));
                            $owner_id=$aId;
                            $window='MALL';
                            $pos=$this->setPos($getPos);
                            $item_time=$getItem['item_time'];
                            $item_name=$getItem['item_name'];
                            $item_image=$getItem['item_image'];
                            $itemId = $getItem['id'];
                            $count=$getItem['adet'];
                            $coins=$getWheelCoins;
                            $vnum=$getItem['vnum'];
                            $socket0=$getItem['socket0'];
                            $socket1=$getItem['socket1'];
                            $socket2=$getItem['socket2'];
                            $attrtype0=$getItem['attrtype0'];
                            $attrtype1=$getItem['attrtype1'];
                            $attrtype2=$getItem['attrtype2'];
                            $attrtype3=$getItem['attrtype3'];
                            $attrtype4=$getItem['attrtype4'];
                            $attrtype5=$getItem['attrtype5'];
                            $attrtype6=$getItem['attrtype6'];
                            $attrvalue0=$getItem['attrvalue0'];
                            $attrvalue1=$getItem['attrvalue1'];
                            $attrvalue2=$getItem['attrvalue2'];
                            $attrvalue3=$getItem['attrvalue3'];
                            $attrvalue4=$getItem['attrvalue4'];
                            $attrvalue5=$getItem['attrvalue5'];
                            $attrvalue6=$getItem['attrvalue6'];
                            $date = date("Y-m-d H:i:s");
                            if($getItem['item_time'] == '1'){
                                $setItem = $this->gdb->prepare("INSERT INTO ".PLAYER_DB_NAME.".item (owner_id, window, pos, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES ('".$owner_id."','".$window."','".$pos."','".$count."','".$vnum."',UNIX_TIMESTAMP(NOW())+'".$socket0."','".$socket1."','".$socket2."','".$attrtype0."','".$attrvalue0."','".$attrtype1."','".$attrvalue1."','".$attrtype2."','".$attrvalue2."','".$attrtype3."','".$attrvalue3."','".$attrtype4."','".$attrvalue4."','".$attrtype5."','".$attrvalue5."','".$attrtype6."','".$attrvalue6."')");
                                $setItem->execute();
                                $setItemLog = $this->db->prepare("INSERT INTO items_log (account_id, item_id, vnum, item_name, tur, coins, adet, tarih) VALUES ('".$aId."','".Session::get('cLogin')."','".$vnum."','".$vnum."','".$item_name."','".$item_image."','4','".$coins."','".$count."','".$date."')");
                                $setItemLog->execute();
                            }elseif ($getItem['item_time'] == '0'){
                                $setItem = $this->gdb->prepare("INSERT INTO ".PLAYER_DB_NAME.".item (owner_id, window, pos, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES ('".$owner_id."','".$window."','".$pos."','".$count."','".$vnum."','".$socket0."','".$socket1."','".$socket2."','".$attrtype0."','".$attrvalue0."','".$attrtype1."','".$attrvalue1."','".$attrtype2."','".$attrvalue2."','".$attrtype3."','".$attrvalue3."','".$attrtype4."','".$attrvalue4."','".$attrtype5."','".$attrvalue5."','".$attrtype6."','".$attrvalue6."')");
                                $setItem->execute();
                                $setItemLog = $this->db->prepare("INSERT INTO items_log (account_id, item_id, vnum, item_name, tur, coins, adet, tarih) VALUES ('".$aId."','".Session::get('cLogin')."','".$vnum."','".$vnum."','".$item_name."','".$item_image."','4','".$coins."','".$count."','".$date."')");
                                $setItemLog->execute();
                            }
                            Session::set('information',$itemId);
                            echo '<script>window.location = "'.URI::get_path('wheel/information/'.$itemId).'";</script>';
                        }
                    }
               }
            }
        }
		public function slotControl()
		{
			$type = isset($_POST["type"]) ? filter_var($_POST['type'],FILTER_SANITIZE_STRING) : null;

			if ($type === null)
				die(json_encode(["result"=>false]));

			$typeArray = ["0","1","2","3","4"];
			if (!in_array($type,$typeArray))
				die(json_encode(["result"=>false]));

			$accountID = Session::get('aId');

            $accountControl = $this->gdb->select(CASH.', login')->table(''.ACCOUNT_DB_NAME.'.account')->where(['id'=>$accountID])->get()[0];
			if ($accountControl->count <= 0)
				die(json_encode(["result"=>false]));

			$accountLogin = $accountControl["login"];
			$accountCash = $accountControl[CASH];

			if ($type === "0")
			{
				if ($accountCash < 5)
					die(json_encode(["result"=>false]));

				$newCash = $accountCash - 5;

				$updateCash = $this->gdb->update("account",[CASH=>$newCash],["id"=>$accountID]);
				if (!$updateCash)
					die(json_encode(["result"=>false]));

				$slotLogData = [
					"account_id" => $accountID,
					"login" => $accountLogin,
					"cash" => "5",
					"date_time" => date('d-m-Y H:i:s')
				];
				$this->db->insert('slot_log',$slotLogData);

				$keyGenerator = md5(Functions::generateRandomString());
				Session::set('slot_cash_hash', $keyGenerator);
				Session::set('slot_cash_play', "1");

				die(json_encode(["result"=>true,"hash"=>Session::get('slot_cash_hash'),"cash"=>$newCash]));
			}

			if ($type === "1")
			{
				if ($accountCash < 10)
					die(json_encode(["result"=>false]));

				$newCash = $accountCash - 10;

				$updateCash = $this->gdb->update("account",[CASH=>$newCash],["id"=>$accountID]);
				if (!$updateCash)
					die(json_encode(["result"=>false]));

				$slotLogData = [
					"account_id" => $accountID,
					"login" => $accountLogin,
					"cash" => "10",
					"date_time" => date('d-m-Y H:i:s')
				];
				$this->db->insert('slot_log',$slotLogData);

				$keyGenerator = md5(Functions::generateRandomString());
				Session::set('slot_cash_hash', $keyGenerator);
				Session::set('slot_cash_play', "1");

				die(json_encode(["result"=>true,"hash"=>Session::get('slot_cash_hash'),"cash"=>$newCash]));
			}

			if ($type === "2")
			{
				if ($accountCash < 25)
					die(json_encode(["result"=>false]));

				$newCash = $accountCash - 25;

				$updateCash = $this->gdb->update("account",[CASH=>$newCash],["id"=>$accountID]);
				if (!$updateCash)
					die(json_encode(["result"=>false]));

				$slotLogData = [
					"account_id" => $accountID,
					"login" => $accountLogin,
					"cash" => "25",
					"date_time" => date('d-m-Y H:i:s')
				];
				$this->db->insert('slot_log',$slotLogData);

				$keyGenerator = md5(Functions::generateRandomString());
				Session::set('slot_cash_hash', $keyGenerator);
				Session::set('slot_cash_play', "1");

				die(json_encode(["result"=>true,"hash"=>Session::get('slot_cash_hash'),"cash"=>$newCash]));
			}

			if ($type === "3")
			{
				if ($accountCash < 50)
					die(json_encode(["result"=>false]));

				$newCash = $accountCash - 50;

				$updateCash = $this->gdb->update("account",[CASH=>$newCash],["id"=>$accountID]);
				if (!$updateCash)
					die(json_encode(["result"=>false]));

				$slotLogData = [
					"account_id" => $accountID,
					"login" => $accountLogin,
					"cash" => "50",
					"date_time" => date('d-m-Y H:i:s')
				];
				$this->db->insert('slot_log',$slotLogData);

				$keyGenerator = md5(Functions::generateRandomString());
				Session::set('slot_cash_hash', $keyGenerator);
				Session::set('slot_cash_play', "1");

				die(json_encode(["result"=>true,"hash"=>Session::get('slot_cash_hash'),"cash"=>$newCash]));
			}

			if ($type === "4")
			{
				if ($accountCash < 100)
					die(json_encode(["result"=>false]));

				$newCash = $accountCash - 100;

				$updateCash = $this->gdb->update("account",[CASH=>$newCash],["id"=>$accountID]);
				if (!$updateCash)
					die(json_encode(["result"=>false]));

				$slotLogData = [
					"account_id" => $accountID,
					"login" => $accountLogin,
					"cash" => "100",
					"date_time" => date('d-m-Y H:i:s')
				];
				$this->db->insert('slot_log',$slotLogData);

				$keyGenerator = md5(Functions::generateRandomString());
				Session::set('slot_cash_hash', $keyGenerator);
				Session::set('slot_cash_play', "1");

				die(json_encode(["result"=>true,"hash"=>Session::get('slot_cash_hash'),"cash"=>$newCash]));
			}
		}
		public function slotGiftControl()
		{
			$hash = isset($_POST["hash"]) ? filter_var($_POST['hash'],FILTER_SANITIZE_STRING) : null;
			$roulette = isset($_POST["roulette"]) ? filter_var($_POST['roulette'],FILTER_SANITIZE_STRING) : null;
			$roulette0 = isset($_POST["roulette0"]) ? filter_var($_POST['roulette0'],FILTER_SANITIZE_STRING) : null;
			$roulette1 = isset($_POST["roulette1"]) ? filter_var($_POST['roulette1'],FILTER_SANITIZE_STRING) : null;
			$roulette2 = isset($_POST["roulette2"]) ? filter_var($_POST['roulette2'],FILTER_SANITIZE_STRING) : null;

			if (Session::get('slot_cash_play') !== "1")
			{
				Session::set('slot_cash_play', "0");
				die(json_encode(["result"=>false,"cash"=>0]));
			}

			if ($hash === null || $roulette === null || $roulette0 === null || $roulette1 === null || $roulette2 === null)
			{
				Session::set('slot_cash_play', "0");
				die(json_encode(["result"=>false,"cash"=>0]));
			}

			if ($hash === "" || $roulette === "" || $roulette0 === "" || $roulette1 === "" || $roulette2 === "")
			{
				Session::set('slot_cash_play', "0");
				die(json_encode(["result"=>false,"cash"=>0]));
			}

			$typeArray = ["0","1","2","3","4"];
			if (!in_array($roulette,$typeArray))
				die(json_encode(["result"=>false]));

			if (Session::get('slot_cash_hash') !== $hash)
			{
				Session::set('slot_cash_play', "0");
				die(json_encode(["result"=>false,"cash"=>0]));
			}

			$accountID = Session::get('aId');

			$accountControl = $this->gdb->select(CASH.', login')->table(''.ACCOUNT_DB_NAME.'.account')->where(['id'=>$accountID])->get()[0];

			if ($accountControl->count <= 0)
			{
				Session::set('slot_cash_play', "0");
				die(json_encode(["result"=>false,"cash"=>0]));
			}

			$accountCash = $accountControl[CASH];

			if ($roulette0 !== $roulette1)
			{
				Session::set('slot_cash_play', "0");
				die(json_encode(["result"=>false,"cash"=>intval($accountCash)]));
			}

			if ($roulette1 !== $roulette2)
			{
				Session::set('slot_cash_play', "0");
				die(json_encode(["result"=>false,"cash"=>intval($accountCash)]));
			}

			$giftArray = [5,10,25,50,100];

			$keyGenerator = md5(Functions::generateRandomString());
			Session::set('slot_cash_play', "0");
			Session::set('slot_cash_win', "1");
			Session::set('slot_cash_hash', $keyGenerator);
			$giftCash = intval($giftArray[$roulette]) * intval(\StaticDatabase\StaticDatabase::settings('slot_cash_gift'));
			die(json_encode(["result"=>true,"hash"=>Session::get('slot_cash_hash'),"gift"=>$giftCash,"cash"=>intval($accountCash)]));
		}
		public function slotGift()
		{
			$hash = isset($_POST["hash"]) ? filter_var($_POST['hash'],FILTER_SANITIZE_STRING) : null;
			$roulette = isset($_POST["roulette"]) ? filter_var($_POST['roulette'],FILTER_SANITIZE_STRING) : null;
			$cash = isset($_POST["cash"]) ? filter_var($_POST['cash'],FILTER_SANITIZE_STRING) : null;
			$roulette0 = isset($_POST["roulette0"]) ? filter_var($_POST['roulette0'],FILTER_SANITIZE_STRING) : null;
			$roulette1 = isset($_POST["roulette1"]) ? filter_var($_POST['roulette1'],FILTER_SANITIZE_STRING) : null;
			$roulette2 = isset($_POST["roulette2"]) ? filter_var($_POST['roulette2'],FILTER_SANITIZE_STRING) : null;

			if (Session::get('slot_cash_win') !== "1")
			{
				Session::set('slot_cash_win', "0");
				die(json_encode(["result"=>false]));
			}

			if ($hash === null || $roulette === null || $cash === null || $roulette0 === null || $roulette1 === null || $roulette2 === null)
			{
				Session::set('slot_cash_win', "0");
				die(json_encode(["result"=>false]));
			}

			if ($hash === "" || $roulette === "" || $cash === "" || $roulette0 === "" || $roulette1 === "" || $roulette2 === "")
			{
				Session::set('slot_cash_win', "0");
				die(json_encode(["result"=>false]));
			}

			$typeArray = ["0","1","2","3","4"];
			if (!in_array($roulette,$typeArray))
			{
				Session::set('slot_cash_win', "0");
				die(json_encode(["result"=>false]));
			}

			if (Session::get('slot_cash_hash') !== $hash)
			{
				Session::set('slot_cash_win', "0");
				die(json_encode(["result"=>false]));
			}

			$giftArray = [5,10,25,50,100];
			$giftCash = intval($giftArray[$roulette]) * intval(\StaticDatabase\StaticDatabase::settings('slot_cash_gift'));

			if (intval($cash) !== $giftCash)
			{
				Session::set('slot_cash_win', "0");
				die(json_encode(["result"=>false]));
			}


			$accountID = Session::get('aId');
			$accountControl = $this->gdb->select(CASH.', login')->table(''.ACCOUNT_DB_NAME.'.account')->where(['id'=>$accountID])->get()[0];

			if ($accountControl->count <= 0)
			{
				Session::set('slot_cash_win', "0");
				die(json_encode(["result"=>false]));
			}

			$accountLogin = $accountControl["login"];
			$accountCash = $accountControl[CASH];
			$newCash = intval($accountCash) + $giftCash;

			$updateCash = $this->gdb->update('account',[CASH=>$newCash],["id"=>$accountID]);
			if (!$updateCash)
			{
				Session::set('slot_cash_win', "0");
				die(json_encode(["result"=>false]));
			}

			$slotGiftData = [
				"account_id" => $accountID,
				"login" => $accountLogin,
				"roulette" => $roulette,
				"roulette0" => $roulette0,
				"roulette1" => $roulette1,
				"roulette2" => $roulette2,
				"cash" => $cash,
				"date_time" => date('d-m-Y H:i:s')
			];
			$this->db->insert('slot_gift_log',$slotGiftData);

			Session::set('slot_cash_play', "0");
			Session::set('slot_cash_win', "0");
			Session::set('slot_cash_hash', "0");

			die(json_encode(["result"=>true,"cash"=>$newCash]));
		}
        public function information($arg){
            Session::init();
            $itemId = Session::get('information');
            if($itemId != $arg){
                echo '<script>window.location = "'.URI::get_path('error/index').'";</script>';
            }else{
                Session::set('information','false');
                $result['item'] = $this->db->select()->table('wheel')->where(array('id'=>$itemId))->get();
                return $result;
            }
        }
        public function setPos($getPos){
            if($getPos >= '-1' and $getPos < '4'){
                return $getPos+1;
            }elseif($getPos == '4'){
                return $getPos+6;
            }elseif ($getPos >= '10' and $getPos < '14'){
                return $getPos+1;
            }elseif($getPos == '14'){
                return $getPos+6;
            }elseif ($getPos >= '20' and $getPos < '24'){
                return $getPos+1;
            }elseif ($getPos == '24'){
                return $getPos+6;
            }elseif($getPos >= '30' and $getPos < '34'){
                return $getPos+1;
            }elseif ($getPos == '34' and $getPos > '34'){
                return false;
            }
        }
    }