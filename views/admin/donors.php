<?php
require_once "../config/config.php";
requireAdmin();

require_once "../config/database.php";
$database = new Database();
$db = $database->connect();

try {
    $stmt = $db->query("
        SELECT d.*, u.name, u.email 
        FROM donors d 
        JOIN users u ON d.user_id = u.id 
        ORDER BY d.id DESC
    ");
    $donors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    try {
        $stmt = $db->query("
            SELECT d.*, u.full_name as name, u.email 
            FROM donors d 
            JOIN users u ON d.user_id = u.id 
            ORDER BY d.id DESC
        ");
        $donors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e2) {
        $donors = [];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Donors - BloodBridge</title>
    <link rel="stylesheet" href="style/authority.css">
</head>
<body>
<div class="container">
    <h1>Manage Donors</h1>
    <div>
        <a href="index.php?page=dashboard" class="btn btn-outline" style="margin-bottom: 20px;">Back to Dashboard</a>
        <a href="index.php?page=admin-donor-add" class="btn btn-primary" style="margin-bottom: 20px;">+ Add New Donor</a>
    </div>
    
    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background: #f3f4f6; text-align: left;">
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Donor ID</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Name</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Blood Group</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Phone</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Gmail</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">NID Status</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Last Donation</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Status</th>
                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($donors as $donor): ?>
            <tr>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;"><?= htmlspecialchars($donor['id'] ?? $donor['user_id']) ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;"><?= htmlspecialchars($donor['name'] ?? '') ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;"><?= htmlspecialchars($donor['blood_group'] ?? '') ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;"><?= htmlspecialchars($donor['phone'] ?? '') ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;"><?= htmlspecialchars($donor['email'] ?? '') ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;"><?= empty($donor['verified']) ? 'Unverified' : 'Verified' ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;"><?= htmlspecialchars($donor['last_donation_date'] ?? '') ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;"><?= !empty($donor['availability']) ? 'Available' : 'Unavailable' ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #e5e7eb;">
                    <a href="index.php?page=admin-donor-edit&id=<?= htmlspecialchars($donor['user_id']) ?>" style="color: var(--dark); text-decoration: none; margin-right: 8px;">Edit</a>
                    <a href="index.php?page=admin-donor-delete&id=<?= htmlspecialchars($donor['user_id']) ?>" onclick="return confirm('Are you sure you want to delete this donor?')" style="color: var(--red); text-decoration: none;">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($donors)): ?>
            <tr>
                <td colspan="9" style="padding: 12px; text-align: center; color: var(--gray);">No donors found</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>