<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Become a Blood Donor</title>
    <link rel="stylesheet" href="../../public/style/1.home.css">
    <link rel="stylesheet" href="../../public/style/donar&UserRegistration.css">
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
        <a href="../../views/authority/login.php">
            Log in
        </a>       
        
    </nav>    
</header>

<div class="main-container">
        <!-- LEFT SIDE -->
        <div class="form-section">
            <div class="form-box">
                <h1>Become a Blood Donor</h1>
                <p class="subtitle">
                    Fill in your information to register as a donor
                </p>

                <form>
                    <div class="form-grid">
                        <!-- Full Name -->
                        <div class="input-group">
                            <label>Full Name</label>
                            <input type="text" placeholder="Enter your full name">
                        </div>

                        <!-- NID -->
                        <div class="input-group">
                            <label>NID Number</label>
                            <input type="text" placeholder="Enter your NID number">
                        </div>

                        <!-- Phone -->
                        <div class="input-group">
                            <label>Phone Number</label>
                            <input type="text" placeholder="01XXXXXXXXX">
                        </div>

                        <!-- Email -->
                        <div class="input-group">
                            <label>Email</label>
                            <input type="email" placeholder="example@gmail.com">
                        </div>

                        <!-- Blood Group -->
                        <div class="input-group">
                            <label>Blood Group</label>

                            <select>
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

                        <!-- Last Donation Date -->
                        <div class="input-group">
                            <label>Last Donation Date</label>
                            <input type="date">
                        </div>

                        <!-- Previous Donations -->
                        <div class="input-group">
                            <label>Number of Previous Donations</label>
                            <input type="number" placeholder="Enter number">
                        </div>

                        <!-- Password -->
                        <div class="input-group">
                            <label>Password</label>

                            <div class="password-box">
                                <input type="password" placeholder="Enter password">
                                <span>◉</span>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="input-group">
                            <label>Confirm Password</label>

                            <div class="password-box">
                                <input type="password" placeholder="Confirm password">
                                <span>◉</span>
                            </div>
                        </div>

                    </div>

                    <!-- Terms -->
                    <div class="terms">
                        <input type="checkbox" id="terms">

                        <label for="terms">
                            I agree to the
                            <span>terms and conditions</span>
                        </label>
                    </div>

                    <!-- Button -->
                    <button type="submit">
                        Register as Donor
                    </button>

                </form>

                <p class="login-text">
                    Already have an account?
                    <a href="../../views/authority/login.php">Login</a>
                </p>

            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="donation-section">
            <!-- Blood Bag Illustration -->
            <div class="blood-illustration">
                <img src="../../public/images/bloodOnBag.png" alt="Blood on Bag">
            </div>

            <div>
                <h2>
                Donate Blood<br>
                Save Life
                </h2>

                <p>
                Your donation can bring<br>
                someone back to life.
                </p>
            </div>
            

        </div>

    </div>

</body>
</html>