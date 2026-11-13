<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Get search parameters
$bloodGroup = $_GET['blood_group'] ?? 'O+';
$location   = $_GET['location'] ?? '';
$radius     = (int)($_GET['radius'] ?? 5);
$lat        = $_GET['lat'] ?? '';
$lng        = $_GET['lng'] ?? '';

// 2. Check if user is logged in (to show contact details later)
$isLoggedIn = isset($_SESSION['user_id']);
$userName   = $_SESSION['name'] ?? 'User';
$userRole   = $_SESSION['role'] ?? 'user';
$profileUrl = $userRole === 'donor' ? 'index.php?page=donor-dashboard' : ($userRole === 'admin' ? 'index.php?page=admin-dashboard' : 'index.php?page=user-dashboard');

// 3. Connect to Database
require_once "../config/database.php";
$db = new Database();
$conn = $db->connect();

$donors = [];

// 4. Run the Search Query
if ($lat !== '' && $lng !== '') {
    // We use the Haversine formula to calculate the distance between coordinates in KM
    $sql = "
        SELECT 
            donors.id, 
            users.name, 
            users.email, 
            donors.phone, 
            donors.blood_group, 
            donors.last_donation_date, 
            donors.total_donations, 
            (
                6371 * ACOS(
                    LEAST(1.0, COS(RADIANS(:lat)) 
                    * COS(RADIANS(donors.latitude)) 
                    * COS(RADIANS(donors.longitude) - RADIANS(:lng)) 
                    + SIN(RADIANS(:lat)) 
                    * SIN(RADIANS(donors.latitude)))
                )
            ) AS distance
        FROM donors
        INNER JOIN users ON donors.user_id = users.id
        WHERE donors.blood_group = :blood_group
        AND donors.availability = 1
        HAVING distance <= :radius
        ORDER BY distance ASC
    ";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':lat' => $lat,
        ':lng' => $lng,
        ':blood_group' => $bloodGroup,
        ':radius' => $radius
    ]);
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Format the results for the HTML page
    foreach ($results as $row) {
        $donors[] = [
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'blood_group' => $row['blood_group'],
            'distance' => round($row['distance'], 1),
            'last_date' => $row['last_donation_date'] ? date('M d, Y', strtotime($row['last_donation_date'])) : 'Never',
            'donations' => $row['total_donations']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results · BloodBridge</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/1.home.css">
    <link rel="stylesheet" href="style/blood.css">
</head>
<body>

    <!-- Navbar -->
    <header class="navbar">
        <div class="brand">
            BloodBridge               
            <img src="images/logo.jpg" alt="Logo">        
        </div>

        <nav class="nav-links">
            <a href="index.php?page=home">Home</a>
            <a href="index.php?page=find-blood" class="active">Find Blood</a>
            <a href="index.php?page=donor-register">Become a Donor</a>
        </nav>

        <div class="nav-actions">        
            <?php if ($isLoggedIn): ?>
                <a href="<?php echo $profileUrl; ?>" style="text-decoration:none; color: black; font-weight: bold;">
                    👤 <?php echo $userName; ?>
                </a>
                <form method="POST" action="index.php?page=logout" style="display:inline;">
                    <button type="submit" class="btn btn-primary btn-sm">Logout</button>
                </form>
            <?php else: ?>
                <a href="index.php?page=login" class="btn btn-outline btn-sm">Log in</a>
                <a href="index.php?page=user-register" class="btn btn-primary btn-sm">Register</a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Search Results Section -->
    <section class="search-results-section">
        
        <div class="search-results-header">
            <div>
                <h2>Donors Near You</h2>
                <p>Showing donors within <?php echo $radius; ?> KM</p>
            </div>
            <div>
                <span class="badge badge-red">Blood group: <?php echo htmlspecialchars($bloodGroup); ?></span>
                <br>
                <a href="index.php?page=find-blood" style="color: red; text-decoration: none; font-size: 14px;">Change search</a>
            </div>
        </div>

        <!-- Loop Through Donors -->
        <?php if (count($donors) > 0): ?>
            <?php foreach ($donors as $donor): ?>
                <div class="card donor-card">
                    <div>
                        <h3 style="margin: 0;"><?php echo htmlspecialchars($donor['name']); ?></h3>
                        <p style="margin: 5px 0; color: gray; font-size: 14px;">
                            Distance: <?php echo $donor['distance']; ?> km away <br>
                            Last donation: <?php echo $donor['last_date']; ?>
                        </p>
                    </div>
                    
                    <div>
                        <span class="badge badge-success">Available</span>
                        <!-- Pass donor data to Javascript when button is clicked -->
                        <button 
                            type="button" 
                            class="btn btn-outline btn-sm"
                            onclick="showContactModal('<?php echo $donor['name']; ?>', '<?php echo $donor['phone']; ?>', '<?php echo $donor['email']; ?>', '<?php echo $isLoggedIn; ?>')"
                        >
                            View Contact
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card" style="text-align: center;">
                <h3>No Donors Found</h3>
                <p>We could not find any active donors matching <?php echo htmlspecialchars($bloodGroup); ?> in this radius.</p>
                <a href="index.php?page=find-blood" class="btn btn-primary btn-sm" style="text-decoration:none;">Try Wider Search</a>
            </div>
        <?php endif; ?>
    </section>

    <!-- Popup Modal For Logged In Users -->
    <div id="contactModal" class="popup-overlay" style="display: none;">
        <div class="popup-box">
            <h2 id="modalName">Donor Name</h2>
            <div class="popup-contact-info">
                <p><strong>Phone:</strong> <span id="modalPhone"></span></p>
                <p><strong>Email:</strong> <span id="modalEmail"></span></p>
            </div>
            <button class="btn btn-outline" onclick="closeModal('contactModal')">Close</button>
        </div>
    </div>

    <!-- Popup Modal For Guests -->
    <div id="loginModal" class="popup-overlay" style="display: none;">
        <div class="popup-box">
            <h2>Log In Required</h2>
            <p>Please log in to view donor contact information.</p>
            <a href="index.php?page=login" class="btn btn-primary">Log In</a>
            <button class="btn btn-outline" onclick="closeModal('loginModal')">Cancel</button>
        </div>
    </div>

    <!-- Simple JavaScript for Modals -->
    <script>
        function showContactModal(name, phone, email, isLoggedIn) {
            if (isLoggedIn) {
                document.getElementById('modalName').innerText = name;
                document.getElementById('modalPhone').innerText = phone;
                document.getElementById('modalEmail').innerText = email;
                document.getElementById('contactModal').style.display = 'flex';
            } else {
                document.getElementById('loginModal').style.display = 'flex';
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
    </script>
</body>
</html>
