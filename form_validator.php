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
        if (array_key_exists($key, $_POST)) {
            $params[$key] = format_input($_POST[$key]);
        } else {
            $params[$key] = "";
        }
    }
    $_SESSION["fields"] = $params;
    return $params;
}

function check_if_valid_date($key, &$params, &$errors)
{
    $date_chunks = explode("-", $params[$key]);
    if (!checkdate($date_chunks[1], $date_chunks[2], $date_chunks[0])) {
        $errors[$key] = ERR_MSG_BAD_DATE;
    }
}

function create_format_message($key)
{
    $symbols = "";
    if (PATTERN[$key] == ".") {
        $symbols = "всички";
    } else if (PATTERN[$key] == "\d") {
        $symbols = "цифри";
    } else {
        $symbols = PATTERN[$key];
    }

    $min = MIN_LENGTH[$key];
    $max = MAX_LENGTH[$key];

    return "Разрешени символи: " . $symbols . ", дължина между " . $min . " и " . $max . " символа.";
}

function check_if_matches_pattern(String $key, &$params, &$errors)
{
    $match = "";
    $value = $params[$key];
    $pattern = PATTERN[$key] . "{" . MIN_LENGTH[$key] . "," . MAX_LENGTH[$key] . "}";
    if (!preg_match("/" . $pattern . "/", $value, $match)) {
        $errors[$key] = ERR_MSG_WRONG_FORMAT . create_format_message($key);
    }
}

function check_if_filled(String $key, &$params, &$errors)
{
    if (!$params[$key]) {
        $errors[$key] = ERR_MSG_REQUIRED . $key . $params[$key];
    }
}

function check_if_positive(String $key, &$params, &$errors)
{
    $value = $params[$key];
    if (is_numeric($value)) {
        if ($value <= 0) {
            $errors[$key] = ERR_MSG_IS_NEGATIVE;
        }
    }
}

function validate_form(&$params, &$errors)
{
    foreach (KEYS as $key) {
        check_if_matches_pattern($key, $params, $errors);
    }

    foreach (REQUIRED_FIELDS as $key) {
        check_if_filled($key, $params, $errors);
    }

    foreach (DATE_FIELDS as $key) {
        check_if_valid_date($key, $params, $errors);
    }

    foreach (NUMBER_FIELDS as $key) {
        check_if_positive($key, $params, $errors);
    }

    foreach (IMAGE_FIELDS as $image) {
        validate_image($image, $errors);
    }
}

function validate_image(String $key, &$errors)
{
    $filetype = $_FILES[$key]["type"];
    $filename = $_FILES[$key]["name"];

    if ($filename == "") {
        return;
    }

    if (substr($filetype, 0, 5) != "image") {
        $errors[$key] = ERR_MSG_NOT_IMAGE;
    }
}



if ($_SERVER["REQUEST_METHOD"] != "POST") {
    show_system_error(SYS_ERR_BAD_REQUEST);
    exit();
}

$errors = array();
$params = create_param_list();

validate_form($params,  $errors);
process_data($params,  $errors);
