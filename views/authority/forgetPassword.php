<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password · BloodBridge</title>
    <link rel="stylesheet" href="../../public/style/auth-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="auth-parent" style="justify-content: center;">
        <div class="auth-left">
            <div class="auth-box-center">
                <div class="auth-icon">
                    <img src="/BloodBridge/public/images/email.png" alt="Forgot Password" width="100%" height="100%">
                </div>

                <h1 class="auth-h1">Forgot Password?</h1>
                <p class="auth-p">Enter your Gmail and we'll send you a verification code.</p>

                <div class="field-block">
                    <label class="field-label">Gmail</label>
                    <input class="field-input" placeholder="example@gmail.com">
                </div>

                <button class="common-btn">Send OTP</button>

                <p class="auth-bottom-text">
                    <a href="login.php" class="auth-link">← Back to login</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
