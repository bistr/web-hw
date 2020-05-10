<?php

session_start();

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
	<form action="./form-validator.php" method="POST">
		<section>
			<label for="fname">Име</label>
			<input type="text" placeholder="Име" required id="fname" name="fname" pattern="[A-ZА-Яa-zа-я\-]{2,63}" value='<?php echo array_key_exists("fname", $fields) ? $fields["fname"] : ''; ?>'>
			<p><?php
				if (isset($_SESSION['fname'])) {
					echo $_SESSION['fname'];

					unset($_SESSION['fname']);
				}
				?>
			</p>
		</section>
		<hr>

		<section>
		<label for="lname">Фамилия</label>
		<input type="text" id="lname" placeholder="Фамилия" name="lname" pattern="[A-ZА-Яa-zа-я\-]{2,63}" required value='<?php echo array_key_exists("lname", $fields) ? $fields["lname"] : ''; ?>'>
		<p><?php
				if (isset($_SESSION['lname'])) {
					echo $_SESSION['lname'];

					unset($_SESSION['lname']);
				}
				?>
			</p>
	</section>
		<hr>


		<section>
			<label for="course-major">Специалност</label>
			<input type="text" id="course_major" name="course_major" required placeholder="Специалност" pattern="[A-ZА-Яa-zа-я\-\s,]{2,255}" value='<?php echo array_key_exists("course_major", $fields) ? $fields["course_major"] : ''; ?>'>
			
			<p><?php
				if (isset($_SESSION['course_major'])) {
					echo $_SESSION['course_major'];

					unset($_SESSION['course_major']);
				}
				?>
			</p>
		</section>
		<hr>

		<section>
		<label for="course_year">Курс</label>
		<input type="number" id="course_year" name="course_year" placeholder="Курс" pattern="\d+" required value='<?php echo array_key_exists("course_year", $fields) ? $fields["course_year"] : ''; ?>'>
		<p><?php
				if (isset($_SESSION['course_year'])) {
					echo $_SESSION['course_year'];

					unset($_SESSION['course_year']);
				}
				?>
	</section>
		<hr>

		<section>
		<label for="fac_number">Факултетен номер</label>
		<input type="text" id="fac_number" name="fac_number" placeholder="Факултетен номер" pattern="[A-ZА-Яa-zа-я\-0-9]{2,63}" required value='<?php echo array_key_exists("fac_number", $fields) ? $fields["fac_number"] : ''; ?>'>
		<p><?php
				if (isset($_SESSION['fac_number'])) {
					echo $_SESSION['fac_number'];

					unset($_SESSION['fac_number']);
				}
				?>
	</section>
		<hr>

		<section>
		<label for="group_number">Група</label>
		<input type="number" id="group-number" name="group_number" placeholder="Група" pattern="\d+" required value='<?php echo array_key_exists("group_number", $fields) ? $fields["group_number"] : ''; ?>'>
		<p><?php
				if (isset($_SESSION['group_number'])) {
					echo $_SESSION['group_number'];

					unset($_SESSION['group_number']);
				}
				?>
	</section>
		<hr>


		<section>
			<label for="birthdate">Дата на раждане</label>
			<input type="date" id="birthdate" name="birthdate" required placeholder="Дата на раждане" onchange="calculate_sign(event)" value='<?php echo array_key_exists("birthdate", $fields) ? $fields["birthdate"] : ''; ?>'>
			<input type="text" name="zodiac_sign" id="zodiac_sign" readonly value='<?php echo array_key_exists("zodiac_sign", $fields) ? $fields["zodiac_sign"] : ''; ?>'>
			<p><?php
				if (isset($_SESSION['birthdate'])) {
					echo $_SESSION['birthdate'];

					unset($_SESSION['birthdate']);
				}
				?>
			</p>
		</section>
		<hr>


		<section>
			<label for="photo">Снимка</label>
			<input type="file" id="photo" name="photo" required value='<?php echo array_key_exists("photo", $fields) ? $fields["photo"] : ''; ?>'>
			<p><?php
				if (isset($_SESSION['photo'])) {
					echo $_SESSION['photo'];

					unset($_SESSION['photo']);
				}
				?>
			</p>
		</section>
		<hr>
		<section>
			<label for="website">Уебсайт</label>
			<input type="url" id="website" name="website" maxlength="255" required value='<?php echo array_key_exists("website", $fields) ? $fields["website"] : ''; ?>'>
			<p><?php
				if (isset($_SESSION['website'])) {
					echo $_SESSION['website'];

					unset($_SESSION['website']);
				}
				?>
			</p>
		</section>
		<hr>
		<section>
			<label for="letter">Мотивационно писмо</label>
			<textarea id="letter" name="letter" rows="5" cols="40" required maxlength="65535" ><?php echo array_key_exists("letter", $fields) ? $fields["letter"] : ''; ?></textarea>
			<p><?php
				if (isset($_SESSION['letter'])) {
					echo $_SESSION['letter'];

					unset($_SESSION['letter']);
				}
				?>
			</p>
		</section>
		<section>
			<button>Изпрати</button>
		</section>

	</form>
</body>
<script type="text/javascript" src="calculate_sign.js" charset="UTF-8"></script>

</html>