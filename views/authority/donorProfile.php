<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Profile</title>

    <link rel="stylesheet" href="profile.css">
</head>

<body>

    <div class="profile-container">

        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-icon">
                🩸
            </div>

            <div>
                <h1>Donor Profile</h1>
                <p>Manage your donor information</p>
            </div>
        </div>


        <!-- Profile Form -->
        <div class="profile-form">

            <div class="section-title">
                <h2>Personal Information</h2>
            </div>


            <div class="form-row">

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" value="Shojjoti Hossen">
                </div>

                <div class="form-group">
                    <label>NID Number</label>
                    <input type="text" value="1234567890">
                </div>

            </div>


            <div class="form-row">

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" value="01XXXXXXXXX">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" value="example@gmail.com">
                </div>

            </div>


            <div class="form-row">

                <div class="form-group">
                    <label>Blood Group</label>

                    <select>
                        <option>Select blood group</option>
                        <option selected>A+</option>
                        <option>A-</option>
                        <option>B+</option>
                        <option>B-</option>
                        <option>AB+</option>
                        <option>AB-</option>
                        <option>O+</option>
                        <option>O-</option>
                    </select>

                </div>


                <div class="form-group">
                    <label>Last Donation Date</label>
                    <input type="date" value="2026-08-01">
                </div>

            </div>


            <div class="form-row">

                <div class="form-group">
                    <label>Number of Previous Donations</label>
                    <input type="number" value="3">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" value="password123">
                </div>

            </div>


            <div class="form-group confirm-password">
                <label>Confirm Password</label>
                <input type="password" value="password123">
            </div>


            <!-- Account Information -->
            <div class="section-title account-section">
                <h2>Donor Status</h2>
            </div>

            <div class="status-box">

                <div class="status-item">
                    <span class="status-label">Donor Status</span>
                    <span class="status active">Active</span>
                </div>

                <div class="status-item">
                    <span class="status-label">Blood Group</span>
                    <span class="blood-group">A+</span>
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