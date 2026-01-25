<?php
    /**
     * Created by PhpStorm.
     * User: Oğuzcan GÖKMEN
     * Date: 7.04.2017
     * Time: 16:57
     */
    use Model\IN_Model;

    class LanguagesModel extends IN_Model
    {
        public function index($arg)
		{
			$arg = $this->filter->mainFilter(strtolower($arg));
			if ($arg === false)
				URI::redirect('index');
			else
			{
				$control = $this->db->select()->table('language')->where(['code'=>$arg])->get();
				if (count($control) <= 0)
					URI::redirect('index');
				else
				{
					$_SESSION['language'] = $arg;
					URI::redirect('index');
				}
			}
		}
    }
