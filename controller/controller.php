<?php 

	if (!class_exists("view")) 		require("view/view.php");
	if (!class_exists("model")) 	require("model/frontModel.php");

	class Controller {

		function __construct() {

			session_start();

			$this->View  = new View($this);
			$this->Model = new frontModel($this);
			$this->route = (isset($_GET['route']) && $this->route($_GET['route'])) ? $this->route($_GET['route']) : "content";
			$this->url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			
			if (isset($_POST['action'])) {
				$this->action = $_POST['action'];
				unset($_POST['action']);
			}
			else 
				$this->action = null;

		}

		function getSession() {
			return $this->Model->getSession();
		}

		function catchBackgroundAction() {

			switch ($this->action) {
				case 'setup' 					: $this->result = $this->Model->setupConstants();	break;
				case 'checkAuth' 				: $this->result = $this->Model->checkAuth(); 		break;
			}

			if ($this->getSession())
				switch ($this->action) {
					case 'logout' 	 			: unset($_SESSION['username']); session_destroy(); $this->result = new alert(1, "Logout effettuato con successo."); break;
					case 'updateAccessLevels'	: $this->result = $this->Model->updateAccessLevels();			break;
					case 'updateMenu' 			: $this->result = $this->Model->updateMenu(); 					break;
					case 'backup'				: $this->result = $this->Model->backup();		 				break;
					case 'restoreBackup' 		: $this->result = $this->Model->restoreBackup(); 				break;
					case 'pullMenu' 			: $this->result = $this->Model->pullMenu(info::$CONTENT_ROOT);	break;
					case 'addUser' 				: $this->result = $this->Model->addUser();							break;
					default : break;
				}
		}

		function getUserMessage($result) {
			return $this->View->getUserMessage($result);
		}

		function getAuthPanel($result) {
			return $this->View->getAuthPanel(@$result);
		}

		function getSetupPanel($result) {
			return $this->View->getSetupPanel(@$result);
		}

		function getPath() {
			if (isset($_GET['route']) && $this->route($_GET['route']))
				$path = $this->View->getPath(info::$CONTENT_ALIAS."/".$_GET['route']);
			else
				$path = $this->View->getPath(info::$CONTENT_ALIAS);
			return $path;
		}

		function getLogout() {
			return $this->View->getLogout();
		}

		function getMenu() {
			$path = $this->route;
			$items = new stdClass();
			$back = (isset($_GET['route']) && $this->route($_GET['route'])) ? $this->backward($_GET['route']) : null;

			if ($this->visit($path)) {
				$items = $this->visit($path);
				foreach($items as $item) {
					$item->route = (isset($_GET['route']) && $this->route($_GET['route'])) ? $_GET['route']."/".$item->alias : $item->alias;
				}
			}

			return $this->View->getMenu($items,$back);
		}

		function getContent() {
			if (is_file($this->route))					// se la route e' un file include
				include($this->route);
			else {
				if (is_file($this->route."/index.php"))	
					include($this->route."/index.php");
			}
		}

		function backward($route) {
			$exploded = explode("/",$route);
			unset($exploded[count($exploded)-1]);
			return implode("/",$exploded);
		}

		function getTitle() {
			return $this->View->getTitle();
		}

		function getPageTitle() {
			return $this->View->getPageTitle();
		}

		function getFooter() {
			return $this->View->getFooter();
		}

		private function visit($path) {
			$return = false;
			$exploded = explode("/",$path);
			$last = $exploded[count($exploded)-1];
			$path = $path."/menu.json";
			
			if (is_file($path)) {
				$content = file_get_contents($path);
				$content = json_decode($content);
				$return = array();
				foreach($content as $key => $node) {
					if ($node->perms[$_SESSION['access_level']]) 
						array_push($return, $node);
				}

				for($i=0; $i<count($return); $i++) {
					for ($k=0; $k<count($return)-$i-1; $k++) {
						if ($return[$k]->order > $return[$k+1]->order) {
							$bubble = $return[$k];
							$return[$k] = $return[$k+1];
							$return[$k+1] = $bubble;
						}
					}
 				}
			}

			return $return;
		}

		function route($route) {
			$exploded = explode("/",$route);
			$accessible = true;
			$finished = false;
			$counter = 0;
			$path = info::$CONTENT_ROOT;

			while ($accessible && $counter<count($exploded)) {
				$accessible = false;
				if (is_file($path."/menu.json")) {
					$json = file_get_contents($path."/menu.json");
					$content = json_decode($json);
					foreach($content as $key=>$node) {
						if ($node->alias == $exploded[$counter] && isset($_SESSION['access_level']) && $node->perms[$_SESSION['access_level']]) {
							$path .= "/".$key;
							$accessible = true;
						}
					}
				}
			
				$counter++;
			}

			$path = $accessible ? $path : false;

			return $path;
		}
	}
?>