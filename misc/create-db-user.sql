
CREATE DATABASE fintrack;
CREATE USER 'fintrack'@'%' IDENTIFIED BY 'fintrack';
GRANT ALL PRIVILEGES ON *.* TO 'fintrack'@'%';
