<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    if (function_exists('redirect')) {
        redirect("login");
    } else {
        header("Location: index.php?page=login");
        exit;
    }
}

$user_id = $_SESSION['user_id'];

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/donor.php';
require_once __DIR__ . '/../../models/user.php';

$donorModel = new Donor();
$userModel = new User();

$donorData = $donorModel->findByUserId($user_id);
$userData  = $userModel->findById($user_id);

$name       = $userData['name'] ?? ($userData['full_name'] ?? ($_SESSION['name'] ?? 'Donor'));
$email      = $userData['email'] ?? '';
$bloodGroup = !empty($donorData['blood_group']) ? strtoupper($donorData['blood_group']) : 'O+';
$phone      = !empty($donorData['phone']) ? $donorData['phone'] : '01XXXXXXXXX';
$nid        = $donorData['nid'] ?? ($donorData['nid_number'] ?? 'Not Provided');
$location   = $donorData['location'] ?? ($donorData['address'] ?? ($donorData['district'] ?? 'Dhaka, Bangladesh'));
$totalDonations = (int)($donorData['total_donations'] ?? ($donorData['previous_donations'] ?? 0));
$lastDonationDate = $donorData['last_donation_date'] ?? null;
$isVerified = !empty($donorData['verified']) && $donorData['verified'] == 1;
$isAvailable = !isset($donorData['availability']) || $donorData['availability'] == 1 || $donorData['availability'] === '1';

// Initials
$nameParts = preg_split('/\s+/', trim($name));
if (count($nameParts) >= 2) {
    $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[count($nameParts) - 1], 0, 1));
} else {
    $initials = strtoupper(substr($name, 0, 2));
}

// Greeting based on time of day
$hour = (int)date('H');
if ($hour < 12) {
    $greeting = 'Good Morning';
} elseif ($hour < 18) {
    $greeting = 'Good Afternoon';
} else {
    $greeting = 'Good Evening';
}

// Calculate days since last donation
$lastDonationDisplay = 'None';
$daysAgoDisplay = 'No donation recorded';
if (!empty($lastDonationDate) && $lastDonationDate !== '0000-00-00') {
    $timestamp = strtotime($lastDonationDate);
    if ($timestamp) {
        $lastDonationDisplay = date('d M', $timestamp);
        $diffDays = (int)floor((time() - $timestamp) / 86400);
        if ($diffDays <= 0) {
            $daysAgoDisplay = 'Today';
        } elseif ($diffDays === 1) {
            $daysAgoDisplay = '1 day ago';
        } else {
            $daysAgoDisplay = $diffDays . ' days ago';
        }
    }
}

// Fetch urgent matching blood requests from database if table exists
$db = (new Database())->connect();
$bloodRequests = [];
if ($db) {
    try {
        $stmt = $db->prepare("SELECT * FROM blood_requests WHERE blood_group = :bg OR blood_group = :bg_alt ORDER BY id DESC LIMIT 3");
        $stmt->execute([':bg' => $bloodGroup, ':bg_alt' => strtolower($bloodGroup)]);
        $bloodRequests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $bloodRequests = [];
    }
}

