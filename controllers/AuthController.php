<?php

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../models/user.php";
require_once __DIR__ . "/../models/donor.php";

class AuthController
{

    public function login()
    {
        $email = trim($_POST["email"] ?? "");
        $password = $_POST["password"] ?? "";

        $errors = [];


        if ($email === "") {
            $errors[] = "Gmail is required.";
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Enter a valid Gmail.";
        }


        if ($password === "") {
            $errors[] = "Password is required.";
        }


        if (!empty($errors)) {
            $_SESSION["old"] = ["email" => $email];
            $_SESSION["errors"] = $errors;
            redirect("login");
        }


        $userModel = new User();

        $user = $userModel->findByEmail($email);


        if (!$user || !password_verify($password, $user["password"])) {
            $_SESSION["old"] = ["email" => $email];
            $_SESSION["errors"] = [
                "Invalid Gmail or password."
            ];

            redirect("login");
        }


        $role = strtolower(trim($user["role"] ?? "user"));
        $name = $user["name"] ?? ($user["full_name"] ?? "Admin");

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["role"] = $role;
        $_SESSION["name"] = $name;
        $_SESSION["logged_in"] = true;
        $_SESSION["user_role"] = $role;
        $_SESSION["user_name"] = $name;

        if ($role === "admin") {
            redirect("admin-dashboard");
        } elseif ($role === "donor") {
            redirect("donor-dashboard");
        } else {
            redirect("home");
        }
    }


    public function userRegister()
    {
        $name = trim($_POST["name"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $password = $_POST["password"] ?? "";
        $confirmPassword = $_POST["confirm_password"] ?? "";


        $errors = [];


        if ($name === "") {
            $errors[] = "Name is required.";
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Enter a valid Gmail.";
        }


        if (strlen($password) < 8) {
            $errors[] = "Password must contain at least 8 characters.";
        }


        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match.";
        }


        $userModel = new User();

        if ($userModel->findByEmail($email)) {
            $errors[] = "This email is already registered.";
        }


        if (!empty($errors)) {

            $_SESSION["errors"] = $errors;

            redirect("user-register");
        }


        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );


        $userModel->create(
            $name,
            $email,
            $hashedPassword
        );


        redirect("login");
    }


    public function donorRegister()
    {
        $name = trim($_POST["name"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $password = $_POST["password"] ?? "";
        $confirmPassword = $_POST["confirm_password"] ?? "";

        $nid = trim($_POST["nid"] ?? "");
        $phone = trim($_POST["phone"] ?? "");
        $bloodGroup = $_POST["blood_group"] ?? "";

        $lastDonation = $_POST["last_donation_date"] ?? null;
        $totalDonations = $_POST["total_donations"] ?? 0;

        $latitude = $_POST["latitude"] ?? null;
        $longitude = $_POST["longitude"] ?? null;

        $availability = $_POST["availability"] ?? 1;


        $errors = [];


        if ($name === "") {
            $errors[] = "Name is required.";
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Enter a valid Gmail.";
        }


        if (!preg_match('/^[0-9]{10}$|^[0-9]{13}$|^[0-9]{17}$/', $nid)) {
            $errors[] = "Invalid NID number.";
        }


        if (!preg_match('/^01[3-9][0-9]{8}$/', $phone)) {
            $errors[] = "Invalid Bangladesh phone number.";
        }


        $validBloodGroups = [
            "A+",
            "A-",
            "B+",
            "B-",
            "AB+",
            "AB-",
            "O+",
            "O-"
        ];


        if (!in_array($bloodGroup, $validBloodGroups)) {
            $errors[] = "Invalid blood group.";
        }


        if (strlen($password) < 8) {
            $errors[] = "Password must contain at least 8 characters.";
        }


        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match.";
        }


        if (!is_numeric($totalDonations) || $totalDonations < 0) {
            $errors[] = "Invalid donation count.";
        }


        if ($lastDonation !== "") {

            $date = strtotime($lastDonation);

            if ($date > time()) {
                $errors[] = "Last donation date cannot be in the future.";
            }
        }


        $userModel = new User();

        if ($userModel->findByEmail($email)) {
            $errors[] = "This email is already registered.";
        }


        if (!empty($errors)) {

            $_SESSION["errors"] = $errors;

            redirect("donor-register");
        }


        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );


        $userModel->create(
            $name,
            $email,
            $hashedPassword
        );


        $user = $userModel->findByEmail($email);


        /*
        The donor role is changed after user creation.
        */

        $database = new Database();
        $connection = $database->connect();

        $statement = $connection->prepare(
            "UPDATE users SET role = 'donor' WHERE id = :id"
        );

        $statement->execute([
            ":id" => $user["id"]
        ]);


        $donorModel = new Donor();


        $donorModel->create([
            "user_id" => $user["id"],
            "nid" => $nid,
            "phone" => $phone,
            "blood_group" => $bloodGroup,
            "last_donation_date" => $lastDonation ?: null,
            "total_donations" => $totalDonations,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "availability" => $availability
        ]);


        redirect("login");
    }


    public function logout()
    {
        session_unset();
        session_destroy();

        redirect("home");
    }

    public function forgotPassword()
    {
        $email = trim($_POST['email'] ?? '');
        if ($email === '') {
            $_SESSION['errors'] = ['email' => 'Email is required.'];
            redirect('forgot-password');
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);
        
        if (!$user) {
            // Display success anyway to prevent email enumeration, but in this prototype we can show error or success.
            // Let's redirect to reset anyway for simplicity, or we can just proceed.
            $_SESSION['reset_email'] = $email;
            redirect('reset-password');
        }

        $_SESSION['reset_email'] = $email;
        // In a real app we'd send an OTP here.
        redirect('reset-password');
    }

    public function resetPassword()
    {
        $email = $_SESSION['reset_email'] ?? '';
        if (!$email) {
            redirect('forgot-password');
        }

        $password = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $errors = [];

        if (strlen($password) < 8) {
            $errors['new_password'] = 'Password must be at least 8 characters.';
        }
        if ($password !== $confirmPassword) {
            $errors['confirm_password'] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            redirect('reset-password');
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $database = new Database();
            $connection = $database->connect();
            $statement = $connection->prepare("UPDATE users SET password = :password WHERE email = :email");
            $statement->execute([':password' => $hashedPassword, ':email' => $email]);
        }

        unset($_SESSION['reset_email']);
        redirect('login');
    }
}

// Handle direct form submissions if called directly outside of index.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && basename($_SERVER['PHP_SELF']) === 'AuthController.php') {
    $auth = new AuthController();
    $action = $_GET['action'] ?? ($_POST['action'] ?? 'login');
    if ($action === 'userRegister') {
        $auth->userRegister();
    } elseif ($action === 'donorRegister') {
        $auth->donorRegister();
    } elseif ($action === 'logout') {
        $auth->logout();
    } else {
        $auth->login();
    }
}