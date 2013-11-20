<h3></h3>
<p>Questa &egrave; la pagina relativa al menu ed alle relative modifiche di nuovi contenuti.</p>

<?php
echo "<form method='POST' action=''>";
echo "<input type='hidden' value='pullMenu' name='action'>";
echo "<input type='submit' value='Pull Menu'>";
echo "</form>";

$header 	= array("Path","Etichetta","Alias","Tipo","Ordine","Permessi");
$widths 	= array("30%","20%","20%","10%","8%","10%");
$contents 	= $this->Model->getMenu(info::$CONTENT_ROOT);
$orders 	= array(null,null,null,null,null,null);
$colors 	= array("#000000","#000000","#000000","#000000","#000000","#000000");
$path 		= array('type' => 'hidden',	'name' => 'path', 'value' => null);
$labels		= array('type' => 'text',	'name' => 'label', 'value' => null, 'width' => "170px");
$alias 		= array('type' => 'text',	'name' => 'alias', 'value' => null, 'width' => "170px");
$order 		= array('type' => 'text',	'name' => 'order', 'value' => null, 'width' => "20px");
$perms 		= array('type' => 'text',	'name' => 'perms', 'value' => null, 'width' => "60px");

$inputs 	= array($path,$labels,$alias,null,$order,$perms);

$table = $this->View->newTable();
$table->setHeader($header);
$table->setWidths($widths);
$table->setContents($contents);
$table->setOrderLinks($orders);
$table->setColors($colors);
$table->setInputs($inputs);

echo "<br>";
echo "<form method='POST' action=''>";
echo "<input type='hidden' value='updateMenu' name='action'>";
echo $table->getTable();
echo "<input type='submit' value='Salva'>";
echo "</form>";

?>