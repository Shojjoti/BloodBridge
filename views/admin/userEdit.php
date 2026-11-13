<?php
requireAdmin();

$id = $_GET['id'] ?? null;
if (!$id) redirect('admin-users');

$db = (new Database())->connect();
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) redirect('admin-users');
$name = $user['name'] ?? $user['full_name'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User - BloodBridge</title>
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
        <h2>Edit User</h2>
        <form method="POST" action="index.php?page=admin-user-save">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="form-group">
                <label>Password (leave blank to keep current)</label>
                <input type="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
</div>
</body>
</html>
