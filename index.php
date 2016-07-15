<?php

/*
 * A simple and badly written web application to
 *  demonstrate some security vulnerabilities.
 *
 * Copyright 2016 Alfio E. Fresta
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('inc/configuration.php');

ob_start();
ini_set("session.gc_maxlifetime", $conf["php.session.gc_maxlifetime"]);
session_start();

require('inc/database.php');
require('inc/functions.php');

$user = getCurrentUser();

require('inc/header.php');

if ( empty($_GET['page']) ) {
    $page = 'index.php';

} else {
    $page = $_GET['page'];

}

$full_path = "./pages/{$page}";
$file_exists = @include $full_path;
if (!$file_exists) {
    include "./pages/404.php";
}

require('inc/footer.php');
