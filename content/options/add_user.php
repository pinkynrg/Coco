<h3>Aggiungi Utente</h3>

<?php 
	$query = "SELECT * FROM access_levels";
	$this->Model->db->setQuery($query);
	$this->Model->db->query(false);
	$access_levels = $this->Model->db->result;

	function getSelect($options, $name) {
			
	$select = "<select name='".$name."'>";
	$select .= "<option value=''></option>";
	
	foreach ($options as $option) 
		$select .= "<option value='".$option[0]."'>".$option[1]." (".$option[0].") </option>";
	
	$select .= "</select>";
	return $select;
}
?>

<form class="short" method="POST" action="">

	<input type="hidden" value="addUser" name="action">

	<div> <label for="nome"> Nome <span style='color:red; font-size:12px'>*</span> </label> <input type="text" name="nome"> </div>
	<div> <label for="cognome"> Cognome <span style='color:red; font-size:12px'>*</span> </label> <input type="text" name="cognome"> </div>
	<div> <label for="username"> Username <span style='color:red; font-size:12px'>*</span> </label> <input type="text" name="username"> </div>
	<div> <label for="e-mail"> E-mail <span style='color:red; font-size:12px'>*</span> </label> <input type="text" name="email"> </div>
	<div> <label for="password"> Password <span style='color:red; font-size:12px'>*</span> </label> <input type="password" name="password"> </div>
	<div> <label for="password2"> Ripetere Password <span style='color:red; font-size:12px'>*</span> </label> <input type="password" name="password2"> </div>
	<div> <label for="access_level"> Accesso <span style='color:red; font-size:12px'>*</span> </label> <?php echo getSelect($access_levels, "access_level"); ?> </div>
	<input type="submit" value="Aggiungi utente">

</form>