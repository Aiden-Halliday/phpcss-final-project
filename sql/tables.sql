CREATE DATABASE renting;

USE renting;

CREATE TABLE useraccounts(
  accountid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fname VARCHAR(100) NOT NULL,
  lname VARCHAR(100) NOT NULL,
  dob DATE NOT NULL,
  email VARCHAR(255) NOT NULL,
  userpassword VARCHAR(70) NOT NULL,
  profileimage VARCHAR(255)
);


CREATE TABLE gameinfo(
    gameid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description VARCHAR(350) NOT NULL,
    genre VARCHAR(50),
    publisher VARCHAR(200) NOT NULL,
    stock INT NOT NULL,
    rating DECIMAL(2, 1) NOT NULL,
    gameimage VARCHAR(255) NOT NULL
);
