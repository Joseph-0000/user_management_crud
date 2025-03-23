<?php
require "db_connection.php";

// Check if all fields are set
if (!isset($_POST["first_name"], $_POST["last_name"], $_POST["email"], $_POST["password"])) {
    die("Error: Missing form data.");
}

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");

if (!$stmt) {
    die("Error: " . $conn->error); // Debugging step: Check if prepare() fails
}

$stmt->bind_param("ssss", $first_name, $last_name, $email, $password);

if ($stmt->execute()) {
    echo "User added successfully!";
} else {
    die("Error executing query: " . $stmt->error); // Debugging step: Check if execute() fails
}
?>
