<?php
	
	class helper {
		static function show($data) {
			echo "<pre>";
			print_r($data);
			echo "</pre>";
		}

		static function bold($bolded) {
			echo "<b>".$bolded."</b>";
		}

		static function getObjProp($obj) {
			$properties = array();
			foreach($obj as $prop => $elem)
				$properties[] = $prop;
			return $properties;
		}

		static function transpose($array) {
		    array_unshift($array, null);
		    return call_user_func_array('array_map', $array);
		}

		static function getContentPath($path) {

			if (is_file($path)) {
				$exploded = explode("/",$path);
				unset($exploded[count($exploded)-1]);
				$path = implode($exploded);
			}
 
			$content = scandir($path);

			// delete extra stuff inside directory
			foreach ($content as $key=>$value) {
				if (($value==".")||($value=="..")||($value==".DS_Store")) {
					unset($content[$key]);
				} 
			}

			// fills the empty index left by unset
			$content = array_values($content);

			return $content;
		}
	}



?>