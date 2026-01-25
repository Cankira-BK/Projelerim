<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 28.12.2016
     * Time: 11:10
     */
    namespace StaticDatabase;
    class StaticDatabase{
        public static $db;
        protected static $DB_TYPE = DB_TYPE;
        protected static $DB_NAME = DB_NAME;
        protected static $DB_HOST = DB_HOST;
        protected static $DB_USER = DB_USER;
        protected static $DB_PASS = DB_PASS;

        public static function init()
        {
            try{
                @self::$db = new \PDO(self::$DB_TYPE . ':dbname='.self::$DB_NAME.';host='.self::$DB_HOST, self::$DB_USER, self::$DB_PASS, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
                return self::$db;
            }catch (\Exception $error){
                exit(self::errorTheme($error->getCode()));
            }
        }

        public static function settings($keys)
        {
            $sth = self::init()->prepare("SELECT deger FROM settings WHERE anahtar = :anahtar");
            $sth->execute(array('anahtar' => $keys));
            $sth->setFetchMode(\PDO::FETCH_ASSOC);
            return $sth->fetch()['deger'];

        }
		public static function systems($keys)
        {
            $sth = self::init()->prepare("SELECT deger FROM systems WHERE anahtar = :anahtar");
            $sth->execute(array('anahtar' => $keys));
            $sth->setFetchMode(\PDO::FETCH_ASSOC);
            return $sth->fetch()['deger'];

        }
		public static function gettable($tablename,$keys,$where)
        {
            $sth = self::init()->prepare("SELECT $keys FROM $tablename WHERE $where = :$where");
            $sth->execute(array($where => '1'));
            $sth->setFetchMode(\PDO::FETCH_ASSOC);
            return $sth->fetch()[$keys];

        }
        private static function errorTheme($errorCode)
		{

			$theme = "
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
        <div id='container' style='margin: 10px;border: 1px solid #D0D0D0;box-shadow: 0 0 8px #D0D0D0;'>
        <h1 style='color: #444;background-color: transparent;border-bottom: 1px solid #D0D0D0;font-size: 19px;font-weight: normal;margin: 0 0 14px 0;padding: 14px 15px 10px 15px;'>Database Bağlantı Hatası</h1>
        <p style='margin: 12px 15px 12px 15px;'>Hata Kodu: ".$errorCode."</p>
        <p style='margin: 12px 15px 12px 15px;'>Açıklama: ".self::errorMessage($errorCode)."</p>
        <p style='margin: 12px 15px 12px 15px;'>Tür: Birincil</p>
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
    }
