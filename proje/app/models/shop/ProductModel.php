<?php
use Model\IN_Model;

class ProductModel extends IN_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function ajax($arg)
	{
		Session::init();
		$aId = $_SESSION['aId'];
		$itemId = $arg;
		$getItemInfo = $this->db->select()->table('items')->where(array('item_id' => $itemId));
		if ($getItemInfo->count() <= 0) {
			exit("404 NOT FOUND");
		} else {
			$itemInfo = $getItemInfo->get()[0];
			if ($itemInfo['durum'] != 1 and $itemInfo['durum'] != 2) {
				exit("404 NOT FOUND");
			} else {
				$vnum = $itemInfo['vnum'];
				$tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
				$tokens = md5($aId . $itemId . $vnum . $tokenKey);
				$token = filter_var($_GET['token'], FILTER_SANITIZE_URL);
				if ($token != $tokens) {
					exit("404 NOT FOUND");
				} else {
					$result['item'] = $itemInfo;
					$categoryId = $itemInfo['kategori_id'];
					$result['category'] = $this->db->select('id,name')->table('shop_menu')->where(array('id' => $categoryId))->get();
					return $result;
				}
			}
		}
	}

	public function view($arg)
	{
		$result['menus'] = $this->db->select()->table('shop_menu')->where(array('status' => 0))->get();
		$result['menu'] = $this->db->select()->table('shop_menu')->where(array('id' => $arg))->get();
		$result['items'] = $this->db->select()->table('items')->where(array('kategori_id' => $arg, 'durum' => 1))->get();
		return $result;
	}

	public function views($arg)
	{
		$result['menus'] = $this->db->select()->table('shop_menu')->where(array('status' => 0))->get();
		$result['allMenu'] = $this->db->select()->table('shop_menu')->where(array('mainmenu' => $arg))->get();
		return $result;
	}

	public function discount()
	{
		$result['menu'] = $this->db->select()->table('shop_menu')->where(array('status' => 0))->get();

		$result['items'] = $this->db->select()->table('items')->where(array('popularite' => 1))->get();
		return $result;
	}

	public function em()
	{
		$result['menu'] = $this->db->select()->table('shop_menu')->where(array('status' => 0))->get();

		$result['items'] = $this->db->select()->table('items')->where(array('durum' => 3))->get();
		return $result;
	}

	public function buy()
	{
		$dataUrl = explode("/", filter_var($_GET['url'], FILTER_SANITIZE_URL));
		$item_id = isset($dataUrl[3]) ? $dataUrl[3] : null;
		$itemNum = isset($dataUrl[4]) ? $dataUrl[4] : null;
		$token = isset($dataUrl[5]) ? $dataUrl[5] : null;
		if ($item_id == null || $token == null) {
			$result = ["result" => false, "message" => "error", "data"=>[400]];
		} else {
			Session::init();
			$aId = Session::get('aId');
			$getInfo = $this->db->select()->table('items')->where(array('item_id' => $item_id));
			if ($getInfo->count() <= 0) {
				$result = ["result" => false, "message" => "error", "data"=>[401]];
			} else {
				$getItem = $getInfo->get()[0];
				$itemId = $getItem['item_id'];
				$vNum = $getItem['vnum'];
				$tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
				$hash = $this->hash->create('sha256', $aId . $itemId . $vNum . $itemNum, $tokenKey);
				if ($hash != $token) {
					$result = ["result" => false, "message" => "error", "data"=>[402]];
				} else {
					if ($getItem['durum'] != 1 and $getItem['durum'] != 2) {
						$result = ["result" => false, "message" => "error", "data"=>[403]];
					} else {
						$getCoinses = $this->gdb->select(CASH.','.MILEAGE)->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aId))->get()[0];
						$getCoins = $getCoinses[CASH];
						$getEm = $getCoinses[MILEAGE];
						$coins = $getItem['coins'];
						$getItemCount = $getItem["count_$itemNum"];
						$getDiscountPercent = $getItem["discount_$itemNum"];
						$totalPrice = intval(floor($getItemCount * ($coins - ($coins * $getDiscountPercent / 100))));
						if ($getCoins < $totalPrice)
							$result = ["result" => false, "message" => "coins", "data" => [$coins, $getCoins, $getItem['item_image'], $getItemCount]];
						else {
							$Pos = $this->gdb->sql("SELECT pos FROM ".PLAYER_DB_NAME.".item WHERE owner_id = ? and window = ? ORDER BY pos DESC", [$aId, 'MALL']);
							$getPos = (count($Pos) > 0) ? $Pos[0]['pos'] : -1;
							if ($getPos >= '34')
								$result = ["result" => false, "message" => "depo", "data" => [$coins, $getCoins, $getItem['item_image']]];
							else {
								$randId = rand(1000000000,2147483640);
								$controlId = $this->gdb->select('id')->table(''.PLAYER_DB_NAME.'.item')->where(['id'=>$randId])->get();
								if (count($controlId) > 0)
									$result = ["result" => false, "message" => "same", "data" => 404];
								else{
									$newCoins = $getCoins - $totalPrice;
									$newEm = $getEm + $totalPrice;
									$this->gdb->update('account', array(CASH => $newCoins, MILEAGE => $newEm), array('id' => $aId));
									$owner_id = $aId;
									$window = 'MALL';
									$pos = $this->setPos($getPos);
									$item_name = $getItem['item_name'];
									$item_image = $getItem['item_image'];
									$count = $getItem['unit_price']*$getItemCount;
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
									if ($getItem['vnum'] == '50027' || $getItem['vnum'] == '70111' || $getItem['vnum'] == '70112') {
										$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, $vnum, $socket0, $socket1, $socket2, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
										$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '1', 'coins' => $coins, 'adet' => $count, 'tarih' => $date];
										$this->db->insert('items_log', $insertLog);
									}elseif ($getItem['is_giftbox'] == '1') {
										$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, socket3, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,UNIX_TIMESTAMP(NOW())+?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, 50199, $socket0, $socket1, $socket2, $vnum, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
										$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '1', 'coins' => $coins, 'adet' => $count, 'tarih' => $date];
										$this->db->insert('items_log', $insertLog);
									}elseif ($getItem['item_time'] == '1') {
										$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, socket3, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,UNIX_TIMESTAMP(NOW())+?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, $vnum, $socket0, $socket1, $socket2, 9999, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
										$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '1', 'coins' => $coins, 'adet' => $count, 'tarih' => $date];
										$this->db->insert('items_log', $insertLog);
									}elseif ($getItem['item_time'] == '0') {
										$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, $vnum, $socket0, $socket1, $socket2, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
										$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '1', 'coins' => $coins, 'adet' => $count, 'tarih' => $date];
										$this->db->insert('items_log', $insertLog);
									}
									$result['result'] = true;
									$result['data'] = array($item_name, $item_image, $newCoins, $newEm);
								}
							}
						}
					}
				}
			}
		}
		return $result;
	}

	public function buy_faq()
	{
		$dataUrl = explode("/", filter_var($_GET['url'], FILTER_SANITIZE_URL));
		$item_id = isset($dataUrl[3]) ? $dataUrl[3] : null;
		$itemNum = isset($dataUrl[4]) ? $dataUrl[4] : null;
		$token = isset($dataUrl[5]) ? $dataUrl[5] : null;
		$faq_1 = $this->filter->numberFilter($_POST['faq_1']);
		$faq_2 = $this->filter->numberFilter($_POST['faq_2']);
		$faq_3 = $this->filter->numberFilter($_POST['faq_3']);
		$faq_4 = $this->filter->numberFilter($_POST['faq_4']);
		$faq_5 = $this->filter->numberFilter($_POST['faq_5']);
		if ($item_id == null || $token == null || $faq_1 === false || $faq_2 === false || $faq_3 === false || $faq_4 === false || $faq_5 === false) {
			$result = ["result" => false, "message" => "error", "data"=>[400]];
		} else {
			$aId = Session::get('aId');
			$getInfo = $this->db->select()->table('items')->where(array('item_id' => $item_id));
			if ($getInfo->count() <= 0) {
				$result = ["result" => false, "message" => "error", "data"=>[401]];
			} else {
				$getItem = $getInfo->get()[0];
				$itemId = $getItem['item_id'];
				$vNum = $getItem['vnum'];
				$tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
				$hash = $this->hash->create('sha256', $aId . $itemId . $vNum . $itemNum, $tokenKey);
				if ($hash != $token) {
					$result = ["result" => false, "message" => "error", "data"=>[402]];
				} else {
					if ($getItem['durum'] != 1 and $getItem['durum'] != 2) {
						$result = ["result" => false, "message" => "error", "data"=>[403]];
					} else {
						$getCoinses = $this->gdb->select(CASH.','.MILEAGE)->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aId))->get()[0];
						$getCoins = $getCoinses[CASH];
						$getEm = $getCoinses[MILEAGE];
						$coins = $getItem['coins'];
						$getItemCount = $getItem["count_$itemNum"];
						$getDiscountPercent = $getItem["discount_$itemNum"];
						$totalPrice = intval(floor($getItemCount * ($coins - ($coins * $getDiscountPercent / 100))));
						if ($getCoins < $totalPrice)
							$result = ["result" => false, "message" => "coins", "data" => [$coins, $getCoins, $getItem['item_image'], $getItemCount]];
						else {
							$Pos = $this->gdb->sql("SELECT pos FROM ".PLAYER_DB_NAME.".item WHERE owner_id = ? and window = ? ORDER BY pos DESC", [$aId, 'MALL']);
							$getPos = (count($Pos) > 0) ? $Pos[0]['pos'] : -1;
							if ($getPos >= '34')
								$result = ["result" => false, "message" => "depo", "data" => [$coins, $getCoins, $getItem['item_image']]];
							else {
								$randId = rand(1000000000,2147483640);
								$controlId = $this->gdb->select('id')->table(''.PLAYER_DB_NAME.'.item')->where(['id'=>$randId])->get();
								if (count($controlId) > 0)
									$result = ["result" => false, "message" => "same", "data" => [404]];
								else{
									$faqArray = [$faq_1,$faq_2,$faq_3,$faq_4,$faq_5];
									if ($getItem['faq_status'] !== "1")
										$result = ["result" => false, "message" => "faq_status", "data" => [406]];
									else
									{
										if ($faq_1 === "0" || $faq_2 === "0" || $faq_3 === "0" || $faq_4 === "0" || $faq_5 === "0")
											$result = ["result" => false, "message" => "select_faq", "data" => [$coins, $getCoins, $getItem['item_image']]];
										else
										{
											$wear_flag = $getItem['wear_flag'];

											$getItemAttr = \StaticDatabase\StaticDatabase::init()->prepare("SELECT apply,rate FROM shop_bonus WHERE wear_flag = :wear_flag");
											$getItemAttr->execute(array(':wear_flag'=>$wear_flag));
											$getItemAttr->setFetchMode(PDO::FETCH_ASSOC);
											$getItemAttrs = $getItemAttr->fetchAll();
											
											$rightFaq = array();
											$faqKey = 0;
											foreach ($getItemAttrs as $key => $attr_1)
											{
												if($attr_1['apply'] !== $getItem['applytype0'] && $attr_1['apply'] !== $getItem['applytype1'] && $attr_1['apply'] !== $getItem['applytype2'])
												{
													if (in_array($attr_1['apply'],$faqArray))
													{
														$rightFaq[$faqKey] = [$attr_1['apply'],$attr_1['rate']];
														$faqKey++;
													}
												}
											}
											if (count($rightFaq) < 5)
												$result = ["result" => false, "message" => "false_faq_select", "data" => [$coins, $getCoins, $getItem['item_image']]];
											else
											{
												$newCoins = $getCoins - $totalPrice;
												$newEm = $getEm + $totalPrice;
												$this->gdb->update('account', array(CASH => $newCoins, MILEAGE => $newEm), array('id' => $aId));
												$owner_id = $aId;
												$window = 'MALL';
												$pos = $this->setPos($getPos);
												$item_name = $getItem['item_name'];
												$item_image = $getItem['item_image'];
												$count = $getItemCount;
												$vnum = $getItem['vnum'];
												$socket0 = $getItem['socket0'];
												$socket1 = $getItem['socket1'];
												$socket2 = $getItem['socket2'];
												$attrtype0 = $rightFaq[0][0];
												$attrtype1 = $rightFaq[1][0];
												$attrtype2 = $rightFaq[2][0];
												$attrtype3 = $rightFaq[3][0];
												$attrtype4 = $rightFaq[4][0];
												$attrtype5 = $getItem['attrtype5'];
												$attrtype6 = $getItem['attrtype6'];
												$attrvalue0 = $rightFaq[0][1];
												$attrvalue1 = $rightFaq[1][1];
												$attrvalue2 = $rightFaq[2][1];
												$attrvalue3 = $rightFaq[3][1];
												$attrvalue4 = $rightFaq[4][1];
												$attrvalue5 = $getItem['attrvalue5'];
												$attrvalue6 = $getItem['attrvalue6'];
												$date = date("Y-m-d H:i:s");
												if ($getItem['vnum'] == '50027' || $getItem['vnum'] == '70111' || $getItem['vnum'] == '70112') {
													$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, $vnum, $socket0, $socket1, $socket2, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
													$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '1', 'coins' => $coins, 'adet' => $count, 'tarih' => $date];
													$this->db->insert('items_log', $insertLog);
												}elseif ($getItem['is_giftbox'] == '1') {
													$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, socket3, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,UNIX_TIMESTAMP(NOW())+?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, 50199, $socket0, $socket1, $socket2, $vnum, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
													$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '1', 'coins' => $coins, 'adet' => $count, 'tarih' => $date];
													$this->db->insert('items_log', $insertLog);
												}elseif ($getItem['item_time'] == '1') {
													$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,UNIX_TIMESTAMP(NOW())+?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, $vnum, $socket0, $socket1, $socket2, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
													$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '1', 'coins' => $coins, 'adet' => $count, 'tarih' => $date];
													$this->db->insert('items_log', $insertLog);
												} elseif ($getItem['item_time'] == '0') {
													$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, $vnum, $socket0, $socket1, $socket2, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
													$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '1', 'coins' => $coins, 'adet' => $count, 'tarih' => $date];
													$this->db->insert('items_log', $insertLog);
												}
												$result['result'] = true;
												$result['data'] = array($item_name, $item_image, $newCoins, $newEm);
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		echo json_encode($result);
	}

	public function faq_buy()
	{
		if (isset($_POST['result']) && isset($_POST['data']))
			return $_POST;
	}

	public function select_faq()
	{
		$faq = $this->filter->numberFilter($_POST['faq']);
		$hash = $this->filter->mainFilter($_POST['hash']);
		$item_id = $this->filter->numberFilter($_POST['item_id']);
		$vnum = $this->filter->numberFilter($_POST['vnum']);
		$aId = Session::get('aId');
		$hashControl = $this->hash->create('sha256',$aId.$item_id.$vnum.'1',\StaticDatabase\StaticDatabase::settings('tokenkey'));
		if ($hash === false || $item_id === false || $vnum === false || $faq === false)
			$return = ["data"=>"0"];
		elseif($hash !== $hashControl)
			$return = ["data"=>"0"];
		else
		{
			$getItemData = $this->db->select('faq_status,wear_flag,applytype0,applytype1,applytype2')->table('items')->where(['item_id'=>$item_id])->get();
			if (count($getItemData) <= 0)
				$return = ["data"=>"0"];
			else
			{
				$ItemData = $getItemData[0];
				if ($ItemData['faq_status'] !== "1")
					$return = ["data"=>"0"];
				else
				{
					$wear_flag = $ItemData['wear_flag'];
					$getItemAttr = \StaticDatabase\StaticDatabase::init()->prepare("SELECT apply,rate FROM shop_bonus WHERE wear_flag = :wear_flag");
					$getItemAttr->execute(array(':wear_flag'=>$wear_flag));
					$getItemAttr->setFetchMode(PDO::FETCH_ASSOC);
					$getItemAttrs = $getItemAttr->fetchAll();
					$rightFaq = array();
					foreach ($getItemAttrs as $key => $attr_1)
					{
						if($attr_1['apply'] !== $ItemData['applytype0'] && $attr_1['apply'] !== $ItemData['applytype1'] && $attr_1['apply'] !== $ItemData['applytype2'])
						{
							$rightFaq[$key] = $attr_1['apply'];
						}
					}
					if (in_array($faq,$rightFaq))
						$return = ["data"=>$faq];
					else
						$return = ["data"=>"0"];
				}
			}
		}
		echo json_encode($return);
	}

	public function buyem()
	{
		$dataUrl = explode("/", filter_var($_GET['url'], FILTER_SANITIZE_URL));
		$item_id = isset($dataUrl[3]) ? $dataUrl[3] : null;
		$itemNum = isset($dataUrl[4]) ? $dataUrl[4] : null;
		$token = isset($dataUrl[5]) ? $dataUrl[5] : null;
		if ($item_id == null || $token == null) {
			$result = ["result" => false, "message" => "error", "data"=>[400]];
		} else {
			$aId = Session::get('aId');
			$getInfo = $this->db->select()->table('items')->where(array('item_id' => $item_id));
			if ($getInfo->count() <= 0) {
				$result = ["result" => false, "message" => "error", "data"=>[401]];
			} else {
				$getItem = $getInfo->get()[0];
				$itemId = $getItem['item_id'];
				$vNum = $getItem['vnum'];
				$tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
				$hash = $this->hash->create('sha256', $aId . $itemId . $vNum . $itemNum, $tokenKey);
				if ($hash != $token) {
					$result = ["result" => false, "message" => "error", "data"=>[402]];
				} else {
					if ($getItem['durum'] != 3) {
						$result = ["result" => false, "message" => "error", "data"=>[403]];
					} else {
						$getCoinses = $this->gdb->select(MILEAGE)->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aId))->get()[0];
						$getEm = $getCoinses[MILEAGE];
						$coins = $getItem['coins'];
						$getItemCount = $getItem["count_$itemNum"];
						$getDiscountPercent = $getItem["discount_$itemNum"];
						$totalPrice = intval(floor($getItemCount * ($coins - ($coins * $getDiscountPercent / 100))));
						if ($getEm < $totalPrice)
							$result = ["result" => false, "message" => "coins", "data" => [$coins, $getEm, $getItem['item_image'],$getItemCount]];
						else {
							$Pos = $this->gdb->sql("SELECT pos FROM ".PLAYER_DB_NAME.".item WHERE owner_id = ? and window = ? ORDER BY pos DESC", [$aId, 'MALL']);
							$getPos = (count($Pos) > 0) ? $Pos[0]['pos'] : -1;
							if ($getPos >= '34')
								$result = ["result" => false, "message" => "depo", "data" => [$coins, $getEm, $getItem['item_image']]];
							else {
								$randId = rand(1000000000,2147483640);
								$controlId = $this->gdb->select('id')->table(''.PLAYER_DB_NAME.'.item')->where(['id'=>$randId])->get();
								if (count($controlId) > 0)
									$result = ["result" => false, "message" => "same", "data" => 404];
								else{
									$newEm = $getEm - $totalPrice;
									$this->gdb->update('account', array(MILEAGE => $newEm), array('id' => $aId));
									$owner_id = $aId;
									$window = 'MALL';
									$pos = $this->setPos($getPos);
									$item_name = $getItem['item_name'];
									$item_image = $getItem['item_image'];
									$count = $getItem['unit_price']*$getItemCount;
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
									$result['result'] = true;
									$result['data'] = array($item_name, $item_image, $newEm);
									if ($getItem['vnum'] == '50027' || $getItem['vnum'] == '70111' || $getItem['vnum'] == '70112') {
										$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, $vnum, $socket0, $socket1, $socket2, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
										$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '2', 'coins' => $coins, 'adet' => $count, 'tarih' => $date];
										$this->db->insert('items_log', $insertLog);
									}elseif ($getItem['is_giftbox'] == '1') {
										$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, socket3, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,UNIX_TIMESTAMP(NOW())+?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, 50199, $socket0, $socket1, $socket2, $vnum, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
										$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '2', 'coins' => $coins, 'adet' => $count, 'tarih' => $date];
										$this->db->insert('items_log', $insertLog);
									}elseif ($getItem['item_time'] == '1') {
										$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,UNIX_TIMESTAMP(NOW())+?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, $vnum, $socket0, $socket1, $socket2, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
										$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '2', 'coins' => $coins, 'adet' => $count, 'tarih' => $date];
										$this->db->insert('items_log', $insertLog);
									} elseif ($getItem['item_time'] == '0') {
										$this->gdb->sql("INSERT INTO ".PLAYER_DB_NAME.".item (id, owner_id, window, pos, count, vnum, socket0, socket1, socket2, attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, attrvalue5, attrtype6, attrvalue6) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$randId,$owner_id, $window, $pos, $count, $vnum, $socket0, $socket1, $socket2, $attrtype0, $attrvalue0, $attrtype1, $attrvalue1, $attrtype2, $attrvalue2, $attrtype3, $attrvalue3, $attrtype4, $attrvalue4, $attrtype5, $attrvalue5, $attrtype6, $attrvalue6]);
										$insertLog = ['account_id' => $aId, 'account_name' => Session::get('cLogin'), 'item_id' => $vnum, 'vnum' => $vnum, 'item_name' => $item_name, 'item_image' => $item_image, 'tur' => '2', 'coins' => $coins, 'adet' => $count, 'tarih' => $date];
										$this->db->insert('items_log', $insertLog);
									}
								}
							}
						}
					}
				}
			}
		}
		return $result;
	}

	public function setPos($getPos)
	{
		if ($getPos >= '-1' and $getPos < '4') {
			return $getPos + 1;
		} elseif ($getPos == '4') {
			return $getPos + 6;
		} elseif ($getPos >= '10' and $getPos < '14') {
			return $getPos + 1;
		} elseif ($getPos == '14') {
			return $getPos + 6;
		} elseif ($getPos >= '20' and $getPos < '24') {
			return $getPos + 1;
		} elseif ($getPos == '24') {
			return $getPos + 6;
		} elseif ($getPos >= '30' and $getPos < '34') {
			return $getPos + 1;
		} elseif ($getPos == '34' and $getPos > '34') {
			return false;
		}
	}

	public function ajaxem($arg)
	{
		Session::init();
		$aId = $_SESSION['aId'];
		$itemId = $arg;
		$getItemInfo = $this->db->select()->table('items')->where(array('item_id' => $itemId));
		if ($getItemInfo->count() <= 0) {
			exit("404 NOT FOUND");
		} else {
			$itemInfo = $getItemInfo->get()[0];
			if ($itemInfo['durum'] != 3) {
				exit("404 NOT FOUND");
			} else {
				$vnum = $itemInfo['vnum'];
				$tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
				$tokens = md5($aId . $itemId . $vnum . $tokenKey);
				$token = filter_var($_GET['token'], FILTER_SANITIZE_URL);
				if ($token != $tokens) {
					exit("404 NOT FOUND");
				} else {
					$result['item'] = $itemInfo;
					$categoryId = $itemInfo['kategori_id'];
					$result['category'] = $this->db->select('id,name')->table('shop_menu')->where(array('id' => $categoryId))->get();
					return $result;
				}
			}
		}
	}

	public function price_change()
	{
		$itemId = $this->filter->numberFilter($_POST['item_id']);
		$num = $this->filter->numberFilter($_POST['num']);
		$control = $this->db->select("id,coins,discount_$num,count_$num,unit_price")->table('items')->where(['id' => $itemId])->get();
		if (count($control) > 0) {
			$getItem = $control[0];
			$price = $getItem["coins"];
			$discount = $getItem["discount_$num"];
			$count = $getItem["count_$num"];
			$return = ["status" => true, "price" => floor($count * ($price - ($price * $discount / 100)))];

		} else
			$return = ["status" => false];
		echo json_encode($return);
	}

	public function price_change2()
	{
		$itemId = $this->filter->numberFilter($_POST['item_id']);
		$num = $this->filter->numberFilter($_POST['num']);
		$control = $this->db->select("id,item_id,vnum,coins,discount_$num,discount_status,multi_count,count_$num")->table('items')->where(['id' => $itemId])->get();
		if (count($control) > 0) {
			$getItem = $control[0];
			$price = $getItem["coins"];
			$discount = $getItem["discount_$num"];
			$multi_count = $getItem["multi_count"];
			$count = $getItem["count_$num"];
			$tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
			$hash = $this->hash->create('sha256', Session::get('aId') . $getItem["item_id"] . $getItem["vnum"] . $num, $tokenKey);
			$return = ["status" => true, "price" => floor($count * ($price - ($price * $discount / 100))), "multi" => $multi_count, "count" => $num, "hash" => $hash];

		} else
			$return = ["status" => false];
		echo json_encode($return);
	}
}