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
    <div class="auth-parent">
        <a href="../../views/home/1.home.php" class="back-home">← Back to home</a>

        <div class="auth-left">
            <div class="auth-box">
                <h1 class="auth-h1">Welcome Back</h1>
                <p class="auth-p">Log in to your account</p>

                <div class="field-block">
                    <label class="field-label">Gmail</label>
                    <input class="field-input" placeholder="example@gmail.com">
                </div>

                <div class="field-block">
                    <label class="field-label">Password</label>
                    <div class="field-input-wrap">
                        <input class="field-input" type="password" placeholder="Enter your password">
                        <button class="eye-btn">
                            <img src="/BloodBridge/public/images/eye.png" alt="Toggle password" width="18" height="18">
                        </button>
                    </div>
                </div>

                <div class="forgot-row">
                    <label class="remember-label">
                        <input type="checkbox">
                        Remember me
                    </label>
                    <a href="forgetPassword.php" class="auth-link">Forgot password?</a>
                </div>

                <button class="common-btn">Log in</button>

                <p class="auth-bottom-text">Don't have an account?</p>
                <div class="register-row">
                    <button class="btn-outline" onclick="location.href='donerRegistration.php'">Register as
                        Donor</button>
                    <button class="btn-secondary" onclick="location.href='userRegistration.php'">Register as
                        User</button>
                </div>
            </div>
        </div>

        <div class="auth-right">
            <img src="/BloodBridge/public/images/blood_drop.png" alt="Blood Drop" width="220" height="220">
            <div>
                <h2>Every Drop Counts</h2>
                <p>Sign in to manage requests, track donations, and stay connected.</p>
            </div>
        </div>
    </div>
</body>

</html>
