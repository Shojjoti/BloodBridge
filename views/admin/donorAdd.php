<?php
requireAdmin();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Donor - BloodBridge</title>
    <link rel="stylesheet" href="style/authority.css">
    <style>
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 600; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .form-wrapper { max-width: 500px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<div class="container">
    <a href="index.php?page=admin-donors" class="btn btn-outline" style="margin-bottom: 20px;">Back to Donors</a>
    <div class="form-wrapper">
        <h2>Add New Donor</h2>
        <form method="POST" action="index.php?page=admin-donor-save">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Blood Group</label>
                <select name="blood_group" required>
                    <option value="">Select</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" required>
            </div>
            <div class="form-group">
                <label>Verified</label>
                <select name="verified">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="form-group">
                <label>Password (for the user account)</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Donor</button>
        </form>
    </div>
</div>
</body>
</html>
