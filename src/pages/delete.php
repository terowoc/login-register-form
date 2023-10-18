<?php

require '../database/conn.php';
require '../includes/functions.php';

$id = $_GET['id'];
if (isset($id)) {
    $sql = "SELECT * FROM files where id = '" . $id . "'";
    $result = mysqli_query($conn, $sql);
    $document = mysqli_fetch_array($result);
    if ($document) {
        unlink($document['link']);
        mysqli_query($conn, "DELETE FROM files WHERE id = '" . $id . "'");
        header('Location: /pages/user-docs.php');
    } else {
        flash('Документ не найдена!');
        header('Location: /');
    }
} else {
    header('Location: /');
}
