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


/*POST REQUESTS*/

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if ($page === "login") {

        $controller = new AuthController();
        $controller->login();
        exit;
    }


    if ($page === "donor-register") {

        $controller = new AuthController();
        $controller->donorRegister();
        exit;
    }


    if ($page === "user-register") {

        $controller = new AuthController();
        $controller->userRegister();
        exit;
    }


    if ($page === "logout") {

        $controller = new AuthController();
        $controller->logout();
        exit;
    }


    if ($page === "update-donor") {

        $controller = new DonorController();
        $controller->updateProfile();
        exit;
    }


    if ($page === "update-user") {

        $controller = new UserController();
        $controller->updateProfile();
        exit;
    }


    if ($page === "blood-request") {

        $controller = new UserController();
        $controller->createBloodRequest();
        exit;
    }
}


/* NORMAL PAGES
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
        require "../views/authority/donor-registration.php";
        break;


    case "user-register":
        require "../views/authority/user-registration.php";
        break;


    case "forgot-password":
        require "../views/authority/forgot-password.php";
        break;


    case "reset-password":
        require "../views/authority/reset-password.php";
        break;


    case "find-blood":
        require "../views/blood/find-blood.php";
        break;


    case "search-results":
        require "../views/blood/search-results.php";
        break;


    case "admin-dashboard":

        requireAdmin();
        require "../views/admin/dashboard.php";
        break;


    case "admin-donors":

        requireAdmin();

        require "../views/admin/donors.php";

        break;


    case "admin-users":

        requireAdmin();

        require "../views/admin/users.php";

        break;


    case "admin-requests":

        requireAdmin();

        require "../views/admin/requests.php";

        break;


    default:

        require "../views/home/1.home.php";
}