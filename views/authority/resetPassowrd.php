<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password · BloodBridge</title>
    <link rel="stylesheet" href="../../public/style/auth-style.css">
    <link rel="stylesheet" href="../../public/style/1.home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,900&display=swap"
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

    <div class="auth-parent" style="justify-content: center;">
        <div class="auth-left">
            <div class="auth-box-center">

                <div class="step-row">
                    <div class="step-item">
                        <div class="step-circle step-circle-done">
                            <span style="color: #fff; font-weight: bold;">&#10003;</span>
                        </div>
                        <span class="step-text-todo">Verify OTP</span>
                    </div>
                    <div class="step-line-done"></div>
                    <div class="step-item">
                        <div class="step-circle step-circle-active">
                            <span>2</span>
                        </div>
                        <span class="step-text-active">New Password</span>
                    </div>
                    <div class="step-line"></div>
                    <div class="step-item">
                        <div class="step-circle step-circle-todo">
                            <span>3</span>
                        </div>
                        <span class="step-text-todo">Complete</span>
                    </div>
                </div>

                <div class="auth-icon">
                    <img src="../../public/images/lock.png" alt="Reset Password" width="100%" height="100%">
                </div>

                <h1 class="auth-h1">Set New Password</h1>
                <p class="auth-p">Choose a new password for your account.</p>

                <form action="" method="POST" novalidate>
                    <div class="field-block">
                        <label class="field-label">New password</label>
                        <div class="field-input-wrap">
                            <input class="field-input" type="password" name="new_password" placeholder="Enter new password">
                            <button class="eye-btn" type="button">
                                <img src="../../public/images/eye.png" alt="Toggle password" width="18" height="18">
                            </button>
                        </div>
                    </div>

                    <div class="field-block">
                        <label class="field-label">Confirm password</label>
                        <div class="field-input-wrap">
                            <input class="field-input" type="password" name="confirm_password" placeholder="Confirm new password">
                            <button class="eye-btn" type="button">
                                <img src="../../public/images/eye.png" alt="Toggle password" width="18" height="18">
                            </button>
                        </div>
                    </div>

                    <button class="common-btn" type="submit" name="reset_password">Reset Password</button>
                </form>

                <p class="auth-bottom-text">
                    <a href="login.php" class="auth-link">← Back to login</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>