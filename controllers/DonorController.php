<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/donor.php';
require_once __DIR__ . '/../models/user.php';

class DonorController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('donor-register');
        }

        $errors = [];

        $fullName = trim($_POST['fullName'] ?? '');
        $nid = trim($_POST['nid'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $bloodGroup = trim($_POST['bloodGroup'] ?? '');
        $location = trim($_POST['location'] ?? '');
        $latitude = trim($_POST['lat'] ?? '');
        $longitude = trim($_POST['lng'] ?? '');
        $lastDonationDate = trim($_POST['lastDonationDate'] ?? '');
        $previousDonations = trim($_POST['previousDonations'] ?? '0');
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

        // Validate Location
        if ($location === '') {
            $errors['location'] = 'Location is required.';
        }
        if ($latitude === '' || $longitude === '') {
            $errors['location'] = 'Please select a location from the map suggestions or use GPS.';
        }

        // Validate Last Donation Date 
        if ($lastDonationDate !== '') {
            $today = date('Y-m-d');
            if ($lastDonationDate > $today) {
                $errors['lastDonationDate'] = 'Date cannot be in the future.';
            }
        }

        // Validate Previous Donations 
        if ($previousDonations !== '' && !ctype_digit((string)$previousDonations)) {
            $errors['previousDonations'] = 'Enter a valid number (0 or more).';
        }

        // Validate Password
        if ($password === '') {
            $errors['password'] = 'Password is required.';
        } elseif (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters.';
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
            redirect('donor-register');
        }

        $userModel = new User();
        if ($userModel->findByEmail($email)) {
            $errors['email'] = 'An account with this email already exists.';
            $_SESSION['errors'] = $errors;
            redirect('donor-register');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userModel->create($fullName, $email, $hashedPassword);
        $user = $userModel->findByEmail($email);

        if ($user) {
            $db = new Database();
            $conn = $db->connect();
            $stmt = $conn->prepare("UPDATE users SET role = 'donor' WHERE id = :id");
            $stmt->execute([':id' => $user['id']]);

            $donorModel = new Donor();
            $donorModel->create([
                'user_id' => $user['id'],
                'nid' => $nid,
                'phone' => $phone,
                'blood_group' => $bloodGroup,
                'last_donation_date' => $lastDonationDate ?: null,
                'total_donations' => (int)$previousDonations,
                'location' => $location,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'availability' => 1
            ]);
        }

        $_SESSION['registration_success'] = true;
        $_SESSION['registered_name'] = $fullName;
        redirect('login');
    }

    public function updateProfile()
    {
        // Update profile implementation
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && basename($_SERVER['PHP_SELF']) === 'DonorController.php') {
    $controller = new DonorController();
    $controller->register();
}