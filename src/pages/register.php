<?php

require '../includes/header.php';
require '../database/conn.php';

if (!check_auth()) {
    $username = (isset($_POST['username'])) ? $_POST['username'] : null;
    $password = (isset($_POST['password'])) ? $_POST['password'] : null;

    if (isset($_POST['submit'])) {
        if ($password == $_POST['password2']) {
            if (mb_strlen($username) >= 8) {
                if (preg_match("#^[a-z0-9]{1,15}$#i", $username)) {
                    if (mb_strlen($password) >= 8) {
                        if (preg_match("/^.*(?=.{7,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $password)) {
                            $sql = "SELECT * FROM users WHERE username ='$username'";
                            $result = mysqli_query($conn, $sql);
                            $user = mysqli_fetch_array($result);

                            if (!$user) {
                                $sql = "INSERT INTO users (username, password) VALUES ('" . $username . "', '" . password_hash($password, PASSWORD_DEFAULT) . "')";
                                mysqli_query($conn, $sql);

                                setcookie('username', $username, time() + (86400 * 30));
                                setcookie('password', $password, time() + (86400 * 30));
                                mkdir('../docs/' . $username);

                                flash('Вы успешно зарегистрировались!');
                                header('Location: login.php');
                            } else {
                                flash('Это имя пользователя уже занято.');
                            }
                        } else {
                            flash('Пароль должен содержать минимум один заглавнуя букву и один цифру!');
                        }
                    } else {
                        flash('Пароль должен содержать минимум 8 символов!');
                    }
                } else {
                    flash('Логин должен состоять из латинских букв и/или цифр!');
                }
            } else {
                flash('Логин должен содержать минимум 8 символов!');
            }
        } else {
            flash('Пароль должен совподать друг с другом!');
        }
    }
    ?>
<div class="container">
  	<div class="row py-5">
    	<div class="col-lg-6">
			<h1 class="mb-5">Регистрация</h1>
        		<?php flash();?>
			<form method="post" action="">
				<div class="input-group mb-3">
					<input type="text" class="form-control" id="username" name="username" placeholder="Логин" required>
				</div>

				<div class="input-group mb-3">
				  <input type="password" class="form-control" id="password" name="password" placeholder="Пароль" required>
				  <span class="input-group-text">
				    <i class="bi bi-eye" id="togglePassword"
				   style="cursor: pointer"></i>
				   </span>
				</div>

				<div class="input-group mb-3">
				  <input type="password" class="form-control" id="password2" name="password2" placeholder="Повторный пароль"required>
				</div>

				<button type="submit" name="submit" class="btn btn-primary">Регистрация</button>
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
