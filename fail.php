<?php
session_start()
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Fail</title>
    </head>
    <body>
    <p><?php
				if (isset($_SESSION['errors'])) {
                    foreach($_SESSION["errors"] as $err)
                    {
                        echo $err."<br>";
                    }
					

					unset($_SESSION['errors']);
				}
				?>
			</p>
    </body>
</html>