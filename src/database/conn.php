<?php

session_start();

require '../vendor/autoload.php';
use Doctrine\DBAL\DriverManager;

$connectionParams = [
	'driver' => 'sqlite3',
	'path' => '../database.sql',
];

$conn = DriverManager::getConnection($connectionParams);
$conn->query("CREATE TABLE IF NOT EXISTS files (
	`id` INTEGER PRIMARY KEY AUTOINCREMENT,
	`user` VARCHAR(50),
	`name` TEXT,
	`link` VARCHAR(250)
);");

$conn->query("CREATE TABLE IF NOT EXISTS users (
	`id` INTEGER PRIMARY KEY AUTOINCREMENT,
	`username` VARCHAR(50),
	`password` VARCHAR(250)
);");
?>