<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 27.12.2016
     * Time: 23:45
     */
    namespace Model;

    use Database\Database;
    use GameDatabase\GameDatabase;
    class IN_Model
    {
        public function __construct()
        {
            $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
            $this->gdb = new GameDatabase( GAME_DB_HOST, GAME_DB_USER, GAME_DB_PASS);
        }
    }