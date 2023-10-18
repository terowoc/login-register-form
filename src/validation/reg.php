<?php

require '../includes/functions.php';
require '../database/conn.php';

if ($_POST['password'] == $_POST['password2']) {
	if (mb_strlen($_POST['username']) >= 8) {
		if (preg_match("#^[a-z0-9]{1,15}$#i", $_POST['username'])) {
			$user = $conn->createQueryBuilder()
				->select('*')
				->from('users')
				->where('username = :user')
				->setParameter('user', $_POST['username'])
				->execute()
				->fetchOne();

			if ($user == false) {
				$a = $conn->createQueryBuilder()
					->insert('users')
					->values([
						'username' => ':user',
						'password' => ':pass',
					])
					->setParameter('user', $_POST['username'])
					->setParameter('pass', password_hash($_POST['password'], PASSWORD_DEFAULT))
					->execute();

				setcookie('username', $_POST['username'], time() + 3600);
				setcookie('password', $_POST['password'], time() + 3600);

				flash('Вы успешно зарегистрировались!');
				header('Location: ../pages/login.php');
			} else {
				flash('Это имя пользователя уже занято.');
				header('Location: ../pages/register.php');
			}
		} else {
			flash('Логин должен состоять из латинских букв и/или цифр!');
			header('Location: ../pages/register.php');
		}
	} else {
		flash('Логин должен содержать минимум 8 символов!');
		header('Location: ../pages/register.php');
	}
} else {
	flash('Пароль должен совподать друг с другом!');
	header('Location: ../pages/register.php');
}