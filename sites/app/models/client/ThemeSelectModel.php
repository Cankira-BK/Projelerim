<?php
    /**
     * Created by PhpStorm.
     * User: Oğuzcan GÖKMEN
     * Date: 7.04.2017
     * Time: 16:57
     */
    use Model\IN_Model;

    class ThemeSelectModel extends IN_Model
    {
        public function index($arg)
		{
			$arg = $this->filter->mainFilter($arg);
			if ($arg === false)
				URI::redirect('index');
			else
			{
				$control = $this->db->select()->table('settings')->where(['client'=>$arg])->get();
				if (count($control) == 1)
					URI::redirect('index');
				else
				{
					$_SESSION['themes'] = $arg;
					Cache::delete('all');
					URI::redirect('index');
				}
			}
		}
    }
