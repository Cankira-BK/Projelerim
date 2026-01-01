<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 05.05.2017
     * Time: 17:06
     */
    use Model\IN_Model;

    class LogModel extends IN_Model
    {
        public function shop()
        {
			$data['all'] = $this->db->select('account_id,account_name,item_name,adet,tarih')->table('items_log')->get();
            $data['popular'] = $this->db->sql("SELECT item_id,adet,item_name FROM (SELECT item_id, COUNT(vnum) as adet,item_name FROM items_log GROUP BY vnum HAVING COUNT( * ) > ?) items_log ORDER BY adet DESC",['5']);
			return $data;
        }
        public function ban()
        {
            return $this->db->select()->table('ban_list')->get();
        }
		public function hwidban()
        {
            return $this->gdb->select()->table(''.ACCOUNT_DB_NAME.'.'.SECURITYPCTABLE2.'')->get();
        }
		public function guvenlipc()
        {
            return $this->gdb->select()->table(''.ACCOUNT_DB_NAME.'.'.SECURITYPCTABLE1.'')->where(['acik'=>'1'])->get();
        }
		public function guvenlipc2()
        {
            return $this->gdb->select()->table(''.ACCOUNT_DB_NAME.'.'.SECURITYPCTABLE1.'')->where(['acik'=>'0'])->get();
        }
		public function virustotal()
        {
            return $this->db->select()->table('log_virustotal')->get();
        }
		public function oxoyun()
        {
            return $this->gdb->select()->table(''.ACCOUNT_DB_NAME.'.api_maxepin')->where(['Durum'=>'OK'])->get();
        }
		public function kasagame()
        {
            return $this->db->select()->table('api_kasagame')->where(['Durum'=>'OK'])->get();
        }
		public function paywant()
        {
            return $this->db->select()->table('api_paywant')->where(['Status'=>'100'])->get();
        }
		public function payreks()
        {
			return $this->db->sql("SELECT order_id,user_id,user_info,credit,pay_label,net_price,date_time FROM payreks_log ORDER BY date_time ASC");
        }
        public function changeempire()
        {
            date_default_timezone_set('Asia/Bahrain');
            $getNew = $this->gdb->select()->table(''.PLAYER_DB_NAME.'.player_index')->get();
            foreach ($getNew as $row)
            {
                $id = $row['id'];
                $newEmpire = $row['empire'];
                $getOld = $this->gdb->select()->table(''.PLAYER_DB_NAME.'.player_index')->where(['id'=>$id])->get();
                $getOlds = $getOld[0];
                if ($getOld['empire'] != $newEmpire)
                {
                    $id2 = $getOlds['id'];
                    $getChange = $this->gdb->sql("SELECT * FROM ".LOG_DB_NAME.".change_empire WHERE account_id = ?",[$id]);
                    $getChanges = $getChange[0];
                    $time = strtotime($getChanges['time']);
                    $date = strtotime("2017-07-12 09:00:00");
                    if ($time < $date)
                    {
                        $oldEmpire = isset($getOlds['empire']) ? $getOlds['empire'] : 1;
                        $this->gdb->update(''.PLAYER_DB_NAME.'.player_index',array('empire'=>$oldEmpire),array('id'=>$id2));
                        echo $id.PHP_EOL.$oldEmpire.PHP_EOL.$newEmpire.'<br>';
                        $this->db->insert('change_empire',array('account_id'=>$id2,'empire_old'=>$oldEmpire,'empire_new'=>$newEmpire));
                    }
                }
            }
        }
        public function deletecache()
		{
            Cache::delete('all');
            Session::set('delete_cache',true);
            URI::redirect('index');
        }
		public function deletecloudflarecache()
		{
            $cust_email = \StaticDatabase\StaticDatabase::settings('cloud_mail');
			$cust_xauth = \StaticDatabase\StaticDatabase::settings('cloud_auth');
			$cust_domain = \StaticDatabase\StaticDatabase::settings('cloud_dom');

			if($cust_email == "" || $cust_xauth == "" || $cust_domain == "") return;

			$ch_query = curl_init();
			curl_setopt($ch_query, CURLOPT_URL, "https://api.cloudflare.com/client/v4/zones?name=".$cust_domain."&status=active&page=1&per_page=5&order=status&direction=desc&match=all");
			curl_setopt($ch_query, CURLOPT_RETURNTRANSFER, 1);
			$qheaders = array(
				'X-Auth-Email: '.$cust_email.'',
				'X-Auth-Key: '.$cust_xauth.'',
				'Content-Type: application/json'
			);
			curl_setopt($ch_query, CURLOPT_HTTPHEADER, $qheaders);
			$qresult = json_decode(curl_exec($ch_query),true);
			curl_close($ch_query);

			$cust_zone = $qresult['result'][0]['id']; 

			$ch_purge = curl_init();
			curl_setopt($ch_purge, CURLOPT_URL, "https://api.cloudflare.com/client/v4/zones/".$cust_zone."/purge_cache");
			curl_setopt($ch_purge, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch_purge, CURLOPT_RETURNTRANSFER, 1);
			$headers = [
				'X-Auth-Email: '.$cust_email,
				'X-Auth-Key: '.$cust_xauth,
				'Content-Type: application/json'
			];
			$data = json_encode(array("purge_everything" => true));
			curl_setopt($ch_purge, CURLOPT_POST, true);
			curl_setopt($ch_purge, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch_purge, CURLOPT_HTTPHEADER, $headers);

			$result = json_decode(curl_exec($ch_purge),true);
			curl_close($ch_purge);

			if($result['success']==1) Session::set('delete_cloud_cache',true);
			else Session::set('delete_cloud_cache_error',true);
            URI::redirect('site/cloudflare');
        }

    }