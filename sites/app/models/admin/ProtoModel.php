<?php
use Model\IN_Model;
class ProtoModel extends IN_Model
{
	public function index()
	{
		return $this->gdb->select('vnum,locale_name')->table(''.PLAYER_DB_NAME.'.item_proto')->get();
	}
	public function search()
	{
		$vnum = $_POST['vnum'];
		$result['data'] = $this->gdb->sql("SELECT id,owner_id,window,count,vnum FROM ".PLAYER_DB_NAME.".item WHERE vnum = ?",[$vnum]);
		$getItemName = $this->gdb->sql("SELECT locale_name FROM ".PLAYER_DB_NAME.".item_proto WHERE vnum = ?",[$vnum]);
		$result['name'] = Functions::utf8($getItemName[0]['locale_name']);
		$result['playername'] = Functions::karakter_adi_goster($getItemName[0]['owner_id']);
		$result['loginname'] = Functions::hesap_adi_goster($getItemName[0]['owner_id']);
		return $result;
	}
}