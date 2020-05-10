<?php
define("SYS_ERR_BAD_PASSWORD", "Паролата за връзка с базата е грешна. Свържете се с администратор. Също така - има я в SQL файла. ;)");
define("SYS_ERR_OTHER", "Проблем със системата. Опитайте по-късно.");

function add_user(&$params)
{
    $host = "localhost";
    $db = "62169_Bistra_Chilikova";
    $username = "root";
    $pass = "1";
    try
    {
        $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $username, $pass);
        $sql = "INSERT INTO Users (fname, lname, course_year, course_major, fac_number, group_number, birthdate, website, photo, letter, zodiac_sign) VALUES (:fname, :lname, :course_year, :course_major, :fac_number,  :group_number, :birthdate, :website, :photo, :letter, :zodiac_sign)";
        $stmt = $conn->prepare($sql) or die("what?");
        foreach ($params as $key => $value) {
            $placeholder = ":" . $key;
            $stmt->bindParam($placeholder, $params[$key]);
        }

        $stmt->execute();
        header("Location: ./success.html");
        exit();
        echo "New records created successfully";
    } catch (PDOException $e) {
        //echo "Error: " . $e->getMessage();
        array_push($_SESSION["errors"], SYS_ERR_BAD_PASSWORD);
        header("Location: ./fail.php");
        exit();
    } catch (Exception $e)
    {
        $_SESSION["error"] = "bad password";
    }


}
