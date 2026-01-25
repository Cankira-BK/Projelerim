<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 26.01.2017
     * Time: 17:34
     */
    class Info{
        public static function get(){
            @session_start();
            if(isset($_SESSION['resPid']) || isset($_SESSION['resSas'])){
                $pid = $_SESSION['resPid'];
                $getInfo = \StaticGame\StaticGame::sql("SELECT account_id FROM ".PLAYER_DB_NAME.".player WHERE id = ?",[$pid]);
                $result['aid'] = $getInfo[0]['account_id'];
                $result['pid'] = $pid;
            }elseif(isset($_GET['token'])){
                $getToken = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                $decrypt = inDecrypt($getToken);
                $sub = explode('/',$decrypt);
                $result['pid'] = $sub[0];
                $result['aid'] = $sub[2];
            }elseif(isset($_GET['pid']) || isset($_GET['sas'])){
                $pid = filter_var($_GET['pid'],FILTER_SANITIZE_URL);
                $getInfo = \StaticGame\StaticGame::sql("SELECT account_id FROM ".PLAYER_DB_NAME.".player WHERE id = ?",[$pid]);
                $result['pid'] = $pid;
                $result['aid'] = $getInfo[0]['account_id'];
            }
            return @$result;
        }
        public static function totalYang($account_id){

            $sth = \StaticGame\StaticGame::sql("SELECT SUM(gold) as toplam FROM ".PLAYER_DB_NAME.".player WHERE account_id = ?",[$account_id])[0];
            return $sth['toplam'];
        }
		public static function totalWon($account_id){

            $sth = \StaticGame\StaticGame::sql("SELECT SUM(".CHEQUEWON.") as toplam FROM ".PLAYER_DB_NAME.".player WHERE account_id = ?",[$account_id])[0];
            return $sth['toplam'];
        }
		public static function totalGaya($account_id){

            $sth = \StaticGame\StaticGame::sql("SELECT SUM(".METINGAYA.") as toplam FROM ".PLAYER_DB_NAME.".player WHERE account_id = ?",[$account_id])[0];
            return $sth['toplam'];
        }
		public static function totalBGaya($account_id){

            $sth = \StaticGame\StaticGame::sql("SELECT SUM(".BOSSGAYA.") as toplam FROM ".PLAYER_DB_NAME.".player WHERE account_id = ?",[$account_id])[0];
            return $sth['toplam'];
        }
		public static function totalNP($account_id){

            $sth = \StaticGame\StaticGame::sql("SELECT SUM(".NATURALPOINT.") as toplam FROM ".PLAYER_DB_NAME.".player WHERE account_id = ?",[$account_id])[0];
            return $sth['toplam'];
        }
    }