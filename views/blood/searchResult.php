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
        <button class="btn btn-outline btn-sm" onclick="window.location.href='../../views/authority/login.php'"> Log in </button>
        <button class="btn btn-primary btn-sm" onclick="window.location.href='../../views/authority/donerRegistration.php'"> Register </button>    
    </div>
</header>

<section class="container search-results-section">
    <div class="search-results-header">
        <div>
            <h1 class="search-results-title">Donors Near You</h1>
            <p class="search-results-subtitle">Showing donors within 5 KM</p>
        </div>
        <div class="search-filter-badge-col">
            <span class="badge badge-red">Blood group: O+</span>
            <div>
                <a href="../../views/blood/findBlood.php" class="change-search-link">Change search</a>
            </div>
        </div>
    </div>

    <!-- Donor Card 1 -->
    <div class="card donor-card">
        <div class="donor-info-group">
            <div class="donor-avatar">RA</div>
            <div>
                <div class="donor-title-row">
                    <span class="donor-name">Rahim Ahmed</span>
                    <span class="badge badge-red">O+</span>
                </div>
                <div class="donor-meta">0.3 km away &middot; Last donation: 12 Apr 2026 &middot; Donations: 5</div>
            </div>
        </div>
        <div class="donor-action-group">
            <span class="badge badge-success">Available</span>
            <button class="btn btn-outline btn-sm">View Contact</button>
        </div>
    </div>

    <!-- Donor Card 2 -->
    <div class="card donor-card">
        <div class="donor-info-group">
            <div class="donor-avatar">KH</div>
            <div>
                <div class="donor-title-row">
                    <span class="donor-name">Karim Hasan</span>
                    <span class="badge badge-red">O+</span>
                </div>
                <div class="donor-meta">0.8 km away &middot; Last donation: 03 May 2026 &middot; Donations: 4</div>
            </div>
        </div>
        <div class="donor-action-group">
            <span class="badge badge-success">Available</span>
            <button class="btn btn-outline btn-sm">View Contact</button>
        </div>
    </div>

    <!-- Donor Card 3 -->
    <div class="card donor-card">
        <div class="donor-info-group">
            <div class="donor-avatar">SR</div>
            <div>
                <div class="donor-title-row">
                    <span class="donor-name">Sadia Rahman</span>
                    <span class="badge badge-red">O+</span>
                </div>
                <div class="donor-meta">1.6 km away &middot; Last donation: 16 Apr 2026 &middot; Donations: 6</div>
            </div>
        </div>
        <div class="donor-action-group">
            <span class="badge badge-success">Available</span>
            <button class="btn btn-outline btn-sm">View Contact</button>
        </div>
    </div>

    <p class="no-donors-text">No more donors found in this area.</p>
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

</body>
</html>
