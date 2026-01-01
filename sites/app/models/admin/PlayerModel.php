<?php
    use Model\IN_Model;
    class PlayerModel extends IN_Model
    {
        public function search()
        {
            $name = $this->filter->mainFilter($_POST['name']);
            if ($name == false || $name == '' || strlen($name) < 3){
                $result['result'] = false;
            }else{
                $result['result'] = true;
                $result['data'] = $this->gdb->sql("SELECT ".PLAYER_DB_NAME.".player.id,".PLAYER_DB_NAME.".player.account_id,".PLAYER_DB_NAME.".player.name,".PLAYER_DB_NAME.".player.ip,".PLAYER_DB_NAME.".player.job,".ACCOUNT_DB_NAME.".account.login FROM ".PLAYER_DB_NAME.".player LEFT JOIN ".ACCOUNT_DB_NAME.".account ON account.id = player.account_id WHERE player.`name` LIKE ?",["%$name%"]);
                Functions::setAdminLog("$name İsminde Karakter Aradı");
                $result['name'] = $name;
            }
            return $result;
        }
		public function shopsearch()
        {
            $name = $this->filter->mainFilter($_POST['name']);
            if ($name == false || $name == ''){
                $result['result'] = false;
            }else{
                $result['result'] = true;
				$result['data'] = $this->gdb->sql("SELECT id,vnum,count,price,cheque_price,attrtype0,attrtype1,attrtype2,attrtype3,attrtype4,attrtype5,attrtype6,attrvalue0,attrvalue1,attrvalue2,attrvalue3,attrvalue4,attrvalue5,attrvalue6,socket0,socket1,socket2,socket3 FROM ".PLAYER_DB_NAME.".offlineshop_item where owner_id = ?",[$name]);
                Functions::setAdminLog("$name ID Pazar Aradı");
                $result['name'] = $name;
            }
            return $result;
        }
        public function player($arg)
        {
            $control = $this->gdb->select('id')->table(''.PLAYER_DB_NAME.'.player')->where(array('id'=>$arg))->count();
			$offline_shop_npc = \StaticDatabase\StaticDatabase::settings('offline_shop_npc');
            if ($control <= 0){
                URI::redirect('erros/index');
                die;
            }else{
                //Player Bilgileri
				$data['player'] = $this->gdb->select('*')->table(''.PLAYER_DB_NAME.'.player')->where(array('id'=>$arg))->get();
                $player_name = $data['player'][0]['name'];
				//Ekipman İnfo
                $data['equipment'] = $this->gdb->sql("SELECT item.id,item.count,item.vnum,item.socket0,item.socket1,item.socket2,item.socket3,item.attrtype0,item.attrtype1,item.attrtype2,item.attrtype3,item.attrtype4,item.attrtype5,item.attrtype6,item.attrvalue0,item.attrvalue1,item.attrvalue2,item.attrvalue3,item.attrvalue4,item.attrvalue5,item.attrvalue6,".PLAYER_DB_NAME.".item_proto.locale_name as name,".PLAYER_DB_NAME.".item_proto.size FROM ".PLAYER_DB_NAME.".item
LEFT JOIN ".PLAYER_DB_NAME.".item_proto ON ".PLAYER_DB_NAME.".item_proto.vnum = ".PLAYER_DB_NAME.".item.vnum 
WHERE owner_id = ? AND window = ?",[$arg,'EQUIPMENT']);;

                //Envanter İnfo
                $data['inventory'] = $this->gdb->sql("SELECT item.id,item.count,item.vnum,item.socket0,item.socket1,item.socket2,item.socket3,item.attrtype0,item.attrtype1,item.attrtype2,item.attrtype3,item.attrtype4,item.attrtype5,item.attrtype6,item.attrvalue0,item.attrvalue1,item.attrvalue2,item.attrvalue3,item.attrvalue4,item.attrvalue5,item.attrvalue6,".PLAYER_DB_NAME.".item_proto.locale_name as name,".PLAYER_DB_NAME.".item_proto.size FROM ".PLAYER_DB_NAME.".item
LEFT JOIN ".PLAYER_DB_NAME.".item_proto ON ".PLAYER_DB_NAME.".item_proto.vnum = ".PLAYER_DB_NAME.".item.vnum 
WHERE owner_id = ? AND (window = ? OR window = ?)",[$arg,'INVENTORY','SWITCHBOT']);

				//Belt İnfo
                $data['belt'] = $this->gdb->sql("SELECT item.id,item.count,item.vnum,item.socket0,item.socket1,item.socket2,item.socket3,item.attrtype0,item.attrtype1,item.attrtype2,item.attrtype3,item.attrtype4,item.attrtype5,item.attrtype6,item.attrvalue0,item.attrvalue1,item.attrvalue2,item.attrvalue3,item.attrvalue4,item.attrvalue5,item.attrvalue6,".PLAYER_DB_NAME.".item_proto.locale_name as name,".PLAYER_DB_NAME.".item_proto.size FROM ".PLAYER_DB_NAME.".item
LEFT JOIN ".PLAYER_DB_NAME.".item_proto ON ".PLAYER_DB_NAME.".item_proto.vnum = ".PLAYER_DB_NAME.".item.vnum 
WHERE owner_id = ? AND window = ?",[$arg,'BELT_INVENTORY']);

				//DragonSoul İnfo
                $data['dragonsoul'] = $this->gdb->sql("SELECT item.id,item.count,item.vnum,item.socket0,item.socket1,item.socket2,item.socket3,item.attrtype0,item.attrtype1,item.attrtype2,item.attrtype3,item.attrtype4,item.attrtype5,item.attrtype6,item.attrvalue0,item.attrvalue1,item.attrvalue2,item.attrvalue3,item.attrvalue4,item.attrvalue5,item.attrvalue6,".PLAYER_DB_NAME.".item_proto.locale_name as name,".PLAYER_DB_NAME.".item_proto.size FROM ".PLAYER_DB_NAME.".item
LEFT JOIN ".PLAYER_DB_NAME.".item_proto ON ".PLAYER_DB_NAME.".item_proto.vnum = ".PLAYER_DB_NAME.".item.vnum 
WHERE owner_id = ? AND window = ?",[$arg,'DRAGON_SOUL_INVENTORY']);

				//Special Envanter İnfo
                $data['special'] = $this->gdb->sql("SELECT item.id,item.window,item.count,item.vnum,item.socket0,item.socket1,item.socket2,item.socket3,item.attrtype0,item.attrtype1,item.attrtype2,item.attrtype3,item.attrtype4,item.attrtype5,item.attrtype6,item.attrvalue0,item.attrvalue1,item.attrvalue2,item.attrvalue3,item.attrvalue4,item.attrvalue5,item.attrvalue6,".PLAYER_DB_NAME.".item_proto.locale_name as name,".PLAYER_DB_NAME.".item_proto.size FROM ".PLAYER_DB_NAME.".item
LEFT JOIN ".PLAYER_DB_NAME.".item_proto ON ".PLAYER_DB_NAME.".item_proto.vnum = ".PLAYER_DB_NAME.".item.vnum 
WHERE owner_id = ? AND (window = ? OR window = ? OR window = ? OR window = ? OR window = ? OR window = ?)",[$arg,'UPGRADE_INVENTORY','BOOK_INVENTORY','STONE_INVENTORY','ATTR_INVENTORY','FLOWER_INVENTORY','BLEND_INVENTORY']);

				
				#$data['pshop'] = $this->gdb->sql("SELECT * FROM ".PLAYER_DB_NAME.".".$offline_shop_npc." where owner_id = ?",[$arg]);
				$data['exchange'] = $this->gdb->sql("SELECT * FROM ".LOG_DB_NAME.".tic_gecmis where kisi1 = ? OR kisi2 = ?",[$player_name,$player_name]);
				$data['shop'] = $this->gdb->sql("SELECT * FROM ".LOG_DB_NAME.".pazar_gecmis where name = ? OR alanname = ?",[$player_name,$player_name]);
				
                return $data;
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
                URI::redirect('player/player/'.$owner_id);
            }
        }
		public function shopclose($arg)
		{
			if ($arg == false){
				URI::redirect('errors/index');
				die;
			}
			$offline_shop_npc = \StaticDatabase\StaticDatabase::settings('offline_shop_npc');
			$this->gdb->sql("UPDATE ".PLAYER_DB_NAME.".".$offline_shop_npc." SET status = ? WHERE id = ?",['CLOSED',$arg]);
			URI::redirect('index');
		}
    }