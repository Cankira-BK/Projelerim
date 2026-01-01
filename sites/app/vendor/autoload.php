<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 28.12.2016
     * Time: 10:42
     */
    class Autoload
    {
        public function init()
        {
            //config
            require 'app/config/database.php';
            require 'app/utils/Css.php';
            require 'app/utils/Javascript.php';
            require 'app/utils/Language.php';
			
			//helper
			require 'app/helper/mail/class.phpmailer.php';
            require 'app/helper/browser/Browser.php';
            require 'app/helper/Curl/Curl.php';
            require 'app/helper/bulletproof/bulletproof.php';
			#require 'app/helper/ssh2/Net/SSH2.php';
            #require 'app/helper/ssh2/Net/SFTP.php';
            #require 'app/helper/ssh2/File/ANSI.php';

            //libs
            require 'app/libs/Bootstrap.php';
            require 'app/libs/Controller.php';
            require 'app/libs/Model.php';
            require 'app/libs/View.php';
            require 'app/libs/Helper.php';
            require 'app/libs/Functions.php';
            require 'app/libs/Plugins.php';
            require 'app/libs/Hasher.php';
            require 'app/libs/Client.php';
            require 'app/libs/Themes.php';
            require 'app/libs/Cache.php';
            require 'app/libs/Mobile.php';
            require 'app/libs/Statistics.php';
            require 'app/libs/Database.php';
            require 'app/libs/StaticDatabase.php';
            require 'app/config/gamedatabase.php';
            require 'app/libs/GameDatabase.php';
            require 'app/config/gamesystems.php';
            require 'app/libs/StaticGame.php';
            require 'app/libs/Info.php';
            require 'app/config/path.php';
            require 'app/libs/URI.php';
            require 'app/libs/Session.php';
            require 'app/libs/Socket.php';
            require 'app/libs/Translate.php';
            require 'app/libs/VirusTotal.php';
            #require 'app/libs/SSH.php';
        }
    }