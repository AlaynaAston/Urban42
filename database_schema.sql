/* ------------------------------DDL To Create Tables-----------------------------*/

CREATE TABLE `users` (
  `userID` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`userID`)
);

CREATE TABLE `products` (
    `productID` int NOT NULL,
    `availableStock` int NOT NULL,
    `price` decimal NOT NULL,
    `name` VARCHAR(200) NOT NULL,
    `description` VARCHAR(500) NOT NULL,
    `materials`VARCHAR(300) NOT NULL,
    `category`enum('hoodie', 'Jeans', 'Shoes', 'Hats', 'Accessories', 'Tops', 'Bottoms'),
    `image1` varchar(200)  NOT NULL,
    `image2` varchar(200)  NOT NULL,
    `image3` varchar(200)  NOT NULL,
    `image4` varchar(200) NOT NULL,
    `size` int NOT NULL,
    PRIMARY KEY (`productID`),
    UNIQUE(`name`)
);

CREATE TABLE `baskets` (
    `basketID` int NOT NULL,
    `userID` int NOT NULL,
    `productID` int NOT NULL,
    `quantity` int NOT NULL,
    PRIMARY KEY (`basketID`),
    FOREIGN KEY (`productID`) REFERENCES products(`productID`)
);

CREATE TABLE `orders` (
  `orderID` int NOT NULL,
  `userID` int,
  `status` enum('paid', 'shipped', 'arrived', 'cancelled', 'returned') DEFAULT 'paid',
  `totalPrice` DECIMAL NULL,
  `datePurchased` DATETIME DEFAULT(CURRENT_TIMESTAMP),
  PRIMARY KEY (`orderID`),
  FOREIGN KEY (`userID`) REFERENCES users(`userID`)
);

CREATE TABLE purchasedItems (
  `orderID` INT NOT NULL,
  `productID` INT NOT NULL,
  `quantity` INT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `subtotal` DECIMAL(10,2) GENERATED ALWAYS AS (quantity * price) STORED,
  FOREIGN KEY (`orderID`) REFERENCES orders(`orderID`),
  FOREIGN KEY (`productID`) REFERENCES products(`productID`)
);
