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
        <button class="btn btn-outline btn-sm" onclick="window.location.href='../../views/authority/login.php'"> Log in </button>
        <button class="btn btn-primary btn-sm" onclick="window.location.href='../../views/authority/donerRegistration.php'"> Register </button>    
    </div>
</header>

<section class="container find-blood-container">
    <div class="find-blood-form-col">
        <h1 class="find-blood-title">Find Blood Donors</h1>
        <p class="find-blood-subtitle">Search for available blood donors near you</p>

        <div class="field">
            <label>Blood group</label>
            <select class="select">
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
        </div>

        <div class="field">
            <label>Your location</label>
            <div class="input-wrap">
                <input class="input" placeholder="Use my current location">
                <span class="input-icon">
                    <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--red)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M12 2v3M12 19v3M2 12h3M19 12h3"></path>
                    </svg>
                </span>
            </div>
        </div>

        <div class="field">
            <label>Search radius</label>
            <select class="select">
                <option>5 KM</option>
                <option>10 KM</option>
                <option>25 KM</option>
                <option>50 KM</option>
            </select>
        </div>

        <button class="btn btn-primary btn-block" onclick="window.location.href='searchResult.php'">Search Donors</button>
    </div>

    <div class="card map-card">
        <svg viewBox="0 0 400 400" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <rect width="400" height="400" fill="#F1F5F9"/>
            <line x1="0" y1="0" x2="0" y2="400" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="40" y1="0" x2="40" y2="400" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="80" y1="0" x2="80" y2="400" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="120" y1="0" x2="120" y2="400" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="160" y1="0" x2="160" y2="400" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="200" y1="0" x2="200" y2="400" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="240" y1="0" x2="240" y2="400" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="280" y1="0" x2="280" y2="400" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="320" y1="0" x2="320" y2="400" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="360" y1="0" x2="360" y2="400" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="400" y1="0" x2="400" y2="400" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="0" x2="400" y2="0" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="40" x2="400" y2="40" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="80" x2="400" y2="80" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="120" x2="400" y2="120" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="160" x2="400" y2="160" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="200" x2="400" y2="200" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="240" x2="400" y2="240" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="280" x2="400" y2="280" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="320" x2="400" y2="320" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="360" x2="400" y2="360" stroke="#E2E8F0" stroke-width="1"/>
            <line x1="0" y1="400" x2="400" y2="400" stroke="#E2E8F0" stroke-width="1"/>
            <circle cx="200" cy="190" r="30" fill="#FDEEEF"/>
            <path d="M200 130c22 0 38 17 38 38 0 26-38 62-38 62s-38-36-38-62c0-21 16-38 38-38Z" fill="#D62839"/>
            <circle cx="200" cy="168" r="12" fill="#ffffff"/>
        </svg>
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