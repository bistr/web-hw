<?php
include "./db_connection.php";

function upload_image(String $key,  &$params)
{
    $filename = $_FILES[$key]["name"];
    if ($filename === "") {
        return;
    }
    $source = $_FILES[$key]["tmp_name"];

    if (!is_writable("./" . UPLOAD_FOLDER)) {
        show_system_error(SYS_ERR_NOT_WRITABLE);
    }

    $destination = "./" . UPLOAD_FOLDER . "/" . basename($filename);

    if (move_uploaded_file($source, $destination)) {
        $params[$key] = $destination;
    } else {
        show_system_error(SYS_ERR_CANT_UPLOAD);
    }
}

function upload_all_images(&$params)
{
    foreach (IMAGE_FIELDS as $image) {
        upload_image($image, $params);
    }
}



function process_data(&$params, &$errors)
{
    if (count($errors) == 0) {
        unset($_SESSION['fields']);
        upload_all_images($params);
        add_user($params);
    } else {
        foreach ($errors as $key => $err) {
            $_SESSION[$key] = $err;
        }
        header("Location: ./" . INDEX_PAGE);
        exit();
    }
}
