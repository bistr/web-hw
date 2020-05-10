<?php
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
define("SYS_ERR_BAD_PASSWORD", "Паролата за връзка с базата е грешна. Свържете се с администратор. Също така - има я в SQL файла. ;)");
define("SYS_ERR_OTHER", "Проблем със системата. Опитайте по-късно.");

const KEYS = array("fname", "lname", "course_year", "course_major", "fac_number", "group_number", "birthdate", "zodiac_sign", "website", "photo", "letter");
const REQUIRED_FIELDS = array("fname", "lname", "course_year", "course_major", "fac_number", "group_number", "birthdate", "letter", "zodiac_sign");
const READONLY_FIELDS = array("zodiac_sign");
const DATE_FIELDS = array("birthdate");
const NUMBER_FIELDS = array("course_year", "group_number");
const IMAGE_FIELDS = array("photo");

const PATTERN = array(
    "fname" => "[A-ZА-Яa-zа-я\-]{2,63}",
    "lname" => "[A-ZА-Яa-zа-я\-]{2,63}",
    "course_major" => "[A-ZА-Яa-zа-я\-\s,]{2,255}",
    "course_year" => "\d+",
    "fac_number" => "[A-ZА-Яa-zа-я\-0-9]{2,63}",
    "group_number" => "\d+",
    "photo" => ".*",
    "birthdate" => "\d{4}-\d{2}-\d{2}",
    "zodiac_sign" => "[A-ZА-Яa-zа-я\-]{2,63}",
    "website" => ".{0,255}", "letter" => ".*{1,65535}"
);

const PRETTY_PRINT = array(
    "fname" => "Име",
    "lname" => "Фамилия",
    "course_major" => "Специалност",
    "course_year" => "Курс",
    "fac_number" => "Факултетен номер",
    "group_number" => "Група",
    "photo" => "Снимка",
    "birthdate" => "Дата на раждане",
    "zodiac_sign" => "Зодия",
    "website" => "Уебсайт",
    "letter" => "Мотивационно писмо"
);

const FIELD_TYPE = array(
    "fname" => "text",
    "lname" => "text",
    "course_major" => "text",
    "course_year" => "number",
    "fac_number" => "text",
    "group_number" => "number",
    "photo" => "file",
    "birthdate" => "date",
    "zodiac_sign" => "text",
    "website" => "url",
    "letter" => "text"
);
