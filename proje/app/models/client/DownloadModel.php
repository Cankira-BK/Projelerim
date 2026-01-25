<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 13.03.2017
     * Time: 03:49
     */
    use Model\IN_Model;

    class DownloadModel extends IN_Model
    {
        public function index()
        {
            $data = $this->db->select()->table('pack')->get();
            return $data;
        }
    }