if (empty($bloodRequests)) {
    $bloodRequests = [
        [
            'blood_group' => $bloodGroup,
            'title' => 'Emergency Blood Needed',
            'location' => 'Dhaka Medical College Area',
            'posted' => '15 minutes ago',
            'quantity' => '2 Bags',
            'needed' => 'Needed Today'
        ],
        [
            'blood_group' => $bloodGroup,
            'title' => 'Blood Required for Surgery',
            'location' => 'Mirpur, Dhaka',
            'posted' => '1 hour ago',
            'quantity' => '1 Bag',
            'needed' => 'Tomorrow'
        ],
        [
            'blood_group' => $bloodGroup,
            'title' => 'Urgent Blood Donation',
            'location' => 'Uttara, Dhaka',
            'posted' => '3 hours ago',
            'quantity' => '3 Bags',
            'needed' => 'Needed Today'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Donor Dashboard - BloodBridge</title>

    <!-- CSS -->
    <link rel="stylesheet" href="style/donorDeshboard.css">
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

                <a href="index.php?page=donor-dashboard" class="nav-link active">
                    <span class="nav-icon">⌂</span>
                    <span>Dashboard</span>
                </a>

                <a href="index.php?page=donor-profile" class="nav-link">
                    <span class="nav-icon">👤</span>
                    <span>My Profile</span>
                </a>

                <a href="index.php?page=home" class="nav-link">
                    <span class="nav-icon">🌐</span>
                    <span>Home Page</span>
                </a>


                <p class="nav-title second-title">ACCOUNT</p>

                <a href="index.php?page=donor-profile" class="nav-link">
                    <span class="nav-icon">⚙</span>
                    <span>Settings</span>
                </a>

                <form method="POST" action="index.php?page=logout" id="logoutForm" style="margin:0;">
                    <button type="submit" class="nav-link logout" style="width:100%; background:none; border:none; cursor:pointer; text-align:left; font-size:inherit; font-family:inherit;">
                        <span class="nav-icon">↪</span>
                        <span>Logout</span>
                    </button>
                </form>

            </nav>


            <!-- Sidebar Bottom Profile -->
            <div class="sidebar-profile" onclick="window.location.href='index.php?page=donor-profile'" style="cursor:pointer;">

                <div class="profile-avatar">
                    <?= htmlspecialchars($initials) ?>
                </div>

                <div class="profile-info">
                    <strong><?= htmlspecialchars($name) ?></strong>
                    <span><?= $isVerified ? 'Verified Donor' : 'Blood Donor' ?></span>
                </div>

                <span class="profile-more">⋮</span>

            </div>

        </aside>


        <!-- ================= MAIN CONTENT ================= -->
        <main class="main-content">


            <!-- TOP HEADER -->
            <header class="top-header">

                <div class="welcome">

                    <h1><?= htmlspecialchars($greeting) ?>, <?= htmlspecialchars($name) ?> 👋</h1>

                    <p>
                        Thank you for being a BloodBridge donor.
                    </p>

                </div>


                <div class="header-actions">

                    <!-- Search -->
                    <div class="search-box">
                        <span>⌕</span>
                        <input type="text" placeholder="Search requests..." onkeydown="if(event.key==='Enter'){window.location.href='index.php?page=find-blood';}">
                    </div>


                    <!-- Notification -->
                    <button class="header-button notification-button" onclick="window.location.href='index.php?page=find-blood'" title="Urgent requests">
                        🔔
                        <span class="header-notification"></span>
                    </button>


                    <!-- Profile -->
                    <div class="header-profile" onclick="window.location.href='index.php?page=donor-profile'" style="cursor:pointer;">

                        <div class="header-avatar">
                            <?= htmlspecialchars($initials) ?>
                        </div>

                        <div>
                            <strong><?= htmlspecialchars($name) ?></strong>
                            <span>Donor (<?= htmlspecialchars($bloodGroup) ?>)</span>
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
                                <?= $totalDonations > 0 ? '+' . $totalDonations . ' Total' : 'Ready' ?>
                            </span>

                        </div>

                        <p>Total Donations</p>

                        <h2><?= htmlspecialchars((string)$totalDonations) ?></h2>

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

                        <h2><?= htmlspecialchars($lastDonationDisplay) ?></h2>

                        <span class="stat-description">
                            <?= htmlspecialchars($daysAgoDisplay) ?>
                        </span>

                    </div>


                    <!-- Blood Group -->
                    <div class="stat-card">

                        <div class="stat-top">

                            <div class="stat-icon group-icon">
                                🩸
                            </div>

                            <span class="blood-badge">
                                <?= htmlspecialchars($bloodGroup) ?>
                            </span>

                        </div>

                        <p>Blood Group</p>

                        <h2><?= htmlspecialchars($bloodGroup) ?></h2>

                        <span class="stat-description">
                            Your registered type
                        </span>

                    </div>

                </div>



                <!-- ================= PROFILE CARD (FULL WIDTH) ================= -->
                <div class="dashboard-card profile-card" style="margin-bottom: 20px;">

                    <div class="card-header">

                        <div>
                            <h3>My Donor Profile</h3>
                            <p>Your personal donor information</p>
                        </div>

                        <button class="edit-button" onclick="window.location.href='index.php?page=donor-profile'">
                            ✎ Edit Profile
                        </button>

                    </div>


                    <div class="donor-profile-content">

                        <div class="large-avatar">
                            <?= htmlspecialchars($initials) ?>
                        </div>


                        <div class="donor-details" style="flex: 1;">

                            <h2><?= htmlspecialchars($name) ?></h2>

                            <span class="donor-role">
                                <?= $isVerified ? '✓ Verified Blood Donor' : 'Registered Blood Donor' ?>
                            </span>


                            <div class="detail-grid">

                                <div class="detail-item">

                                    <span class="detail-label">
                                        Blood Group
                                    </span>

                                    <strong class="red-text">
                                        <?= htmlspecialchars($bloodGroup) ?>
                                    </strong>

                                </div>


                                <div class="detail-item">

                                    <span class="detail-label">
                                        Phone
                                    </span>

                                    <strong>
                                        <?= htmlspecialchars($phone) ?>
                                    </strong>

                                </div>


                                <div class="detail-item">

                                    <span class="detail-label">
                                        Email
                                    </span>

                                    <strong>
                                        <?= htmlspecialchars($email) ?>
                                    </strong>

                                </div>


                                <div class="detail-item">

                                    <span class="detail-label">
                                        NID Number
                                    </span>

                                    <strong>
                                        <?= htmlspecialchars($nid) ?>
                                    </strong>

                                </div>


                                <div class="detail-item" style="grid-column: span 2;">

                                    <span class="detail-label">
                                        Location
                                    </span>

                                    <strong>
                                        <?= htmlspecialchars($location) ?>
                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>



                <!-- ================= BLOOD REQUEST SECTION ================= -->
                <div class="dashboard-card requests-card">

                    <div class="card-header">

                        <div>

                            <h3>Urgent Blood Requests</h3>

                            <p>
                                Blood requests matching your blood group (<?= htmlspecialchars($bloodGroup) ?>)
                            </p>

                        </div>

                        <a href="index.php?page=find-blood" class="view-all">
                            View All →
                        </a>

                    </div>


                    <div class="request-list">

                        <?php foreach ($bloodRequests as $req): ?>
                        <div class="request-item">

                            <div class="request-blood">
                                <?= htmlspecialchars($req['blood_group'] ?? $bloodGroup) ?>
                            </div>

                            <div class="request-info">

                                <h4><?= htmlspecialchars($req['title'] ?? ($req['request_message'] ?? 'Urgent Blood Needed')) ?></h4>

                                <p>
                                    📍 <?= htmlspecialchars($req['location'] ?? 'Dhaka Area') ?>
                                </p>

                                <span>
                                    Posted <?= htmlspecialchars($req['posted'] ?? ($req['created_at'] ?? 'recently')) ?>
                                </span>

                            </div>


                            <div class="request-details">

                                <strong><?= htmlspecialchars($req['quantity'] ?? '1 Bag') ?></strong>

                                <span><?= htmlspecialchars($req['needed'] ?? 'Needed Urgently') ?></span>

                            </div>


                            <button class="respond-button" onclick="window.location.href='index.php?page=find-blood'">
                                Respond
                            </button>

                        </div>
                        <?php endforeach; ?>

                    </div>

                </div>



                <!-- ================= BOTTOM TWO COLUMNS ================= -->
                <div class="bottom-grid" id="history-section">


                    <!-- DONATION HISTORY -->
                    <div class="dashboard-card history-card">

                        <div class="card-header">

                            <div>

                                <h3>Recent Donation History</h3>

                                <p>Your latest donations record</p>

                            </div>

                            <a href="index.php?page=donor-profile" class="view-all">
                                Edit History →
                            </a>

                        </div>


                        <div class="history-table">

                            <div class="table-row table-heading">

                                <span>Date</span>
                                <span>Location</span>
                                <span>Status</span>

                            </div>

                            <?php if (!empty($lastDonationDate) && $lastDonationDate !== '0000-00-00'): ?>
                            <div class="table-row">

                                <span>
                                    <?= htmlspecialchars(date('d M Y', strtotime($lastDonationDate))) ?>
                                </span>

                                <span>
                                    <?= htmlspecialchars($location) ?>
                                </span>

                                <span class="completed">
                                    ✓ Completed
                                </span>

                            </div>
                            <?php else: ?>
                            <div class="table-row">
                                <span colspan="3" style="color:#687280; font-style:italic;">No past donations logged yet.</span>
                            </div>
                            <?php endif; ?>

                            <?php if ($totalDonations > 1): ?>
                            <div class="table-row">
                                <span>Previous Donations</span>
                                <span>Registered Record</span>
                                <span class="completed">✓ <?= htmlspecialchars((string)($totalDonations - 1)) ?> Recorded</span>
                            </div>
                            <?php endif; ?>

                        </div>

                    </div>



                    <!-- NOTIFICATIONS -->
                    <div class="dashboard-card notification-card">

                        <div class="card-header">

                            <div>

                                <h3>Notifications</h3>

                                <p>Latest updates</p>

                            </div>

                            <a href="index.php?page=find-blood" class="view-all">
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
                                        Urgent <?= htmlspecialchars($bloodGroup) ?> request nearby
                                    </strong>

                                    <p>
                                        Patients in <?= htmlspecialchars($location) ?> need <?= htmlspecialchars($bloodGroup) ?> blood.
                                    </p>

                                    <span>
                                        Active now
                                    </span>

                                </div>

                            </div>


                            <div class="notification-item">

                                <div class="notification-icon green">
                                    ✓
                                </div>

                                <div>

                                    <strong>
                                        <?= $isVerified ? 'Account Verified' : 'Profile Complete' ?>
                                    </strong>

                                    <p>
                                        <?= $isVerified ? 'Your donor profile is fully verified.' : 'Your donor profile is active and ready.' ?>
                                    </p>

                                    <span>
                                        Status updated
                                    </span>

                                </div>

                            </div>


                            <div class="notification-item">

                                <div class="notification-icon blue">
                                    ℹ
                                </div>

                                <div>

                                    <strong>
                                        Keep Your Info Current
                                    </strong>

                                    <p>
                                        Update your last donation date after every blood donation.
                                    </p>

                                    <span>
                                        <a href="index.php?page=donor-profile" style="color:#2563EB; font-weight:600;">Update profile →</a>
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