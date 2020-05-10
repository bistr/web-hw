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
define("ERR_MSG_IS_NEGATIVE", "Не може да е с отрицателна стойност.");
define("ERR_MSG_NOT_IMAGE", "Файлът не е изображение.");
define("SYS_ERR_CANT_UPLOAD", "Проблем с добавянето на изображение.");

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
        if (array_key_exists($key, $_POST))
        {
            $params[$key] = format_input($_POST[$key]);
        }
        else
        {
            $params[$key] = "";
        }
        
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

function check_if_positive(String $key, &$params, &$errors)
{
    $value = $params[$key];
    if (is_numeric($value)) {
        if ($value<=0)
        {
            $errors[$key] = ERR_MSG_IS_NEGATIVE;
        }
    }
}

function validate_form(&$params, &$maxlen, &$errors, &$required, &$dates, &$numbers, &$images)
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

    foreach ($numbers as $key) {
        check_if_positive($key, $params, $errors);
    }

    foreach($images as $image)
    {
        validate_image($image, $errors);
    }
}

function validate_image(String $key, &$errors)
{
	$filetype = $_FILES[$key]["type"];
    
    if(substr( $filetype, 0, 5 ) != "image")
    {
        $errors[$key] = ERR_MSG_NOT_IMAGE;
    }
}

function upload_image(String $key, &$system_errors, &$params)
{
    $upload_folder = "photos";
	$filename = $_FILES[$key]["name"];
    $source = $_FILES[$key]["tmp_name"];
    $destination = "./".$upload_folder."/".basename($filename);
    
    if (move_uploaded_file($source, $destination))
    {
        $params[$key] = $destination;
        //$system_errors[$key] = SYS_ERR_CANT_UPLOAD;
    }
    else
    {
        $system_errors[$key] = SYS_ERR_CANT_UPLOAD;
        array_push($_SESSION["errors"], SYS_ERR_CANT_UPLOAD);
    }
}

function upload_all_images(&$images, &$system_errors, &$params)
{
    foreach ($images as $image)
    {   
        upload_image($image, $system_errors, $params);
    }
}



function process_data(&$params, &$errors, &$system_errors)
{
    if (count($system_errors) != 0)
    {
        header("Location: ./fail.php");
        exit();
        // foreach($system_errors as $key => $error)
        // {
        //     echo ($error . "<br>");
        // }
        // return;
    }
    if (count($errors) == 0) 
    {
        foreach ($params as $key => $value) 
        {
            echo ($key . " = " . $value . "<br>");
        }
        unset($_SESSION['fields']);
        add_user($params);
        
    }
    else 
    {
        foreach ($errors as $key => $err) 
        {
            $_SESSION[$key] = $err;

        }


    header("Location: ./index.php");
    exit();



    }
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "Bad request.";
    exit();
}



$keys = array("fname", "lname", "course_year", "course_major", "fac_number", "group_number", "birthdate", "website", "photo", "letter", "zodiac_sign");
$errors = array();
$system_errors = array();
$params = create_param_list($keys);
$maxlen = create_maxlen_arr();
$required = array("fname", "lname", "course_year", "course_major", "fac_number", "group_number", "birthdate", "letter", "zodiac_sign");
$dates = array("birthdate");
$numbers = array("course_year", "group_number");
$images = array("photo");

validate_form($params, $maxlen, $errors, $required, $dates, $numbers, $images);
upload_all_images($images,  $system_errors, $params);
process_data($params,  $errors, $system_errors);
