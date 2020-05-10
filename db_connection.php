<?php
include "./config.php";
include "./system_error_handler.php";

function add_user(&$params)
{
    $host = "localhost";
    $db = "62169_Bistra_Chilikova";
    $username = "root";
    $pass = "";
    try {
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
        show_system_error(SYS_ERR_BAD_PASSWORD);
    } catch (Exception $e) {
        show_system_error(SYS_ERR_OTHER);
    }
}
