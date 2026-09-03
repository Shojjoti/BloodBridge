<!-- Name
Blood Group
Phone
Gmail
NID
Last Donation Date
Total Donations
Location
Account Status -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Donor Dashboard - BloodBridge</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../../public/style/donorDeshboard.css">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

    <div class="dashboard">

        <!-- ================= SIDEBAR ================= -->
        <aside class="sidebar">

            <div class="logo">
                <div class="logo-icon">🩸</div>

                <div>
                    <h2>BloodBridge</h2>
                    <span>Donor Portal</span>
                </div>
            </div>


            <!-- Navigation -->
            <nav class="sidebar-nav">

                <p class="nav-title">MAIN MENU</p>

                <a href="#" class="nav-link active">
                    <span class="nav-icon">⌂</span>
                    <span>Dashboard</span>
                </a>

                <a href="#" class="nav-link">
                    <span class="nav-icon">👤</span>
                    <span>My Profile</span>
                </a>

                <a href="#" class="nav-link">
                    <span class="nav-icon">🩸</span>
                    <span>Donation History</span>
                </a>

                <a href="#" class="nav-link">
                    <span class="nav-icon">📋</span>
                    <span>Blood Requests</span>

                    <span class="notification-count">3</span>
                </a>

                <a href="#" class="nav-link">
                    <span class="nav-icon">🔔</span>
                    <span>Notifications</span>

                    <span class="notification-dot"></span>
                </a>


                <p class="nav-title second-title">ACCOUNT</p>

                <a href="#" class="nav-link">
                    <span class="nav-icon">⚙</span>
                    <span>Settings</span>
                </a>

                <a href="#" class="nav-link logout">
                    <span class="nav-icon">↪</span>
                    <span>Logout</span>
                </a>

            </nav>


            <!-- Sidebar Bottom Profile -->
            <div class="sidebar-profile">

                <div class="profile-avatar">
                    RA
                </div>

                <div class="profile-info">
                    <strong>Rahim Ahmed</strong>
                    <span>Blood Donor</span>
                </div>

                <span class="profile-more">⋮</span>

            </div>

        </aside>


        <!-- ================= MAIN CONTENT ================= -->
        <main class="main-content">


            <!-- TOP HEADER -->
            <header class="top-header">

                <div class="welcome">

                    <h1>Good Morning, Rahim 👋</h1>

                    <p>
                        Thank you for being a BloodBridge donor.
                    </p>

                </div>


                <div class="header-actions">

                    <!-- Search -->
                    <div class="search-box">
                        <span>⌕</span>
                        <input type="text" placeholder="Search...">
                    </div>


                    <!-- Notification -->
                    <button class="header-button notification-button">
                        🔔
                        <span class="header-notification"></span>
                    </button>


                    <!-- Profile -->
                    <div class="header-profile">

                        <div class="header-avatar">
                            RA
                        </div>

                        <div>
                            <strong>Rahim Ahmed</strong>
                            <span>Donor</span>
                        </div>

                        <span class="arrow">⌄</span>

                    </div>

                </div>

            </header>


            <!-- ================= CONTENT ================= -->
            <section class="content">


                <!-- ================= STAT CARDS ================= -->
                <div class="stats-grid">


                    <!-- Total Donations -->
                    <div class="stat-card">

                        <div class="stat-top">

                            <div class="stat-icon blood-icon">
                                🩸
                            </div>

                            <span class="stat-status positive">
                                +2 this year
                            </span>

                        </div>

                        <p>Total Donations</p>

                        <h2>8</h2>

                        <span class="stat-description">
                            Donations completed
                        </span>

                    </div>


                    <!-- Last Donation -->
                    <div class="stat-card">

                        <div class="stat-top">

                            <div class="stat-icon calendar-icon">
                                📅
                            </div>

                        </div>

                        <p>Last Donation</p>

                        <h2>12 Aug</h2>

                        <span class="stat-description">
                            22 days ago
                        </span>

                    </div>


                    <!-- Blood Group -->
                    <div class="stat-card">

                        <div class="stat-top">

                            <div class="stat-icon group-icon">
                                🩸
                            </div>

                            <span class="blood-badge">
                                O+
                            </span>

                        </div>

                        <p>Blood Group</p>

                        <h2>O+</h2>

                        <span class="stat-description">
                            Your blood type
                        </span>

                    </div>


                    <!-- Availability -->
                    <div class="stat-card">

                        <div class="stat-top">

                            <div class="stat-icon available-icon">
                                ✓
                            </div>

                            <span class="available-badge">
                                ACTIVE
                            </span>

                        </div>

                        <p>Availability</p>

                        <h2>Available</h2>

                        <span class="stat-description">
                            Ready to donate
                        </span>

                    </div>

                </div>



                <!-- ================= TWO COLUMN AREA ================= -->
                <div class="two-column">


                    <!-- PROFILE CARD -->
                    <div class="dashboard-card profile-card">

                        <div class="card-header">

                            <div>
                                <h3>My Donor Profile</h3>
                                <p>Your personal donor information</p>
                            </div>

                            <button class="edit-button">
                                ✎ Edit Profile
                            </button>

                        </div>


                        <div class="donor-profile-content">

                            <div class="large-avatar">
                                RA
                            </div>


                            <div class="donor-details">

                                <h2>Rahim Ahmed</h2>

                                <span class="donor-role">
                                    Verified Blood Donor
                                </span>


                                <div class="detail-grid">

                                    <div class="detail-item">

                                        <span class="detail-label">
                                            Blood Group
                                        </span>

                                        <strong class="red-text">
                                            O+
                                        </strong>

                                    </div>


                                    <div class="detail-item">

                                        <span class="detail-label">
                                            Phone
                                        </span>

                                        <strong>
                                            01XXXXXXXXX
                                        </strong>

                                    </div>


                                    <div class="detail-item">

                                        <span class="detail-label">
                                            Email
                                        </span>

                                        <strong>
                                            rahim@gmail.com
                                        </strong>

                                    </div>


                                    <div class="detail-item">

                                        <span class="detail-label">
                                            Location
                                        </span>

                                        <strong>
                                            Dhaka, Bangladesh
                                        </strong>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- AVAILABILITY CARD -->
                    <div class="dashboard-card availability-card">

                        <div class="card-header">

                            <div>

                                <h3>Donation Availability</h3>

                                <p>Manage your donor status</p>

                            </div>

                            <div class="status-circle">
                                ✓
                            </div>

                        </div>


                        <div class="availability-content">

                            <div class="availability-status">

                                <span class="online-dot"></span>

                                <div>

                                    <strong>You are Available</strong>

                                    <p>
                                        You can receive blood requests
                                    </p>

                                </div>

                            </div>


                            <label class="switch">

                                <input type="checkbox" checked>

                                <span class="slider"></span>

                            </label>

                        </div>


                        <div class="availability-message">

                            <span>✓</span>

                            <p>
                                BloodBridge will notify you when
                                someone nearby needs your blood group.
                            </p>

                        </div>

                    </div>

                </div>



                <!-- ================= BLOOD REQUEST SECTION ================= -->
                <div class="dashboard-card requests-card">

                    <div class="card-header">

                        <div>

                            <h3>Urgent Blood Requests</h3>

                            <p>
                                Blood requests matching your profile
                            </p>

                        </div>

                        <a href="#" class="view-all">
                            View All →
                        </a>

                    </div>


                    <div class="request-list">


                        <!-- Request 1 -->
                        <div class="request-item">

                            <div class="request-blood">
                                O+
                            </div>

                            <div class="request-info">

                                <h4>Emergency Blood Needed</h4>

                                <p>
                                    📍 Dhaka Medical College Area
                                </p>

                                <span>
                                    Posted 15 minutes ago
                                </span>

                            </div>


                            <div class="request-details">

                                <strong>2 Bags</strong>

                                <span>Needed Today</span>

                            </div>


                            <button class="respond-button">
                                Respond
                            </button>

                        </div>



                        <!-- Request 2 -->
                        <div class="request-item">

                            <div class="request-blood">
                                O+
                            </div>

                            <div class="request-info">

                                <h4>Blood Required for Patient</h4>

                                <p>
                                    📍 Mirpur, Dhaka
                                </p>

                                <span>
                                    Posted 1 hour ago
                                </span>

                            </div>


                            <div class="request-details">

                                <strong>1 Bag</strong>

                                <span>Tomorrow</span>

                            </div>


                            <button class="respond-button">
                                Respond
                            </button>

                        </div>



                        <!-- Request 3 -->
                        <div class="request-item">

                            <div class="request-blood">
                                O+
                            </div>

                            <div class="request-info">

                                <h4>Urgent Blood Donation</h4>

                                <p>
                                    📍 Uttara, Dhaka
                                </p>

                                <span>
                                    Posted 3 hours ago
                                </span>

                            </div>


                            <div class="request-details">

                                <strong>3 Bags</strong>

                                <span>Needed Today</span>

                            </div>


                            <button class="respond-button">
                                Respond
                            </button>

                        </div>


                    </div>

                </div>



                <!-- ================= BOTTOM TWO COLUMNS ================= -->
                <div class="bottom-grid">


                    <!-- DONATION HISTORY -->
                    <div class="dashboard-card history-card">

                        <div class="card-header">

                            <div>

                                <h3>Recent Donation History</h3>

                                <p>Your latest donations</p>

                            </div>

                            <a href="#" class="view-all">
                                View All →
                            </a>

                        </div>


                        <div class="history-table">

                            <div class="table-row table-heading">

                                <span>Date</span>
                                <span>Location</span>
                                <span>Status</span>

                            </div>


                            <div class="table-row">

                                <span>
                                    12 Aug 2026
                                </span>

                                <span>
                                    Dhaka
                                </span>

                                <span class="completed">
                                    ✓ Completed
                                </span>

                            </div>


                            <div class="table-row">

                                <span>
                                    18 May 2026
                                </span>

                                <span>
                                    Mirpur
                                </span>

                                <span class="completed">
                                    ✓ Completed
                                </span>

                            </div>


                            <div class="table-row">

                                <span>
                                    20 Feb 2026
                                </span>

                                <span>
                                    Dhaka
                                </span>

                                <span class="completed">
                                    ✓ Completed
                                </span>

                            </div>


                        </div>

                    </div>



                    <!-- NOTIFICATIONS -->
                    <div class="dashboard-card notification-card">

                        <div class="card-header">

                            <div>

                                <h3>Notifications</h3>

                                <p>Latest updates</p>

                            </div>

                            <a href="#" class="view-all">
                                View All
                            </a>

                        </div>


                        <div class="notifications">


                            <div class="notification-item">

                                <div class="notification-icon red">
                                    🩸
                                </div>

                                <div>

                                    <strong>
                                        Urgent O+ request
                                    </strong>

                                    <p>
                                        Someone nearby needs O+ blood.
                                    </p>

                                    <span>
                                        10 minutes ago
                                    </span>

                                </div>

                            </div>


                            <div class="notification-item">

                                <div class="notification-icon green">
                                    ✓
                                </div>

                                <div>

                                    <strong>
                                        Donation completed
                                    </strong>

                                    <p>
                                        Thank you for your donation.
                                    </p>

                                    <span>
                                        22 days ago
                                    </span>

                                </div>

                            </div>


                            <div class="notification-item">

                                <div class="notification-icon blue">
                                    ℹ
                                </div>

                                <div>

                                    <strong>
                                        Update your profile
                                    </strong>

                                    <p>
                                        Keep your information up to date.
                                    </p>

                                    <span>
                                        1 month ago
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </section>
        </main>
    </div>
</body>

</html>