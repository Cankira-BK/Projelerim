<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.10.2017
 * Time: 22:40
 */
use Model\IN_Model;
class PackModel extends IN_Model
{
	public function create()
	{
		$name = $_POST['name'];
		$size = $_POST['size'];
		$url = $_POST['url'];
		$source = $_POST['source'];
		if ($name == '' || $size == '' || $url == '' || $source == '')
			$result['result'] = false;
		else
		{
			$datetime = date('Y-m-d H:i:s');
			$this->db->insert('pack',['name'=>$name,'size'=>$size,'url'=>$url,'image'=>$source,'tarih'=>$datetime,'type'=>1]);
			$result['result'] = true;
		}
		echo json_encode($result);

	}
	public function liste()
	{
		return  $this->db->select()->table('pack')->where(['type'=>1])->get();
	}
	public function delete($arg){
		$this->db->delete('pack',array('id'=>$arg));
		Session::set('changeOK',true);
		URI::redirect('pack/liste');
	}
}