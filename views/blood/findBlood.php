<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Basic session checks for the navbar
$isLoggedIn = isset($_SESSION['user_id']);
$userName   = $_SESSION['name'] ?? 'User';
$userRole   = $_SESSION['role'] ?? 'user';
$profileUrl = $userRole === 'donor' ? 'index.php?page=donor-dashboard' : ($userRole === 'admin' ? 'index.php?page=admin-dashboard' : 'index.php?page=user-dashboard');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Blood · BloodBridge</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/1.home.css">
    <link rel="stylesheet" href="style/blood.css">
</head>

<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="brand">
            BloodBridge
            <img src="images/logo.jpg" alt="Logo">
        </div>

        <nav class="nav-links">
            <a href="index.php?page=home">Home</a>
            <a href="index.php?page=find-blood" class="active">Find Blood</a>
            <a href="index.php?page=donor-register">Become a Donor</a>
        </nav>

        <div class="nav-actions">
            <?php if ($isLoggedIn): ?>
                <a href="<?php echo $profileUrl; ?>" style="text-decoration:none; color: black; font-weight: bold;">
                    👤 <?php echo $userName; ?>
                </a>
                <form method="POST" action="index.php?page=logout" style="display:inline;">
                    <button type="submit" class="btn btn-primary btn-sm">Logout</button>
                </form>
            <?php else: ?>
                <a href="index.php?page=login" class="btn btn-outline btn-sm">Log in</a>
                <a href="index.php?page=user-register" class="btn btn-primary btn-sm">Register</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <section class="container find-blood-container">
        
        <!-- Search Form Column -->
        <div class="find-blood-form-col">
            <h1 class="find-blood-title">Find Blood Donors</h1>
            <p class="find-blood-subtitle">Search for available blood donors near you</p>

            <form action="index.php" method="GET">
                <!-- Tells index.php to load the search results page -->
                <input type="hidden" name="page" value="search-results">

                <!-- Blood Group Input -->
                <div class="field">
                    <label>Blood group</label>
                    <select class="input" name="blood_group" required>
                        <option value="">Select blood group</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>

                <!-- Location Input -->
                <div class="field">
                    <label>Your location</label>
                    <div style="position: relative;">
                        <!-- Text box for location name -->
                        <input type="text" class="input" id="location" name="location" placeholder="Enter area, city or click GPS" required>
                        
                        <!-- Hidden fields for coordinates -->
                        <input type="hidden" id="lat" name="lat">
                        <input type="hidden" id="lng" name="lng">

                        <!-- GPS Button -->
                        <button type="button" id="geoBtn" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; font-size: 20px; cursor: pointer;">
                            📍
                        </button>
                    </div>
                </div>

                <!-- Radius Input -->
                <div class="field">
                    <label>Search radius</label>
                    <select class="input" name="radius" required>
                        <option value="5">5 KM</option>
                        <option value="10">10 KM</option>
                        <option value="25">25 KM</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Search Donors</button>
            </form>
        </div>

        <!-- Google Map Image/Iframe -->
        <div class="map-card">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.086797302404!2d-122.402498!3d37.784057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858087d0d4b37b%3A0x90c1b8e9e8f4c2a7!2sMoscone%20Center!5e0!3m2!1sen!2sus!4v1710000000000" 
                width="100%" height="400" style="border:0;" loading="lazy">
            </iframe>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-container">
            <!-- ABOUT -->
            <div class="footer-column footer-about">
                <div class="footer-brand">
                    BloodBridge
                    <img src="../../public/images/logo.jpg" alt="blood drop logo">
                </div>
                <p>
                    BloodBridge connects donors with people in need,
                    so help arrives faster when it matters most.
                </p>
            </div>
            <!-- QUICK LINKS -->
            <div class="footer-column">
                <h4> Quick Links </h4>

                <a href="index.php?page=home">Home </a>
                <a href="index.php?page=find-blood">Find Blood </a>
                <a href="index.php?page=donor-register">Become a Donor</a>
                <a href="index.php?page=about"> About Us </a>
            </div>

            <!-- DONORS -->
            <div class="footer-column">
                <h4> For Donors </h4>
                <a href="index.php?page=donor-register">
                    Donor Register
                </a>
                <a href="#">Donation Guide</a>
                <a href="#"> Donor FAQs </a>
            </div>

            <!-- USERS -->
            <div class="footer-column">
                <h4> For Users </h4>
                <a href="index.php?page=search-results">
                    Search Blood
                </a>
                <a href="index.php?page=search-results">
                    Blood Requests
                </a>
                <a href="#">
                    User FAQs
                </a>
            </div>

            <!-- CONTACT -->
            <div class="footer-column">
                <h4> Contact Us </h4>
                <span>
                    +880 1234-567890
                </span>
                <span>
                    support@bloodBridge.com
                </span>
                <span>
                    Dhaka, Bangladesh
                </span>
            </div>
        </div>

        <!-- COPYRIGHT -->
        <div class="footer-bottom">
            <div class="footer-bottom-inner">
                <span>
                    © 2026 BloodBridge. All rights reserved.
                </span>
                <div>
                    <a href="#">
                        Privacy Policy
                    </a>
                    <a href="#">
                        Terms & Conditions
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/blood-search.js"></script>
</body>

</html>