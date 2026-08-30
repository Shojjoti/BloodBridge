<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];

    $fullName = trim($_POST['fullName'] ?? '');
    $nid = trim($_POST['nid'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $bloodGroup = trim($_POST['bloodGroup'] ?? '');
    $lastDonationDate = trim($_POST['lastDonationDate'] ?? '');
    $previousDonations = trim($_POST['previousDonations'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';
    $terms = $_POST['terms'] ?? '';

    // Validate Full Name
    if ($fullName === '') {
        $errors['fullName'] = 'Full name is required.';
    } elseif (strlen($fullName) < 3) {
        $errors['fullName'] = 'Full name must be at least 3 characters.';
    } elseif (!preg_match("/^[A-Za-z\s.'-]+$/", $fullName)) {
        $errors['fullName'] = 'Full name can only contain letters and spaces.';
    }

    // Validate NID
    if ($nid === '') {
        $errors['nid'] = 'NID number is required.';
    } elseif (!preg_match('/^\d{10}$|^\d{13}$|^\d{17}$/', $nid)) {
        $errors['nid'] = 'Enter a valid NID (10, 13, or 17 digits).';
    }

    // Validate Phone
    if ($phone === '') {
        $errors['phone'] = 'Phone number is required.';
    } elseif (!preg_match('/^01[3-9]\d{8}$/', $phone)) {
        $errors['phone'] = 'Enter a valid BD phone number.';
    }

    // Validate Email
    if ($email === '') {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // Validate Blood Group
    $validBloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
    if ($bloodGroup === '' || !in_array($bloodGroup, $validBloodGroups)) {
        $errors['bloodGroup'] = 'Please select a valid blood group.';
    }

    // Validate Last Donation Date 
    if ($lastDonationDate !== '') {
        $today = date('Y-m-d');
        if ($lastDonationDate > $today) {
            $errors['lastDonationDate'] = 'Date cannot be in the future.';
        }
    }

    // Validate Previous Donations 
    if ($previousDonations !== '') {
        if (!ctype_digit($previousDonations)) {
            $errors['previousDonations'] = 'Enter a valid number (0 or more).';
        }
    }

    // Validate Password
    if ($password === '') {
        $errors['password'] = 'Password is required.';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters.';
    } elseif (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors['password'] = 'Password must include an uppercase letter and a number.';
    }

    // Validate Confirm Password
    if ($confirmPassword === '') {
        $errors['confirmPassword'] = 'Please confirm your password.';
    } elseif ($password !== $confirmPassword) {
        $errors['confirmPassword'] = 'Passwords do not match.';
    }

    // Validate Terms
    if ($terms !== 'on') {
        $errors['terms'] = 'You must agree to the terms and conditions.';
    }

    // If there are errors, send back to the form
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: ../views/authority/donerRegistration.php');
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);    

    // On success  
    $_SESSION['registration_success'] = true;
    $_SESSION['registered_name'] = $fullName;
    header('Location: ../views/authority/login.php');
    exit;

} else {
    header('Location: ../views/authority/donerRegistration.php');
    exit;
}