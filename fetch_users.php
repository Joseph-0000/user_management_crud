<?php
require "db_connection.php";

$result = $conn->query("SELECT id, first_name, last_name, email FROM users");
$data = [];

while ($row = $result->fetch_assoc()) {
    $row['action'] = '
        <button class="btn btn-warning edit-btn" data-id="' . $row["id"] . '">Edit</button>
        <button class="btn btn-danger delete-btn" data-id="' . $row["id"] . '">Delete</button>
    ';
    $data[] = $row;
}

echo json_encode(["data" => $data]);
?>
