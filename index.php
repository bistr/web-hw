<?php

session_start();
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
	<form action="./form_validator.php" method="POST" enctype="multipart/form-data">

		<?php
		foreach (KEYS as $key) {
			$pattern = PATTERN[$key] . "{" . MIN_LENGTH[$key] . "," . MAX_LENGTH[$key] . "}";
			$field_type = FIELD_TYPE[$key];
			$required_flag = in_array($key, REQUIRED_FIELDS) ? 'required' : '';
			$readonly_flag = in_array($key, READONLY_FIELDS) ? 'readonly' : '';
			$value = array_key_exists($key, $fields) ? $fields[$key] : '';
			$asterisk_if_required = in_array($key, REQUIRED_FIELDS) ? '*' : '';

			echo "
			<section>
			<label for=" . $key . ">" . PRETTY_PRINT[$key].$asterisk_if_required. "</label>";
			if ($key != "letter") {
				echo "<input type=" . $field_type . " min='1' " . $required_flag . " " . $readonly_flag . " id=" . $key . " name=" . $key . " pattern = " . $pattern . " value = " . $value . ">";
			} else {
				echo "<textarea id=" . $key . " rows='5' cols='40' " . $required_flag . " " . $readonly_flag . " name=" . $key . " pattern = " . $pattern . ">" . $value . "</textarea>";
			};
			echo "
			<p>" . (isset($_SESSION[$key]) ? $_SESSION[$key] : '') . "</p>
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