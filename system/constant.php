<?php 
	
	class info {

		//DB access
		static $DB_HOST;
		static $DB_USER;
		static $DB_PASS;
		static $DB_SCHEMA;

		//salt
		static $SALT;

		//general infos
		static $PAGE_TITLE 	= "Pannello Agenti Fastweb";
		static $TITLE 		= "Pannello Agenti Fastweb";
		static $ALIAS 		= "Pannello Agenti Fastweb";
		static $FOOTER 		= "All right reserved - COCO";

		//labels
		static $MENU_LABEL 		= "Menu";
		static $MENU_BACK_LABEL	= "Indietro";
		static $LOGOUT_LABEL 	= "Esci";

		//paths
		
		//specify this only if COCO root is contained in a subfolder, otherwise set $BASE_PATH to ""
		static $BASE_PATH = "";		
		static $CONTENT_ROOT = "content";
		static $CONTENT_ALIAS = "home";


		function sync() {

			$SALT = sha1(md5("salty!"));

			if (file_exists("system/constant.json")) {
				$content = json_decode(file_get_contents("system/constant.json"));

				self::$DB_HOST 		= $content->db_host;
				self::$DB_USER 		= $content->db_user;
				self::$DB_PASS 		= $content->db_pass;
				self::$DB_SCHEMA 	= $content->db_name;
			}

		}
	}

?>
