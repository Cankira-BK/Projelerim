<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 1.01.2017
     * Time: 20:50
     */
    namespace Helper;
    class IN_Helper{
        public function helper($name){
            foreach ($name as $key=>$row){
                $helper = ucfirst($row);
                require 'app/libs/'.$helper.'.php';
            }
        }
    }