<?php

require '../includes/header.php';
require '../database/conn.php';

if ($_SESSION['login']) {
	?>
<div class="container">
  	<div class="row py-5">
    	<div class="col-12">

			<?php
$user_docs = $conn->createQueryBuilder()
		->select('*')
		->from('files')
		->where('user = :user')
		->setParameter('user', $_SESSION['user'])
		->execute()
		->fetchAll();

	if ($user_docs == null) {
		flash('Вы еще не сгенерировали !');
		header('Location: /');
	} else {
		?>
		    <table class="table">
		    <thead>
		        <tr>
		            <th scope="col">ID</th>
		            <th scope="col">Имя</th>
		            <th scope="col">Действия</th>
		            </tr>
		    </thead>
		    <tbody>
		    <?php
foreach ($user_docs as $document) {
			echo '
								<tr>
						            <th scope="row">' . $document['id'] . '</th>
						            <td>' . $document['name'] . '</td>
						            <td><a href="' . $document['link'] . '"> Скачать</a></td>
						        </tr>';
		}
		?>
		    </tbody>
		    </table>
		    <?php
}
	?>
		</div>
	</div>
</div>
<?php
} else {
	?>
<div class="container">
  	<div class="row py-5">
    	<div class="col-lg-6">
            <h1>Login or Register</h1>

            <a href="pages/register.php">Register</a>
            <a href="pages/login.php">Login</a>
		</div>
	</div>
</div>
<?php
}
require '../includes/footer.php';
?>