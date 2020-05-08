<?php

function add_user(&$params)
{

    $host = "localhost";
    $db = "62169_Bistra_Chilikova";
    $username = "root";
    $pass = "";

    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $username, $pass);
    try {

        $sql = "INSERT INTO Users (fname, lname, course_year, course_major, fac_number, group_number, birthdate, website, photo, letter) VALUES (:fname, :lname, :course_year, :course_major, :fac_number,  :group_number, :birthdate, :website, :photo, :letter)";
        $stmt = $conn->prepare($sql) or die("what?");
        foreach ($params as $key => $value) {
            $placeholder = ":" . $key;
            $stmt->bindParam($placeholder, $params[$key]);
        }

        $stmt->execute();
        echo "New records created successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
