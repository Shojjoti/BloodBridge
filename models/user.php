<?php
require_once __DIR__ . '/../config/database.php';

// Find a "general user" account by email. Returns the row as an array, or false if not found.
function findUserByEmail($email) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $stmt->execute(['email' => $email]);
    return $stmt->fetch();
}

// Insert a new general user. Returns the new user's id.
function createUser($fullName, $email, $hashedPassword) {
    global $pdo;
    $stmt = $pdo->prepare(
        'INSERT INTO users (full_name, email, password) VALUES (:full_name, :email, :password)'
    );
    $stmt->execute([
        'full_name' => $fullName,
        'email'     => $email,
        'password'  => $hashedPassword,
    ]);
    return $pdo->lastInsertId();
}
