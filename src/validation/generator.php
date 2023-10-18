<?php

require '../includes/functions.php';
require '../database/conn.php';
require '../vendor/autoload.php';

if (isset($_POST['submit'])) {

	$phpWord = new \PhpOffice\PhpWord\PhpWord();
	$section = $phpWord->addSection();

	$section->addText("Имя - " . $_POST['firstname']);
	$section->addText("Фамилия - " . $_POST['lastname']);
	$section->addText("Отчества - " . $_POST['middlename']);
	$section->addText("Дата рождения - " . $_POST['birthday']);

	$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
	if (!is_dir('../docs/' . $_SESSION['user'])) {
		mkdir('../docs/' . $_SESSION['user']);
	}
	$file_name = strtolower($_POST['firstname']) . '-' . strtolower($_POST['lastname']);
	$file = '../docs/' . $_SESSION['user'] . '/' . date('h_i_s_d_m_Y') . '_' . $file_name . '.docx';
	$objWriter->save($file);

	$conn->createQueryBuilder()
		->insert('files')
		->values([
			'user' => ':user',
			'name' => ':name',
			'link' => ':link',
		])
		->setParameter('user', $_SESSION['user'])
		->setParameter('name', $file_name)
		->setParameter('link', $file)
		->execute();
	header('Location: ../index.php');
} else {
	header('Location: ../index.php');
}

?>