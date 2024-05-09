<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "simple_book_data";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}