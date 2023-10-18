<?php

require_once '../includes/header.php';

if (!check_auth()) {
	?>
<div class="container">
  	<div class="row py-5">
    	<div class="col-lg-6">
			<h1 class="mb-5">Логин</h1>

        		<?php flash();?>
			<form method="post" action="./validation/log.php">
				<div class="input-group mb-3">
					<input type="text" class="form-control" id="username" name="username" placeholder="Логин" value="<?php if (isset($_COOKIE['username'])) {echo $_COOKIE['username'];}?>" required>
				</div>

				<div class="input-group mb-3">
				  <input class="form-control" id="password" name="password" placeholder="Пароль" value="<?php if (isset($_COOKIE['password'])) {echo $_COOKIE['password'];}?>" required>
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

				<button type="submit" class="btn btn-primary">Войти</button>
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
