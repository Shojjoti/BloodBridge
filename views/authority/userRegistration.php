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

    <title>General User Registration</title>

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

        <a href="index.php?page=home" class="back-home">← Back to home</a>

    </header>

    <!-- Main Container -->
    <div class="main-container">
        <!-- LEFT SIDE  -->
        <div class="form-section">
            <div class="form-box">
                <h1>Create Your Account</h1>
                <p class="subtitle">
                    Join us to find blood donors near you
                </p>

                <form id="registerForm" action="<?php echo defined('BASE_URL') ? BASE_URL . '?page=user-register' : 'index.php?page=user-register'; ?>" method="POST" novalidate>
                    <!-- Full Name -->
                    <div class="input-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName" placeholder="Enter your full name">

                        <span class="error-message" id="fullNameError"></span>
                    </div>
                    <!-- Email -->
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="example@gmail.com">

                        <span class="error-message" id="emailError"></span>
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                        <label for="password">Password</label>
                        <div class="password-box">
                            <input type="password" id="password" name="password" placeholder="Enter password">

                            <span class="error-message" id="passwordError"></span>
                        </div>
                    </div>


                    <!-- Confirm Password -->
                    <div class="input-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="password-box">
                            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password">
                        </div>
                        <span class="error-message" id="confirmPasswordError"></span>
                    </div>

                    <!-- Register Button -->
                    <button type="submit">Register</button>

                </form>


                <!-- Login -->
                <p class="login-text">
                    Already have an account?
                    <a href="index.php?page=login">
                        Login
                    </a>
                </p>

            </div>

        </div>
        <!-- RIGHT SIDE  -->
        <div class="illustration-section">
            <!-- image -->
            <img src="images/peopleBlood.png" onerror="this.src='../../public/images/peopleBlood.png'" alt="peopleBlood">
            <h2>
                Be the reason<br>
                someone smiles today.
            </h2>

        </div>

    </div>


    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-container">
            <!-- ABOUT -->
            <div class="footer-column footer-about">
                <div class="footer-brand">
                    BloodBridge
                    <img src="images/logo.jpg" onerror="this.src='../../public/images/logo.jpg'" alt="blood drop logo">
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

    <script src="js/generalUserReg.js"></script>

</body>

</html>