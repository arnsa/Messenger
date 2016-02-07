<?php
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);
ini_set('error_log','script_errors.log');
ini_set('log_errors','On');

require('core/init.php');
$user = new User;

$template = new Template;
$template->registered = false;

if(isset($_POST['register'])) {
	$data = array();

	$data['name'] = $_POST['name'];
	$data['second_name'] = $_POST['second_name'];
	$data['username'] = $_POST['username'];
	$data['email'] = $_POST['email'];
	$data['password'] = $_POST['password'];
	$data['repeat_password'] = $_POST['repeat_password'];

	$user_registration = $user->register($data);

	if($user_registration[0]) {
		$template->registered = true;
		$template->registrationMsg = $user_registration[1];
		header('refresh:2; url=index.php');
	} else {
		$template->registered = false;
		$template->registrationMsg = $user_registration[1];
	}
}

$template->title = 'Register';
$template->render('register.php');