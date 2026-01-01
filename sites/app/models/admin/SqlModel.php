<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4.02.2017
 * Time: 21:29
 */
use Model\IN_Model;
class SqlModel extends IN_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function npcliste()
	{
		return $this->gdb->sql("SELECT * FROM ".PLAYER_DB_NAME.".shop ORDER BY vnum DESC");
	}
	public function offprice()
	{
		return $this->gdb->sql("SELECT * FROM ".PLAYER_DB_NAME.".offline_shop_price ORDER BY vnum DESC");
	}
	public function item_proto()
	{
		return $this->gdb->select('vnum,locale_name')->table(''.PLAYER_DB_NAME.'.item_proto')->get();
	}
	public function npc_list()
	{
		return $this->gdb->sql("SELECT * FROM ".PLAYER_DB_NAME.".mob_proto where rank='5' and type='1' and ai_flag='NOMOVE' and vnum BETWEEN 20100 AND 35083 and name not in ('mount','pet','.') ORDER BY vnum DESC");
	}
	public function offpriceadd()
	{
		$itemvnum = $_POST['itemvnum'];
		$itemprice = $_POST['itemprice'];

		if ($itemvnum == '' || $itemprice == '')
			URI::redirect('sql/offprice');

		$this->gdb->insert(''.PLAYER_DB_NAME.'.offline_shop_price',['vnum'=>$itemvnum,'min_price'=>$itemprice]);

		URI::redirect('sql/offprice');
	}
	public function offpricedelete($arg)
	{
		$control = $this->gdb->select('vnum')->table(''.PLAYER_DB_NAME.'.offline_shop_price')->where(['vnum'=>$arg])->count();
		if ($control > 0)
			$this->gdb->delete(''.PLAYER_DB_NAME.'.offline_shop_price',['vnum'=>$arg],1);
		URI::redirect('sql/offprice');
	}
	public function npcitemekle()
	{
		$shop_vnum = $_POST['shop_vnum'];
		$item_vnum = $_POST['item_vnum'];
		$item_count = $_POST['item_count'];
		$item_price = $_POST['item_price'];

		$shop_type = $_POST['shop_type'];
		$price_vnum = $_POST['price_vnum'];

		if ($shop_vnum == '' || $item_vnum == '' || $item_count == '' || $item_price == '' || $shop_type == '')
			URI::redirect('sql/npcitemekle');

		if ($_POST['shop_type'] == 5)
			$this->gdb->insert(''.PLAYER_DB_NAME.'.shop_item',['shop_vnum'=>$shop_vnum,'item_vnum'=>$item_vnum,'count'=>$item_count,'price'=>$item_price,'witemVnum'=>$price_vnum]);
		else
			$this->gdb->insert(''.PLAYER_DB_NAME.'.shop_item',['shop_vnum'=>$shop_vnum,'item_vnum'=>$item_vnum,'count'=>$item_count,'price'=>$item_price]);
		URI::redirect('sql/npcitemekle');
	}
	public function npcitemduzenle2($arg)
	{
		$login = $this->filter->numberFilter($arg);
		if ($login == false) {
			URI::redirect('errors/index');
		} else {
			$control = $this->gdb->select('shop_vnum')->table(''.PLAYER_DB_NAME.'.shop_item')->where(array('shop_vnum' => $login))->count();
			if ($control <= 0) {
				$result['result'] = false;
			} else {
				$result['result'] = true;
				//Account İnfo
				$result['account'] = $this->gdb->sql("SELECT * FROM ".PLAYER_DB_NAME.".shop_item LEFT JOIN ".PLAYER_DB_NAME.".item_proto ON shop_item.item_vnum=item_proto.vnum   WHERE shop_vnum = '".$login."' ORDER by item_vnum asc");
			}
			return $result;
		}
	}
	public function npcitemkaldir($arg1,$arg2)
	{
		$control = $this->gdb->select('item_vnum')->table(''.PLAYER_DB_NAME.'.shop_item')->where(['item_vnum'=>$arg1,'shop_vnum'=>$arg2])->count();
		if ($control > 0)
			$this->gdb->delete(''.PLAYER_DB_NAME.'.shop_item',['item_vnum'=>$arg1,'shop_vnum'=>$arg2],1);
		URI::redirect('sql/offprice');
	}
	public function npctur($arg)
	{
		$login = $this->filter->numberFilter($arg);
		if ($login == false) {
			URI::redirect('errors/index');
		} else {
			$control = $this->gdb->select('vnum')->table(''.PLAYER_DB_NAME.'.shop')->where(array('vnum' => $login))->count();
			if ($control <= 0) {
				$result['result'] = false;
			} else {
				$result['result'] = true;
				$result['account'] = $this->gdb->select('npc_type,vnum')->table(''.PLAYER_DB_NAME.'.shop')->where(array('vnum' => $login))->get()[0];
			}
			return $result;
		}
	}
	public function npcturdegistir()
	{
		$shop_type = $_POST['shop_type'];
		$shop_vnum = $_POST['shop_vnum'];

		if ($shop_type == '' || $shop_vnum == '')
			URI::redirect('sql/npc');

		$this->gdb->sql("UPDATE ".PLAYER_DB_NAME.".shop SET npc_type = ? WHERE vnum = ?",[$shop_type,$shop_vnum]);
		URI::redirect('sql/npc');
	}
	public function npcekle()
	{
		$shop_type = $_POST['shop_type'];
		$vnum = $_POST['npc_vnum'];

		if ($shop_type == '' || $vnum == '')
			URI::redirect('sql/npcekle');

		$this->gdb->insert(''.PLAYER_DB_NAME.'.shop',['npc_type'=>$shop_type,'vnum'=>$vnum,'npc_vnum'=>$vnum,'name'=>'SITENAME_'.$vnum.'_0']);

		URI::redirect('sql/npcekle');
	}
}