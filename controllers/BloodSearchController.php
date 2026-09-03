<?php

require_once "../config/database.php";

class BloodSearchController
{

    public function searchDonors()
    {
        header("Content-Type: application/json");


        $bloodGroup =
            $_GET["blood_group"] ?? "";

        $latitude =
            $_GET["latitude"] ?? "";

        $longitude =
            $_GET["longitude"] ?? "";


        if (
            $bloodGroup === "" ||
            !is_numeric($latitude) ||
            !is_numeric($longitude)
        ) {

            echo json_encode([
                "success" => false,
                "message" => "Invalid search information."
            ]);

            return;
        }


        $database = new Database();

        $connection = $database->connect();


        /*
        Haversine formula.
        Distance is calculated in KM.
        */

        $sql = "
            SELECT
                donors.id,
                users.name,
                users.email,
                donors.phone,
                donors.blood_group,
                donors.last_donation_date,
                donors.total_donations,
                donors.latitude,
                donors.longitude,

                (
                    6371 * ACOS(
                        COS(RADIANS(:latitude))
                        *
                        COS(RADIANS(donors.latitude))
                        *
                        COS(
                            RADIANS(donors.longitude)
                            -
                            RADIANS(:longitude)
                        )
                        +
                        SIN(RADIANS(:latitude))
                        *
                        SIN(RADIANS(donors.latitude))
                    )
                ) AS distance

            FROM donors

            INNER JOIN users
                ON donors.user_id = users.id

            WHERE donors.blood_group = :blood_group

            AND donors.availability = 1

            AND donors.verified = 1

            HAVING distance <= 5

            ORDER BY distance ASC
        ";


        $statement =
            $connection->prepare($sql);


        $statement->execute([
            ":latitude" => $latitude,
            ":longitude" => $longitude,
            ":blood_group" => $bloodGroup
        ]);


        $donors =
            $statement->fetchAll(PDO::FETCH_ASSOC);


        echo json_encode([
            "success" => true,
            "count" => count($donors),
            "donors" => $donors
        ]);
    }


    public function donorDetails()
    {
        header("Content-Type: application/json");


        $id = $_GET["id"] ?? "";


        if (!is_numeric($id)) {

            echo json_encode([
                "success" => false,
                "message" => "Invalid donor ID."
            ]);

            return;
        }


        $database = new Database();

        $connection = $database->connect();


        $sql = "
            SELECT
                donors.id,
                users.name,
                users.email,
                donors.phone,
                donors.blood_group,
                donors.last_donation_date,
                donors.total_donations,
                donors.latitude,
                donors.longitude

            FROM donors

            INNER JOIN users
                ON donors.user_id = users.id

            WHERE donors.id = :id

            AND donors.verified = 1

            LIMIT 1
        ";


        $statement =
            $connection->prepare($sql);


        $statement->execute([
            ":id" => $id
        ]);


        $donor =
            $statement->fetch(PDO::FETCH_ASSOC);


        if (!$donor) {

            echo json_encode([
                "success" => false,
                "message" => "Donor not found."
            ]);

            return;
        }


        echo json_encode([
            "success" => true,
            "donor" => $donor
        ]);
    }
}