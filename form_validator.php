<?php

include "./form_processor.php";

session_start();


function format_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function create_param_list()
{
    $params = array();
    foreach (KEYS as $key) {
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
        $errors[$key] = ERR_MSG_REQUIRED.$key.$params[$key];
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

function validate_form(&$params, &$maxlen, &$errors)
{

    foreach (REQUIRED_FIELDS as $key) {
        check_if_filled($key, $params, $errors);
    }

    foreach ($maxlen as $key => $maximum_length) {
        check_if_valid_length($key, $params, $maximum_length, $errors);
    }

    foreach (DATE_FIELDS as $key) {
        check_if_valid_date($key, $params, $errors);
    }

    foreach (NUMBER_FIELDS as $key) {
        check_if_number($key, $params, $errors);
        check_if_positive($key, $params, $errors);
    }

    foreach(IMAGE_FIELDS as $image)
    {
        validate_image($image, $errors);
    }
}

function validate_image(String $key, &$errors)
{
    $filetype = $_FILES[$key]["type"];
    $filename = $_FILES[$key]["type"];

    if($filename == "")
    {
        return;
    }
    
    if(substr( $filetype, 0, 5 ) != "image")
    {
        $errors[$key] = ERR_MSG_NOT_IMAGE;
    }
}



if ($_SERVER["REQUEST_METHOD"] != "POST") {
    echo "Bad request.";
    exit();
}

$errors = array();
$params = create_param_list();
$maxlen = create_maxlen_arr();

validate_form($params, $maxlen, $errors);
process_data($params,  $errors);

