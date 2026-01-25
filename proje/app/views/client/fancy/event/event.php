<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 27.05.2017
     * Time: 23:17
     */
    date_default_timezone_set('Asia/Bahrain');
    if (filter_var($_GET['day'],FILTER_SANITIZE_URL) == 29){
        $data = strtotime("2017-04-18 23:24:56");
        echo '[{"name":"Dojang","timestamp":'.$data.',"timestamp2":1495909000}]';
    }else if(filter_var($_GET['day'],FILTER_SANITIZE_URL) == 28){
        echo '[{"name":"Deneme","timestamp":1495900800}]';
    }else{
        echo '[]';
    }