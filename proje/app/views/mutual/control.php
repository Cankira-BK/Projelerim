<?php
$cLogin = isset($_SESSION['cLogin']) ? $_SESSION['cLogin'] : null;
$aId = isset($_SESSION['aId']) ? $_SESSION['aId'] : null;
$aid = isset($_SESSION['aid']) ? $_SESSION['aid'] : null;

if (\StaticDatabase\StaticDatabase::settings('ticket_status'))
{
	//SITE LOGIN
	if ($aid !== null)
		Session::set('aId',$aid);
//GAME LOGIN
	elseif ($aId !== null)
		return true;
	else
	{
		URI::redirect('errors/index');
		die;
	}
}
else
{
	URI::redirect('errors/index');
	die;
}
