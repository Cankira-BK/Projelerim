<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 26.02.2017
     * Time: 16:43
     */
    use Model\IN_Model;

    class WikiModel extends IN_Model
    {
		
		public function mob_drop()
        {
        	if (Cache::check('wiki_mobdrop'))
				$result['wiki'] = $this->db->sql("SELECT * FROM wiki where title='MobDrop' and status='1' ORDER BY mob ASC");
			return isset($result) ? $result : null;
        }
		
		public function special_item()
        {
        	if (Cache::check('wiki_special'))
				$result['wiki'] = $this->db->sql("SELECT * FROM wiki where title='SpecialDrop' and status='1' ORDER BY mob ASC");
			return isset($result) ? $result : null;
        }
		
		public function game_system()
        {
        	if (Cache::check('wiki_gamesystem'))
				$result['wiki'] = $this->db->sql("SELECT * FROM wiki where title='GameSystem' and status='1' ORDER BY mob ASC");
			return isset($result) ? $result : null;
        }
		
		public function game_npcs()
        {
        	if (Cache::check('wiki_npc'))
				$result['wiki'] = $this->db->sql("SELECT * FROM wiki where title='GameNpc' and status='1' ORDER BY mob ASC");
			return isset($result) ? $result : null;
        }
		
		public function item_upgrade()
        {
        	if (Cache::check('wiki_itemupgrade'))
				$result['wiki'] = $this->db->sql("SELECT * FROM wiki where title='ItemUpgrade' and status='1' ORDER BY mob ASC");
			return isset($result) ? $result : null;
        }
		
		public function game_events()
        {
        	if (Cache::check('wiki_events'))
				$result['wiki'] = $this->db->sql("SELECT * FROM wiki where title='GameEvent' and status='1' ORDER BY mob ASC");
			return isset($result) ? $result : null;
        }
		
		public function view($arg)
        {
            $sth = $this->db->select()->table('wiki')->where(array('seo' => $arg))->get()[0];
            if (count($sth) == 0) {
                URI::redirect('errors');
            } else {
                return $sth;
            }
        }

    }