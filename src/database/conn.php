<?php

require '../vendor/autoload.php';
use Doctrine\DBAL\DriverManager;

$connectionParams = [
	'dbname' => 'user6652_authlog',
	'user' => 'user6652_authlog',
	'password' => 'qw34tyui',
	'host' => 'localhost',
	'driver' => 'pdo_mysql',
];

$conn = DriverManager::getConnection($connectionParams);
?>