<?php
session_start();
function show_system_error(String $error)
{
    if (!isset($_SESSION[SESSION_KEY_SYS_ERRORS])) 
    {
        $_SESSION[SESSION_KEY_SYS_ERRORS] = array();
    }
    array_push($_SESSION[SESSION_KEY_SYS_ERRORS], $error);
    header("Location: ./".FAIL_PAGE);
    exit();
}
?>