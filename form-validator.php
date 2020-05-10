<?php

include "./db-connection.php";


define("MAX_LENGTH_FNAME", 63);
define("MAX_LENGTH_LNAME", 63);
define("MAX_LENGTH_MAJOR", 255);
define("MAX_LENGTH_FAC_NUMBER", 63);
define("MAX_LENGTH_WEBSITE", 255);
define("MAX_LENGTH_LETTER", 65535);

define("ERR_MSG_REQUIRED", "Полето е задължително.");
define("ERR_MSG_TOO_LONG", "Превишена дължина.");
define("ERR_MSG_BAD_DATE", "Неправилна дата.");
define("ERR_MSG_NOT_NUMERIC", "Не е число.");

session_start();


function format_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function create_param_list(&$keys)
{
    $params = array();
    foreach ($keys as $key) {
        $params[$key] = format_input($_POST[$key]);
    }
    $_SESSION["fields"] = $params;
    return $params;
}

function create_maxlen_arr()
{
    $maxlen = array();
    $maxlen['fname'] = MAX_LENGTH_FNAME;
    $maxlen['lname'] = MAX_LENGTH_LNAME;
    $maxlen['course_major'] = MAX_LENGTH_MAJOR;
    $maxlen['fac_number'] = MAX_LENGTH_FAC_NUMBER;
    $maxlen['website'] = MAX_LENGTH_WEBSITE;
    $maxlen['letter'] = MAX_LENGTH_LETTER;
    return $maxlen;
}

function check_if_valid_date($key, &$params, &$errors)
{
    $date_chunks = explode("-", $params[$key]);
    if (!checkdate($date_chunks[1], $date_chunks[2], $date_chunks[0])) {
        $errors[$key] = ERR_MSG_BAD_DATE;
    }
}

function validate(String $key, &$params, &$maxlen, &$errors)
{
    if (!$params[$key]) {
        $errors[$key] = ERR_MSG_REQUIRED;
    } elseif (strlen($params[$key]) > $maxlen[$key]) {
        $errors[$key] = ERR_MSG_TOO_LONG;
    }
}

function check_if_filled(String $key, &$params, &$errors)
{
    if (!$params[$key]) {
        $errors[$key] = ERR_MSG_REQUIRED;
    }
}

function check_if_valid_length(String $key, &$params, int $maximum_length, &$errors)
{
    $value_length = strlen($params[$key]);
    if ($value_length > $maximum_length) {
        $errors[$key] = ERR_MSG_TOO_LONG;
    }
}

function check_if_number(String $key, &$params, &$errors)
{
    $value = $params[$key];
    if (!is_numeric($value)) {
        $errors[$key] = ERR_MSG_NOT_NUMERIC;
    }
}

function validate_form(&$params, &$maxlen, &$errors, &$required, &$dates, &$numbers)
{
    echo ("Validating <br>");

    foreach ($required as $key) {
        check_if_filled($key, $params, $errors);
    }

    foreach ($maxlen as $key => $maximum_length) {
        check_if_valid_length($key, $params, $maximum_length, $errors);
    }

    foreach ($dates as $key) {
        check_if_valid_date($key, $params, $errors);
    }

    foreach ($numbers as $key) {
        check_if_number($key, $params, $errors);
    }



    // foreach($params as $key => $value)
    // {
    //     validate($key, $params, $maxlen, $errors);
    // }


}

function process_data(&$params, &$error_message, &$errors)
{
    if (count($errors) == 0) 
    {
        foreach ($params as $key => $value) 
        {
            echo ($key . " = " . $value . "<br>");
        }
        add_user($params);
    }
    else 
    {
        // echo ("Errors:\n");

        // foreach ($errors as $key => $err) 
        // {
        //     echo ($key . ": " . $err . "<br>");
        // }

        // foreach ($errors as $key => $err) 
        // {
        //     $error_message .= $err . '<br />';
        // }

        // $_SESSION['ERR'] = $error_message;

        foreach ($errors as $key => $err) 
        {
            $_SESSION[$key] = $err;

        }

        //$_SESSION['ERR'] = $error_message;

        
    header("Location: ./index.php");
    exit();



    }
}




//$fname = $lname = $course_year = $course_major = $fac_number = $website = $group_number = $birthdate = $photo = $letter = "";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    return;
}


$error_message = "";
$keys = array("fname", "lname", "course_year", "course_major", "fac_number", "group_number", "birthdate", "website", "photo", "letter", "zodiac_sign");
$errors = array();
$params = create_param_list($keys);
$maxlen = create_maxlen_arr();
$required = $keys;
$dates = array("birthdate");
$numbers = array("course_year", "group_number");

validate_form($params, $maxlen, $errors, $required, $dates, $numbers);
process_data($params, $error_message, $errors);
