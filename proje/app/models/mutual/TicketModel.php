<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17.02.2017
 * Time: 12:50
 */

use Model\IN_Model;

class TicketModel extends IN_Model
{
	public function unread()
	{
		$aid = Session::get('aId');
		$sth = $this->db->select()->table('ticket_status')->where(array('accountid' => $aid, 'status' => '1'))->get();
		return $sth;
	}

	public function read()
	{
		$aid = Session::get('aId');
		$sth = $this->db->select()->table('ticket_status')->where(array('accountid' => $aid, 'status' => '0'))->get();
		return $sth;
	}

	public function lock()
	{
		$aid = Session::get('aId');
		$sth = $this->db->select()->table('ticket_status')->where(array('accountid' => $aid, 'status' => '2'))->get();
		return $sth;
	}

	public function view($arg)
	{
		$aid = Session::get('aId');
		$ticketControl = $this->db->sql("SELECT ticketid FROM ticket_status WHERE ticketid = ? and accountid = ? and status != ?", [$arg, $aid, '2']);
		if (count($ticketControl) <= 0) {
			URI::redirect('errors/index');
		} else {
			$sth = $this->db->select()->table('tickets')->where(array('ticketid' => $arg, 'accountid' => $aid))->get();
			return $sth;
		}
	}

	public function send($arg)
	{
		$aid = Session::get('aId');
		$arg = $this->filter->numberFilter($arg);
		$message = $this->filter->turkishFilter($_POST['message']);
		if ($arg === false || $message === false)
			Session::set('tNoty', 'filter');
		else {
			$ticketControl = $this->db->sql("SELECT ticketid FROM ticket_status WHERE ticketid = ? and accountid = ? and status != ?", [$arg, $aid, '2']);
			if (count($ticketControl) <= 0)
				Session::set('tNoty', 'empty');
			else {
				if (strlen($message) < 10)
					Session::set('tNoty', 'lengt');
				else {
					$getTicket = $this->db->select('title,tarih,whoid')->table('ticket_status')->where(array('ticketid' => $arg, 'accountid' => $aid))->get()[0];
					$title = $getTicket['title'];
					$ticketDate = $getTicket['tarih'];
					$whoId = $getTicket['whoid'];
					$now = date('Y-m-d H:i:s', time() - 300);
					if ($now < $ticketDate)
						Session::set('tNoty', 'time');
					else {
						$login = $this->gdb->select('login')->table(''.ACCOUNT_DB_NAME.'.account')->where(['id' => $aid])->get()[0]['login'];
						$data = array(
							'ticketid' => $arg,
							'accountid' => $aid,
							'username' => $login,
							'title' => $title,
							'message' => $message,
							'divs' => 'user',
							'tarih' => date("Y-m-d H:i:s"),
							'first' => '0'
						);
						$this->db->insert('tickets', $data);
						$this->db->update('ticket_status', array('message' => $message, 'status' => '1', 'tarih' => date("Y-m-d H:i:s"), 'first' => '0'), array('ticketid' => $arg, 'accountid' => $aid));
						if (\StaticDatabase\StaticDatabase::settings('ticket_mail'))
						{
							//Mail Gönderimi
							$getMail = $this->gdb->select('email')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0]['email'];
							$ticketUrl = URI::get_path('ticket/view/' . $arg);
							$mailText = "Sayın $login, <br><br> <strong>#$arg</strong> numaralı destek talebiniz tarafımıza ulaşmıştır. En kısa zamanda yönetim ekibi tarafından dönüş sağlanacaktır. Lütfen beklemede kalınız. <br><br> 
                                <strong>Konu : </strong> $title<br>
                                <strong>Mesaj : </strong>$message<br>
                                <strong>Ticket Numarası : </strong>: $arg<br>
                                <strong>Ticket Adresiniz : </strong> : $ticketUrl <br><br>
                                " . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi
                                ";
							$this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . ' Ticket Sistemi', $getMail, $this->sablon->sablon1($mailText));
							//Mail Gönderimi
						}
						Session::set('tNoty', 'true');
					}
				}
			}
		}
		URI::redirect('ticket/view/' . $arg);
	}

	public function close($arg, $arg2)
	{
		$arg = $this->filter->turkishFilter($arg);
		$arg2 = $this->filter->numberFilter($arg2);
		$aid = Session::get('aId');
		if ($arg === false || $arg2 === false)
			URI::redirect('errors/index');
		else
		{
			$ticketControl = $this->db->select('ticketid')->table('ticket_status')->where(array('ticketid' => $arg2, 'accountid' => $aid))->count();
			if ($ticketControl <= 0)
				URI::redirect('errors/index');
			else {
				$this->db->update('ticket_status', array('status' => '2'), array('ticketid' => $arg2, 'accountid' => $aid));
				if ($arg === "Unread")
					URI::redirect('ticket/unread');
				else
					URI::redirect('ticket/read');
			}
		}
	}
}