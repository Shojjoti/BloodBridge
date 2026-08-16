<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>General User Registration</title>
    <link rel="stylesheet" href="public/style/userRegistration.css">
</head>

<body>

    <!-- Page Title -->
    <div class="page-title">
        GENERAL USER REGISTRATION PAGE
    </div>


    <!-- Main Container -->
    <div class="main-container">
        <!-- ================= LEFT SIDE ================= -->
        <div class="form-section">
            <div class="form-box">
                <h1>Create Your Account</h1>
                <p class="subtitle">
                    Join us to find blood donors near you
                </p>

                <form>

                    <!-- Full Name -->
                    <div class="input-group">
                        <label>Full Name</label>
                        <input type="text" placeholder="Enter your full name">
                    </div>
                    <!-- Email -->
                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" placeholder="example@gmail.com">
                    </div>

                    <!-- Password -->
                    <div class="input-group">
                        <label>Password</label>
                        <div class="password-box">
                            <input type="password" placeholder="Enter password" >                           <span>◉</span>
                        </div>
                    </div>


                    <!-- Confirm Password -->
                    <div class="input-group">
                        <label>Confirm Password</label>
                        <div class="password-box">
                            <input  type="password" placeholder="Confirm password">
                            <span>◉</span>
                        </div>
                    </div>

                    <!-- Register Button -->
                    <button type="submit">
                        Register
                    </button>

                </form>


                <!-- Login -->
                <p class="login-text">

                    Already have an account?

                    <a href="views/authority/login.php">
                        Login
                    </a>

                </p>

            </div>

        </div>
        <!-- ================= RIGHT SIDE ================= -->

        <div class="illustration-section">

            <!-- image -->
             <img src="public/..images/..peopleBlood.png" alt="peopleBlood">
            <h2>
                Be the reason<br>
                someone smiles today.
            </h2>

        </div>

    </div>

</body>
</html>