<!DOCTYPE html>
<html>
<head>
	<title>Login-Register form</title>
</head>
<body>
<?php
switch ($_GET['action']) {
	case 'register':
		$ism = $_GET['ism'];
		echo '<h4>Assalomu aleykum, '.$ism.'</h4>';
		break;
	case 'login':
		$ism = $_GET['ism'];
		echo '<h4>Assalomu aleykum, '.$ism.'</h4>';
		break;
	default:
		echo '<table border="1" widht="300">
<td><a href="login.php">Kirish</a></td>
<td><a href="register.php">Ro\'yxatdan o\'tish</a></td>
</table>';
		break;
}
?>
</body>
</html>
