<?php
session_start();
require_once __DIR__ . '/../models/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];

    // Collect and trim input
    $fullName = trim($_POST['fullName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Validate Full Name
    if ($fullName === '') {
        $errors['fullName'] = 'Full name is required.';
    } elseif (strlen($fullName) < 3) {
        $errors['fullName'] = 'Full name must be at least 3 characters.';
    } elseif (!preg_match("/^[A-Za-z\s.'-]+$/", $fullName)) {
        $errors['fullName'] = 'Full name can only contain letters and spaces.';
    }

    // Validate Email
    if ($email === '') {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
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

    // If there are errors, send back to the form
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = ['fullName' => $fullName, 'email' => $email];
        header('Location: ../views/authority/userRegistration.php');
        exit;
    }

    // Check for duplicate email before inserting
    if (findUserByEmail($email)) {
        $errors['email'] = 'An account with this email already exists.';
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = ['fullName' => $fullName, 'email' => $email];
        header('Location: ../views/authority/userRegistration.php');
        exit;
    }

    // Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    createUser($fullName, $email, $hashedPassword);

    // On success
    $_SESSION['registration_success'] = true;
    $_SESSION['registered_name'] = $fullName;
    header('Location: ../views/authority/login.php');
    exit;

} else {
    header('Location: ../views/authority/userRegistration.php');
    exit;
}
