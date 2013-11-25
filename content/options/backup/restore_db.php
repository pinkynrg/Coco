<h3> Ripristina Backup </h3>

<?php if (count(helper::getContentPath("backups"))) : ?>

	<p> Da questa pagina &egrave; possibile ripristinare uno dei seguenti backup. </p>

	<form method='POST' action=''>
	<input type='hidden' value='restoreBackup' name='action'>
	<select name='backup' id='select_backup'>

	<?php 
	foreach (helper::getContentPath("backups") as $backup)
		echo "<option value='".$backup."'>".$backup."</option>";
	?>

	</select>
		<input type='submit'>
	</form>

<?php else : ?>

	Non sono presenti backup da cui poter ripristinare il sistema.

<?php endif; ?>
