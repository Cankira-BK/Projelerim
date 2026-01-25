<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 23.01.2017
     * Time: 19:08
     */
    namespace StaticGame;
    class StaticGame{
        public static $db;
        protected static $DB_HOST = GAME_DB_HOST;
        protected static $DB_USER = GAME_DB_USER;
        protected static $DB_PASS = GAME_DB_PASS;
        protected static $DB_NAME = ACCOUNT_DB_NAME;
        private static $_queryString;
        private static $_bindValue;

        public static function init()
        {
            try{
                self::$db = new \PDO('mysql:dbname='.self::$DB_NAME.';host='.self::$DB_HOST, self::$DB_USER, self::$DB_PASS, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
                return self::$db;
            }catch (\Exception $error){
                exit(self::errorTheme($error->getCode()));
            }
        }
		private static function errorTheme($errorCode)
		{

			$theme = "
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
        <div id='container' style='margin: 10px;border: 1px solid #D0D0D0;box-shadow: 0 0 8px #D0D0D0;'>
        <h1 style='color: #444;background-color: transparent;border-bottom: 1px solid #D0D0D0;font-size: 19px;font-weight: normal;margin: 0 0 14px 0;padding: 14px 15px 10px 15px;'>Database Bağlantı Hatası</h1>
        <p style='margin: 12px 15px 12px 15px;'>Hata Kodu: ".$errorCode."</p>
        <p style='margin: 12px 15px 12px 15px;'>Açıklama: ".self::errorMessage($errorCode)."</p>
        <p style='margin: 12px 15px 12px 15px;'>Tür: İkincil</p>
        </div>";
			return $theme;
		}
		private static function errorMessage($errorCode)
		{
			if ($errorCode === 2002)
				return "Bilinen böyle bir ana bilgisayar yok";
			elseif ($errorCode === 1049)
				return "Hatalı database adı";
			elseif ($errorCode === 1044)
				return "Hatalı kullanıcı adı";
			elseif ($errorCode === 1045)
				return "Hatalı şifre";
		}

		public static function sql($sql, $data = null)
		{
			$data = ($data !== null) ? $data : array();
			self::$_queryString = $sql;

			if (self::_firstCharacter(self::$_queryString) === "select") {
				$sth = self::init()->prepare(self::$_queryString);
				if (!empty($data)) {
					$bindCount = count($data);
					for ($i = 0; $i < $bindCount; $i++) {
						$sth->bindValue($i + 1, $data[$i]);
						self::$_bindValue .= $data[$i] . ',';
					}
				}
				self::$_bindValue = rtrim(self::$_bindValue, ',');
				$sth->execute();
				$return = $sth->fetchAll(\PDO::FETCH_ASSOC);
			} else {
				$sth = self::init()->prepare(self::$_queryString);
				if (!empty($data)) {
					$bindCount = count($data);
					for ($i = 0; $i < $bindCount; $i++) {
						$sth->bindValue($i + 1, $data[$i]);
						self::$_bindValue .= $data[$i] . ',';
					}
				}
				self::$_bindValue = rtrim(self::$_bindValue, ',');
				$sth->execute();
				$return = ($sth->rowCount()) ? true : false;
			}
			return $return;
		}
		/**
		 * @param $string
		 * @return string
		 */
		private static function _firstCharacter($string)
		{
			if (substr($string, 0, 1) === "S" || substr($string, 0, 1) === "s")
				$return = "select";
			elseif (substr($string, 0, 1) === "I" || substr($string, 0, 1) === "i")
				$return = "insert";
			elseif (substr($string, 0, 1) === "U" || substr($string, 0, 1) === "u")
				$return = "update";
			elseif (substr($string, 0, 1) === "D" || substr($string, 0, 1) === "d")
				$return = "delete";
			return $return;
		}
    }