<?php
date_default_timezone_get('Europe/Vilnius');

session_start();

require_once('config/config.php');

function __autoload($class_name) {
	require_once('libraries/' . $class_name . '.php');
}