<h3> Gestione livelli d'accesso utente </h3>

<p> Di seguito &egrave; possibile gestire i livelli d'accesso dell'utenza. </p>

<?php 

$query = "SELECT * FROM access_levels";
$this->Model->db->setQuery($query);
$this->Model->db->query(false);
$levels = $this->Model->db->result;

$query = "	SELECT id,`name`, lastname, username, access_level
			FROM users as u
			LEFT JOIN access_levels as al ON al.grade = u.access_level";

$this->Model->db->setQuery($query);
$this->Model->db->query();
$contents = $this->Model->db->result;

$header   		= array("Id","Nome","Cognome","Username","Livello d'accesso");
$widths   		= array("5%","23%","24%","24%","24%");
$colors 		= array("#000000","#000000","#000000","#000000","#000000");
$access_levels 	= array('type' => 'select', 'name' => 'level', 'selected' => null, 'options' => $levels, 'width' => '120px', 'id' => true);
$ids 			= array('type' => 'hidden',	'name' => 'id', 'value' => null);
$inputs 		= array($ids,null,null,null,$access_levels);
$orders 		= array(null,null,null,null,null);

$table = $this->View->newTable();
$table->setHeader($header);
$table->setWidths($widths);
$table->setContents($contents);
$table->setColors($colors);
$table->setOrderLinks($orders);
$table->setInputs($inputs);

echo $this->View->getSearchbox();
echo "<form method='POST' action=''>";
echo "<input type='hidden' value='updateAccessLevels' name='action'>";
echo $table->getTable();
echo "<input type='submit'>";
echo "</form>";

?>
