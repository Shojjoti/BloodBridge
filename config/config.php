<?php

session_start();

define("BASE_URL", "/BloodBridge/public/index.php");

function redirect($page)
{
    header("Location: " . BASE_URL . "?page=" . $page);
    exit;
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        redirect("login");
    }
}

function requireAdmin()
{
    if (
        !isset($_SESSION['user_id']) ||
        $_SESSION['role'] !== "admin"
    ) {
        redirect("login");
    }
}