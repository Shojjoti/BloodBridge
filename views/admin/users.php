<?php
require_once "../config/config.php";
requireAdmin();

require_once "../config/database.php";
$database = new Database();
$db = $database->connect();

try {
    $stmt = $db->query("SELECT * FROM users WHERE role = 'user' ORDER BY id DESC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    try {
        $stmt = $db->query("SELECT * FROM users ORDER BY id DESC");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e2) {
        $users = [];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users - BloodBridge</title>
    <link rel="stylesheet" href="style/authority.css">
</head>
<body>
<div class="container">
    <h1>Manage Users</h1>
    <div>
        <a href="index.php?page=dashboard" class="btn btn-outline" style="margin-bottom: 20px;">Back to Dashboard</a>
        <a href="index.php?page=admin-user-add" class="btn btn-primary" style="margin-bottom: 20px;">+ Add New User</a>
    </div>
    
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background: #f3f4f6; text-align: left;">
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">User ID</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Name</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Gmail</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Registration Date</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Status</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;"><?= htmlspecialchars($user['id'] ?? '') ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;"><?= htmlspecialchars($user['name'] ?? $user['full_name'] ?? '') ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;"><?= htmlspecialchars($user['email'] ?? '') ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;"><?= htmlspecialchars($user['created_at'] ?? 'N/A') ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">Active</td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                    <a href="index.php?page=admin-user-edit&id=<?= htmlspecialchars($user['id']) ?>" style="color: var(--dark); text-decoration: none; margin-right: 8px;">Edit</a>
                    <a href="index.php?page=admin-user-delete&id=<?= htmlspecialchars($user['id']) ?>" onclick="return confirm('Are you sure you want to delete this user?')" style="color: var(--red); text-decoration: none;">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($users)): ?>
            <tr>
                <td colspan="6" style="padding: 12px; text-align: center; color: var(--gray);">No users found</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>