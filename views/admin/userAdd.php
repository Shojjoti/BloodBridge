<?php
requireAdmin();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add User - BloodBridge</title>
    <link rel="stylesheet" href="style/authority.css">
    <style>
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .form-wrapper { max-width: 500px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<div class="container">
    <a href="index.php?page=admin-users" class="btn btn-outline" style="margin-bottom: 20px;">Back to Users</a>
    <div class="form-wrapper">
        <h2>Add New User</h2>
        <form method="POST" action="index.php?page=admin-user-save">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Save User</button>
        </form>
    </div>
</div>
</body>
</html>
