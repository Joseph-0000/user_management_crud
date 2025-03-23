<?php
require "db_connection.php";
$id = $_POST["id"];

$stmt = $conn->prepare("DELETE FROM users WHERE id=?");
$stmt->bind_param("i", $id);
echo $stmt->execute() ? "User deleted successfully" : "Error";
?>
