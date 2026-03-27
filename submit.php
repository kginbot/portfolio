<?php
$conn = new mysqli("localhost", "root", "", "portfolio_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$comment = $_POST['comment'];

$sql = "INSERT INTO comments (name, email, comment)
        VALUES ('$name', '$email', '$comment')";

if ($conn->query($sql) === TRUE) {
    echo "Comment submitted successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>