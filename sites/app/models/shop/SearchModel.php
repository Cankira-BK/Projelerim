<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 3.02.2017
     * Time: 13:24
     */
    use Model\IN_Model;

    class SearchModel extends IN_Model
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function search(){
            $token = filter_var($_POST['__token'],FILTER_SANITIZE_STRING);;
            $searchString = $this->filter->passwordFilter($_POST['searchString']);
            Session::init();
            $aId = Session::get('aId');
            $pId = Session::get('pId');
            $hash = hash_hmac('md5',$aId.$pId,'inpinos');
            if (strlen($searchString) < 2)
            	$result = ["result"=>false,"message"=>500];
            elseif ($hash != $token)
            	$result = ["result"=>false,"message"=>501];
			elseif (empty($searchString))
				$result = ["result"=>false,"message"=>502];
			else{
				$sth = $this->db->sql("SELECT * FROM items WHERE (item_name LIKE ? OR coins LIKE ?) AND (durum = ? OR durum = ?)",["%$searchString%",$searchString,"1","2"]);
				if(count($sth) <= 0)
					$result = ["result"=>false,"message"=>503];
				else{
					$result['result'] = true;
					$result['data'] = $sth;
					$result['menu'] = $this->db->select()->table('shop_menu')->where(array('status'=>0))->get();
                    $result['message'] = 'OK';
                    }
                }
            return $result;
        }
    }