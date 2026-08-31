<?php
session_start();
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../models/donor.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    
    if (isset($_POST['login'])) {

        $errors = [];

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validate Email
        if ($email === '') {
            $errors['email'] = 'Email is required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address.';
        }

        // Validate Password
        if ($password === '') {
            $errors['password'] = 'Password is required.';
        }

        
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = ['email' => $email];
            header('Location: ../views/authority/login.php');
            exit;
        }

       
        $account = findDonorByEmail($email);
        $role = 'donor';

        if (!$account) {
            $account = findUserByEmail($email);
            $role = 'user';
        }

        if (!$account) {
            // No record with this email at all
            $errors['email'] = 'Email does not match any account.';
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = ['email' => $email];
            header('Location: ../views/authority/login.php');
            exit;
        }

        if (!password_verify($password, $account['password'])) {
            $errors['password'] = 'Password does not match.';
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = ['email' => $email];
            header('Location: ../views/authority/login.php');
            exit;
        }

        $_SESSION['logged_in'] = true;
        $_SESSION['user_email'] = $account['email'];
        $_SESSION['user_role'] = $role;
        $_SESSION['user_name'] = $account['full_name'];
        header('Location: ../views/home/1.home.php');
        exit;

    } elseif (isset($_POST['reset_password'])) {

        $errors = [];

        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Validate New Password
        if ($newPassword === '') {
            $errors['new_password'] = 'Password is required.';
        } elseif (strlen($newPassword) < 8) {
            $errors['new_password'] = 'Password must be at least 8 characters.';
        } elseif (!preg_match('/[A-Z]/', $newPassword) || !preg_match('/[0-9]/', $newPassword)) {
            $errors['new_password'] = 'Password must include an uppercase letter and a number.';
        }

        // Validate Confirm Password
        if ($confirmPassword === '') {
            $errors['confirm_password'] = 'Please confirm your password.';
        } elseif ($newPassword !== $confirmPassword) {
            $errors['confirm_password'] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header('Location: ../views/authority/resetPassowrd.php');
            exit;
        }


        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $_SESSION['password_reset_success'] = true;
        header('Location: ../views/authority/login.php');
        exit;

    } else {
        header('Location: ../views/authority/login.php');
        exit;
    }

} else {
    header('Location: ../views/authority/login.php');
    exit;
}
