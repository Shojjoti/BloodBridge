<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

$oldSearch = $_SESSION['old_search'] ?? [];
unset($_SESSION['old_search']);

// Prefill from session old search or persistent cookies
$prefillGroup    = $oldSearch['blood_group'] ?? ($_COOKIE['bb_last_blood_group'] ?? '');
$prefillLocation = $oldSearch['location'] ?? ($_COOKIE['bb_last_location'] ?? '');
$prefillRadius   = $oldSearch['radius'] ?? ($_COOKIE['bb_last_radius'] ?? '5');
$prefillLat      = $oldSearch['lat'] ?? '';
$prefillLng      = $oldSearch['lng'] ?? '';

// Recent searches from cookie
$recentSearches = [];
if (!empty($_COOKIE['bb_recent_searches'])) {
    $decoded = json_decode($_COOKIE['bb_recent_searches'], true);
    if (is_array($decoded)) {
        $recentSearches = $decoded;
    }
}

// User session state
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$userName   = $_SESSION['user_name'] ?? '';
$userRole   = $_SESSION['user_role'] ?? 'user';
$profileUrl = $userRole === 'donor' ? '../authority/donorProfile.php' : '../authority/userProfile.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Blood · BloodBridge</title>

    <link rel="stylesheet" href="../../public/style/1.home.css">
    <link rel="stylesheet" href="../../public/style/blood.css">
</head>

<body>
    <header class="navbar">
        <div class="brand">
            BloodBridge
            <img src="../../public/images/logo.jpg" alt="BloodBridge Logo">
        </div>

        <nav class="nav-links">
            <a href="../../views/home/1.home.php">
                Home
            </a>
            <a href="../../views/blood/findBlood.php" class="active">
                Find Blood
            </a>
            <a href="../../views/authority/donerRegistration.php">
                Become a Donor
            </a>
        </nav>

        <div class="nav-actions">
            <?php if ($isLoggedIn): ?>
                <a href="<?php echo htmlspecialchars($profileUrl); ?>" class="user-menu-badge" style="text-decoration:none;">
                    <span class="user-avatar-sm"><?php echo htmlspecialchars(strtoupper(substr($userName, 0, 2))); ?></span>
                    <span><?php echo htmlspecialchars($userName); ?></span>
                </a>
            <?php else: ?>
                <button class="btn btn-outline btn-sm" onclick="window.location.href='../../views/authority/login.php'"> Log in </button>
                <button class="btn btn-primary btn-sm" onclick="window.location.href='../../views/authority/userRegistration.php'"> Register </button>
            <?php endif; ?>
        </div>
    </header>

    <section class="container find-blood-container">
        <div class="find-blood-form-col">
            <h1 class="find-blood-title">Find Blood Donors</h1>
            <p class="find-blood-subtitle">Search for available blood donors near you</p>

            <form id="findBloodForm" action="../../controllers/BloodSearchController.php" method="GET" novalidate>
                <!-- Blood Group -->
                <div class="field">
                    <label for="bloodGroup">Blood group</label>
                    <select class="select <?php echo isset($errors['bloodGroup']) ? 'invalid' : ''; ?>" id="bloodGroup" name="blood_group">
                        <option value="">Select blood group</option>
                        <?php
                        $groups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                        foreach ($groups as $g):
                        ?>
                            <option value="<?php echo $g; ?>" <?php echo ($prefillGroup === $g) ? 'selected' : ''; ?>>
                                <?php echo $g; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="error-message" id="bloodGroupError"><?php echo htmlspecialchars($errors['bloodGroup'] ?? ''); ?></span>
                </div>

                <!-- Location with Geolocation Support -->
                <div class="field">
                    <label for="location">Your location</label>
                    <div class="input-wrap">
                        <input
                            type="text"
                            class="input <?php echo isset($errors['location']) ? 'invalid' : ''; ?>"
                            id="location"
                            name="location"
                            placeholder="Enter area, city or click GPS icon"
                            value="<?php echo htmlspecialchars($prefillLocation); ?>">
                        <input type="hidden" id="lat" name="lat" value="<?php echo htmlspecialchars($prefillLat); ?>">
                        <input type="hidden" id="lng" name="lng" value="<?php echo htmlspecialchars($prefillLng); ?>">

                        <button type="button" class="input-icon" id="geoBtn" title="Use current GPS location">
                            <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--red)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path d="M12 2v3M12 19v3M2 12h3M19 12h3"></path>
                            </svg>
                        </button>
                    </div>
                    <span class="error-message" id="locationError"><?php echo htmlspecialchars($errors['location'] ?? ''); ?></span>
                </div>

                <!-- Search Radius -->
                <div class="field">
                    <label for="radius">Search radius</label>
                    <select class="select <?php echo isset($errors['radius']) ? 'invalid' : ''; ?>" id="radius" name="radius">
                        <option value="5" <?php echo ($prefillRadius == '5') ? 'selected' : ''; ?>>5 KM</option>
                        <option value="10" <?php echo ($prefillRadius == '10') ? 'selected' : ''; ?>>10 KM</option>
                        <option value="25" <?php echo ($prefillRadius == '25') ? 'selected' : ''; ?>>25 KM</option>
                    </select>
                    <span class="error-message" id="radiusError"><?php echo htmlspecialchars($errors['radius'] ?? ''); ?></span>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Search Donors</button>
            </form>

            <!-- Recent Searches from Cookie -->
            <?php if (!empty($recentSearches)): ?>
                <div class="recent-searches-box">
                    <div class="recent-searches-title">Recent Searches (Cookies)</div>
                    <div class="recent-chips-list">
                        <?php foreach ($recentSearches as $item): ?>
                            <button
                                type="button"
                                class="recent-chip"
                                data-group="<?php echo htmlspecialchars($item['group']); ?>"
                                data-location="<?php echo htmlspecialchars($item['location']); ?>"
                                data-radius="<?php echo htmlspecialchars($item['radius']); ?>">
                                <span class="chip-group"><?php echo htmlspecialchars($item['group']); ?></span>
                                <span>•</span>
                                <span><?php echo htmlspecialchars($item['location']); ?></span>
                                <span>(<?php echo htmlspecialchars($item['radius']); ?>km)</span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="card map-card">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.086797302404!2d-122.402498!3d37.784057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858087d0d4b37b%3A0x90c1b8e9e8f4c2a7!2sMoscone%20Center!5e0!3m2!1sen!2sus!4v1710000000000" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy">
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

                <a href="../../views/home/1.home.php">Home </a>
                <a href="index.php?page=find-blood">
                    Find Blood
                </a>
                <a href="../../views/authority/donerRegistration.php">Become a Donor</a>
                <a href="../../views/home/aboutUs.php"> About Us </a>
            </div>

            <!-- DONORS -->
            <div class="footer-column">
                <h4> For Donors </h4>
                <a href="../../views/authority/donerRegistration.php">
                    Donor Register
                </a>
                <a href="#">Donation Guide</a>
                <a href="#"> Donor FAQs </a>
            </div>

            <!-- USERS -->
            <div class="footer-column">
                <h4> For Users </h4>
                <a href="../../views/blood/searchResult.php">
                    Search Blood
                </a>
                <a href="../../views/blood/searchResult.php">
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

    <script src="../../public/js/blood-search.js"></script>
</body>

</html>