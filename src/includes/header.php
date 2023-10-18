<?php
require 'functions.php';
?>
<!DOCTYPE html>
<html lang="uz">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Тестовое задания</title>
 	<link rel="stylesheet" href="/assets/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<div class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="display-flex collapse navbar-collapse" id="navbarNavAltMarkup">
	    <div class="navbar-nav">
	      <a class="nav-item nav-link" href="/">Главная страница</a>
<?php
if (check_auth()) {
	?>
	      <a class="nav-item nav-link" href="/pages/user-docs.php">Мои документы</a>
	      <a class="nav-item nav-link" href="/pages/logout.php">Выйти</a>

	  <?php } else {?>
		<a class="nav-item nav-link" href="/pages/login.php">Логин</a>
	    <a class="nav-item nav-link" href="/pages/register.php">Регистрация</a>
	  <?php }?>
	    </div>
	  </div>
	</nav>
</div>
