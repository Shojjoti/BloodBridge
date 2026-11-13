<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Session expired. Please log in again.']);
    exit;
}

$user_id = $_SESSION['user_id'];

$full_name = $_POST['full_name'] ?? '';
$nid_number = $_POST['nid_number'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$blood_group = $_POST['blood_group'] ?? '';
$last_donation_date = $_POST['last_donation_date'] ?? null;
$total_donations = $_POST['total_donations'] ?? 0;
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../models/donor.php';

$availability = $_POST['availability'] ?? null;

if (!empty($password) || !empty($confirm_password)) {
    if ($password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
        exit;
    }
}

$userModel = new User();
$donorModel = new Donor();

// Check if email changed and is already taken
if ($email !== '') {
    $existing = $userModel->findByEmail($email);
    if ($existing && $existing['id'] != $user_id) {
        echo json_encode(['success' => false, 'message' => 'Email is already in use by another account.']);
        exit;
    }
}

// 1. Update User info
$db = new Database();
$conn = $db->connect();
$userSql = "UPDATE users SET name = :name, email = :email";
$userParams = [
    ':name' => $full_name,
    ':email' => $email,
    ':id' => $user_id
];

if (!empty($password)) {
    $userSql .= ", password = :password";
    $userParams[':password'] = password_hash($password, PASSWORD_DEFAULT);
}
$userSql .= " WHERE id = :id";
$stmt = $conn->prepare($userSql);
$stmt->execute($userParams);

// 2. Update Donor info
$donorData = $donorModel->findByUserId($user_id);
if ($donorData) {
    // Safely pull from POST if submitted (full form), else fallback to existing DB data (availability toggle)
    $upd_phone = isset($_POST['phone']) ? $_POST['phone'] : $donorData['phone'];
    $upd_blood_group = isset($_POST['blood_group']) ? $_POST['blood_group'] : $donorData['blood_group'];
    
    $upd_last_donation_date = isset($_POST['last_donation_date']) ? $_POST['last_donation_date'] : $donorData['last_donation_date'];
    if ($upd_last_donation_date === '') $upd_last_donation_date = null;
    
    $upd_total_donations = isset($_POST['total_donations']) ? $_POST['total_donations'] : $donorData['total_donations'];
    if ($upd_total_donations === '') $upd_total_donations = 0;
    
    $upd_location = isset($_POST['location']) ? $_POST['location'] : $donorData['location'];
    
    $upd_latitude = isset($_POST['latitude']) ? $_POST['latitude'] : $donorData['latitude'];
    if ($upd_latitude === '') $upd_latitude = null;
    
    $upd_longitude = isset($_POST['longitude']) ? $_POST['longitude'] : $donorData['longitude'];
    if ($upd_longitude === '') $upd_longitude = null;
    
    $upd_availability = isset($_POST['availability']) ? $_POST['availability'] : $donorData['availability'];
    
    $donorModel->update($user_id, [
        'phone' => $upd_phone,
        'blood_group' => $upd_blood_group,
        'last_donation_date' => $upd_last_donation_date,
        'total_donations' => $upd_total_donations,
        'location' => $upd_location,
        'latitude' => $upd_latitude,
        'longitude' => $upd_longitude,
        'availability' => $upd_availability
    ]);
}

echo json_encode(['success' => true, 'message' => 'Profile updated successfully!']);