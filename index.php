<?php

session_start();
$_SESSION["errors"] = array();
include "./config.php";

?>
<!DOCTYPE html>
<html>

<head>
	<title> Web HW </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="index.css">
</head>

<body>
	<?php
	if (isset($_SESSION['fields'])) {
		$fields = $_SESSION['fields'];
		unset($_SESSION['fields']);
	} else {
		$fields = array();
	}
	?>
	<form action="./form-validator.php" method="POST" enctype="multipart/form-data">

	<?php
		foreach(KEYS as $key)
		{
			echo "
			<section>
			<label for=".$key.">".PRETTY_PRINT[$key]." ".(in_array($key, REQUIRED_FIELDS) ? '*' : '')."</label>";
			if ($key != "letter")
			{
				echo "<input type=".FIELD_TYPE[$key]." ".(in_array($key, REQUIRED_FIELDS) ? 'required' : '')." ".(in_array($key, READONLY_FIELDS) ? 'readonly' : '')." id=".$key." name=".$key." pattern = ".PATTERN[$key]." value = ".(array_key_exists($key, $fields) ? $fields[$key] : '').">";
			}
			else
			{
				echo "<textarea id=".$key." rows='5' cols='40' ".(in_array($key, REQUIRED_FIELDS) ? 'required' : '')." ".(in_array($key, READONLY_FIELDS) ? 'readonly' : '')." name=".$key." pattern = ".PATTERN[$key].">".(array_key_exists($key, $fields) ? $fields[$key] : '')."</textarea>";
			};
			echo "
			<p>".(isset($_SESSION[$key])?$_SESSION[$key]:'')."</p>
			</section>
			<hr>";

			if (isset($_SESSION[$key])) {
				unset($_SESSION[$key]);
			}
		}


		?>


		<section>
			<button>Изпрати</button>
		</section> 
	</form>
</body>
<script type="text/javascript" src="calculate_sign.js" charset="UTF-8"></script>
<script type="text/javascript" src="add_onchange_hook.js" charset="UTF-8"></script>
<script type="text/javascript" src="set_max_date.js" charset="UTF-8"></script>

</html>