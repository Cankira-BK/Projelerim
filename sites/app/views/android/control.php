<?php
if (\StaticDatabase\StaticDatabase::settings('multi_languages'))
{
	$siteLang = isset($_SESSION['language']) ? $_SESSION['language'] : null;
	if ($siteLang === null)
		$_SESSION['language'] = \StaticDatabase\StaticDatabase::settings('default_language');
	require_once "app/language/android/".$_SESSION['language'].".php";
}
else
	require_once "app/language/android/tr.php";