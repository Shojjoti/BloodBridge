<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../../public/style/1.home.css">
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
        <a href="../../views/blood/findBlood.php">
            Find Blood
        </a>
        <a href="../../views/authority/donerRegistration.php">
            Become a Donor
        </a>
    </nav>


    <div class="nav-actions">        

        <button class="btn btn-outline btn-sm" onclick="window.location.href='../../views/authority/login.php'"> Log in </button>
              
        <button class="btn btn-primary btn-sm" onclick="window.location.href='../../views/authority/donerRegistration.php'"> Register </button>    
                
    </div>
</header>

    <section class="about-section" id="about">

    <div class="about-container">

        <!-- Left Side -->
        <div class="about-content">
            <span class="section-tag"> ABOUT BLOODBRIDGE </span>

            <h2>
                Connecting Donors,
                <span>Saving Lives.</span>
            </h2>

            <p>
                BloodBridge is a blood donor connection platform designed
                to make finding and connecting with blood donors easier,
                faster, and more reliable.
            </p>

            <p>
                Our platform allows eligible donors to register their
                blood group, contact information, donation history and
                location. People who need blood can then search for
                available donors nearby based on their required blood
                group and location.
            </p>

            <p>
                BloodBridge aims to reduce the time required to find a
                suitable blood donor and create a trusted connection
                between people who are willing to donate blood and those
                who urgently need it.
            </p>
        </div>


        <!-- Right Side -->
        <div class="about-card">

            <div class="about-card-header">
                <div class="about-icon">
                    ♥
                </div>

                <div>
                    <h3>
                        Our Mission
                    </h3>

                    <p>
                        Making blood donation more accessible
                        when every second matters.
                    </p>
                </div>

            </div>


            <div class="about-features">
                <div class="about-feature">
                    <span>01</span>
                    <div>
                        <h4>Connect</h4>

                        <p>
                            Connect blood donors with people
                            searching for blood nearby.
                        </p>
                    </div>

                </div>


                <div class="about-feature">
                    <span>02</span>
                    <div>
                        <h4>Verify</h4>

                        <p>
                            Maintain donor information with
                            verified identity and contact details.
                        </p>
                    </div>

                </div>


                <div class="about-feature">
                    <span>03</span>
                    <div>
                        <h4>Save Lives</h4>
                        <p>
                            Help people find suitable blood
                            donors faster during emergencies.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Team -->
    <div class="team-container">
        <div class="team-heading">
            <span class="section-tag">
                OUR TEAM
            </span>

            <h2>
                Meet the People Behind
                <span>BloodBridge</span>
            </h2>

            <p>
                BloodBridge is developed with the goal of using
                technology to make blood donation easier and more
                accessible for everyone.
            </p>

        </div>


        <div class="team-grid">

            <!-- Shojjoti -->
            <div class="team-card">

                <div class="team-avatar">
                    S
                </div>

                <h3>
                    Shojjoti
                </h3>

                <span class="team-role">
                    Co-Founder & Developer
                </span>

                <p>
                    Shojjoti contributes to the design and development
                    of BloodBridge, focusing on creating a simple,
                    user-friendly platform that makes it easier for
                    people to connect with blood donors.
                </p>

            </div>


            <!-- Mustak -->
            <div class="team-card">

                <div class="team-avatar">
                    M
                </div>

                <h3>
                    Mustak
                </h3>

                <span class="team-role">
                    Co-Founder & Developer
                </span>

                <p>
                    Mustak contributes to the development and technical
                    implementation of BloodBridge, helping build the
                    platform's functionality and reliable donor
                    connection system.
                </p>

            </div>


            <!-- Rubeyat -->
            <div class="team-card">

                <div class="team-avatar">
                    R
                </div>

                <h3>
                    Rubeyat
                </h3>

                <span class="team-role">
                    Co-Founder & Developer
                </span>

                <p>
                    Rubeyat contributes to the development and overall
                    project implementation, helping BloodBridge become
                    a practical platform for connecting blood donors
                    with people in need.
                </p>

            </div>

        </div>

    </div>

</section>
</body>
</html>