<?php

require_once "../config/database.php";

class User
{
    private $connection;

    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->connect();
    }


    public function create($name, $email, $password)
    {
        $sql = "INSERT INTO users
                (name, email, password, role)
                VALUES
                (:name, :email, :password, 'user')";

        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            ":name" => $name,
            ":email" => $email,
            ":password" => $password
        ]);
    }


    public function findByEmail($email)
    {
        $sql = "SELECT *
                FROM users
                WHERE email = :email
                LIMIT 1";

        $statement = $this->connection->prepare($sql);

        $statement->execute([
            ":email" => $email
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }


    public function findById($id)
    {
        $sql = "SELECT *
                FROM users
                WHERE id = :id
                LIMIT 1";

        $statement = $this->connection->prepare($sql);

        $statement->execute([
            ":id" => $id
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }


    public function update($id, $name, $email)
    {
        $sql = "UPDATE users
                SET name = :name,
                    email = :email
                WHERE id = :id";

        $statement = $this->connection->prepare($sql);

        return $statement->execute([
            ":id" => $id,
            ":name" => $name,
            ":email" => $email
        ]);
    }


    public function countUsers()
    {
        $sql = "SELECT COUNT(*) FROM users";

        return $this->connection
            ->query($sql)
            ->fetchColumn();
    }
}
