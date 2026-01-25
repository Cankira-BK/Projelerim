<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 16.02.2017
 * Time: 13:34
 */

use Model\IN_Model;

class IndexModel extends IN_Model
{
	public function index()
	{
		$aID = Session::get('aId');
		@$result['ban'] = $this->gdb->select('ticket_ban')->table(''.ACCOUNT_DB_NAME.'.account')->where(['id'=>$aID])->get()[0]['ticket_ban'];
		@$result['title'] = $this->db->sql("SELECT * FROM ticket_title");
		return $result;
	}
	public function create()
	{
		$ticket_title = $this->filter->numberFilter($_POST['ticket_title']);
		$ticket_content = $this->filter->turkishFilter($_POST['message_content']);
		$captcha = $this->filter->passwordFilter($_POST['captcha']);
		$randomCode = isset($_SESSION['random_code']) ? $_SESSION['random_code'] : null;
		$captcha_code = md5(Session::get('aId').$randomCode);

		if ($captcha !== $captcha_code)
			$return = ["result"=>"false","message"=>"Captcha işlemini yanlış yaptınız!"];
		elseif ($ticket_title === false || $ticket_content === false || $captcha === false)
			$return = ["result"=>"false","message"=>"Lütfen özel karakter kullanmayınız!"];
		elseif (strlen($ticket_content) < 10)
			$return = ["result"=>"false","message"=>"Mesajınız 10 karakterden büyük olmalıdır!"];
		else
		{
			$aId = $_SESSION['aId'];
			$userControl = $this->gdb->select('id')->table(''.ACCOUNT_DB_NAME.'.account')->where(['id'=>$aId])->count();
			if ($userControl <= 0)
			{
				$return = ["result"=>"false","message"=>"Kullınıcı bulunamadı!"];
			}
			else
			{
				$titleControl = $this->db->select()->table('ticket_title')->where(['id'=>$ticket_title])->get();
				if (count($titleControl) <= 0)
				{
					$return = ["result"=>"false","message"=>"Lütfen bir başlık belirleyiniz!"];
				}
				else
				{
					$getLastTicket = $this->db->sql("SELECT tarih FROM ticket_status WHERE accountid = ? ORDER BY tarih DESC LIMIT 1",[$aId]);
					$getLastTicket = count($getLastTicket) > 0 ? $getLastTicket[0]['tarih'] : "0000-00-00 00:00:00";
					$now = date('Y-m-d H:i:s');
					if (strtotime($now) - strtotime($getLastTicket) < 300)
						$return = ["result"=>"false","message"=>"5 dakika ara ile ticket gönderebilirsiniz!"];
					else
					{
						$ticketInfo = $titleControl[0];
						$cLogin = $_SESSION['cLogin'];
						$ticket_title = $ticketInfo['title'];
						$ticketID = rand(100000000, 999999999);
						$this->db->insert('tickets', array('ticketid' => $ticketID, 'accountid' => $aId, 'username' => $_SESSION['cLogin'], 'title' => $ticket_title, 'message' => $ticket_content, 'divs' => "user", 'tarih' => date("Y-m-d H:i:s"), 'first' => '1'));
						$this->db->insert('ticket_status', array('ticketid' => $ticketID, 'accountid' => $aId, 'username' => $_SESSION['cLogin'], 'type' => '1', 'title' => $ticket_title, 'message' => $ticket_content, 'status' => '1', 'tarih' => date("Y-m-d H:i:s"), 'first' => '1'));
						if (\StaticDatabase\StaticDatabase::settings('ticket_mail'))
						{
							//Mail Gönderimi
							$getMail = $this->gdb->select('email')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aId))->get()[0]['email'];
							$ticketUrl = URI::get_path('ticket/view/' . $ticketID);
							$mailText = "Sayın $cLogin, <br><br> <strong>#$ticketID</strong> numaralı destek talebiniz tarafımıza ulaşmıştır. En kısa zamanda yönetim ekibi tarafından dönüş sağlanacaktır. Lütfen beklemede kalınız. <br><br> 
                                Ticket Başlığı : $ticket_title <br>
                                $ticket_content<br>
                                Ticket Adresiniz : $ticketUrl <br>
                                <br><br>
                                " . StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi
                                ";
							$this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . ' Ticket Sistemi', $getMail, $this->sablon->sablon1($mailText));
							//Mail Gönderimi
						}
						$return = ["result"=>"true"];
					}
				}

			}
		}
		Session::set('mResult',$return["result"]);
		if ($return["result"] === "false")
			Session::set('mMessage',$return["message"]);
		unset($_SESSION['random_code']);
		URI::redirect('index');
	}
}