<?php 

class smartCSV {

	function CSVtoArray($link, $separator) {
		$array = array();
		if (file_exists($link) && is_readable($link)) {
			if (($handle = fopen($link, 'r')) !== FALSE) {
				while (($row = fgetcsv($handle, 1000, $separator)) !== FALSE)
					$array[] = $row;
			}
		}
		return $array;
	}
}

?>