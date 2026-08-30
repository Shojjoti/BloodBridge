
CREATE DATABASE IF NOT EXISTS bloodbridge CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE bloodbridge;

CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    full_name  VARCHAR(150) NOT NULL,
    email      VARCHAR(150) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS donors (
    id                   INT AUTO_INCREMENT PRIMARY KEY,
    full_name            VARCHAR(150) NOT NULL,
    nid                  VARCHAR(20) NOT NULL UNIQUE,
    phone                VARCHAR(20) NOT NULL,
    email                VARCHAR(150) NOT NULL UNIQUE,
    blood_group          VARCHAR(5) NOT NULL,
    last_donation_date   DATE NULL,
    previous_donations   INT DEFAULT 0,
    password             VARCHAR(255) NOT NULL,
    created_at           TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
