<?php

require_once __DIR__ . "/../config/database.php";

class AdminController
{

    public function adminStats()
    {
        header("Content-Type: application/json");

        try {
            $database = new Database();
            $connection = $database->connect();

            $donors = 0;
            $users = 0;
            $requests = 0;
            $verified = 0;

            try {
                $donors = $connection->query("SELECT COUNT(*) FROM donors")->fetchColumn() ?: 0;
            } catch (Exception $e) {}

            try {
                $users = $connection->query("SELECT COUNT(*) FROM users WHERE role = 'user'")->fetchColumn() ?: 0;
            } catch (Exception $e) {
                try {
                    $users = $connection->query("SELECT COUNT(*) FROM users")->fetchColumn() ?: 0;
                } catch (Exception $e2) {}
            }

            try {
                $requests = $connection->query("SELECT COUNT(*) FROM blood_requests")->fetchColumn() ?: 0;
            } catch (Exception $e) {}

            try {
                $verified = $connection->query("SELECT COUNT(*) FROM donors WHERE verified = 1")->fetchColumn() ?: 0;
            } catch (Exception $e) {}

            echo json_encode([
                "success" => true,
                "donors" => (int)$donors,
                "users" => (int)$users,
                "requests" => (int)$requests,
                "verified" => (int)$verified
            ]);
        } catch (Exception $e) {
            echo json_encode([
                "success" => false,
                "message" => $e->getMessage(),
                "donors" => 0,
                "users" => 0,
                "requests" => 0,
                "verified" => 0
            ]);
        }
    }

    public function deleteUser()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = (new Database())->connect();
            $db->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
        }
        redirect("admin-users");
    }

    public function deleteDonor()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = (new Database())->connect();
            $db->prepare("DELETE FROM donors WHERE user_id = ?")->execute([$id]);
        }
        redirect("admin-donors");
    }

    public function saveUser()
    {
        $db = (new Database())->connect();
        $id = $_POST['id'] ?? '';
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($id) {
            // Update
            try {
                if ($password) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $db->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?")->execute([$name, $email, $hash, $id]);
                } else {
                    $db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?")->execute([$name, $email, $id]);
                }
            } catch (Exception $e) {
                if ($password) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $db->prepare("UPDATE users SET full_name = ?, email = ?, password = ? WHERE id = ?")->execute([$name, $email, $hash, $id]);
                } else {
                    $db->prepare("UPDATE users SET full_name = ?, email = ? WHERE id = ?")->execute([$name, $email, $id]);
                }
            }
        } else {
            // Add
            $hash = password_hash($password, PASSWORD_DEFAULT);
            try {
                $db->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')")->execute([$name, $email, $hash]);
            } catch (Exception $e) {
                $db->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'user')")->execute([$name, $email, $hash]);
            }
        }
        redirect("admin-users");
    }

    public function saveDonor()
    {
        $db = (new Database())->connect();
        $id = $_POST['id'] ?? '';
        $user_id = $_POST['user_id'] ?? '';
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $blood_group = $_POST['blood_group'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $verified = $_POST['verified'] ?? 0;

        if ($id) {
            // Update user part
            try {
                $db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?")->execute([$name, $email, $user_id]);
            } catch (Exception $e) {
                $db->prepare("UPDATE users SET full_name = ?, email = ? WHERE id = ?")->execute([$name, $email, $user_id]);
            }
            // Update donor part
            $db->prepare("UPDATE donors SET blood_group = ?, phone = ?, verified = ? WHERE id = ?")->execute([$blood_group, $phone, $verified, $id]);
        } else {
            // Add user and donor
            $password = $_POST['password'] ?? 'donor123';
            $hash = password_hash($password, PASSWORD_DEFAULT);
            try {
                $db->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')")->execute([$name, $email, $hash]);
            } catch (Exception $e) {
                $db->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'user')")->execute([$name, $email, $hash]);
            }
            $new_user_id = $db->lastInsertId();
            $db->prepare("INSERT INTO donors (user_id, blood_group, phone, verified) VALUES (?, ?, ?, ?)")->execute([$new_user_id, $blood_group, $phone, $verified]);
        }
        redirect("admin-donors");
    }
}