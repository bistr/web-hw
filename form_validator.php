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

function show_error(String $key, String $error)
{
    global $errors;
    $errors[$key] = $error;
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

function check_if_valid_date($key, $value)
{
    $date_chunks = explode("-", $value);
    if (!checkdate($date_chunks[1], $date_chunks[2], $date_chunks[0])) {
        show_error($key, ERR_MSG_BAD_DATE);
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

function check_if_matches_pattern(String $key, $value)
{
    $match = "";
    $pattern = PATTERN[$key] . "{" . MIN_LENGTH[$key] . "," . MAX_LENGTH[$key] . "}";
    if (!preg_match("/" . $pattern . "/", $value, $match)) {
        show_error($key, ERR_MSG_WRONG_FORMAT . create_format_message($key));
    }
}

function check_if_filled(String $key, &$params)
{
    if (!$params[$key]) {
        show_error($key, ERR_MSG_REQUIRED);
    }
}

function check_zodiac($key, $value, $date)
{
    if (!in_array($value, ZODIAC)) {
        show_error($key, ERR_MSG_BAD_ZODIAC);
    } else {

        $firstDayInMonth = array();
        $firstDayInMonth[1] = 20;
        $firstDayInMonth[2] = 20;
        $firstDayInMonth[3] = 21;
        $firstDayInMonth[4] = 21;
        $firstDayInMonth[5] = 22;
        $firstDayInMonth[6] = 22;
        $firstDayInMonth[7] = 23;
        $firstDayInMonth[8] = 24;
        $firstDayInMonth[9] = 24;
        $firstDayInMonth[10] = 23;
        $firstDayInMonth[11] = 23;
        $firstDayInMonth[12] = 22;

        $date_chunks = explode("-", $date);
        $month = (int) $date_chunks[1];
        $day = (int) $date_chunks[2];

        $zodiac_number = ($month + 9) % 12;

        if ($firstDayInMonth[$month] > $day) {
            $zodiac_number -= 1;
            if ($zodiac_number < 0) {
                $zodiac_number = 11;
            }
        }

        if (ZODIAC[$zodiac_number] != $value) {
            show_error($key, ERR_MSG_WRONG_SIGN);
        }
    }
}

function check_if_positive(String $key, $value)
{
    if (is_numeric($value)) {
        if ($value <= 0) {
            show_error($key, ERR_MSG_IS_NEGATIVE);
        }
    }
}

function validate_form(&$params)
{
    foreach (KEYS as $key) {
        check_if_matches_pattern($key, $params[$key]);
    }

    foreach (REQUIRED_FIELDS as $key) {
        check_if_filled($key, $params);
    }

    foreach (DATE_FIELDS as $key) {
        check_if_valid_date($key, $params[$key]);
    }

    foreach (NUMBER_FIELDS as $key) {
        check_if_positive($key, $params[$key]);
    }

    foreach (IMAGE_FIELDS as $image) {
        validate_image($image);
    }

    check_zodiac("zodiac_sign", $params["zodiac_sign"], $params["birthdate"]);
}

function validate_image(String $key)
{
    $filetype = $_FILES[$key]["type"];
    $filename = $_FILES[$key]["name"];

    if ($filename == "") {
        return;
    }

    if (substr($filetype, 0, 5) != "image") {
        show_error($key, ERR_MSG_NOT_IMAGE);
    }
}



if ($_SERVER["REQUEST_METHOD"] != "POST") {
    show_system_error(SYS_ERR_BAD_REQUEST);
    exit();
}

$errors = array();
$params = create_param_list();

validate_form($params);
process_data($params, $errors);
