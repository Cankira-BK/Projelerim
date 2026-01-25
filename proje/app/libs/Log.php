<?php
    /**
     * Created by PhpStorm.
     * User: Oğuzcan GÖKMEN
     * Date: 30.03.2017
     * Time: 11:49
     */
    use Database\Database;
    class Log
    {
        public function __construct()
        {
            $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        }
        public function set($type,$type2,$content = null){
            $now = date('Y-m-d H:i:s');
            $ip = $this->GetIP();
            $aid = $_SESSION['aid'];
            $cLogin = $_SESSION['cLogin'];
            if ($type == 'login'){
                $sth = $this->db->prepare("INSERT INTO login_log (account_id,login,ip,type,date) VALUES (:account_id,:login,:ip,:type,:date)");
                $sth->execute(array(
                    ':account_id'=>$aid,
                    ':login'=>$cLogin,
                    ':ip'=>$ip,
                    ':type'=>$type2,
                    ':date'=>$now
                ));
            }elseif ($type == 'player'){
                $sth = $this->db->prepare("INSERT INTO player_log (account_id,login,content,ip,type,date) VALUES (:account_id,:login,:content,:ip,:type,:date)");
                $sth->execute(array(
                    ':account_id'=>$aid,
                    ':login'=>$cLogin,
                    ':content'=>$content,
                    ':ip'=>$ip,
                    ':type'=>$type2,
                    ':date'=>$now
                ));
            }
        }

        public function GetIP()
        {
            if(getenv("HTTP_CLIENT_IP")) {
                $ip = getenv("HTTP_CLIENT_IP");
            } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
                $ip = getenv("HTTP_X_FORWARDED_FOR");
                if (strstr($ip, ',')) {
                    $tmp = explode (',', $ip);
                    $ip = trim($tmp[0]);
                }
            } else {
                $ip = getenv("REMOTE_ADDR");
            }
            return $ip;
        }
    }