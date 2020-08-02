<?php

include '../connect.php';
if (isset($_POST['submit'])) {
	if (empty($_POST['username'])) {
		echo "Usernameni kiritmadingiz.";
		die();
	}else{
		$username = $_POST['username'];
		if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			echo "Usernameni faqat `a-zA-Z0-9` belgilari orqali kirita olasiz.";
			die();
		}
	}

	if (empty($_POST['mail'])) {
		echo "Emailingizni kiritmadingiz.";
		die();
	}else{
		$mail = $_POST['mail'];
	if (!preg_match("|^([a-z0-9_\.\-]{1,25})@([a-z0-9_\.\-]{1,25})\.([a-z]{2,4})$|ius", $mail)) {
			echo "Emailiningizni to'g'ri kiriting";
			die();
		}
	}

	if (empty($_POST['password'])) {
		echo "Parolingizni kiritmadingiz.";
		die();
	}else{
		$password = $_POST['password'];
		if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
			echo "Parolingizni faqat `a-zA-Z0-9` belgilari orqali kirita olasiz.";
			die();
		}
	}

	if (empty($_POST['password2'])) {
		echo "Qaytalangan parolingizni kiritmadingiz.";
		die();
	}else{
		$password2 = $_POST['password2'];
		if (!preg_match("/^[a-zA-Z0-9]*$/", $password2)) {
			echo "Qaytalangan parolingizni faqat `a-zA-Z0-9` belgilari orqali kirita olasiz.";
			die();
		}
	}
}

if ($password != $password2) {
	echo "Parollar mos kelmayabdi";
	die();
}

$sql = "SELECT * FROM users where login = '$username'";
$result = mysqli_query($connect, $sql);
$conn = mysqli_fetch_assoc($result);

if ($conn) {
	echo "Bunday username orqali foydalanuvchi ro'yxatdan o'tgan";
	die();
}
$sql2 = "SELECT * FROM users where mail = '$mail'";
$result2 = mysqli_query($connect, $sql2);
$conn2 = mysqli_fetch_assoc($result2);

if ($conn2) {
	echo "Bunday email orqali foydalanuvchi ro'yxatdan o'tgan";
	die();
}else{
	$pass = sha1(md5($password));

	$sql3 = "INSERT INTO users(login, mail, pass) VALUES ('$username', '$mail', '$pass')";
	$result3 = mysqli_query($connect, $sql3);

	if ($result3) {
		header("Location: ../index.php?action=register&ism=$username");
	}
}










?>