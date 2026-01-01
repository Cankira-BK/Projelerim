<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 31.01.2017
     * Time: 02:28
     */
    use Model\IN_Model;

    class NavModel extends IN_Model
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function characters(){
            Session::init();
            $aId = Session::get('aId');
            $result['characters'] = $this->gdb->select('name,job,level')->table(''.PLAYER_DB_NAME.'.player')->where(array('account_id'=>$aId))->get();
            $result['depo'] = $this->gdb->select('id')->table(''.PLAYER_DB_NAME.'.item')->where(array('owner_id'=>$aId,'window'=>'MALL'))->count();
            return $result;
        }
        public function log(){
            Session::init();
            $aId = Session::get('aId');
            $result['log'] = $this->db->select('item_name,coins,tarih,tur,adet,item_image')->table('items_log')->where(array('account_id'=>$aId))->get();
            $result['depo'] = $this->gdb->select('id')->table(''.PLAYER_DB_NAME.'.item')->where(array('owner_id'=>$aId,'window'=>'MALL'))->count();
            return $result;
        }
        public function depo(){
            Session::init();
            $aId = Session::get('aId');
            $result['depos'] = $this->gdb->sql("SELECT ".PLAYER_DB_NAME.".item.vnum,".PLAYER_DB_NAME.".item_proto.locale_name FROM ".PLAYER_DB_NAME.".item LEFT JOIN ".PLAYER_DB_NAME.".item_proto ON ".PLAYER_DB_NAME.".item.vnum = ".PLAYER_DB_NAME.".item_proto.vnum WHERE ".PLAYER_DB_NAME.".item.owner_id = ? AND ".PLAYER_DB_NAME.".item.window = ?",[$aId,'MALL']);
            $result['depo'] = $this->gdb->select('id')->table(''.PLAYER_DB_NAME.'.item')->where(array('owner_id'=>$aId,'window'=>'MALL'))->count();
            return $result;
        }
        public function coupon(){
            Session::init();
            $aId = Session::get('aId');
            $result['depo'] = $this->gdb->select('id')->table(''.PLAYER_DB_NAME.'.item')->where(array('owner_id'=>$aId,'window'=>'MALL'))->count();
            return $result;
        }
        public function control(){
            Session::init();
            $aId = Session::get('aId');
            $code = filter_var($_POST['code'],FILTER_SANITIZE_STRING);
            $control = $this->db->select('id')->table('kuponlar')->where(array('anahtar'=>$code,'status'=>'0'))->count();
            if($control <= 0){
                $result['result'] = false;
            }else{
                $result['result'] = true;
                $getCoins = $this->db->select('ep')->table('kuponlar')->where(array('anahtar'=>$code,'status'=>'0'))->get()[0]['ep'];
                $coins = $this->gdb->select(CASH)->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$aId))->get()[0][CASH];
                if (\StaticDatabase\StaticDatabase::settings('happy_hour'))
					$newCoins = ($getCoins * intval(\StaticDatabase\StaticDatabase::settings('happy_hour_discount')) / 100) + $getCoins + $coins;
                else
                	$newCoins = $getCoins + $coins;
                $this->gdb->update('account',array(CASH=>$newCoins),array('id'=>$aId));
                $date = date("Y-m-d H:i:s");
                $this->db->update('kuponlar',array('account_id'=>$aId,'status'=>'1','use_date'=>$date),array('anahtar'=>$code));
                $result['coins'] = $getCoins;
            }
            return $result;
        }
    }