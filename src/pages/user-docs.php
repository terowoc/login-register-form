<?php

require '../includes/header.php';
require '../database/conn.php';

if (check_auth()) {
    $sql = "SELECT * FROM files WHERE user ='" . $_SESSION['user'] . "'";
    $result = mysqli_query($conn, $sql);
    $length = mysqli_num_rows($result);
    if ($length > 0) {
        flash();
        ?>
<div class="container">
  	<div class="row py-5">
    	<div class="col-12">
		    <table class="table">
			    <thead>
			        <tr>
			            <th scope="col">Имя</th>
			            <th scope="col">Действия</th>
			            </tr>
			    </thead>

		    	<tbody>
					<?php
while ($document = mysqli_fetch_array($result)) {
            echo '<tr>
		            <td>' . $document['name'] . '</td>
		            <td>
		            	<a href="' . $document['link'] . '"> Скачать |</a>
		            	<a href="delete.php?id=' . $document['id'] . '"> Удалить</a>
		            </td>
		        </tr>';
        }
        ?>
		    	</tbody>
		    </table>
		</div>
	</div>
</div>
			<?php
require '../includes/footer.php';
    } else {
        flash('Вы еще не сгенерировали !');
        header('Location: /');
    }
} else {
    header('Location: /');
}
