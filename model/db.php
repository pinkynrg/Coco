<?php 

class DB {

	function __construct() {
		
		$this->thin = false;
		
		$this->con = mysqli_connect(info::$DB_HOST , info::$DB_USER , info::$DB_PASS , info::$DB_SCHEMA);
		
		$this->con->set_charset("utf8");
		
		if ($this->err = mysqli_connect_errno($this->con))
			return "Error: failed to connect to MySQL: ".mysqli_connect_error().".";
		else 
			return "Connection established.";
	}

	function setQuery($query) {
		$this->query = $query;
	}

	function multiquery() {
		$this->query = explode(";",$this->query);
		foreach($this->query as $query) {
			if (trim($query)) {
				$this->setQuery($query);
				$result = $this->query();
				if (!$result->type) break;
			}
		}

		if ($result->type)
			$result = new alert(1,"Query eseguita con successo.");

		return $result;
	}

	function query($obj = true) {

		if ($result = mysqli_query($this->con, $this->query)) {
			
			$rows = 0;
			$cols = 0;
			
			if (!is_bool($result)) {
				
				$this->result = array();

				if ($obj) {
					while ($row = mysqli_fetch_object($result)) {
						$this->result[$rows] = $row;
						$rows++;
					}
					
				}
				else {
					while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
						$this->result[$rows] = $row;
						$rows++;
					}
				}

				if ($this->thin) {
					if (isset($this->result[0])) {
						if(count((array)$this->result[0]) < 2) {
								
							$column = array();
							$name = helper::getObjProp($this->result[0]);
							
							foreach ($this->result as $row)
								foreach($row as $elem)
									$column[] = $elem;

							if (count($column) < 2) $column = $column[0];

							$this->result = new stdClass();
							
							if ($name[0] != '0')
								$this->result->{$name[0]} = $column;
							else
								$this->result = $column;
						}
					} 
					else
						$this->result = array();
				}

				mysqli_free_result($result);	
			} 

			
			$result =  new alert(1, "Query eseguita con successo.");
		}
		else $result = new alert(0, "Si &egrave; verificato un errore con il DB : ".mysqli_error($this->con));

		return $result;
	}
}

?>