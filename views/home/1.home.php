<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home · BloodBridge</title>
    
    <link rel="stylesheet" href="../../public/style/1.home.css">
</head>
<body>
<header class="navbar">

    <div class="brand">
        BloodBridge               
            <img src="../../public/images/logo.jpg" alt="BloodBridge Logo">        
    </div>


    <nav class="nav-links">
        <a href="../../views/home/1.home.php" class="active">
            Home
        </a>
        <a href="../../views/blood/findBlood.php">
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

<section class="hero container">
    <!-- LEFT SIDE -->
    <div class="hero-content">
        <h1>
            Every Drop Can
            <span>Save a Life</span>
        </h1>
        <p>
            BloodBride connects blood donors with people in need.
            Find the right donor, right now, right near you.
        </p>
        <div class="hero-buttons">          

            <button class="btn btn-primary" onclick="window.location.href='../../views/blood/findBlood.php'"> Find Blood Now </button>

            <button class="btn btn-outline" onclick="window.location.href='../../views/authority/donerRegistration.php'"> Become a Donor </button>             
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="hero-image">
        <img src="../../public/images/bloodOnHand.png" alt="Blood Donation">       
    </div>
</section>

<section class="stats container">
    <!-- STAT 1 -->
    <div class="stat-item">
        <div class="stat-icon">
            <img src="../../public/images/users.png" alt="user">
        </div>
        <div class="stat-info">

            <div class="stat-number">
                5,240+
            </div>

            <div class="stat-label">
                Total Donors
            </div>
        </div>
    </div>

    <!-- STAT 2 -->

    <div class="stat-item">
        <div class="stat-icon">
            <!-- IMAGE: Heart icon -->
             <img src="../../public/images/community.png" alt="people helped">
        </div>

        <div class="stat-info">

            <div class="stat-number">
                10,000+
            </div>

            <div class="stat-label">
                People Helped
            </div>
        </div>
    </div>

    <!-- STAT 3 -->
    <div class="stat-item">
        <div class="stat-icon">
            <!-- IMAGE: Blood drop icon -->
             <img src="../../public/images/blood.png" alt="Blood-Request icon">
        </div>

        <div class="stat-info">
            <div class="stat-number">
                2,350+
            </div>

            <div class="stat-label">
                Blood Requests
            </div>
        </div>
    </div>

    <!-- STAT 4 -->
    <div class="stat-item">
        <div class="stat-icon">
            <!-- IMAGE: Location / Map icon -->
             <img src="../../public/images/location-pin.png" alt="cities covers icon">

        </div>

        <div class="stat-info">
            <div class="stat-number">
                120+
            </div>

            <div class="stat-label">
                Cities Covered
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="how-section container">
  <h2>  How It Works   </h2>

    <p class="section-description">
        Three simple steps to save a life
    </p>
    <div class="steps">
        <!-- STEP 1 -->
        <div class="step">
            <div class="step-number">
                1
            </div>
            <img src="../../public/images/user-profile.png" alt="">
            <h3> Register </h3>

            <p>
                Create your free account as a donor
                or someone in need.
            </p>
        </div>

        <div class="step-line"></div>

        <!-- STEP 2 -->
        <div class="step">
            <div class="step-number">
                2
            </div>
            <img src="../../public/images/computer-mouse.png" alt="search">            
            <h3>Search  </h3>
            <p>
                Filter donors near you by blood group
                and location.
            </p>
          </div>
        <div class="step-line"></div>

        <!-- STEP 3 -->
        <div class="step">
            <div class="step-number">
                3
            </div>
            <img src="../../public/images/circle.png" alt="connect">
            <!-- IMAGE: Connect icon/image -->
            <h3>   Connect </h3>
            <p>
                Reach out directly and arrange
                to save a life.
            </p>
        </div>
    </div>
</section>


<!-- BLOOD GROUP SECTION -->
<section class="blood-group-section container">
    <h2>
        Blood Groups
    </h2>

    <p class="section-description">
        We support every blood type
    </p>

    <div class="blood-groups">
        <span>A+</span>
        <span>A-</span>
        <span>B+</span>
        <span>B-</span>
        <span>AB+</span>
        <span>AB-</span>
        <span>O+</span>
        <span>O-</span>
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
                <!-- IMAGE: Small blood drop logo -->
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
            <a href="../../views/home/aboutUs.php"> About Us  </a>
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
            <h4> For Users  </h4>
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