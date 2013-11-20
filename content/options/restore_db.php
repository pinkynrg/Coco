<h3> Ripristina Backup </h3>
<p> Da questa pagina &egrave; possibile ripristinare uno dei seguenti backup. </p>

<?php 
	
	echo "<form method='POST' action=''>";
	echo "<input type='hidden' value='restoreBackup' name='action'>";
	echo "<select name='backup' id='select_backup'>";
	
	foreach (helper::getContentPath("backups") as $backup)
		echo "<option value='".$backup."'>".$backup."</option>";
	
	echo "</select>";
	echo "<input type='submit'>";
	echo "</form>";

?>