<?php 

	class table {

		private $columns;
		private $widths;
		private $header;
		private $contents;
		private $inputs;
		private $legend;
		private $colors;
		private $borders;

		function __construct() {
			$this->cells = 0;
			$this->rows = 0;
			$this->extra_info = false;
		}

		private function error($err) {
			echo "<div class='error'>Table Class : ".$err."</div>";
		}

		public function setBorders($borders) {
			if (is_array($borders)) {
				$this->borders = $borders;
			}
			else
				$this->error("I bordi devono essere in formato array.");
		}

		public function setHeader($header) {
			if (is_array($header)) {
				$this->header  = $header;
				$this->columns = count($header);
			}
		}

		public function setOrderLinks($orders) {
			if (is_array($orders))
				$this->orders  = $orders;
		}

		public function setWidths($widths) {
			if (is_array($widths)) {
				$this->widths = $widths;
			} else $this->error("Larghezze delle colonne non valido.");
		}

		public function setContents($contents) {
			if (is_array($contents)) {
				$this->contents = $contents;
			}
			else 
				$this->error("contenuto della colonna non conforme.");
		}

		public function setInputs($inputs) {
			if (is_array($inputs)) {
				$this->inputs = $inputs;
			}
		}

		public function setExtraInfo($extras) {
			if (is_array($extras)) {
				$this->extras = $extras;
			}
		}

		public function setLegend($legend) {
			$this->legend = $legend;
		}

		public function setColors($colors) {
			$this->colors = $colors;
		}

		public function getLegend() {
			if (isset($this->legend)) {
				$legend = "<ul class='legend'>";
				$legend .= "<li class='header'><i class='fa fa-align-justify'></i> Legenda </li>";
				foreach ($this->legend as $key => $elem) {
					$legend .= "<li>";
					$legend .= "<span style='background-color:".$key."'></span> ".$elem;
					$legend .= "</li>";
				}

				$legend .= "</ul>";
			}

			else 
				$legend = "La legenda non e' stata settata.";

			return $legend;
		}

		public function getTable() {

			$header 	= $this->header;
			$widths 	= $this->widths;
			$contents 	= $this->contents;
			$inputs 	= $this->inputs;
			$legend 	= $this->legend;
			$colors 	= $this->colors;
			$orders 	= $this->orders;

			$table 	= "<ul class='list'>";
			$table .= "<li class='header_list' id='header_list'>";

			for ($i=0; $i<count($header); $i++) {
				if (isset($orders) && (!is_null($orders[$i])))  
					$table .= "<a href='index.php?route=".$_GET['route']."&orderby=".$orders[$i]."'><span style='width: ".$widths[$i]."'>".$header[$i]."</span></a>";
				else
					$table .= "<span style='width: ".$widths[$i]."'>".$header[$i]."</span>";
			}
			$table .= "</li>";

			$this->rows = 0;

			if ( isset($contents) && !empty($contents) ) {
			
				foreach ($contents as $row) {
					$this->cells = 0;
					$table .= "<li class='row_list'>";

					foreach ($row as $elem) {
						$border = $this->borders[$this->cells] ? "border-right:1px solid #666666; " : "";//"border-right:1px solid #EEEEEE; ";
						$table .= "<span style='".$border."color:".$colors[$this->cells]."; width: ".$widths[$this->cells]."'>";
					
						if (isset($inputs[$this->cells])) {
							
							switch ($inputs[$this->cells]['type']) {
								case 'hidden': 	$table .= $this->getHiddenTextbox($inputs[$this->cells],$elem, $colors[$this->cells]); break;
								case 'text' : 	$table .= $this->getTextbox($inputs[$this->cells],$elem, $colors[$this->cells]); break;
								case 'select' : $table .= $this->getSelect($inputs[$this->cells],$elem, $colors[$this->cells]); break;
								default: break;
							}

						}

						else 
							if ($elem)
								$table .= $elem;
							else
								$table .= "-";

						$table .= "</span>";

						$this->cells++;
					}
					$table .= "</li>";

					if ($this->extra_info) {

						$table .= "<li class='extra_info_wrapper'>";

						$table .= "<div class='extra_info'>";

						$table .= "<h4>Informazioni Aggiuntive</h4>";

						$table .= "<ul>";

							foreach($this->extra_info[$this->rows] as $key => $extra_info) {
								$table .= "<li><label>".$key."</label> : ".$extra_info."</li>";
							}

						$table .= "</ul>";

						$table .= "</div>";

						$table .= "</li>";

					}

					$this->rows++;
				}
			} else $table .= "<div class='empty'>Questa tabella &egrave; vuota.</div>";
			
			$table .= "</ul>";

			return $table;
		}

		function getSelect($input, $value, $color) {

			$style = "color:".$color."; ";
			$style .= isset($input['width']) ? "width:".$input['width']."; " : "width:100px; ";
			$style .= isset($input['height']) ? "height:".$input['height']."; " : "height:20px; ";
			
			$select = "<select name='".$input['name']."_".$this->rows."' style='".$style."'>";
			$select .= "<option value=''></option>";
			
			foreach ($input['options'] as $option) { 
				$selected = ($value == $option[0]) ? "selected" : "";
				$select .= $value."<option value='".$option[0]."' ".$selected.">".$option[1];
				$select .= $input['id'] ? "(".$option[0].") " : "";
				$select .= "</option>";
			}
			$select .= "</select>";
			return $select;
		}

		function getTextbox($input, $value, $color) {

			$style = "color:".$color."; ";
			$style .= isset($input['width']) ? "width:".$input['width']."; " : "width:60px; ";
			$style .= isset($input['height']) ? "height:".$input['height']."; " : "height:15px; ";

			$textbox = "<input type='".$input['type']."' name='".$input['name']."_".$this->rows."' value='".$value."' style='".$style."'>";
			return $textbox;
		}

		function getHiddenTextbox($input, $value, $color) {

			$style = "color:".$color."; ";
			$style .= isset($input['width']) ? "width:".$input['width']."; " : "width:60px; ";
			$style .= isset($input['height']) ? "height:".$input['height']."; " : "height:15px; ";

			$textbox = "<input type='".$input['type']."' name='".$input['name']."_".$this->rows."' value='".$value."' style='".$style."'>";
			$textbox .= $value;
			return $textbox;
		}

	}

?>