<?php

require_once "../config/database.php";

class Donor
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }


    public function create($data)
    {
        $sql = "INSERT INTO donors
        (
            user_id,
            nid,
            phone,
            blood_group,
            last_donation_date,
            total_donations,
            latitude,
            longitude,
            availability,
            verified
        )
        VALUES
        (
            :user_id,
            :nid,
            :phone,
            :blood_group,
            :last_donation_date,
            :total_donations,
            :latitude,
            :longitude,
            :availability,
            0
        )";

        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            ":user_id" => $data["user_id"],
            ":nid" => $data["nid"],
            ":phone" => $data["phone"],
            ":blood_group" => $data["blood_group"],
            ":last_donation_date" => $data["last_donation_date"],
            ":total_donations" => $data["total_donations"],
            ":latitude" => $data["latitude"],
            ":longitude" => $data["longitude"],
            ":availability" => $data["availability"]
        ]);
    }


    public function findByUserId($user_id)
    {
        $sql = "SELECT
                    donors.*,
                    users.name,
                    users.email
                FROM donors
                INNER JOIN users
                    ON donors.user_id = users.id
                WHERE donors.user_id = :user_id";

        $statement = $this->connection->prepare($sql);

        $statement->execute([
            ":user_id" => $user_id
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }


    public function update($user_id, $data)
    {
        $sql = "UPDATE donors
                SET phone = :phone,
                    blood_group = :blood_group,
                    last_donation_date = :last_donation_date,
                    total_donations = :total_donations,
                    latitude = :latitude,
                    longitude = :longitude,
                    availability = :availability
                WHERE user_id = :user_id";

        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            ":phone" => $data["phone"],
            ":blood_group" => $data["blood_group"],
            ":last_donation_date" => $data["last_donation_date"],
            ":total_donations" => $data["total_donations"],
            ":latitude" => $data["latitude"],
            ":longitude" => $data["longitude"],
            ":availability" => $data["availability"],
            ":user_id" => $user_id
        ]);
    }


    public function countDonors()
    {
        $sql = "SELECT COUNT(*) FROM donors";

        return $this->connection
            ->query($sql)
            ->fetchColumn();
    }
}