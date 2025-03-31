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
('The Awesome Adventure', 'An epic journey through fantastical realms.', 'Adventure', 'Epic Games', 9.5, '.uploads/null.png', 1),
('Space Quest', 'Explore the cosmos in a thrilling sci-fi adventure.', 'Platformer', 'FutureTech Studios', 8.9, '.uploads/null.png', 0),
('The Lost Chronicles', 'Embark on an epic journey through ancient ruins.', 'Adventure', 'Epic Studios', 9.2, './uploads/null.png', 0),
('Battle Frenzy', 'Face relentless enemies in a high-octane combat experience.', 'Action', 'Blaze Entertainment', 8.7, './uploads/null.png', 1),
('Shadows Within', 'Survive the horrors of a haunted asylum.', 'Horror', 'Nightmare Games', 8.5, './uploads/null.png', 1),
('Pixel Jump Heroes', 'Navigate challenging platforms with creative power-ups.', 'Platformer', 'Retro Realm', 8.9, './uploads/null.png', 0),
('Warrior’s Quest', 'Level up your hero and defeat enemies in a fantasy world.', 'RPG', 'DragonForge Studios', 9.4, './uploads/null.png', 0);