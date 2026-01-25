<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 28.05.2017
     * Time: 01:57
     */
    use Model\IN_Model;

    class EventModel extends IN_Model
    {
        public function event()
        {
				$day = filter_var($_GET['day'],FILTER_SANITIZE_URL);
				if (strlen($day) == 1){
					$day = '0'.$day;
				}
				$date = new DateTime(date("Y-m-d H:i:s"));
				$month = $date->format('m');
					$getCrone = $this->db->select('startDate,finishDate,eventName')->table('event_crone')->where(array('month'=>$month),'and')->where(array('day'=>$day))->get();

				if ($getCrone != null){
					$startDate = strtotime($getCrone[0]['startDate']);
					$finishDate = strtotime($getCrone[0]['finishDate']);
					$eventName = $getCrone[0]['eventName'];
					echo '[{"name":"'.$eventName.'","timestamp":'.$startDate.',"timestamp2":'.$finishDate.'}]';
				}else{
					echo '[]';
				}

        }

        public function dynamic()
		{
			$getEvents = $this->db->sql("SELECT day,name,time FROM events ORDER BY owner ASC");
			return $getEvents;
		}

    }