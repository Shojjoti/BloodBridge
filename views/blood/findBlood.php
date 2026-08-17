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
            </select>
        </div>

        <button class="btn btn-primary btn-block" onclick="window.location.href='searchResult.php'">Search Donors</button>
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