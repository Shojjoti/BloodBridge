<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!defined("BASE_URL")) {
    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
    if (preg_match('#^(.*?)/(public|controllers|views|config|models)#', $scriptName, $matches)) {
        $baseFolder = $matches[1];
    } else {
        $baseFolder = dirname($scriptName);
        if ($baseFolder === '/' || $baseFolder === '\\') {
            $baseFolder = '';
        }
    }
    define("BASE_URL", rtrim($baseFolder, '/') . "/public/index.php");
}

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