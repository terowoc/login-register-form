<?php

require 'includes/header.php';
require 'database/conn.php';
require 'vendor/autoload.php';

if (check_auth()) {

    if (isset($_POST['submit'])) {
        $user = $_SESSION['user'];
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();

        $section->addText("Имя - " . $_POST['firstname']);
        $section->addText("Фамилия - " . $_POST['lastname']);
        $section->addText("Отчества - " . $_POST['middlename']);
        $section->addText("Дата рождения - " . $_POST['birthday']);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        if (!is_dir('docs/' . $user)) {
            mkdir('docs/' . $user);
        }
        $file_name = strtolower($_POST['firstname']) . '-' . strtolower($_POST['lastname']);
        $file = 'docs/' . $user . '/' . date('h_i_s_d_m_Y') . '_' . $file_name . '.docx';
        $objWriter->save($file);

        $sql = "INSERT INTO files (user, name, link) VALUES ('" . $user . "', '" . $file_name . "', '../" . $file . "')";
        mysqli_query($conn, $sql);
        header('Location: /');
    }

    ?>
<div class="container">
  	<div class="row py-5">
    	<div class="col-12">
            <h1>Добро пожаловать <?php if (isset($_SESSION['user'])) {echo $_SESSION['user'];}?>!</h1>
        		<?php flash();?>
			<form method="post" action="">
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