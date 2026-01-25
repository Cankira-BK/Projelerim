<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 23.01.2017
     * Time: 23:24
     */
    use Model\IN_Model;

    class IndexModel extends IN_Model
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index(){
            $result['mainBanner'] = $this->db->sql("SELECT image,title,content FROM banner WHERE type = ?",['0']);
            $result['subBanner'] = $this->db->sql("SELECT image,title,content FROM banner WHERE type = ?",['1'])[0];
            $where = array('popularite'=>'1');
            $result['items'] = $this->db->select()->table('items')->where($where)->get();
            return $result;
        }
    }