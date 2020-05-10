CREATE DATABASE IF NOT EXISTS `62169_Bistra_Chilikova` CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

USE `62169_Bistra_Chilikova`;

CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(63),
    lname VARCHAR(63),
    course_year INT,
    course_major VARCHAR(255),
    fac_number VARCHAR(63),
    group_number INT,
    birthdate DATE,
    website VARCHAR(255),
    photo VARCHAR(255),
    letter TEXT,
    zodiac_sign VARCHAR(63)

);

INSERT INTO
    Users (
        fname,
        lname,
        course_year,
        course_major,
        fac_number,
        group_number,
        birthdate,
        website,
        photo,
        letter,
        zodiac_sign
    )
VALUES
    (
        'Bistra',
        'Chilikova',
        3,
        'SI',
        '62169',
        1,
        '1998-04-10',
        'www.haha.com',
        'tralala',
        'wow! so motivational',
        'Aries'
    );