<?php
require "db_connection.php";

if (!isset($_GET["id"])) {
    die("Error: No user ID provided.");
}

$id = $_GET["id"];
$stmt = $conn->prepare("SELECT first_name, last_name, email FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Error: User not found.");
}

require "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>Edit User</h2>
    <form id="editUserForm">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control" value="<?= $user['first_name'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="<?= $user['last_name'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $("#editUserForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "update_user.php",
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
                window.location.href = "dashboard.php";
            }
        });
    });
</script>
</body>
</html>
