<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 26.02.2017
     * Time: 16:43
     */
    use Model\IN_Model;

    class PatchModel extends IN_Model
    {
        public function view($arg)
        {
            $sth = $this->db->select()->table('patch')->where(array('id' => $arg))->get()[0];
            if (count($sth) == 0) {
                URI::redirect('errors');
            } else {
                return $sth;
            }
        }

    }