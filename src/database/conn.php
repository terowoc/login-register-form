<?php


define('DB_SERVER','localhost');
define('DB_USER','user6652_authlog');
define('DB_PASS' ,'qw34tyui');
define('DB_NAME', 'user6652_authlog');

$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

if (mysqli_connect_errno())

{

 echo "Failed to connect to MySQL: " . mysqli_connect_error();

}
?>