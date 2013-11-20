<?php

	if (!class_exists("DB")) 		require("model/db.php");
	if (!class_exists("smartCSV")) 	require("model/smartCSV.php");
	if (!class_exists("error")) 	require("model/alert.php");
	if (!class_exists("PHPExcel")) 	require("view/PHPExcel/PHPExcel.php");	

	class Model {
		function __construct($controller) {
			$this->controller = $controller;
			$this->db = new DB();
			$this->csvHelper = new smartCSV();
		}

		function checkAuth() {

			$username = $_POST['username'];
			$password = $_POST['password'];

			if (isset($username)&&(isset($password))) {
				if (($username!="")&&($password!="")) {

					$conn = new PDO('mysql:dbname='.info::$DB_SCHEMA.';host='.info::$DB_HOST.';charset=utf8', info::$DB_USER, info::$DB_PASS);
					$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

					$query = $conn->prepare("SELECT * FROM `users` WHERE `username` = :username AND `password` = :password");

					$query->bindParam(':username', $_POST['username']);
					$query->bindParam(':password', $_POST['password']);

					$query->execute();

					$query_result = $query->fetch();

					if ($query_result['username'] != "") {
						$this->setupSession($query_result['username'], $query_result['name'], $query_result['lastname'], $query_result['access_level']);
						$result = new alert(1,"Accesso effettuato con successo.");
					} 
					else $result = new alert(0,"Nome utente e / o password errato.");
				}
				else
					$result = new alert(2,"Campi vuoti non validi.");
			}
			else
				$result = new alert(2,"Campi nulli non validi.");;

			return $result;
		}

		function setupSession($username, $firstname, $lastname, $access_level) {
			$_SESSION['username']  = $username;
			$_SESSION['firstname'] = $firstname;
			$_SESSION['lastname']  = $lastname;
			$_SESSION['access_level'] = $access_level;
		}

		function getSession() {
			return isset($_SESSION['username']);
		}

		function dropTable($name) {
			$this->db->setQuery("drop table `".$name."`;");
			return $this->db->query();
		}

		function emptyTable($name) {	
			$this->db->setQuery("delete from `".$name."`;");
			return $this->db->query();
		}

		function createTable($name, $header, $pk) {

			$query = " CREATE  TABLE `".$name."` (";
			if ($pk == -1) 
				$query .= "`id` INT NOT NULL AUTO_INCREMENT,";
			for ($i = 0; $i < count($header); $i++)
				$query .= " `".$header[$i]."` VARCHAR(200) NULL,";
	
			if ($pk == -1) 
				$query .= "PRIMARY KEY (`id`) );";
			else
				$query .= "PRIMARY KEY (`".$header[$pk]."`) );";

			$this->db->setQuery($query);

			return $this->db->query();
		}

		function insertIntoTable($name, $where, $content) {

			$result = true;

			$query_constant = "INSERT INTO `".$name."` (";
			
			for ($i=0; $i<count($where); $i++) {
				$query_constant .= "`".$where[$i]."`";
				if ($i<count($where)-1)
					$query_constant .= ",";
				else $query_constant .= ") VALUES (";
			}

			for ($i=0; $i<count($content); $i++) {
				$query = $query_constant;
				for ($k=0; $k<count($content[$i]); $k++) {
					$query .= "'".addslashes($content[$i][$k])."'";
					if ($k<count($content[$i])-1) 
						$query .= ",";
					else $query .= ");";
				}

				$this->db->setQuery($query);
				
				if ($result) $result = $this->db->query();
			}

			return $result;
		}

		function getFile($types = array(), $extentions = array(), $size = 1048576) {
			
			if (is_array($types) && is_int($size)) {
			
				if ($_FILES["file"]["type"] != "") {
					
					$temp = explode(".", $_FILES["file"]["name"]);
					$extension = end($temp);
					$valid_type = false;
					
					foreach ($types as $type) {
						if (!$valid_type) 
							$valid_type = ($_FILES["file"]["type"] == $type) ? true : false;
					}

					if ($valid_type) {
						
						if ($_FILES["file"]["size"] <= $size) {
						
							if (!$_FILES["file"]["error"]) {
								
								$this->file = $_FILES["file"]["tmp_name"];

								$result = new alert(1, "L'upload del file &egrave; avvenuto con sucesso.");

							} else $result = new alert(0, "Si &egrave; manifestato il seguente errore: ".$_FILES["file"]["error"]);
						
						} else $result = new alert(2, "Il file &egrave; superiore ad un ".($size/1024)."Kb di larghezza. Upload non consentito.");
					
					} else $result = new alert(0, "I file di questo tipologia non sono accettati. Solo ".implode(", ", $extentions )." ammessi.");
				
				} else $result = new alert(2, "Selezionare un file dal proprio computer prima di effettuare un upload.");
			
			} else $result = new alert(0, "il setup dei types, delle extentions, o della size non &egrave; valido.");
			
			return $result;
		}

		function CSVtoSql($link, $separator, $name, $pk, $drop = false, $cols = null, $header = null) {

			$content = $this->csvHelper->CSVtoArray($link, $separator);
			$passed = true;

			if ($content) {
				if (is_null($header)) {
					$header = $content[0];
					unset($content[0]);
					$content = array_values($content);
				}

				if ((isset($content[0])) && (count($header)==count($content[0]))) {
					
					if (!(isset($cols) && $cols != count($header))) {
						
						if ($drop) {
							$this->dropTable($name); 
							$result = $this->createTable($name, $header, $pk);
						}

						if (($drop && $result->type) || (!$drop)) {
							$result = $this->insertIntoTable($name, $header, $content);
						}
						
						else $result = new alert(0, "Problemi con il drop ed il create della nuova tabella.");
				
					} else $result = new alert(0, "Il numero di colonne in questo file non &egrave; conforme. Selezionare un file con ".$cols." colonne. Il tuo file &egrave; ".count($content[0])." colonne.");
			
				} else $result = new alert(0, "Problemi con il set dell'header del CSV o il file CSV &egrave; privo di contenuti.");
			
			} else $result = new alert(0,"Problemi con la conversione del file CSV.");

			return $result;
		}

		function updateAccessLevels() {
			$counter = count($_POST)/2;

			for ($i = 0; $i < $counter; $i++) {

				$query =  "UPDATE `users` SET `access_level`='".$_POST["level_".$i]."'";
				$query .= "WHERE `id`='".$_POST["id_".$i]."'";
				
				$this->db->setQuery($query);
				$result = $this->db->query(); 

				if ($result->type)
					$result = new alert(1,"Aggiornamento degli accessi effettuato con successo.");
			}

			return $result;
		}

		function updateCalendar() {
			$counter = count($_POST)/9;

			for ($i = 0; $i < $counter; $i++) {

				$query = "UPDATE `missions` SET `agente`='".$_POST["agent_".$i]."', `esito1`='".$_POST["outcome1_id_".$i]."',  `esito2`='".$_POST["outcome2_id_".$i]."', `esito3`='".$_POST["outcome3_id_".$i]."', `status`='".$_POST["status_".$i]."'";
				$query .= ($_POST["date1_".$i] != '') ? ", `data1`=STR_TO_DATE('".$_POST["date1_".$i]."','%d/%m/%y')" : ", `data1`=NULL";
				$query .= ($_POST["date2_".$i] != '') ? ", `data2`=STR_TO_DATE('".$_POST["date2_".$i]."','%d/%m/%y')" : ", `data2`=NULL";
				$query .= ($_POST["date3_".$i] != '') ? ", `data3`=STR_TO_DATE('".$_POST["date3_".$i]."','%d/%m/%y')" : ", `data3`=NULL";
				$query .= " WHERE `ragione_sociale`='".$_POST["mission_".$i]."'";
				
				$this->db->setQuery($query);
				$this->db->query();
			}

			return new alert(1,"Modifiche effettuate con successo.");
		}

		function addMission() {
			if ($_POST['agenzia']!='')
				if($_POST['agente']!='')
					if($_POST['ragione_sociale']!='')
						if ($_POST['provincia']!='')
							if ($_POST['telefono']!='')
								if ($_POST['referente']!='')
									if ($_POST['ruolo']!='')
										if($_POST['data']!='')
											if ($_POST['ora']!='') {
												
												$query = "INSERT INTO missions (`agenzia`, `ragione_sociale`, `indirizzo`, `comune`, `provincia`, `telefono`, `referente`, `ruolo`, `data1`, `agente`, `esito1`) VALUES ('".$_POST['agenzia']."', '".$_POST['ragione_sociale']."', '".$_POST['indirizzo']."', '".$_POST['comune']."', '".$_POST['provincia']."', '".$_POST['telefono']."', '".$_POST['referente']."', '".$_POST['ruolo']."', STR_TO_DATE('".$_POST['data']."','%d/%m/%y'), '".$_POST['agente']."', '".$_POST['esito']."');";
												$this->db->setQuery($query);
												$result = $this->db->query();
												if ($result->type) $result = new alert(1,"Missione aggiunta con successo.");
											}
											else $result = new alert(0,"L'ora della missione deve essere inserita.");
										else $result = new alert(0,"La data dell'appuntamento deve essere inserita.");
									else $result = new alert(0,"Il ruolo del referente deve essere inserito.");
								else $result = new alert(0,"Il referente deve essere inserito.");
							else $result = new alert(0,"Il telefono dev'essere inserito.");
						else $result = new alert(0,"La provincia deve essere inserita.");						
					else $result = new alert(0,"La ragione sociale deve essere inserita.");
				else $result = new alert(0,"L'agente responsabile a questa missione dev'essere selezionato.");
			else $result = new alert(0,"L'agenzia emettente la missione dev'essere inserita.");

			return $result;
		}

		function uploadMissions() {
			$types = array("text/csv","text/txt","application/vnd.ms-excel");
			$exts = array("csv");
			$cols = 12;
			$added = 0;

			$result = $this->getFile($types,$exts);

			if ($result->type == 1) {
				$csv = $this->file;
				$contents = $this->csvHelper->CSVtoArray($csv, ",");
				if ( isset($contents[0]) && (count($contents[0])<2) )
					$contents = $this->csvHelper->CSVtoArray($csv, ";");

				foreach($contents as $key=>$row) {
					foreach($row as $key2=>$elem) {
						$contents[$key][$key2] = iconv( "Windows-1252", "UTF-8", addslashes($contents[$key][$key2]));
					}
				}

				if (isset($contents[0])) {
					if (count($contents[0]) == 12) {
						
						unset($contents[0]);
						$contents = array_values($contents);

						for($i=0; $i<count($contents); $i++) {

							$query = "SELECT count(*) as count FROM missions WHERE ragione_sociale = '".$contents[$i][2]."'";
							$this->db->setQuery($query);
							$this->db->query();

							if (!($this->db->result[0]->count)) {

								if ($contents[$i][0]!='') {
									$query = "SELECT id FROM agencies WHERE agency LIKE '%".trim($contents[$i][0])."%'";
									$this->db->setQuery($query);
									$this->db->query();
									$contents[$i][0] = isset($this->db->result[0]->id) ? $this->db->result[0]->id : "?";
								}

								if ($contents[$i][1]!='') {
									$query = "SELECT id FROM agents WHERE nome_agente LIKE '%".trim($contents[$i][1])."%'";
									$this->db->setQuery($query);
									$this->db->query();
									$contents[$i][1] = isset($this->db->result[0]->id) ? $this->db->result[0]->id : "?";
								}

								if ($contents[$i][11]!='') {
									$query = "SELECT id FROM outcomes WHERE outcome LIKE '%".trim($contents[$i][11])."%'";
									$this->db->setQuery($query);
									$this->db->query();
									$contents[$i][11] = isset($this->db->result[0]->id) ? $this->db->result[0]->id : "?";
								}

								$query = "INSERT INTO missions (`agenzia`, `ragione_sociale`, `indirizzo`, `comune`, `provincia`, `telefono`, `referente`, `ruolo`, `data1`, `agente`, `esito1`) VALUES ('".$contents[$i][0]."', '".$contents[$i][2]."', '".$contents[$i][3]."', '".$contents[$i][4]."', '".$contents[$i][5]."', '".$contents[$i][6]."', '".$contents[$i][7]."', '".$contents[$i][8]."', STR_TO_DATE('".$contents[$i][9]."','%d/%m/%Y'), '".$contents[$i][1]."', '".$contents[$i][11]."');";
								$this->db->setQuery($query);
								
								if ($this->db->query()) {
									$added++;
									$result = new alert(1,"Inserimento di ".$added." nuovi appuntamenti avvenuto con successo.");
								}
							}
						}

						if ($added == 0)
							$result = new alert(2,"Non sono stati inseriti nuovi appuntamenti. File privo di nuove informazioni.");
						else
							$result = new alert(1,"Inserimento di ".$added." nuovi appuntamenti avvenuto con successo.");

					} else $result = new alert(0,"Il numero di colonne del CSV incorretto. Il numero delle colonne dev'essere ".$cols." ed ora &egrave; ".count($contents[0]));
				
				} else $result = new alert(2,"Il file CSV &egrave; risulta vuoto. Non sono stati inseriti dati.");

			}
			return $result;
		}

		function backup($tables = '*'){
			
			$this->db->thin =true;

			$return = "";

			//get all of the tables
			if($tables == '*') {
				$tables = array();
				$this->db->setQuery('SHOW TABLES');
				$this->db->query(false);
				$tables = $this->db->result;
			}
			else {
				$tables = is_array($tables) ? $tables : explode(',',$tables);
			}
			
			//cycle through
			foreach($tables as $table) {
				$return .= "DROP TABLE IF EXISTS `".$table."`;\n\n";
				$this->db->setQuery("SHOW CREATE TABLE ".$table);
				$this->db->query(false);
				$return .= $this->db->result[0][1].";\n";

				$this->db->setQuery("SELECT * FROM ".$table);
				$this->db->query(false);

				$result = $this->db->result;
				$num_fields = isset($this->db->result[0]) ? count($this->db->result[0]) : 0;

				$return .= "\n\nLOCK TABLES `".$table."` WRITE;\n\n";

				foreach($result as $row) {
					
					$return .= "INSERT INTO ".$table." VALUES(";

					for ($i=0; $i<$num_fields; $i++) {
						$row[$i] = str_replace("\n","\\n",addslashes($row[$i]));
						$return .= (isset($row[$i]) && ($row[$i] != '')) ? "'".$row[$i]."'" : "NULL";
						$return .= ($i < ($num_fields-1)) ? "," : "";
					}

					$return .= ");\n\n";
				}

				$return.="UNLOCK TABLES;\n\n\n";

				$this->db->thin =false;

			}
			
			//save file
			$handle = @fopen('backups/db-backup-'.info::$ALIAS.'-'.date("d.m.Y-H.i.s").'.sql','wb');
			
			if ($handle) {
				$result = @fwrite($handle,$return);
				if ($result) {
					$result = @fclose($handle);
					if ($result) {
					
						$result = new alert(1,"Backup effettuato con successo.");
				
					} else $result = new alert(0,"Qualcosa &egrave; andato storto durante la scittura del file.");
			
				} else $result = new alert(0,"Qualcosa &egrave; andato storto durante la scittura del file.");
		
			} else $result = new alert(0,"Non ci sono i permessi necessari di scrittura sulla cartella backups.");
		
			return $result;
		}

		function restoreBackup() {
			if (isset($_POST['backup'])) {
				$path = "backups/".$_POST['backup'];
				$query = file_get_contents($path);
				$this->db->setQuery($query);
				$result = $this->db->multiquery();
				if ($result->type)
					$result = new alert(1,"Restore dei dati effettuato con successo.");
			}
			else {
				$result = new alert(0,"Non &egrave; stato potuto effettuare il restore dei dati.");
			}

			return $result;
		}

		function scanDirectory($dir, $show_all = false) {
			$scan = scandir($dir);
			$accepted = array("directory","text/x-php","text/html","text/plain","inode/x-empty");
			$black_list = array(".","..","download_excel.php","home.php","menu.json","how_to_csv.php");

			foreach($scan as $key => $node) {
				if (!in_array(finfo_file(finfo_open(FILEINFO_MIME_TYPE),$dir."/".$node), $accepted)) {
					unset($scan[$key]);
				}
				else if (in_array($node, $black_list))
					unset($scan[$key]);
				else if ($show_all){
					$scan[$key] = $dir."/".$scan[$key];
				}
			}

			array_values($scan);

			return $scan;
		}

		function pullMenu($root) {
			$counter = 0;
			$scan = $this->scanDirectory($root);

			if (file_exists($root."/menu.json")) {
				$old_map = file_get_contents($root."/menu.json");
				$old_map = json_decode($old_map);
			}
			else 
				$old_map = new stdClass();

			$map = new stdClass();
			
			foreach($scan as $node) {

				$map->{$node} = new stdClass();
				$map->{$node}->url = $root."/".$node;
				$map->{$node}->label = isset($old_map->{$node}->label) ? $old_map->{$node}->label : $node;
				$map->{$node}->alias = isset($old_map->{$node}->alias) ? $old_map->{$node}->alias : $node;
				$map->{$node}->type  = finfo_file(finfo_open(FILEINFO_MIME_TYPE),$root."/".$node);
				$map->{$node}->order = isset($old_map->{$node}->order) ? $old_map->{$node}->order : $counter;
				$map->{$node}->perms = isset($old_map->{$node}->perms) ? $old_map->{$node}->perms : "10000";

				
				$counter++;
			}
			
			$handle = @fopen($root."/menu.json","wb");
				
			if ($handle)
				$result = fwrite($handle, json_encode($map,JSON_PRETTY_PRINT));
			else 
				

			foreach($scan as $node) {
				if (is_dir($root."/".$node)) {
					$this->pullMenu($root."/".$node);
				}
			}

			return new alert(1,"L'upload dei contenuti &egrave; avvenuto con successo.");
		}


		function getMenu($root, &$all = array()) {
			
			if ($root == info::$CONTENT_ROOT) {
				$json = json_decode(file_get_contents(info::$CONTENT_ROOT."/menu.json"));
				foreach ($json as $key => $elem) {
					$all[info::$CONTENT_ROOT."/".$key] = $elem;
				}
			}
			
			$content = $this->scanDirectory($root, true);
			
			foreach ($content as $node) {
				if (is_dir($node) && (file_exists($node."/menu.json"))) {
					$json = json_decode(file_get_contents($node."/menu.json"));
					foreach ($json as $key => $elem) {
						$all[$node."/".$key] = $elem;
					}
					$this->getMenu($node, $all);
				}
 			}
			return $all;
		}

		function updateMenu() {
			$counter = count($_POST)/5;
			for($i=0; $i<$counter; $i++) {

				$path = $_POST["path_".$i];
				$exploded = explode("/", $path);
				unset($exploded[count($exploded)-1]);
				$exploded = array_values($exploded);
				$path = implode("/",$exploded);

				$file = $_POST["path_".$i];
				$exploded = explode("/", $file);
				$file = $exploded[count($exploded)-1];

				$nodes = json_decode(file_get_contents($path."/menu.json"));

				$nodes->{$file}->label = $_POST["label_".$i];
				$nodes->{$file}->alias = $_POST["alias_".$i];
				$nodes->{$file}->order = $_POST["order_".$i];
				$nodes->{$file}->perms = $_POST["perms_".$i];

				$handle = fopen($path."/menu.json","wb");
				$result = fwrite($handle, json_encode($nodes));
			}
		}

		function downloadExcel() {
		
			if (isset($_SESSION['matrix'])) {

				$data = $_SESSION['matrix'];

				$data = array(array(1,2,3),array(4,5,6),array(7,8,9));

				$objPHPExcel = new PHPExcel();

				$objPHPExcel->getActiveSheet()->fromArray($data, NULL, 'A1');

				header_remove('Cache-Control');
				header_remove('Content-Length');
				// Redirect output to a clients web browser (Excel5)
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="test.xls"');
				header('Cache-Control: max-age=0');
				// If you're serving to IE 9, then the following may be needed
				header('Cache-Control: max-age=1');

				// If you're serving to IE over SSL, then the following may be needed
				header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
				header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
				header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
				header ('Pragma: public'); // HTTP/1.0

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save("php://output");

				die();
			
			}
		}
	}
?>