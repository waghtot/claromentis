<?php
session_start();
require_once('app/core/constants.php');
require_once('app/core/autoloader.php');



new Security(); // set for POST request in case of uploading and processing file by external application

Router::dispatch();

ob_flush();

?>

