<?php
/**
 * Created by PhpStorm.
 * User: Oğuzcan GÖKMEN
 * Date: 24.03.2017
 * Time: 12:16
 */
use Model\IN_Model;
class AccountModel extends IN_Model
{
	public function create()
	{
		$name = $this->filter->wordFilter($_POST['name']);
		$login = $this->filter->mainFilter($_POST['login']);
		$password = $this->filter->passwordFilter($_POST['password']);
		$email = $_POST['email'];
		$ksk = $this->filter->numberFilter($_POST['ksk']);
		if ($name == false || $login == false || $password == false || $email == false || $ksk == false) {
			$data['result'] = "filter";
		} elseif ($name == "" || $login == "" || $password == "" || $email = "" || $ksk == "") {
			$data['result'] = "empty";
		} elseif (strlen($ksk) > 7) {
			$data['result'] = "filter";
		} else {
			$control = $this->gdb->select('login')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('login' => $login))->count();
			if ($control > 0) {
				$data['result'] = "got";
			} else {
				$data['email'] = $email;
				$now = date("Y-m-d H:i:s");
				$this->gdb->sql("INSERT INTO ".ACCOUNT_DB_NAME.".account (login,password,real_name,social_id,email,create_time,mailaktive) VALUES (:?,PASSWORD(:?),:?,:?,:?,:?,:?)",[$name, $login,$password,$email,$ksk,$now,'0']);
				Functions::setAdminLog("$login Kullanıcısını Oluşturdu");
				$data['result'] = true;
			}
		}
		echo json_encode($data);
	}
	public function account($arg)
	{
		$login = $this->filter->numberFilter($arg);
		if ($login == false) {
			URI::redirect('errors/index');
		} else {
			$control = $this->gdb->select('id')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $login))->count();
			if ($control <= 0) {
				$result['result'] = false;
			} else {
				Functions::setAdminLog("$arg ID'lı Kullanıcının Profilini İnceledi");
				$result['result'] = true;
				//Account İnfo

				$result['account'] = $this->gdb->select('*')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $login))->get()[0];
				if (\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1")
				{
					$result['hwidban'] = $this->gdb->select('hwid')->table(''.ACCOUNT_DB_NAME.'.'.SECURITYPCTABLE2.'')->where(array('hwid' => $result['account'][SECURITYPCTABLE3]))->get()[0];
				}
				$account_id = $result['account']['id'];
				if (\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1")
				{	
					$result['acclock'] = $this->gdb->select('password')->table(''.ACCOUNT_DB_NAME.'.'.ACCOUNTLOCKTABLE.'')->where(array('account_id' => $account_id))->get()[0];
				}
				//Player İnfo
				$result['player'] = $this->gdb->sql("SELECT player.id,player.`name`,player.job,player.`level`,player.ip,player.last_play,player_index.empire,safebox.`password` as depo FROM ".PLAYER_DB_NAME.".player
LEFT JOIN ".PLAYER_DB_NAME.".player_index ON ".PLAYER_DB_NAME.".player_index.pid1 = player.id
OR ".PLAYER_DB_NAME.".player_index.pid2 = player.id
OR ".PLAYER_DB_NAME.".player_index.pid3 = player.id
OR ".PLAYER_DB_NAME.".player_index.pid4 = player.id
LEFT JOIN ".PLAYER_DB_NAME.".safebox ON ".PLAYER_DB_NAME.".safebox.account_id = ?
WHERE player.account_id = ?",[$account_id,$account_id]);
				//Depo İnfo
				$result['depo'] = $this->gdb->sql("SELECT item.id,item.count,item.vnum,item.socket0,item.socket1,item.socket2,item.socket3,item.attrtype0,item.attrtype1,item.attrtype2,item.attrtype3,item.attrtype4,item.attrtype5,item.attrtype6,item.attrvalue0,item.attrvalue1,item.attrvalue2,item.attrvalue3,item.attrvalue4,item.attrvalue5,item.attrvalue6,".PLAYER_DB_NAME.".item_proto.locale_name as name,".PLAYER_DB_NAME.".item_proto.size FROM ".PLAYER_DB_NAME.".item
LEFT JOIN ".PLAYER_DB_NAME.".item_proto ON ".PLAYER_DB_NAME.".item_proto.vnum = ".PLAYER_DB_NAME.".item.vnum
WHERE owner_id = ? AND window = ?",[$account_id,'SAFEBOX']);
				//Nesne İnfo
				$result['nesne'] = $this->gdb->sql("SELECT item.id,item.count,item.vnum,item.socket0,item.socket1,item.socket2,item.socket3,item.attrtype0,item.attrtype1,item.attrtype2,item.attrtype3,item.attrtype4,item.attrtype5,item.attrtype6,item.attrvalue0,item.attrvalue1,item.attrvalue2,item.attrvalue3,item.attrvalue4,item.attrvalue5,item.attrvalue6,".PLAYER_DB_NAME.".item_proto.locale_name as name,".PLAYER_DB_NAME.".item_proto.size FROM ".PLAYER_DB_NAME.".item
LEFT JOIN ".PLAYER_DB_NAME.".item_proto ON ".PLAYER_DB_NAME.".item_proto.vnum = ".PLAYER_DB_NAME.".item.vnum
WHERE owner_id = ? AND window = ?",[$account_id,'MALL']);
				//Market İnfo
				//$result['market'] = $this->gdb->select('id,item_vnum,item_name,what,date')->table(''.LOG_DB_NAME.'.ep_log')->where(array('aid'=>$account_id))->get();
				$result['market'] = $this->db->select('id,vnum,item_name,coins,adet,tarih,tur')->table('items_log')->where(array('account_id'=>$account_id))->get();				
				//Giriş Log
				$result['loginLog'] = $this->db->select('ip,date,type')->table('login_log')->where(array('account_id'=>$account_id))->get();
				//Game Giriş Log
				$result['gameLog'] = $this->gdb->select('type,login_time,channel,pid,ip,logout_time,playtime')->table(''.LOG_DB_NAME.'.loginlog2')->where(array('account_id'=>$account_id))->get();
				//Panel Log
				$result['panelLog'] = $this->db->select('content,ip,date,type')->table('player_log')->where(array('account_id'=>$account_id))->get();
				//Old Password
				$result['oldPass'] = $this->db->select()->table('old_password')->where(array('account_id'=>$account_id))->get();
			}
			return $result;
		}
	}
	public function deleteitem($arg){
		$id = $this->filter->numberFilter($arg);
		$control = $this->gdb->select('id,owner_id')->table(''.PLAYER_DB_NAME.'.item')->where(array('id'=>$id));
		if ($control->count() <= 0){
			URI::redirect('errors/index');
		}else{
			$owner_id = $control->get()[0]['owner_id'];
			$this->gdb->delete(''.PLAYER_DB_NAME.'.item',array('id'=>$id));
			Functions::setAdminLog("$owner_id ID'li Kullanıcının $arg ID'li İtemini Sildi");
			Session::set('changeAccount','delete');
			URI::redirect('account/account/'.$owner_id);
		}
	}
	public function deleteitem1($arg){
		$id = $this->filter->numberFilter($arg);
		$control = $this->gdb->select('id,owner_id')->table(''.PLAYER_DB_NAME.'.item')->where(array('id'=>$id));
		if ($control->count() <= 0){
			URI::redirect('errors/index');
		}else{
			$owner_id = $control->get()[0]['owner_id'];
			$this->gdb->delete(''.PLAYER_DB_NAME.'.item',array('id'=>$id));
			Functions::setAdminLog("$owner_id ID'li Kullanıcının $arg ID'li İtemini Sildi");
			Session::set('changeAccount','delete1');
			URI::redirect('account/account/'.$owner_id);
		}
	}
	public function change()
	{
		$real_name = $_POST['real_name'];
		$login = $_POST['login'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$phone1 = $_POST['phone1'];
		$ksk = $_POST['ksk'];
		if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1")
		{
			$pin = $_POST['pin'];
		}
		$depo = $_POST['depo'];
		$account_id = $_POST['account_id'];
		$player_id = isset($_POST['player_id']) ? $_POST['player_id'] : null;
		$control = $this->gdb->select('id,login,password')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$account_id));
		if ($control->count() <= 0){
			$result['result'] = 'error';
		}else{
			$getInfo = $control->get()[0];
			$getLogin = $getInfo['login'];
			if ($login != $getLogin){
				$searchLogin = $this->gdb->select('login')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('login'=>$login))->count();
				if ($searchLogin == 1){
					$result['result'] = 'got';
				}else{
					if ($password == null){
						if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1")
						{
							$aData = array(
								'real_name' =>$real_name,
								'login'=>$login,
								'email'=>$email,
								'phone1'=>$phone1,
								'social_id'=>$ksk,
								''.PINTABLE.''=>$pin
							);
						}
						else
						{
							$aData = array(
								'real_name' =>$real_name,
								'login'=>$login,
								'email'=>$email,
								'phone1'=>$phone1,
								'social_id'=>$ksk
							);
						}
						$this->gdb->update('account',$aData,array('id'=>$account_id));
						$depoCon = $this->gdb->select('account_id')->table(''.PLAYER_DB_NAME.'.safebox')->where(array('account_id'=>$account_id))->count();
						if ($depoCon <= 0){
							$this->gdb->insert(''.PLAYER_DB_NAME.'.safebox',array('account_id'=>$account_id,'size'=>'5','password'=>$depo));
						}else{
							$this->gdb->update(''.PLAYER_DB_NAME.'.safebox',array('password'=>$depo),array('account_id'=>$account_id));
						}
						
						$result['result'] = true;
					}else{
						$date = date('Y-m-d H:i:s');
						$oldPass = $getInfo['password'];
						$control2 = $this->db->select('id')->table('old_password')->where(array('account_id'=>$account_id))->count();
						if ($control2 < 1)
							$this->db->insert('old_password',array('account_id'=>$account_id,'old_password'=>$oldPass,'date'=>$date));
						else
							$this->db->update('old_password',array('old_password'=>$oldPass,'date'=>$date),array('account_id'=>$account_id));
						if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1")
						{
							$this->gdb->sql("UPDATE account SET real_name = ?,login = ?, phone1 = ?, email = ?, social_id = ?, ".PINTABLE." = ?, password = PASSWORD(?) WHERE id = ?",[$real_name,$login,$phone1,$email,$ksk,$pin,$password,$account_id]);
						}
						else
						{
							$this->gdb->sql("UPDATE account SET real_name = ?,login = ?, phone1 = ?, email = ?, social_id = ?, password = PASSWORD(?) WHERE id = ?",[$real_name,$login,$phone1,$email,$ksk,$password,$account_id]);
						}
						Functions::setAdminLog("$account_id ID'li Kullanıcının Bilgilerini Güncelledi");
						$depoCon = $this->gdb->select('account_id')->table(''.PLAYER_DB_NAME.'.safebox')->where(array('account_id'=>$account_id))->count();
						if ($depoCon <= 0){
							$this->gdb->insert(''.PLAYER_DB_NAME.'.safebox',array('account_id'=>$account_id,'size'=>'5','password'=>$depo));
						}else{
							$this->gdb->update(''.PLAYER_DB_NAME.'.safebox',array('password'=>$depo),array('account_id'=>$account_id));
						}
						
						$result['result'] = true;
					}
				}
			}else{
				if ($password == null){
					if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1")
					{
						$aData = array(
							'real_name' =>$real_name,
							'phone1'=>$phone1,
							'social_id'=>$ksk,
							''.PINTABLE.''=>$pin,
							'email'=>$email
						);
					}
					else
					{
						$aData = array(
							'real_name' =>$real_name,
							'phone1'=>$phone1,
							'social_id'=>$ksk,
							'email'=>$email
						);
					}
					$this->gdb->update('account',$aData,array('id'=>$account_id));
					$depoCon = $this->gdb->select('account_id')->table(''.PLAYER_DB_NAME.'.safebox')->where(array('account_id'=>$account_id))->count();
					if ($depoCon <= 0){
						$this->gdb->insert(''.PLAYER_DB_NAME.'.safebox',array('account_id'=>$account_id,'size'=>'5','password'=>$depo));
					}else{
						$this->gdb->update(''.PLAYER_DB_NAME.'.safebox',array('password'=>$depo),array('account_id'=>$account_id));
					}
				
					$result['result'] = true;
				}else{
					$date = date('Y-m-d H:i:s');
					$oldPass = $getInfo['password'];
					$control2 = $this->db->select('id')->table('old_password')->where(array('account_id'=>$account_id))->count();
					if ($control2 < 1)
						$this->db->insert('old_password',array('account_id'=>$account_id,'old_password'=>$oldPass,'date'=>$date));
					else
						$this->db->update('old_password',array('old_password'=>$oldPass,'date'=>$date),array('account_id'=>$account_id));
					if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1")
					{
						$this->gdb->sql("UPDATE account SET real_name = ?, phone1 = ?,email = ?, social_id = ?, ".PINTABLE." = ?, password = PASSWORD(?) WHERE id = ?",[$real_name,$phone1,$email,$ksk,$pin,$password,$account_id]);
					}
					else
					{
						$this->gdb->sql("UPDATE account SET real_name = ?, phone1 = ?,email = ?, social_id = ?, password = PASSWORD(?) WHERE id = ?",[$real_name,$phone1,$email,$ksk,$password,$account_id]);
					}
					Functions::setAdminLog("$account_id ID'li Kullanıcının Bilgilerini Güncelledi");
					$depoCon = $this->gdb->select('account_id')->table(''.PLAYER_DB_NAME.'.safebox')->where(array('account_id'=>$account_id))->count();
					if ($depoCon <= 0){
						$this->gdb->insert(''.PLAYER_DB_NAME.'.safebox',array('account_id'=>$account_id,'size'=>'5','password'=>$depo));
					}else{
						$this->gdb->update(''.PLAYER_DB_NAME.'.safebox',array('password'=>$depo),array('account_id'=>$account_id));
					}
					
					$result['result'] = true;
				}
			}
		}
		echo json_encode($result);
	}
	public function ban($arg){
		$result['data'] = $this->gdb->select('id,login')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$arg))->get();
		return $result;
	}
	public function banned($arg)
	{
		if ($_POST){
			$banDate = $_POST['banDate'];
			$id = $_POST['id'];
			$id2 = $arg;
			$why = $_POST['why'];
			$evidence = $_POST['evidence'];
			$whoban = $_POST['whoban'];
			if ($id != $id2){
				$result['result'] = false;
				$result['message'] = "Hata";
			}else{
				if ($id == '' || $why == ''){
					$result['result'] = false;
					$result['message'] = "Lütfen Ban Süresi ve Ban Nedenini Giriniz.";
				}else{
					$getInfo = $this->gdb->select('login,status,availDt,email')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$id))->get();
					$status = $getInfo[0]['status'];
					$availDt = $getInfo[0]['availDt'];
					$login = $getInfo[0]['login'];
					$email = $getInfo[0]['email'];
					$availTo = strtotime($availDt);
					$now = time();
					if ($status == 'BLOCK' || $status == 'HW_BAN' || $status == 'HDD_BAN'){
						$result['result'] = false;
						$result['message'] = "Bu hesap zaten banlı";
					}elseif ($availTo > $now){
						$result['result'] = false;
						$result['message'] = "Bu hesap zaten banlı";
					}else{
						$this->gdb->update('account',array('availDt'=>$banDate),array('id'=>$id));
						$controlBanList = $this->db->select('account_id')->table('ban_list')->where(array('account_id'=>$id))->count();
						$date = date('Y-m-d H:i:s');
						if ($controlBanList == 0){
							$this->db->insert('ban_list',array('account_id'=>$id,'why'=>$why,'evidence'=>$evidence,'who'=>$whoban,'date'=>$date,'type'=>'1'));
						}else{
							$this->db->update('ban_list',array('why'=>$why,'evidence'=>$evidence,'date'=>$date,'who'=>$whoban,'type'=>'1'),array('account_id'=>$id));
						}
						$result['result'] = true;
						$result['message'] = "Hesap Başarıyla Banlandı";
						$this->mail->send('Hesabınız Süreli Banlanmıştır!',$email,"Sayın $login, hesabınız $banDate tarihine kadar banlanmıştır. </br> Ban nedeniniz : $why");
						Functions::setAdminLog("$id ID'li Kullanıcıyı $banDate Tarihine Kadar Banladı");
						Functions::sendServer($login,"DC");
					}
				}
			}
			echo json_encode($result);
		}
	}
	public function banned2($arg)
	{
		if($_POST){
			$why = $_POST['why'];
			$evidence = $_POST['evidence'];
			$whoban = $_POST['whoban'];
			$id = $_POST['id'];
			if ($arg != $id){
				$result['result'] = false;
				$result['message'] = "Hata";
			}else{
				if ($id == "" || $why == ""){
					$result['result'] = false;
					$result['message'] = "Lütfen Ban Nedenini Belirtiniz";
				}else{
					$control = $this->gdb->select('id,status,login,email')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$id))->get()[0];
					if (count($control) == 0){
						$result['result'] = false;
						$result['message'] = "Kullanıcı Bulunamadı";
					}else{
						$controlStatus = $control['status'];
						$email = $control['email'];
						$login = $control['login'];
						if ($controlStatus == 'BLOCK' || $controlStatus == 'HW_BAN' || $controlStatus == 'HDD_BAN'){
							$result['result'] = false;
							$result['message'] = "Kullanıcı Zaten Banlı";
						}else{
							$this->gdb->sql("UPDATE account SET status = ? WHERE id = ?",['BLOCK',$id]);
							$controlBanList = $this->db->select('account_id')->table('ban_list')->where(array('account_id'=>$id))->count();
							$date = date('Y-m-d H:i:s');
							if ($controlBanList == 0){
								$this->db->insert('ban_list',array('account_id'=>$id,'why'=>$why,'evidence'=>$evidence,'who'=>$whoban,'date'=>$date,'type'=>'2'));
							}else{
								$this->db->update('ban_list',array('why'=>$why,'evidence'=>$evidence,'who'=>$whoban,'date'=>$date,'type'=>'2'),array('account_id'=>$id));
							}
							$result['result'] = true;
							$result['message'] = "Hesap Başarıyla Banlandı";
							Functions::setAdminLog("$id ID'li Kullanıcıyı Süresiz Banladı");
							$this->mail->send('Hesabınız Süresiz Banlanmıştır!',$email,"Sayın $login, hesabınız süresiz olarak banlanmıştır. </br> Ban nedeniniz : $why");
							$getLogin = $this->gdb->select('login')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$id))->get()[0]['login'];
							Functions::sendServer($getLogin,"DC");
						}
					}
				}
			}
			echo json_encode($result);
		}
	}
	public function banned3($arg)
	{
		if($_POST){
			$why = $_POST['why'];
			$evidence = $_POST['evidence'];
			$whoban = $_POST['whoban'];
			$id = $_POST['id'];
			if ($arg != $id){
				$result['result'] = false;
				$result['message'] = "Hata";
			}else{
				if ($id == "" || $why == ""){
					$result['result'] = false;
					$result['message'] = "Lütfen Ban Nedenini Belirtiniz";
				}else{
					$control = $this->gdb->select('id,status,login,email,'.SECURITYPCTABLE3.'')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$id))->get()[0];
					if (count($control) == 0){
						$result['result'] = false;
						$result['message'] = "Kullanıcı Bulunamadı";
					}else{
						$controlStatus = $control['status'];
						$email = $control['email'];
						$login = $control['login'];
						$mac_addr = $control[SECURITYPCTABLE3];
						if ($controlStatus == 'BLOCK' || $controlStatus == 'HW_BAN' || $controlStatus == 'HDD_BAN'){
							$result['result'] = false;
							$result['message'] = "Kullanıcı Zaten Banlı";
						}else{
							$this->gdb->sql("UPDATE account SET status = ? WHERE id = ?",['HW_BAN',$id]);
							$controlBanList = $this->db->select('account_id')->table('ban_list')->where(array('account_id'=>$id))->count();
							$controlHwidList = $this->gdb->select('hwid')->table(''.ACCOUNT_DB_NAME.'.'.SECURITYPCTABLE2.'')->where(array('hwid'=>$mac_addr))->count();
							$date = date('Y-m-d H:i:s');
							if ($controlHwidList == 0){
								$this->gdb->insert(''.ACCOUNT_DB_NAME.'.'.SECURITYPCTABLE2.'',array('hwid'=>$mac_addr));
							}
							if ($controlBanList == 0){
								$this->db->insert('ban_list',array('account_id'=>$id,'why'=>$why,'evidence'=>$evidence,'who'=>$whoban,'date'=>$date,'type'=>'3'));
							}else{
								$this->db->update('ban_list',array('why'=>$why,'evidence'=>$evidence,'who'=>$whoban,'date'=>$date,'type'=>'3'),array('account_id'=>$id));
							}
							$result['result'] = true;
							$result['message'] = "Hesap Başarıyla HWID Banlandı";
							Functions::setAdminLog("$id ID'li Kullanıcıyı Süresiz Banladı");
							$this->mail->send('Hesabınız Süresiz Banlanmıştır!',$email,"Sayın $login, hesabınız süresiz olarak HWID banlanmıştır. </br> Ban nedeniniz : $why");
							$getLogin = $this->gdb->select('login')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$id))->get()[0]['login'];
							Functions::sendServer($getLogin,"DC");
						}
					}
				}
			}
			echo json_encode($result);
		}
	}
	public function search()
	{
		$login = $this->filter->mainFilter($_POST['login']);
		if ($login == false || $login == '' || strlen($login) < 3){
			$result['result'] = false;
		}else{
			$result['result'] = true;
			$result['data'] = $this->gdb->sql("SELECT * FROM account WHERE login LIKE ?",["%$login%"]);
			Functions::setAdminLog("$login İsminde Kullanıcı Aradı");
			$result['login'] = $login;
		}
		return $result;
	}
	public function searchmac()
	{
		$login = $_POST['mac'];
		if ($login == false || $login == '' || strlen($login) < 3){
			$result['result'] = false;
		}else{
			$result['result'] = true;
			$result['data'] = $this->gdb->sql("SELECT * FROM account WHERE ".SECURITYPCTABLE3." LIKE ?",["%$login%"]);
			Functions::setAdminLog("$login Hwid ile Kullanıcı Aradı");
			$result['mac'] = $login;
		}
		return $result;
	}
	public function allaccountlist($arg)
	{
		$array = array();
		$getLogIp = $this->db->query("SELECT distinct ip FROM login_log WHERE account_id = $arg ORDER BY date ASC")->fetchAll(PDO::FETCH_ASSOC)[0]['ip'];
		@$searchLog = $this->db->select('distinct account_id as id')->table('login_log')->where(array('ip'=>$getLogIp))->get();
		$result = array_merge($array,$searchLog);
		$data = "";
		foreach ($result as $item) {
			$data .= ' id = '.$item['id'].' OR ';
		}
		$data = rtrim($data,' OR ');
		$getSearchResult = $this->gdb->prepare("SELECT id,login,email,status,ip,".SECURITYPCTABLE3." FROM ".ACCOUNT_DB_NAME.".account WHERE $data");
		$getSearchResult->execute();
		$result['who'] = $this->gdb->select('login')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$arg))->get()[0]['login'];
		$result['data'] = $getSearchResult->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	public function oldpass($arg)
	{
		$control = $this->gdb->select('id')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$arg))->count();
		if($control < 1){
			URI::redirect('errors/index');
			die;
		}else{
			$control2 = $this->db->select()->table('old_password')->where(array('account_id'=>$arg));
			if($control2->count() < 1){
				URI::redirect('errors/index');
				die;
			}else{
				$getInfo = $control2->get()[0];
				$newPass = $getInfo['old_password'];
				$this->gdb->update('account',array('password'=>$newPass),array('id'=>$arg));
				$this->db->delete('old_password',array('account_id'=>$arg));
				URI::redirect('account/account/'.$arg);
			}
		}
	}
	public function openban($arg)
	{
		$id = $this->filter->numberFilter($arg);
		if ($id == false){
			URI::redirect('errors/index');
			die;
		}
		$control = $this->gdb->select('id')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$id))->count();
		if($control <= 0){
			URI::redirect('errors/index');
			die;
		}
		$this->gdb->update('account',array('status'=>'OK','availDt'=>'0000-00-00 00:00:00'),array('id'=>$id));
		URI::redirect('account/account/'.$id);
	}
	public function openhwidban($arg)
	{
		if ($arg == false){
			URI::redirect('errors/index');
			die;
		}
		$this->gdb->delete(''.ACCOUNT_DB_NAME.'.'.SECURITYPCTABLE2.'',array('hwid'=>$arg));
		$this->gdb->sql("UPDATE ".ACCOUNT_DB_NAME.".account SET status = ? WHERE ".SECURITYPCTABLE3." = ?",['OK',$arg]);
		URI::redirect('index');
	}
	public function gpcstop($arg)
	{
		if ($arg == false){
			URI::redirect('errors/index');
			die;
		}
		$this->gdb->update(''.ACCOUNT_DB_NAME.'.'.SECURITYPCTABLE1.'',array('acik'=>'0'),array('hwid'=>$arg));
		URI::redirect('log/guvenlipc');
	}
	public function gotep()
	{
		return $this->gdb->sql("SELECT * FROM ".ACCOUNT_DB_NAME.".account WHERE ".CASH." > ?",['0']);
	}
	public function epdelete($arg)
	{
		$control = $this->gdb->select('id')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$arg))->count();
		if($control < 1){
			URI::redirect('errors/index');
			die;
		}else{
			$this->gdb->update('account',[CASH=>0],['id'=>$arg]);
			Session::set('changeOK',true);
			URI::redirect('account/gotep');
		}
	}
	public function addep($arg)
	{
		$control = $this->gdb->select('id')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$arg))->count();
		if($control < 1){
			URI::redirect('errors/index');
			die;
		}else{
			return $this->gdb->select('*')->table(''.ACCOUNT_DB_NAME.'.account')->where(['id'=>$arg])->get();
		}
	}
	public function addedep()
	{
		$id = $_POST['id'];
		$count = $_POST['count'];
		if ($count == '' || $count == '0')
		{
			$result['result'] = false;
		}
		else
		{
			$control = $this->gdb->select()->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$id))->get();
			if(count($control) < 1){
				$result['result'] = false;
			}else{
				$getCash = $control[0][CASH];
				$newCash = $count + $getCash;
				$this->gdb->update("account",[CASH=>$newCash],['id'=>$id]);
				$result['result'] = true;
			}

		}
		echo json_encode($result);
	}
	
	public function alllist()
	{
		$cash = CASH;
		$mileage = MILEAGE;
		return $this->gdb->sql("SELECT id,login,real_name,email,phone1,$cash,$mileage,status FROM account.account");
	}

	public function banlist()
	{
		$cash = CASH;
		$mileage = MILEAGE;

		$return["perma"] = $this->gdb->sql("SELECT id,login,real_name,email,phone1,$cash,$mileage,status FROM account.account WHERE status = ? or status = ?",["BLOCK","HW_BAN"]);

		$now = date("Y-m-d H:i:s");
		$return["time"] = $this->gdb->sql("SELECT id,login,real_name,email,phone1,$cash,$mileage,availDt FROM account.account WHERE availDt <> ? AND availDt > ?",["0000-00-00 00:00:00",$now]);

		return $return;
	}
}