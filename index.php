<?php
require('core/init.php');

$template = new Template();
$user = new User();
$message = new Message();


if(isset($_POST['login'])) {
	$data = array();

	$data['username'] = $_POST['username'];
	$data['password'] = $_POST['password'];
	if($user->login($data))
		$_SESSION['username'] = $data['username'];
	else
		$template->wrongpassword = "Wrong password!";
}

if(isset($_POST['logout']))
	$user->logout($_SESSION['username']);

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['message'])) {
	$data['username'] = $_SESSION['username'];
	$data['message'] = $_POST['message'];
	$data['time'] = date('h:i:s a', time());
	$message->sendMessage($data);
}

$template->messages = $message->getMessages();

if(!empty($_SESSION['username'])) {
	$template->title = "Messenger";
	$template->render('welcome.php');
} else {
	$template->title = "Login";
	$template->render('index.php');
}