<?php
require_once __DIR__ . '/../config/database.php';

// Find a donor account by email. Returns the row as an array, or false if not found.
function findDonorByEmail($email) {
    
    return false;
}

// Find a donor account by NID. Returns the row as an array, or false if not found.
function findDonorByNid($nid) {
    
    return false;
}

// Insert a new donor. Returns the new donor's id.
function createDonor($fullName, $nid, $phone, $email, $bloodGroup, $lastDonationDate, $previousDonations, $hashedPassword) {
    
    return null;
}
