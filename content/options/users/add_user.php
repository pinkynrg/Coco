<?php 
	$query = "SELECT * FROM access_levels";
	$this->Model->setQuery($query);
	$this->Model->query(false);
	$access_levels = $this->Model->result;

	$nome = isset($_POST['nome']) ? $_POST['nome'] : "";
	$cognome = isset($_POST['cognome']) ? $_POST['cognome'] : "";
	$username = isset($_POST['username']) ? $_POST['username'] : "";
	$email = isset($_POST['email']) ? $_POST['email'] : "";
	$access_level = isset($_POST['access_level']) ? $_POST['access_level'] : "";

	function getSelect($options, $name, $selected) {
			
	$select = "<select name='".$name."'>";
	$select .= "<option value=''></option>";
	
	foreach ($options as $option) 
		if ($selected == $option[0])
			$select .= "<option value='".$option[0]."' selected>".$option[1]." (".$option[0].") </option>";
		else
			$select .= "<option value='".$option[0]."'>".$option[1]." (".$option[0].") </option>";

	$select .= "</select>";
	return $select;
}
?>

<form class="short" method="POST" action="">

	<input type="hidden" value="addUser" name="action">

	<div> <label for="nome"> Nome </label> <input type="text" name="nome" value="<?php echo $nome; ?>"> <span class="mandatory_field"> - obbligatorio </span></div>
	<div> <label for="cognome"> Cognome  </label> <input type="text" name="cognome" value="<?php echo $cognome; ?>"> <span class="mandatory_field"> - obbligatorio </span></div>
	<div> <label for="username"> Username </label> <input type="text" name="username" value="<?php echo $username; ?>"> <span class="mandatory_field"> - obbligatorio </span></div>
	<div> <label for="e-mail"> E-mail </label> <input type="text" name="email" value="<?php echo $email; ?>"> <span class="mandatory_field"> - obbligatorio </span></div>
	<div> <label for="password"> Password </label> <input type="password" name="password"> <span class="mandatory_field"> - obbligatorio </span></div>
	<div> <label for="password2"> Ripetere Password </label> <input type="password" name="password2"> <span class="mandatory_field"> - obbligatorio </span></div>
	<div> <label for="access_level"> Accesso </label> <?php echo getSelect($access_levels, "access_level", $access_level); ?> <span class="mandatory_field"> - obbligatorio </span></div>
	<input type="submit" value="Aggiungi utente">

</form>