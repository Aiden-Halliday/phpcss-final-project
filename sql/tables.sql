CREATE DATABASE renting;

USE renting;

CREATE TABLE useraccounts(
  accountid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fname VARCHAR(100) NOT NULL,
  lname VARCHAR(100) NOT NULL,
  dob DATE NOT NULL,
  email VARCHAR(255) NOT NULL,
  userpassword VARCHAR(255) NOT NULL,
  profileimage VARCHAR(255) DEFAULT './uploads/placeholder.png'
);

CREATE TABLE gameinfo(
  gameid INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  description VARCHAR(200) NOT NULL,
  genre VARCHAR(50) NOT NULL,
  publisher VARCHAR(200) NOT NULL,
  rating DECIMAL(2, 1) NOT NULL,
  gameimage VARCHAR(255) NOT NULL,
  sale BOOLEAN NOT NULL,
  accountid INT, 
  FOREIGN KEY (accountid) REFERENCES useraccounts(accountid) ON DELETE SET NULL
);


INSERT INTO gameinfo(title, description, genre, publisher, rating, gameimage, sale) 
VALUES 
('Metroid Prime 2', 'A Journey through Space, with the added pain in butt of an evil doppelganger!', 'Action', 'Nintendo', 8.5, './uploads/MetroidPrime2.jpg', 1),
('Kid Klown in Crazy Chase', 'Run as fast as you can to stop the bomb and get the girl!', 'Platformer', 'Kemco', 6.8, './uploads/KidKlown.jpg', 0),
('Donkey Kong Country Returns', 'Take back DK Island from the evil Tiki Tak Tribe', 'Platformer', 'Retro Studios', 8.4, './uploads/DKCR.jpg', 0),
('Tears Of The Kingdom', 'Save Hyrule from an ancient evil prisonned long ago', 'Adventure', 'Nintendo', 9.8, './uploads/TearsOfTheKingdom.jpg', 1),
('Silent Hill 4: The Room', 'Survive other worldly nightmares while trying to escape you apartment', 'Horror', 'Konami', 7.2, './uploads/SilentHill4.jpg', 1),
('Astro Bot', 'Repair your ship and save your friends across multiple galaxies', 'Platformer', 'Team Asobi', 9.9, './uploads/AstroBot.jpg', 0),
('Persona 6', 'Discover the truth of a sudden string of murders in a brand new town', 'RPG', 'Atlas', 9.7, './uploads/P6.svg', 0);