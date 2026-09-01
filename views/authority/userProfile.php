<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile</title>

    <link rel="stylesheet" href="../../public/style/profile.css">
    <link rel="stylesheet" href="../../public/style/1.home.css">
</head>

<body>

    <header class="navbar">

        <div class="brand">
            BloodBridge
            <img src="../../public/images/logo.jpg" alt="BloodBridge Logo">
        </div>

        <a href="../../views/home/1.home.php" class="back-home">← Back to home</a>

    </header>

    <div class="profile-container">

        <!-- Header -->

        <div class="profile-header">

            <div class="profile-icon">
                👤
            </div>

            <div>
                <h1>User Profile</h1>
                <p>Manage your account information</p>
            </div>

        </div>


        <!-- Profile Form -->

        <div class="profile-form">

            <div class="section-title">
                <h2>Personal Information</h2>
            </div>


            <div class="form-group">
                <label>Full Name</label>

                <input
                    type="text"
                    value="Shojjoti Hossen"
                    placeholder="Enter your full name">
            </div>


            <div class="form-group">
                <label>Email</label>

                <input
                    type="email"
                    value="example@gmail.com"
                    placeholder="Enter your email">
            </div>


            <div class="section-title security-title">
                <h2>Security</h2>
            </div>


            <div class="form-group">
                <label>Password</label>

                <input
                    type="password"
                    value="password123"
                    placeholder="Enter password">
            </div>


            <div class="form-group">
                <label>Confirm Password</label>

                <input
                    type="password"
                    value="password123"
                    placeholder="Confirm password">
            </div>


            <!-- Account Status -->

            <div class="section-title account-title">
                <h2>Account Information</h2>
            </div>


            <div class="status-box">

                <div class="status-item">

                    <span class="status-label">
                        Account Status
                    </span>

                    <span class="status active">
                        Active
                    </span>

                </div>

            </div>


            <!-- Buttons -->

            <div class="button-container">

                <button class="cancel-btn">
                    Cancel
                </button>

                <button class="update-btn">
                    Update Profile
                </button>

            </div>

        </div>

    </div>

</body>
</html>