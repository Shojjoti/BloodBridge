<?php
session_start();

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

if (!empty($password) || !empty($confirm_password)) {
    if ($password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
        exit;
    }
}

if (!empty($password)) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
}


echo json_encode(['success' => true, 'message' => 'Update successful!']);