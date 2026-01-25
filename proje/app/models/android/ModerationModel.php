<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 27.02.2017
     * Time: 19:16
     */
    use Model\IN_Model;

    class ModerationModel extends IN_Model
    {
        public function __construct()
        {
            parent::__construct();
            header('Content-Type: text/html; charset=utf-8');
        }

        public function paywantAntiInjection($sql)
        {
            $sql = preg_replace(@sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "", $sql);
            $sql = trim($sql);
            $sql = strip_tags($sql);
            $sql = addslashes($sql);
            return $sql;
        }

    }