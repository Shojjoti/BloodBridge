<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    if (function_exists('redirect')) {
        redirect("login");
    } else {
        header("Location: ../../views/authority/login.php");
        exit;
    }
}

$user_id = $_SESSION['user_id'];

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/user.php';

$userModel = new User();
$userData = $userModel->findById($user_id);

$userName = $userData['name'] ?? ($userData['full_name'] ?? ($_SESSION['name'] ?? ''));
$userEmail = $userData['email'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile · BloodBridge</title>
    <link rel="stylesheet" href="style/profile.css">
    <link rel="stylesheet" href="style/1.home.css">
</head>
<body>
    <header class="navbar">
        <div class="brand">
            BloodBridge
            <img src="images/logo.jpg" onerror="this.src='../../public/images/logo.jpg'" alt="BloodBridge Logo" width="26" height="26">
        </div>
        <div style="display:flex; gap:16px; align-items:center;">
            <a href="index.php?page=home" class="back-home">Home</a>
            <a href="index.php?page=find-blood" class="back-home">Find Blood</a>
            <form method="POST" action="index.php?page=logout" style="margin:0;">
                <button type="submit" class="btn btn-outline btn-sm" style="padding:4px 12px; font-size:12px;">Logout</button>
            </form>
        </div>
    </header>

    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-icon">👤</div>
            <div>
                <h1>User Profile</h1>
                <p>Manage your account information</p>
            </div>
        </div>

        <div class="profile-form">
            <div class="section-title">
                <h2>Personal Information</h2>
            </div>

            <div class="form-group">
                <label>Full Name</label>
                <input type="text" value="<?= htmlspecialchars($userName) ?>" placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" value="<?= htmlspecialchars($userEmail) ?>" placeholder="Enter your email" readonly>
            </div>


            <div class="section-title security-title">
                <h2>Security</h2>
            </div>


            <div class="form-group">
                <label>Password</label>

                <input
                    type="password"
                    value="password123"
                    placeholder="Enter password">
            </div>


            <div class="form-group">
                <label>Confirm Password</label>

                <input
                    type="password"
                    value="password123"
                    placeholder="Confirm password">
            </div>


            <!-- Account Status -->

            <div class="section-title account-title">
                <h2>Account Information</h2>
            </div>


            <div class="status-box">

                <div class="status-item">

                    <span class="status-label">
                        Account Status
                    </span>

                    <span class="status active">
                        Active
                    </span>

                </div>

            </div>


            <!-- Buttons -->

            <div class="button-container">
                <button type="button" class="cancel-btn" onclick="window.location.href='index.php?page=home'">Cancel</button>
                <button type="submit" class="update-btn">Update Profile</button>
            </div>

        </div>

    </div>

</body>
</html>