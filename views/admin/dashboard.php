<!-- Admin Dashboard
│
├── Total Donors
├── Total Users
├── Total Blood Requests
├── Active Donors
├── Recent Registrations
├── Recent Blood Requests
└── Quick Actions -->


<?php
requireLogin();

if ($_SESSION["role"] !== "admin") {
    redirect("home");
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Admin Dashboard - BloodBridge</title>

    <link rel="stylesheet"  href="style/authority.css" >
</head>


<body>
<div  class="container" id="adminDashboard">

    <h1> Admin Dashboard</h1>
    <p>
        Welcome,
        <?php echo htmlspecialchars($_SESSION["name"]); ?>
    </p>

    <div class="dashboard-grid">
        <div class="card">
            <h3>Total Donors </h3>
            <h2 id="totalDonors"> 0</h2>
        </div>


        <div class="card">
            <h3>Total Users </h3>

            <h2 id="totalUsers">
                0
            </h2>

        </div>


        <div class="card">

            <h3>
                Blood Requests
            </h3>

            <h2 id="totalRequests">
                0
            </h2>

        </div>


        <div class="card">

            <h3>
                Verified Donors
            </h3>

            <h2 id="verifiedDonors">
                0
            </h2>

        </div>


    </div>


    <a
        href="index.php?page=admin-donors"
        class="btn btn-primary"
    >
        Manage Donors
    </a>


    <a
        href="index.php?page=admin-users"
        class="btn btn-outline"
    >
        Manage Users
    </a>


    <form
        method="POST"
        action="index.php?page=logout"
    >

        <button
            class="btn btn-outline"
        >
            Logout
        </button>

    </form>

</div>


<script src="js/admin.js"></script>

</body>

</html>