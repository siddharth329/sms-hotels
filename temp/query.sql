CREATE TABLE Accounts (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
  email VARCHAR(60) NOT NULL,
  pass VARCHAR(255) NOT NULL,
  name VARCHAR(60) NOT NULL,
  mobilenumber VARCHAR(15) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  access INT NOT NULL DEFAULT 0,
  UNIQUE(email)
);

INSERT INTO Accounts (email, pass, name, mobilenumber, access)
VALUES ('apper329@gmail.com', '$2y$10$xJhyxizpJOtJiDEg2Z.VBeKjLK1uHlxuNtYgBfT6USshwMHaZmFyu', 'Siddharth', '9753313077', 1);

CREATE TABLE Locations (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
  name VARCHAR(60) NOT NULL,
  city VARCHAR(60) NOT NULL,
  state VARCHAR(60) NOT NULL,
  price FLOAT NOT NULL,
  image VARCHAR(100) NOT NULL,
  star FLOAT NOT NULL,
  description TEXT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  tag VARCHAR(20)
);

INSERT INTO Locations (name, city, state, price, image, star, description)
VALUES ('The O Hotel', 'Goa', 'Goa', 3200, 'hotel1.jpg', 4.5, 'A beautiful venture by SMS group.'),
       ('SMS Exotica', 'Bangalore', 'Karnataka', 11700, 'hotel2.jpg', 4.5, 'A beautiful venture by SMS group.'),
       ('SMS Enrise', 'Pune', 'Maharashtra', 1700, 'hotel3.jpg', 4.5, 'A beautiful venture by SMS group.'),
       ('The Palm Retreat', 'Jaipur', 'Rajasthan', 7770, 'hotel4.jpg', 4.5, 'A beautiful venture by SMS group.'),
       ('The Palm Retreat', 'New Delhi', 'Delhi', 7770, 'hotel5.jpg', 4.5, 'A beautiful venture by SMS group.'),
       ('The SMS Blu', 'Mumbai', 'Maharashtra', 8900, 'hotel6.jpg', 5.0, 'A beautiful venture by SMS group.');
INSERT INTO Locations (name, city, state, price, image, star, description, tag)
VALUES ('Elite Plaza', 'Goa', 'Goa', 8500, 'hotel1.jpg', 4.5, 'A beautiful venture by SMS group.', 'POPULAR');

-- TO SELECT 6 CITIES FROM HOME PAGE
-- SELECT DISTINCT (city) AS cities, AVG(price) AS price FROM Locations GROUP BY city LIMIT 6;

-- TO SELECT SEARCH RESULTS
-- SELECT id, name, city, state, price, image, star, description, tag FROM Locations WHERE LOWER(city) LIKE ? OR LOWER(name) LIKE ? OR LOWER(state) LIKE ? LIMIT 12;

CREATE TABLE Enquiries (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
  userid INT NOT NULL,
  locationid INT NOT NULL,
  message TEXT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (userid) REFERENCES Accounts(id),
  FOREIGN KEY (locationid) REFERENCES Locations(id)
);
