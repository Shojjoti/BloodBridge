<?php
session_start();
$showSuccessPopup = false;
$registeredName = '';

if (isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) {
    $showSuccessPopup = true;
    $registeredName = $_SESSION['registered_name'] ?? '';
    unset($_SESSION['registration_success']);
    unset($_SESSION['registered_name']);
}

$showResetSuccessPopup = false;
if (isset($_SESSION['password_reset_success']) && $_SESSION['password_reset_success'] === true) {
    $showResetSuccessPopup = true;
    unset($_SESSION['password_reset_success']);
}

$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors']);
unset($_SESSION['old']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login · BloodBridge</title>
    <link rel="stylesheet" href="../../public/style/auth-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <header class="navbar">

        <div class="brand">
            BloodBridge
            <img src="../../public/images/logo.jpg" alt="BloodBridge Logo">
        </div>

        <a href="../../views/home/1.home.php" class="back-home">← Back to home</a>

    </header>

    <div class="auth-parent" style="align-items: center; justify-content: center;">

        <div class="login-card">
            <div class="login-card-left">
                <h1 class="auth-h1">Welcome Back</h1>
                <p class="auth-p">Log in to your account</p>

                <form id="loginForm" action="../../controllers/AuthController.php" method="POST" novalidate>
                    <div class="field-block">
                        <label class="field-label">Gmail</label>
                        <input class="field-input" type="email" id="email" name="email" placeholder="example@gmail.com" value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>">
                        <span class="error-message" id="emailError"><?php echo htmlspecialchars($errors['email'] ?? ''); ?></span>
                    </div>

                    <div class="field-block">
                        <label class="field-label">Password</label>
                        <div class="field-input-wrap">
                            <input class="field-input" type="password" id="password" name="password" placeholder="Enter your password">
                            <button class="eye-btn" type="button">
                                <img src="../../public/images/eye.png" alt="Toggle password" width="18" height="18">
                            </button>
                        </div>
                        <span class="error-message" id="passwordError"><?php echo htmlspecialchars($errors['password'] ?? ''); ?></span>
                    </div>

                    <div class="forgot-row">
                        <label class="remember-label">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>
                        <a href="resetPassowrd.php" class="auth-link">Forgot password?</a>
                    </div>

                    <button class="common-btn" type="submit" name="login">Log in</button>
                </form>

                <p class="auth-bottom-text">Don't have an account?</p>
                <div class="register-row">
                    <button class="btn-outline" type="button" onclick="location.href='donerRegistration.php'">Register as
                        Donor</button>
                    <button class="btn-secondary" type="button" onclick="location.href='userRegistration.php'">Register as
                        User</button>
                </div>
            </div>

            <div class="login-card-right">
                <img src="../../public/images/blood_drop.png" alt="Blood Drop" width="180" height="180">
                <div>
                    <h2>Every Drop Counts</h2>
                    <p>Sign in to manage requests, track donations, and stay connected.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- validation -->
    <?php if ($showSuccessPopup): ?>
        <div id="successPopupOverlay" class="popup-overlay">
            <div class="popup-box">
                <h2>🎉 Registration Successful!</h2>
                <p>Welcome, <strong><?php echo htmlspecialchars($registeredName); ?></strong>! You can now log in.</p>
                <button id="closePopupBtn">Continue</button>
            </div>
        </div>
        <script>
            document.getElementById('closePopupBtn').addEventListener('click', function() {
                document.getElementById('successPopupOverlay').style.display = 'none';
            });
        </script>
    <?php endif; ?>

    <?php if ($showResetSuccessPopup): ?>
        <div id="resetSuccessPopupOverlay" class="popup-overlay">
            <div class="popup-box">
                <h2>✅ Password Updated!</h2>
                <p>Your password has been reset successfully. Please log in with your new password.</p>
                <button id="closeResetPopupBtn">Continue</button>
            </div>
        </div>
        <script>
            document.getElementById('closeResetPopupBtn').addEventListener('click', function() {
                document.getElementById('resetSuccessPopupOverlay').style.display = 'none';
            });
        </script>
    <?php endif; ?>

    <script src="../../public/js/login.js"></script>
</body>

</html>