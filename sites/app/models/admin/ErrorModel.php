<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 7.01.2017
     * Time: 05:54
     */
    use Model\IN_Model;

    class ErrorModel extends IN_Model
    {
        public function search(){
            $search = $_POST['search'];
            $getSearch = $this->db->prepare("SELECT name,link FROM menu WHERE name LIKE :name");
            $getSearch->execute(array(':name'=>"%$search%"));
            $getSearch->setFetchMode(PDO::FETCH_ASSOC);
            if($getSearch->rowCount() > 0){
                $link = $getSearch->fetch()['link'];
                URI::redirect($link);
            }else{
                URI::redirect('error');
            }
        }

    }