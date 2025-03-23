<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

require "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Management</title>
</head>
<body class="bg-secondary">
    
<div class="container mt-4">
   <div class="d-flex justify-content-between align-items-center">
        <h2>Welcome, <strong><?php echo $_SESSION["name"]; ?>!</strong></h2>
        <div>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <hr>
    
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#userModal">+ Create User</button>


    <table id="userTable" class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>

<!-- Modal for Adding User -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
  $(document).ready(function() {
    let table = $('#userTable').DataTable({
        "ajax": "fetch_users.php",
        "columns": [
            { "data": "first_name" },
            { "data": "last_name" },
            { "data": "email" },
            { "data": "action" }
        ]
    });

    $('#userForm').submit(function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "add_user.php",
        data: $(this).serialize(),
        success: function(response) {
            alert(response); 
            $('#userModal').modal('hide'); 
            $('#userForm')[0].reset(); 
            table.ajax.reload(); 
        },
        error: function(xhr, status, error) {
            alert("AJAX Error: " + error); 
        }
    });
});

});


</script>

</body>
</html>
