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
	if( isset($_SESSION['fields']) )
	{
		$fields = $_SESSION['fields'];
	}
	else
	{
		$fields = array();
	}
	?>
    <form action="./form-validator.php" method="POST">
        <section>
            <div>
                <h4>Как се казвате?</h4>
            </div>
            <input type="text" placeholder="Име" name="fname" pattern="[A-ZА-Яa-zа-я\-]{2,63}" value='<?php echo array_key_exists("fname", $fields) ? $fields["fname"] : ''; ?>'>
            <input type="text" placeholder="Фамилия" name="lname" pattern="[A-ZА-Яa-zа-я\-]{2,63}" required value='<?php echo array_key_exists("lname", $fields) ? $fields["lname"] : ''; ?>'>
			<p><?php
				if( isset($_SESSION['fname']) )
				{
						echo $_SESSION['fname'];
			
						unset($_SESSION['fname']);
			
				}

				if( isset($_SESSION['lname']) )
				{
						echo $_SESSION['lname'];
			
						unset($_SESSION['lname']);
			
				}
			?>
			</p>
		</section>
        <hr>
        <section>
            <div>
                <h4>Какво учите?</h4>
            </div>
            <input type="text" name="course_major" placeholder="Специалност" pattern="[A-ZА-Яa-zа-я\-\s,]{2,255}" required value='<?php echo array_key_exists("course_major", $fields) ? $fields["course_major"] : ''; ?>'>
            <input type="number" name="course_year" placeholder="Курс" pattern="\d+" required value='<?php echo array_key_exists("course_year", $fields) ? $fields["course_year"] : ''; ?>'>
			<p><?php
				if( isset($_SESSION['course_major']) )
				{
						echo $_SESSION['course_major'];
			
						unset($_SESSION['course_major']);
			
				}

				if( isset($_SESSION['course_year']) )
				{
						echo $_SESSION['course_year'];
			
						unset($_SESSION['course_year']);
			
				}
			?>
			</p>
		</section>
        <hr>
        <section>
            <div>
                <h4>Информация</h4>
            </div>
            <input type="text" name="fac_number" placeholder="Факултетен номер" pattern="[A-ZА-Яa-zа-я\-0-9]{2,63}" required value='<?php echo array_key_exists("fac_number", $fields) ? $fields["fac_number"] : ''; ?>'>
            <input type="number" name="group_number" placeholder="Група" pattern="\d+" required value='<?php echo array_key_exists("group_number", $fields) ? $fields["group_number"] : ''; ?>'>
		</section>
		<p><?php
				if( isset($_SESSION['fac_number']) )
				{
						echo $_SESSION['fac_number'];
			
						unset($_SESSION['fac_number']);
			
				}

				if( isset($_SESSION['group_number']) )
				{
						echo $_SESSION['group_number'];
			
						unset($_SESSION['group_number']);
			
				}
			?>
			</p>
        <hr>
        <section>
            <div>
                <h4>Дата на раждане</h4>
            </div>
            <input type="date" name="birthdate" placeholder="Дата на раждане" required onchange="calculate_sign(event)" value='<?php echo array_key_exists("birthdate", $fields) ? $fields["birthdate"] : ''; ?>'>
            <input type="text" name="zodiac_sign" id="zodiac_sign" value='<?php echo array_key_exists("zodiac_sign", $fields) ? $fields["zodiac_sign"] : ''; ?>'>
			<p><?php
				if( isset($_SESSION['birthdate']) )
				{
						echo $_SESSION['birthdate'];
			
						unset($_SESSION['birthdate']);
			
				}

				if( isset($_SESSION['zodiac_sign']) )
				{
						echo $_SESSION['zodiac_sign'];
			
						unset($_SESSION['zodiac_sign']);
			
				}
			?>
			</p>
		</section>
        <hr>
        <section>
            <div>
                <h4>Снимка</h4>
            </div>
            <input type="file" name="photo" required value='<?php echo array_key_exists("photo", $fields) ? $fields["photo"] : ''; ?>'>
			<p><?php
				if( isset($_SESSION['photo']) )
				{
						echo $_SESSION['photo'];
			
						unset($_SESSION['photo']);
			
				}
			?>
			</p>
		</section>
        <hr>
        <section>
            <div>
                <h4>Уебсайт</h4>
            </div>
            <input type="url" name="website" maxlength="255" required value='<?php echo array_key_exists("website", $fields) ? $fields["website"] : ''; ?>'>
			<p><?php
				if( isset($_SESSION['website']) )
				{
						echo $_SESSION['website'];
			
						unset($_SESSION['website']);
			
				}
			?>
			</p>
		</section>
        <hr>
        <section>
            <div>
                <h4>Мотивационно писмо</h4>
            </div>
            <textarea name="letter" rows="5" cols="40" maxlength="65535" required value='<?php echo array_key_exists("letter", $fields) ? $fields["letter"] : ''; ?>'></textarea>
			<p><?php
				if( isset($_SESSION['letter']) )
				{
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