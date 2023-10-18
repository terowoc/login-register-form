<?php

require '../includes/header.php';
require '../database/conn.php';

if (!check_auth()) {

    if (isset($_POST['submit'])) {
        $username = (isset($_POST['username'])) ? $_POST['username'] : null;
        $password = (isset($_POST['password'])) ? $_POST['password'] : null;

        $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                if (isset($_POST['rememberme'])) {
                    setcookie('username', $username, time() + (86400 * 30));
                    setcookie('password', $password, time() + (86400 * 30));
                } else {
                    setcookie('username', '');
                    setcookie('password', '');
                }

                $_SESSION['user'] = $username;
                $_SESSION['login'] = true;
                header('Location: ../index.php');
            } else {
                flash('Пароль неверно!');
            }
        } else {
            flash('Такой пользоватеть еще не зарегистрирован!');
        }
    }

    ?>
<div class="container">
  	<div class="row py-5">
    	<div class="col-lg-6">
			<h1 class="mb-5">Логин</h1>
        		<?php flash();?>
			<form method="post" action="">
				<div class="input-group mb-3">
					<input type="text" class="form-control" id="username" name="username" placeholder="Логин" value="<?php if (isset($_COOKIE['username'])) {echo $_COOKIE['username'];}?>" required>
				</div>

				<div class="input-group mb-3">
				  <input class="form-control" type="password" id="password" name="password" placeholder="Пароль" value="<?php if (isset($_COOKIE['password'])) {echo $_COOKIE['password'];}?>" required>
				  <span class="input-group-text">
				    <i class="bi bi-eye" id="togglePassword"
				   style="cursor: pointer"></i>
				   </span>
				</div>

				<div class="form-group mb-3">
				    <input type="checkbox"  name="rememberme" id="rememberme">
				    <label for="rememberme">Запомнить меня</label>
				</div>

				<div class="mb-3">
					<span>Еще не зарегистрированы?</span><a href="/pages/register.php"> Зарегистрироваться</a>
				</div>

				<button type="submit" name="submit" class="btn btn-primary">Войти</button>
			</form>
		</div>
	</div>
</div>
<?php
require_once '../includes/footer.php';
} else {
    header('Location: ../index.php');
}
?>
