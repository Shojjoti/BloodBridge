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
require_once __DIR__ . '/../../models/donor.php';
require_once __DIR__ . '/../../models/user.php';

$donorModel = new Donor();
$userModel = new User();

$donorData = $donorModel->findByUserId($user_id);
$userData = $userModel->findById($user_id);

$donor = [
    'full_name' => $userData['name'] ?? ($userData['full_name'] ?? ($_SESSION['name'] ?? '')),
    'nid_number' => $donorData['nid'] ?? ($donorData['nid_number'] ?? ''),
    'phone' => $donorData['phone'] ?? '',
    'email' => $userData['email'] ?? '',
    'blood_group' => $donorData['blood_group'] ?? '',
    'last_donation_date' => $donorData['last_donation_date'] ?? '',
    'total_donations' => $donorData['total_donations'] ?? ($donorData['previous_donations'] ?? '0'),
    'location' => $donorData['location'] ?? '',
    'latitude' => $donorData['latitude'] ?? '',
    'longitude' => $donorData['longitude'] ?? '',
    'status' => (!empty($donorData['verified']) && $donorData['verified'] == 1) ? 'Verified' : 'Pending Verification',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Profile · BloodBridge</title>
    <link rel="stylesheet" href="style/profile.css">
    <link rel="stylesheet" href="style/1.home.css">
</head>
<body>
    <div id="alert-box" class="alert-box" style="display:none;"></div>

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

            <div class="form-row">
                <div class="form-group" style="flex:1;">
                    <label>Location</label>
                    <div style="position: relative; width: 100%;">
                        <input type="text" id="location" name="location" value="<?= htmlspecialchars($donor['location']) ?>" placeholder="Enter your area/city" style="padding-right: 40px; box-sizing: border-box;">
                        <button type="button" id="geoBtn" title="Get GPS Location" style="position: absolute; right: 11px; top: 50%; transform: translateY(-50%); border: none; background: transparent; cursor: pointer; font-size: 1.2rem; padding: 0; width: auto; margin: 0; line-height: 1; outline: none; box-shadow: none;">
                            📍
                        </button>
                    </div>
                    <input type="hidden" id="lat" name="latitude" value="<?= htmlspecialchars($donor['latitude']) ?>">
                    <input type="hidden" id="lng" name="longitude" value="<?= htmlspecialchars($donor['longitude']) ?>">
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
                <button type="button" class="cancel-btn" onclick="window.location.href='index.php?page=home'">Cancel</button>
                <button type="submit" class="update-btn">Update Profile</button>
            </div>

        </form>
    </div>

    <script>
    document.getElementById('profile-form').addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        try {
            const res = await fetch('../controllers/updateProfile.php', {
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

    document.getElementById('geoBtn').addEventListener('click', function() {
        if (navigator.geolocation) {
            this.innerHTML = '⏳';
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('lat').value = position.coords.latitude;
                document.getElementById('lng').value = position.coords.longitude;
                
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${position.coords.latitude}&lon=${position.coords.longitude}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.display_name) {
                            let addr = data.address;
                            let area = addr.neighbourhood || addr.suburb || addr.residential || addr.village || addr.county || "";
                            let city = addr.city || addr.town || addr.state_district || "";
                            
                            let parts = [];
                            if (area) parts.push(area);
                            if (city && city !== area) parts.push(city);
                            
                            document.getElementById('location').value = parts.length > 0 ? parts.join(', ') : data.display_name.split(',').slice(0, 2).join(', ');
                        }
                        document.getElementById('geoBtn').innerHTML = '✅';
                        setTimeout(() => document.getElementById('geoBtn').innerHTML = '📍', 2000);
                    })
                    .catch(err => {
                        console.error(err);
                        document.getElementById('geoBtn').innerHTML = '📍';
                        document.getElementById('location').value = "Lat: " + position.coords.latitude.toFixed(4) + ", Lng: " + position.coords.longitude.toFixed(4);
                    });
            }, function(error) {
                alert("Error getting location: " + error.message);
                document.getElementById('geoBtn').innerHTML = '📍';
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    });
    </script>

</body>
</html>