<?php
session_start();

// Get Search Parameters from GET query or Session
$bloodGroup = trim($_GET['blood_group'] ?? ($_SESSION['last_search']['blood_group'] ?? ''));
$location   = trim($_GET['location'] ?? ($_SESSION['last_search']['location'] ?? ''));
$radius     = (int)($_GET['radius'] ?? ($_SESSION['last_search']['radius'] ?? 5));
$lat        = trim($_GET['lat'] ?? ($_SESSION['last_search']['lat'] ?? ''));
$lng        = trim($_GET['lng'] ?? ($_SESSION['last_search']['lng'] ?? ''));

// Validate required parameters; fallback to default if missing
$validBloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
if ($bloodGroup === '' || !in_array($bloodGroup, $validBloodGroups, true)) {
    // If accessed directly without search, default to O+ or redirect
    $bloodGroup = 'O+';
}
if ($radius <= 0 || $radius > 100) {
    $radius = 5;
}

// User session status
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
    <title>Search Results · BloodBridge</title>
    
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

<section class="container search-results-section">
    <div class="search-results-header">
        <div>
            <h1 class="search-results-title">Donors Near You</h1>
            <p class="search-results-subtitle">
                Showing donors within <?php echo htmlspecialchars((string)$radius); ?> KM
                <?php if ($location !== ''): ?>
                    around <strong><?php echo htmlspecialchars($location); ?></strong>
                <?php endif; ?>
            </p>
        </div>
        <div class="search-filter-badge-col">
            <span class="badge badge-red">Blood group: <?php echo htmlspecialchars($bloodGroup); ?></span>
            <div>
                <a href="../../views/blood/findBlood.php" class="change-search-link">Change search</a>
            </div>
        </div>
    </div>

    <!-- Donor Cards Loop -->
    <?php if (!empty($donors)): ?>
        <?php foreach ($donors as $donor): ?>
            <div class="card donor-card">
                <div class="donor-info-group">
                    <div class="donor-avatar"><?php echo htmlspecialchars($donor['initials']); ?></div>
                    <div>
                        <div class="donor-title-row">
                            <span class="donor-name"><?php echo htmlspecialchars($donor['name']); ?></span>
                            <span class="badge badge-red"><?php echo htmlspecialchars($donor['blood_group']); ?></span>
                        </div>
                        <div class="donor-meta">
                            <?php echo htmlspecialchars($donor['distance']); ?> km away &middot; 
                            Last donation: <?php echo htmlspecialchars($donor['last_date']); ?> &middot; 
                            Donations: <?php echo htmlspecialchars((string)$donor['donations']); ?>
                        </div>
                    </div>
                </div>
                <div class="donor-action-group">
                    <span class="badge badge-success"><?php echo htmlspecialchars($donor['status']); ?></span>
                    
                    <button 
                        type="button" 
                        class="btn btn-outline btn-sm view-contact-btn"
                        data-logged-in="<?php echo $isLoggedIn ? '1' : '0'; ?>"
                        data-name="<?php echo htmlspecialchars($donor['name']); ?>"
                        data-phone="<?php echo htmlspecialchars($donor['phone']); ?>"
                        data-email="<?php echo htmlspecialchars($donor['email']); ?>"
                        data-group="<?php echo htmlspecialchars($donor['blood_group']); ?>"
                    >
                        View Contact
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
        <p class="no-donors-text">Showing all matching donors within <?php echo htmlspecialchars((string)$radius); ?> KM.</p>
    <?php else: ?>
        <div class="card" style="padding: 40px; text-align: center;">
            <h3>No Donors Found</h3>
            <p style="color: var(--gray); margin-top: 8px;">We could not find any active donors matching <strong><?php echo htmlspecialchars($bloodGroup); ?></strong> in this radius.</p>
            <a href="findBlood.php" class="btn btn-primary btn-sm" style="display:inline-block; margin-top:16px; text-decoration:none;">Try Wider Search</a>
        </div>
    <?php endif; ?>
</section>

<!-- Protected Contact Details Modal (For Logged In Users) -->
<div id="contactModal" class="popup-overlay" style="display: none;">
    <div class="popup-box">
        <h2 id="modalDonorName">Donor Contact</h2>
        <p>Contact the donor directly to request blood donation.</p>

        <div class="popup-contact-info">
            <div class="popup-contact-row">
                <strong>Blood:</strong>
                <span id="modalDonorGroup" class="badge badge-red"></span>
            </div>
            <div class="popup-contact-row">
                <strong>Phone:</strong>
                <span id="modalDonorPhone" style="font-weight: 600;"></span>
            </div>
            <div class="popup-contact-row">
                <strong>Email:</strong>
                <span id="modalDonorEmail"></span>
            </div>
        </div>

        <div class="popup-actions">
            <a id="modalCallBtn" href="#" class="btn btn-primary btn-sm" style="text-decoration:none; padding: 8px 16px;">
                📞 Call Now
            </a>
            <button type="button" id="closeContactModalBtn" class="btn btn-outline btn-sm">
                Close
            </button>
        </div>
    </div>
</div>

<!-- Login Required Prompt Modal (For Guests / Privacy Protection) -->
<div id="loginPromptModal" class="popup-overlay" style="display: none;">
    <div class="popup-box">
        <h2>🔒 Log In Required</h2>
        <p>To protect donor privacy and prevent spam, please log in to view donor contact information.</p>
        <div class="popup-actions">
            <button class="btn btn-primary btn-sm" onclick="window.location.href='../../views/authority/login.php'">
                Log In
            </button>
            <button class="btn btn-outline btn-sm" onclick="window.location.href='../../views/authority/userRegistration.php'">
                Register
            </button>
            <button type="button" id="closeLoginPromptBtn" class="btn btn-outline btn-sm" style="border:none; color:var(--gray);">
                Cancel
            </button>
        </div>
    </div>
</div>

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
            <a href="../../views/blood/findBlood.php">Find Blood </a>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const contactBtns       = document.querySelectorAll('.view-contact-btn');
    const contactModal      = document.getElementById('contactModal');
    const loginPromptModal  = document.getElementById('loginPromptModal');
    const closeContactBtn   = document.getElementById('closeContactModalBtn');
    const closeLoginBtn     = document.getElementById('closeLoginPromptBtn');

    contactBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            const isLoggedIn = btn.getAttribute('data-logged-in') === '1';

            if (isLoggedIn) {
                // User is authenticated -> show donor contact details
                document.getElementById('modalDonorName').textContent = btn.getAttribute('data-name');
                document.getElementById('modalDonorGroup').textContent = btn.getAttribute('data-group');
                document.getElementById('modalDonorPhone').textContent = btn.getAttribute('data-phone');
                document.getElementById('modalDonorEmail').textContent = btn.getAttribute('data-email');
                document.getElementById('modalCallBtn').href = 'tel:' + btn.getAttribute('data-phone');
                contactModal.style.display = 'flex';
            } else {
                // Guest user -> show login prompt modal
                loginPromptModal.style.display = 'flex';
            }
        });
    });

    if (closeContactBtn) {
        closeContactBtn.addEventListener('click', function () {
            contactModal.style.display = 'none';
        });
    }

    if (closeLoginBtn) {
        closeLoginBtn.addEventListener('click', function () {
            loginPromptModal.style.display = 'none';
        });
    }

    // Close on overlay backdrop click
    [contactModal, loginPromptModal].forEach(function (modal) {
        if (modal) {
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }
    });
});
</script>
</body>
</html>
