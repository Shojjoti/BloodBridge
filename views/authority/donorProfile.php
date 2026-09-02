<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../views/auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];


$donor = [
    'full_name' => '',
    'nid_number' => '',
    'phone' => '',
    'email' => '',
    'blood_group' => '',
    'last_donation_date' => '',
    'total_donations' => '',
    'status' => '',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Profile</title>
    <link rel="stylesheet" href="../../public/style/profile.css">
    <link rel="stylesheet" href="../../public/style/1.home.css">
</head>
<body>
    <div id="alert-box" class="alert-box" style="display:none;"></div>

    <header class="navbar">
        <div class="brand">
            BloodBridge
            <img src="../../public/images/logo.jpg" alt="BloodBridge Logo">
        </div>
        <a href="../../views/home/1.home.php" class="back-home">← Back to home</a>
    </header>

    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-icon">🩸</div>
            <div>
                <h1>Donor Profile</h1>
                <p>Manage your donor information</p>
            </div>
        </div>

        <form id="profile-form" class="profile-form">

            <div class="section-title"><h2>Personal Information</h2></div>

            <div class="form-row">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="<?= htmlspecialchars($donor['full_name']) ?>">
                </div>
                <div class="form-group">
                    <label>NID Number</label>
                    <input type="text" name="nid_number" value="<?= htmlspecialchars($donor['nid_number']) ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($donor['phone']) ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($donor['email']) ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Blood Group</label>
                    <select name="blood_group">
                        <?php
                        $groups = ['A+','A-','B+','B-','AB+','AB-','O+','O-'];
                        foreach ($groups as $g) {
                            $selected = ($donor['blood_group'] === $g) ? 'selected' : '';
                            echo "<option value=\"$g\" $selected>$g</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Last Donation Date</label>
                    <input type="date" name="last_donation_date" value="<?= htmlspecialchars($donor['last_donation_date']) ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Number of Previous Donations</label>
                    <input type="number" name="total_donations" value="<?= htmlspecialchars($donor['total_donations']) ?>">
                </div>
                <div class="form-group">
                    <label>New Password (optional)</label>
                    <input type="password" name="password" placeholder="রেখে দাও যদি বদলাতে না চাও">
                </div>
            </div>

            <div class="form-group confirm-password">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="রেখে দাও যদি বদলাতে না চাও">
            </div>

            <div class="section-title account-section"><h2>Donor Status</h2></div>

            <div class="status-box">
                <div class="status-item">
                    <span class="status-label">Donor Status</span>
                    <span class="status <?= strtolower($donor['status']) ?>"><?= htmlspecialchars($donor['status']) ?></span>
                </div>
                <div class="status-item">
                    <span class="status-label">Blood Group</span>
                    <span class="blood-group"><?= htmlspecialchars($donor['blood_group']) ?></span>
                </div>
            </div>

            <div class="button-container">
                <button type="button" class="cancel-btn" onclick="window.location.href='../../views/home/1.home.php'">Cancel</button>
                <button type="submit" class="update-btn">Update Profile</button>
            </div>

        </form>
    </div>

    <script>
    document.getElementById('profile-form').addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        try {
            const res = await fetch('update_profile.php', {
                method: 'POST',
                body: formData
            });
            const data = await res.json();

            showAlert(data.message, data.success);
        } catch (err) {
            showAlert('Something went wrong. Please try again.', false);
        }
    });

    function showAlert(message, success) {
        const box = document.getElementById('alert-box');
        box.textContent = message;
        box.className = 'alert-box ' + (success ? 'alert-success' : 'alert-error');
        box.style.display = 'block';

        setTimeout(() => {
            box.style.display = 'none';
        }, 3000);
    }
    </script>

</body>
</html>