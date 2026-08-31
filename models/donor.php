<?php
require_once __DIR__ . '/../config/database.php';

// Find a donor account by email. Returns the row as an array, or false if not found.
function findDonorByEmail($email) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM donors WHERE email = :email LIMIT 1');
    $stmt->execute(['email' => $email]);
    return $stmt->fetch();
}

// Find a donor account by NID. Returns the row as an array, or false if not found.
function findDonorByNid($nid) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM donors WHERE nid = :nid LIMIT 1');
    $stmt->execute(['nid' => $nid]);
    return $stmt->fetch();
}

// Insert a new donor. Returns the new donor's id.
function createDonor($fullName, $nid, $phone, $email, $bloodGroup, $lastDonationDate, $previousDonations, $hashedPassword) {
    global $pdo;
    $stmt = $pdo->prepare(
        'INSERT INTO donors (full_name, nid, phone, email, blood_group, last_donation_date, previous_donations, password)
         VALUES (:full_name, :nid, :phone, :email, :blood_group, :last_donation_date, :previous_donations, :password)'
    );
    $stmt->execute([
        'full_name'           => $fullName,
        'nid'                 => $nid,
        'phone'               => $phone,
        'email'               => $email,
        'blood_group'         => $bloodGroup,
        'last_donation_date'  => $lastDonationDate !== '' ? $lastDonationDate : null,
        'previous_donations'  => $previousDonations !== '' ? $previousDonations : 0,
        'password'            => $hashedPassword,
    ]);
    return $pdo->lastInsertId();
}
