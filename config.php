<?php

const MAX_LENGTH = array(
    "fname" => 63,
    "lname" => 63,
    "course_major" => 255,
    "course_year" => 3,
    "fac_number" => 63,
    "group_number" => 3,
    "photo" => 255,
    "zodiac_sign" => 63,
    "website" => 255,
    "letter" => 65535,
    "birthdate" => 1
);

const MIN_LENGTH = array(
    "fname" => 2,
    "lname" => 2,
    "course_major" => 1,
    "course_year" => 1,
    "fac_number" => 1,
    "group_number" => 1,
    "photo" => 0,
    "zodiac_sign" => 3,
    "website" => 0,
    "letter" => 10,
    "birthdate" => 1
);

const ZODIAC = array("Овен", "Телец", "Близнаци", "Рак", "Лъв", "Дева", "Везни", "Скорпион", "Стрелец", "Козирог", "Водолей", "Риби");

define("UPLOAD_FOLDER", "photos");
define("SUCCESS_PAGE", "success.html");
define("FAIL_PAGE", "fail.php");
define("INDEX_PAGE", "index.php");

define("ERR_MSG_REQUIRED", "Полето е задължително.");
define("ERR_MSG_TOO_LONG", "Превишена дължина.");
define("ERR_MSG_BAD_DATE", "Неправилна дата.");
define("ERR_MSG_NOT_NUMERIC", "Не е число.");
define("ERR_MSG_IS_NEGATIVE", "Не може да е с отрицателна стойност.");
define("ERR_MSG_NOT_IMAGE", "Файлът не е изображение.");
define("ERR_MSG_WRONG_FORMAT", "Грешка в данните. Не спазва правилен формат.");
define("ERR_MSG_BAD_ZODIAC", "Зодията не е в списъка с разрешени зодии.");
define("ERR_MSG_WRONG_SIGN", "Зодията не е правилна.");
define("SYS_ERR_CANT_UPLOAD", "Проблем с добавянето на изображение.");
define("SYS_ERR_NOT_WRITABLE", "Проблем с добавянето на изображение. Имате ли достъп до директория " . UPLOAD_FOLDER . " в htdocs? Трябва да има write permission. Ако не съществува, я създайте и сложете права 777. Също така я има в ZIP-а.");
define("SYS_ERR_BAD_PASSWORD", "Паролата за връзка с базата е грешна. Свържете се с администратор. Също така - има я в SQL файла. ;)");
define("SYS_ERR_BAD_REQUEST", "Лоша заявка.");
define("SYS_ERR_OTHER", "Проблем със системата. Опитайте по-късно.");



define("SESSION_KEY_SYS_ERRORS", "SYSTEM_ERRORS");

const KEYS = array("fname", "lname", "course_year", "course_major", "fac_number", "group_number", "birthdate", "zodiac_sign", "website", "photo", "letter");
const REQUIRED_FIELDS = array("fname", "lname", "course_year", "course_major", "fac_number", "group_number", "birthdate", "letter", "zodiac_sign");
const READONLY_FIELDS = array("zodiac_sign");
const DATE_FIELDS = array("birthdate");
const NUMBER_FIELDS = array("course_year", "group_number");
const IMAGE_FIELDS = array("photo");

const PATTERN = array(
    "fname" => "[A-ZА-Яa-zа-я\-]",
    "lname" => "[A-ZА-Яa-zа-я\-]",
    "course_major" => "[A-ZА-Яa-zа-я\-\s,]",
    "course_year" => "\d",
    "fac_number" => "[A-ZА-Яa-zа-я\-0-9]",
    "group_number" => "\d",
    "photo" => ".",
    "birthdate" => "(\d{4}-\d{2}-\d{2})",
    "zodiac_sign" => "[A-ZА-Яa-zа-я\-]",
    "website" => ".",
    "letter" => "."
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
