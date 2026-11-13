<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Become a Blood Donor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/1.home.css">
    <link rel="stylesheet" href="style/donar&UserRegistration.css">
</head>

<body>

    <header class="navbar">

        <div class="brand">
            BloodBridge
            <img src="images/logo.jpg" onerror="this.src='../../public/images/logo.jpg'" alt="BloodBridge Logo">
        </div>


        <nav class="nav-links">
            <a href="index.php?page=home">
                Home
            </a>
            <a href="index.php?page=login">
                Log in
            </a>

        </nav>
    </header>

    <div class="main-container">
        <!-- LEFT SIDE -->
        <div class="form-section">
            <div class="form-box">
                <h1>Become a Blood Donor</h1>
                <p class="subtitle">
                    Fill in your information to register as a donor
                </p>

                <form id="donorRegisterForm" action="<?php echo defined('BASE_URL') ? BASE_URL . '?page=donor-register' : 'index.php?page=donor-register'; ?>" method="POST" novalidate>
                    <div class="form-grid">
                        <!-- Full Name -->
                        <div class="input-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" id="fullName" name="fullName" placeholder="Enter your full name">
                            <span class="error-message" id="fullNameError"></span>
                        </div>

                        <!-- NID -->
                        <div class="input-group">
                            <label for="nid">NID Number</label>
                            <input type="text" id="nid" name="nid" placeholder="Enter your NID number">
                            <span class="error-message" id="nidError"></span>
                        </div>

                        <!-- Phone -->
                        <div class="input-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" placeholder="01XXXXXXXXX">
                            <span class="error-message" id="phoneError"></span>
                        </div>

                        <!-- Email -->
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="example@gmail.com">
                            <span class="error-message" id="emailError"></span>
                        </div>

                        <!-- Blood Group -->
                        <div class="input-group">
                            <label for="bloodGroup">Blood Group</label>
                            <select id="bloodGroup" name="bloodGroup">
                                <option value="">Select blood group</option>
                                <option>A+</option>
                                <option>A-</option>
                                <option>B+</option>
                                <option>B-</option>
                                <option>AB+</option>
                                <option>AB-</option>
                                <option>O+</option>
                                <option>O-</option>
                            </select>
                            <span class="error-message" id="bloodGroupError"></span>
                        </div>

                        <!-- Location -->
                        <div class="input-group">
                            <label for="location">Location</label>
                            <div style="position: relative; width: 100%;">
                                <input type="text" id="location" name="location" placeholder="Enter your area/city" style="padding-right: 40px; box-sizing: border-box;">
                                <button type="button" id="geoBtn" title="Get GPS Location" style="position: absolute; right: 11px; top: 50%; transform: translateY(-50%); border: none; background: transparent; cursor: pointer; font-size: 1.2rem; padding: 0; width: auto; margin: 0; line-height: 1; outline: none; box-shadow: none;">
                                    📍
                                </button>
                            </div>
                            <input type="hidden" id="lat" name="lat">
                            <input type="hidden" id="lng" name="lng">
                            <span class="error-message" id="locationError"><?php echo htmlspecialchars($errors['location'] ?? ''); ?></span>
                        </div>

                        <!-- Last Donation Date -->
                        <div class="input-group">
                            <label for="lastDonationDate">Last Donation Date</label>
                            <input type="date" id="lastDonationDate" name="lastDonationDate">
                            <span class="error-message" id="lastDonationDateError"></span>
                        </div>

                        <!-- Previous Donations -->
                        <div class="input-group">
                            <label for="previousDonations">Number of Previous Donations</label>
                            <input type="number" id="previousDonations" name="previousDonations" placeholder="Enter number" min="0">
                            <span class="error-message" id="previousDonationsError"></span>
                        </div>

                        <!-- Password -->
                        <div class="input-group">
                            <label for="password">Password</label>
                            <div class="password-box">
                                <input type="password" id="password" name="password" placeholder="Enter password">

                            </div>
                            <span class="error-message" id="passwordError"></span>
                        </div>

                        <!-- Confirm Password -->
                        <div class="input-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <div class="password-box">
                                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password">

                            </div>
                            <span class="error-message" id="confirmPasswordError"></span>
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="terms">
                        <input type="checkbox" id="terms" name="terms">
                        <label for="terms">
                            I agree to the
                            <span>terms and conditions</span>
                        </label>
                        <span class="error-message" id="termsError"></span>
                    </div>

                    <!-- Button -->
                    <button type="submit">Register as Donor</button>
                </form>

                <p class="login-text">
                    Already have an account?
                    <a href="../../views/authority/login.php">Login</a>
                </p>

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="donation-section">
            <!-- Blood Bag Illustration -->
            <div class="blood-illustration">
                <img src="images/bloodOnBag.png" onerror="this.src='../../public/images/bloodOnBag.png'" alt="Blood on Bag">
            </div>

            <div>
                <h2>
                    Donate Blood<br>
                    Save Life
                </h2>

                <p>
                    Your donation can bring<br>
                    someone back to life.
                </p>
            </div>


        </div>

    </div>

    <script src="js/donorReg.js"></script>
    <script>
        document.getElementById('geoBtn').addEventListener('click', function() {
            if (navigator.geolocation) {
                this.innerHTML = '⏳';
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('lat').value = position.coords.latitude;
                    document.getElementById('lng').value = position.coords.longitude;
                    
                    // Simple reverse geocoding using free API
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