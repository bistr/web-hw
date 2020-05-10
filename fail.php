<?php
session_start();
include "./config.php";
?>

<!DOCTYPE html>

<html>

<head>
    <title>Fail</title>
</head>

<body>
    <p><?php
        echo "Неуспешна заявка!<br>";
        if (isset($_SESSION[SESSION_KEY_SYS_ERRORS])) {
            foreach ($_SESSION[SESSION_KEY_SYS_ERRORS] as $err) {
                echo $err . "<br>";
            }


            unset($_SESSION[SESSION_KEY_SYS_ERRORS]);
        } else {
            echo "No system errors.";
        }
        ?>
    </p>
</body>

</html>