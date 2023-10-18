<?php

require_once '../includes/header.php';

if (!check_auth()) {
	?>
<div class="container">
  	<div class="row py-5">
    	<div class="col-lg-6">
			<h1 class="mb-5">Регистрация</h1>

        		<?php flash();?>
			<form method="post" action="../validation/reg.php">
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
