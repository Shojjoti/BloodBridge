<?php

require_once "../config/database.php";

class AdminController
{

    public function adminStats()
    {
        header("Content-Type: application/json");


        $database = new Database();

        $connection =
            $database->connect();


        $donors =
            $connection
            ->query(
                "SELECT COUNT(*) FROM donors"
            )
            ->fetchColumn();


        $users =
            $connection
            ->query(
                "SELECT COUNT(*) FROM users WHERE role = 'user'"
            )
            ->fetchColumn();


        $requests =
            $connection
            ->query(
                "SELECT COUNT(*) FROM blood_requests"
            )
            ->fetchColumn();


        $verified =
            $connection
            ->query(
                "SELECT COUNT(*) FROM donors WHERE verified = 1"
            )
            ->fetchColumn();


        echo json_encode([

            "success" => true,
            "donors" => $donors,
            "users" => $users,
            "requests" => $requests,
            "verified" => $verified

        ]);
    }
}