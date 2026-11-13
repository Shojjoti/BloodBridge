<?php
requireAdmin();

$id = $_GET['id'] ?? null;
if (!$id) redirect('admin-donors');

$db = (new Database())->connect();
$stmt = $db->prepare("
    SELECT d.*, u.name, u.email 
    FROM donors d 
    JOIN users u ON d.user_id = u.id 
    WHERE d.user_id = ?
");
$stmt->execute([$id]);
$donor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$donor) {
    // fallback check if column is full_name
    $stmt = $db->prepare("
        SELECT d.*, u.full_name as name, u.email 
        FROM donors d 
        JOIN users u ON d.user_id = u.id 
        WHERE d.user_id = ?
    ");
    $stmt->execute([$id]);
    $donor = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$donor) redirect('admin-donors');
$name = $donor['name'] ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Donor - BloodBridge</title>
    <link rel="stylesheet" href="style/authority.css">
    <style>
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .form-wrapper { max-width: 500px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<div class="container">
    <a href="index.php?page=admin-donors" class="btn btn-outline" style="margin-bottom: 20px;">Back to Donors</a>
    <div class="form-wrapper">
        <h2>Edit Donor</h2>
        <form method="POST" action="index.php?page=admin-donor-save">
            <input type="hidden" name="id" value="<?= htmlspecialchars($donor['id']) ?>">
            <input type="hidden" name="user_id" value="<?= htmlspecialchars($donor['user_id']) ?>">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($donor['email']) ?>" required>
            </div>
            <div class="form-group">
                <label>Blood Group</label>
                <select name="blood_group" required>
                    <?php 
                    $groups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                    foreach ($groups as $g): 
                    ?>
                        <option value="<?= $g ?>" <?= ($donor['blood_group'] === $g) ? 'selected' : '' ?>><?= $g ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($donor['phone'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label>Verified</label>
                <select name="verified">
                    <option value="0" <?= empty($donor['verified']) ? 'selected' : '' ?>>No</option>
                    <option value="1" <?= !empty($donor['verified']) ? 'selected' : '' ?>>Yes</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Donor</button>
        </form>
    </div>
</div>
</body>
</html>
