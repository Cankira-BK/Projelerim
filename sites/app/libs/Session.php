<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 28.12.2016
     * Time: 10:29
     */
    class Session
    {
        public static function init()
        {
            @session_start();
        }

        public static function set($key, $value)
        {
        	if (is_array($value))
            	$_SESSION[$key] = $value;
        	else
				$_SESSION[$key] = filter_var($value,FILTER_SANITIZE_STRING);
        }

        public static function get($key)
        {
            if (isset($_SESSION[$key]))
                return $_SESSION[$key];
        }
		
		public static function setHash(array $sessions)
		{
			$tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
			foreach ($sessions as $key => $row)
			{
				$encryptKey = Hasher::encrypt($key,$tokenKey);
				$encryptRow = Hasher::encrypt($row,$tokenKey);
				$_SESSION[$encryptKey] = $encryptRow;
			}
		}
		
		public static function getHash($session = null)
		{
			$data = new stdClass();
			$tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
			if (is_string($session))
			{
				$encryptSessionKey = Hasher::encrypt($session,$tokenKey);
				return isset($_SESSION[$encryptSessionKey]) ? Hasher::decrypt($_SESSION[$encryptSessionKey],$tokenKey) : null;
			}
			else
			{
				foreach ($session as $row)
				{
					$encryptSessionKey = Hasher::encrypt($row,$tokenKey);
					$data->{$row} = isset($_SESSION[$encryptSessionKey]) ? Hasher::decrypt($_SESSION[$encryptSessionKey],$tokenKey) : null;
				}
				return $data;
			}
		}
		
		public static function deleteHash($session = null)
		{
			$tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
			if (is_string($session))
			{
				$encryptSessionKey = Hasher::encrypt($session,$tokenKey);
				unset($_SESSION[$encryptSessionKey]);
			}
			elseif (is_array($session))
			{
				foreach ($session as $row)
				{
					$encryptSessionKey = Hasher::encrypt($row,$tokenKey);
					if (isset($_SESSION[$encryptSessionKey]))
						unset($_SESSION[$encryptSessionKey]);
				}
			}
			else
			{
				foreach ($_SESSION as $key => $row)
					unset($_SESSION[$key]);
			}
		}
		
        public static function destroy()
        {
            //unset($_SESSION);
            session_destroy();
        }
    }