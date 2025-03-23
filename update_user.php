<?php
require "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["id"], $_POST["first_name"], $_POST["last_name"], $_POST["email"])) {
        die("Error: Missing form data.");
    }

    $id = $_POST["id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];

    $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, email=? WHERE id=?");
    $stmt->bind_param("sssi", $first_name, $last_name, $email, $id);

    echo $stmt->execute() ? "User updated successfully!" : "Error updating user.";
}
?>
