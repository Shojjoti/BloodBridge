<?php

require_once "../config/config.php";

$page = $_GET['page'] ?? "home";
$action = $_GET['action'] ?? "";

require_once "../controllers/AuthController.php";
require_once "../controllers/DonorController.php";
require_once "../controllers/UserController.php";
require_once "../controllers/BloodSearchController.php";
require_once "../controllers/AdminController.php";


/*
| AJAX GET REQUESTS
*/

if ($action === "searchDonors") {
    $controller = new BloodSearchController();
    $controller->searchDonors();
    exit;
}

if ($action === "donorDetails") {
    $controller = new BloodSearchController();
    $controller->donorDetails();
    exit;
}

if ($action === "adminStats") {
    $controller = new AdminController();
    $controller->adminStats();
    exit;
}


/*
| POST REQUESTS
*/

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if ($page === "login") {
        $controller = new AuthController();
        $controller->login();
        exit;
    }

    if ($page === "donor-register" || $page === "donorRegister" || $page === "doner-register" || $page === "donerRegistration") {
        $controller = new DonorController();
        $controller->register();
        exit;
    }

    if ($page === "user-register" || $page === "userRegister" || $page === "userRegistration") {
        $controller = new UserController();
        $controller->register();
        exit;
    }

    if ($page === "forgot-password" || $page === "forget-password" || $page === "forgotPassword" || $page === "forgetPassword") {
        $controller = new AuthController();
        $controller->forgotPassword();
        exit;
    }

    if ($page === "reset-password" || $page === "resetPassword") {
        $controller = new AuthController();
        $controller->resetPassword();
        exit;
    }

    if ($page === "logout") {
        $controller = new AuthController();
        $controller->logout();
        exit;
    }

    if ($page === "update-donor" || $page === "updateDonor") {
        $controller = new DonorController();
        $controller->updateProfile();
        exit;
    }

    if ($page === "update-user" || $page === "updateUser") {
        $controller = new UserController();
        $controller->updateProfile();
        exit;
    }

    if ($page === "blood-request" || $page === "bloodRequest") {
        $controller = new UserController();
        $controller->createBloodRequest();
        exit;
    }

    if ($page === "admin-user-save") {
        $controller = new AdminController();
        $controller->saveUser();
        exit;
    }

    if ($page === "admin-donor-save") {
        $controller = new AdminController();
        $controller->saveDonor();
        exit;
    }
}


/*
|--------------------------------------------------------------------------
| NORMAL PAGES
|--------------------------------------------------------------------------
*/

switch ($page) {

    case "home":
        require "../views/home/1.home.php";
        break;

    case "about":
        require "../views/home/aboutUs.php";
        break;

    case "login":
        require "../views/authority/login.php";
        break;

    case "donor-register":
    case "donorRegister":
    case "doner-register":
    case "donerRegistration":
        require "../views/authority/donerRegistration.php";
        break;

    case "user-register":
    case "userRegister":
    case "userRegistration":
        require "../views/authority/userRegistration.php";
        break;

    case "forgot-password":
    case "forget-password":
    case "forgotPassword":
    case "forgetPassword":
        require "../views/authority/forgetPassword.php";
        break;

    case "reset-password":
    case "resetPassword":
        require "../views/authority/resetPassword.php";
        break;

    case "donor-dashboard":
    case "donor-details":
    case "donorDetails":
        require "../views/authority/donorDetails.php";
        break;

    case "donor-profile":
    case "donorProfile":
        require "../views/authority/donorProfile.php";
        break;

    case "user-dashboard":
    case "user-profile":
    case "userProfile":
        require "../views/authority/userProfile.php";
        break;

    case "find-blood":
    case "findBlood":
        require "../views/blood/findBlood.php";
        break;

    case "search-results":
    case "searchResult":
    case "search-result":
        require "../views/blood/searchResult.php";
        break;

    case "dashboard":
    case "admin-dashboard":
    case "adminDashboard":
        requireAdmin();
        require "../views/admin/dashboard.php";
        break;

    case "admin-donors":
    case "adminDonors":
        requireAdmin();
        require "../views/admin/donors.php";
        break;

    case "admin-users":
    case "adminUsers":
        requireAdmin();
        require "../views/admin/users.php";
        break;

    case "admin-user-add":
        requireAdmin();
        require "../views/admin/userAdd.php";
        break;

    case "admin-user-edit":
        requireAdmin();
        require "../views/admin/userEdit.php";
        break;

    case "admin-user-delete":
        requireAdmin();
        $controller = new AdminController();
        $controller->deleteUser();
        break;

    case "admin-donor-add":
        requireAdmin();
        require "../views/admin/donorAdd.php";
        break;

    case "admin-donor-edit":
        requireAdmin();
        require "../views/admin/donorEdit.php";
        break;

    case "admin-donor-delete":
        requireAdmin();
        $controller = new AdminController();
        $controller->deleteDonor();
        break;

    case "admin-requests":
    case "adminRequests":
    case "bloodRequest":
        requireAdmin();
        require "../views/admin/bloodRequest.php";
        break;

    case "admin-donor-details":
    case "donorDetails":
        requireAdmin();
        require "../views/admin/donorDetails.php";
        break;

    case "admin-settings":
    case "settings":
        requireAdmin();
        require "../views/admin/settings.php";
        break;

    default:
        require "../views/home/1.home.php";
        break;
}