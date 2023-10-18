<?php

require '../includes/functions.php';
require '../database/conn.php';

$user = $conn->createQueryBuilder()
	->select('*')
	->from('users')
	->where('username = :user')
	->setParameter('user', $_POST['username'])
	->execute()
	->fetch();
if ($user) {
	if (password_verify($_POST['password'], $user['password'])) {
		if (isset($_POST['rememberme'])) {
			setcookie('username', $_POST['username'], time() + 3600);
			setcookie('password', $_POST['password'], time() + 3600);
		} else {
			setcookie('username', '');
			setcookie('password', '');
		}

		$_SESSION['user'] = $_POST['username'];
		$_SESSION['login'] = true;
		header('Location: ../index.php');
	} else {
		flash('Пароль неверно!');
		header('Location: ../pages/login.php');
	}
} else {
	flash('Такой пользоватеть еще не зарегистрирован!');
	header('Location: ../pages/login.php');
}
