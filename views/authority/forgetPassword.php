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
    <title>Forgot Password · BloodBridge</title>
    <link rel="stylesheet" href="style/auth-style.css">
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
        <img src="images/logo.jpg" onerror="this.src='../../public/images/logo.jpg'" alt="BloodBridge Logo">        
    </div>

    <a href="index.php?page=home" class="back-home">← Back to home</a>
        
</header> 

    <div class="auth-parent" style="justify-content: center;">
        <div class="auth-left">
            <div class="auth-box-center">
                <div class="auth-icon">
                    <img src="images/email.png" onerror="this.src='../../public/images/email.png'" alt="Forgot Password" width="100%" height="100%">
                </div>

                <h1 class="auth-h1">Forgot Password?</h1>
                <p class="auth-p">Enter your Gmail and we'll send you a verification code.</p>

                <form action="" method="POST" novalidate>
                    <div class="field-block">
                        <label class="field-label">Gmail</label>
                        <input class="field-input" type="email" name="email" placeholder="example@gmail.com">
                        <?php if(!empty($errors['email'])): ?><span class="error-message" style="color:var(--red); font-size:13px; display:block; margin-top:5px;"><?= htmlspecialchars($errors['email']) ?></span><?php endif; ?>
                    </div>

                    <button class="common-btn" type="submit" name="send_otp">Send OTP</button>
                </form>

                <p class="auth-bottom-text">
                    <a href="index.php?page=login" class="auth-link">← Back to login</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>