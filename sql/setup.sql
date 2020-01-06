

DROP DATABASE forum;
CREATE DATABASE IF NOT EXISTS forum;
GRANT ALL ON forum.* TO user@localhost IDENTIFIED BY 'pass';
USE forum;
