<?php 
	
	class info {

		static $DB_HOST;
		static $DB_USER;
		static $DB_PASS;
		static $DB_SCHEMA;
		static $DB_PREFIX;

		//general infos
		static $PAGE_TITLE 	= "COCO";
		static $TITLE 		= "COCO <span style='font-size:14px;'>alpha</span>";
		static $ALIAS 		= "COCO";
		static $FOOTER 		= "All right reserved - COCO";

		//labels
		static $MENU_LABEL 		= "Menu";
		static $MENU_BACK_LABEL	= "Indietro";
		static $LOGOUT_LABEL 	= "Esci";

		//paths
		static $CONTENT_ROOT = "content";
		static $CONTENT_ALIAS = "home";


		function sync() {

			if (file_exists("system/constant.json")) {
				$content = json_decode(file_get_contents("system/constant.json"));

				self::$DB_HOST 		= $content->db_host;
				self::$DB_USER 		= $content->db_user;
				self::$DB_PASS 		= $content->db_pass;
				self::$DB_SCHEMA 	= $content->db_name;
				self::$DB_PREFIX 	= $content->db_prefix;
			}

		}
	}

?>
