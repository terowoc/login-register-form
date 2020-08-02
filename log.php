<?php

include '../connect.php';

if (isset($_POST['submit'])) {
	if (empty($_POST['username'])) {
		echo "Loginingizni kiritmadingiz.";
		die();
	}else{
		$ism = $_POST['username'];
		if (!preg_match("/^[a-zA-Z0-9]*$/", $ism)) {
			echo "Loginingizni xato kiritdingiz";
			die();
		}
	}

	if (empty($_POST['password'])) {
		echo "Parolingizni kiritmadingiz.";
		die();
	}else{
		$password = $_POST['password'];
		if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
			echo "Parolingizni xato kiritidingiz";
			die();
		}
	}
}

$pass = sha1(md5($password));
$sql = "SELECT * FROM users where login = '$ism' and pass='$pass'";
$result = mysqli_query($connect, $sql);
$conn = mysqli_fetch_assoc($result);

if ($conn) {
	header("Location: ../index.php?action=login&ism=$ism");
}else{
	die("Ma'lumotlarni xato kiritdingiz");
}
?>