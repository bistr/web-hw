CREATE DATABASE IF NOT EXISTS `62169_Bistra_Chilikova` CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

USE `62169_Bistra_Chilikova`;

-- username: root
-- password: ""
-- needs access to the "photos" directory in htdocs
CREATE TABLE Users (
    -- decided not to rely on fac_number as primary key, since it's not unique in the world
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(63) NOT NULL,
    lname VARCHAR(63) NOT NULL,
    course_year INT NOT NULL,
    course_major VARCHAR(255) NOT NULL,
    fac_number VARCHAR(63) NOT NULL,
    group_number INT NOT NULL,
    birthdate DATE NOT NULL,
    website VARCHAR(255) DEFAULT NULL,
    photo VARCHAR(255) DEFAULT NULL,
    letter TEXT NOT NULL,
    zodiac_sign VARCHAR(63) NOT NULL
);
