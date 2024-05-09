<?php
$code_book = $_POST['code_book'];
$name = $_POST['name'];
$qty = $_POST['qty'];

// connect database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "simple_book_data";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO books (code_book, name, qty) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $code_book, $name, $qty);
if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: index.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
    $stmt->close();
    $conn->close();
}
