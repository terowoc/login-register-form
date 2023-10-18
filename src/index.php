<?php

require 'includes/header.php';

if (check_auth()) {
	?>
<div class="container">
  	<div class="row py-5">
    	<div class="col-12">
            <h1>Добро пожаловать <?php if (isset($_SESSION['user'])) {echo $_SESSION['user'];}?>!</h1>
        		<?php flash();?>
			<form method="post" action="validation/generator.php">
				<div class="mb-3">
					<label for="firstname" class="form-label">Имя</label>
					<input type="text" class="form-control" id="firstname" name="firstname" required>
				</div>

				<div class="mb-3">
					<label for="lastname" class="form-label">Фамилия</label>
					<input type="text" class="form-control" id="lastname" name="lastname" required>
				</div>

				<div class="mb-3">
					<label for="middlename" class="form-label">Отчества</label>
					<input type="text" class="form-control" id="middlename" name="middlename" required>
				</div>

				<div class="mb-3">
					<label for="birthday" class="form-label">Дата рождения</label>
					<input type="date" class="form-control" id="birthday" name="birthday" required>
				</div>

				<button type="submit" name="submit" class="btn btn-primary">Генерировать </button>
			</form>
		</div>
	</div>


</div>
<?php
} else {
	?>
<div class="container">
  	<div class="row py-5">
    	<div class="col-12">
    		<?php flash();?>
            <h1>Вы еще не вошли в свой аккаунт на сайте!</h1>
            <a href="/pages/login.php" class="btn btn-primary">Войти</a>
		</div>
	</div>
</div>
<?php
}
require 'includes/footer.php';
?>