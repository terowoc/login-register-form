<?php

require '../includes/functions.php';

unset($_SESSION['login']);
unset($_SESSION['user']);
header('Location: /');