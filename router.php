<?php
$_SERVER['SCRIPT_NAME'] = '/index.php';
$path = $_SERVER['REQUEST_URI'];
if (file_exists(__DIR__ . '/public' . $path)) {
    return false;
}
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/public/index.php';
require_once __DIR__ . '/public/index.php';