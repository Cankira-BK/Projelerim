<?php
use Model\IN_Model;

class MediaModel extends IN_Model
{
	public function add()
	{
		$ip = $this->filter->passwordFilter($_POST['ip']);
		$secret_key = $this->filter->passwordFilter($_POST['secret_key']);
		if ($ip === false || $secret_key === false)
			echo "İp adresini boş bırakamazsınız!";
		elseif ($ip === '' || $secret_key === '')
			echo "İp adresini boş bırakamazsınız!";
		elseif ($secret_key !== \StaticDatabase\StaticDatabase::settings('tokenkey'))
			echo "Hatalı key!";
		elseif (!filter_var($ip, FILTER_VALIDATE_IP))
			echo "Lütfen ip adresi formatında yazınız!";
		else
		{
			$this->db->insert('ip_list',['ip'=>$ip,'decription'=>'local']);
			echo "İşlem başarılı!";
		}
	}
}