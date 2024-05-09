<?php
require_once 'connect.php';

function deleteBook($id) {
    global $conn;
    $sql_delete = "DELETE FROM books WHERE id=$id";
    if ($conn->query($sql_delete) === TRUE) {
        return true;
    } else {
        return false;
    }
}

