<?php

session_start();

function flash(?string $message = null)
{
    if ($message) {
        $_SESSION['flash'] = $message;
    } else {
        if (!empty($_SESSION['flash'])) {?>
	        <div class="alert alert-danger mb-3">
	            <?=$_SESSION['flash']?>
	        </div>
	      <?php }
        unset($_SESSION['flash']);
    }
}

function check_auth()
{
    if (isset($_SESSION['login'])) {
        return true;
    } else {
        return false;
    }
}

function word()
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (!empty($_SESSION['word'])) {
            $link = explode('|', $_SESSION['word'])[0];
            $name = explode('|', $_SESSION['word'])[1];
            echo "<a href=\"{$link}\" class=\"btn btn-success\">Скачать {$name}</a>";
            unset($_SESSION['word']);
        }
    }
}

?>