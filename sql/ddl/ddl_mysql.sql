-- Ensure UTF8 on the database connection
SET NAMES utf8mb4;


--
-- Table Answer
--
DROP TABLE IF EXISTS Answer;
CREATE TABLE Answer (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `question_id` INTEGER NOT NULL,
    `userID` VARCHAR(50) NOT NULL,
    `username`  VARCHAR(10) NOT NULL,
    `voteup` INTEGER,
    `votedown` INTEGER,
    `answer` TEXT NOT NULL,
    `solution` BOOLEAN DEFAULT 0,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci;


--
-- Table Tag
--
DROP TABLE IF EXISTS Tags;
CREATE TABLE Tags (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `tag` VARCHAR(50) UNIQUE NOT NULL,
    `counter` INTEGER,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci;


--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `acronym` VARCHAR(10) UNIQUE NOT NULL,
    `password` VARCHAR(128) NOT NULL,
    `firstname`VARCHAR(50),
    `lastname` VARCHAR(50),
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `counter` INTEGER,
    `updated` DATETIME,
    `deleted` DATETIME,
    `active` DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;


--
-- Table Questions
--
DROP TABLE IF EXISTS Questions;
CREATE TABLE Questions (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `title` VARCHAR(50) NOT NULL,
    `userID` INTEGER NOT NULL,
    `tags` VARCHAR(256) NOT NULL,
    `question` TEXT NOT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;



--
-- Table Comment
--
DROP TABLE IF EXISTS Comment;
CREATE TABLE Comment (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `username`  VARCHAR(10) NOT NULL,
    `userID`  VARCHAR(10) NOT NULL,
    `questionID` INTEGER,
    `answerID` INTEGER,
    `comment` TEXT NOT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
