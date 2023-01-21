create DATABASE BookStore;

use bookstore;

CREATE TABLE Users(
    UserID INT NOT NULL AUTO_INCREMENT ,
    UserName VARCHAR(25) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Pwd VARCHAR(255) NOT NULL,
    isAdmin BOOLEAN NOT NULL,

    PRIMARY KEY (UserID)
);

CREATE Table Books(
    BookID INT NOT NULL AUTO_INCREMENT,
    BookName VARCHAR(50) NOT NULL,
    BookAuthor VARCHAR(50) NOT NULL,
    BookPublished DATE NOT NULL,
    BookPrice FLOAT NOT NULL,
    BookImage VARCHAR(2000) NOT NULL,
    BookCategory VARCHAR(25) NOT NULL,
    BookDescription VARCHAR(150) NOT NULL,

    PRIMARY KEY (BookID)
);


CREATE TABLE Orders(
    OrderID INT NOT NULL AUTO_INCREMENT,
    BookID INT NOT NULL,
    UserID INT NOT NULL,
    BookName VARCHAR(50) NOT NULL,
    Quantity INT NOT NULL,
    FullPrice INT NOT NULL,

    FOREIGN KEY (BookID) REFERENCES Books(BookID),
    FOREIGN KEY (UserID) REFERENCES Users(UserID),
    PRIMARY KEY (orderID)
);


CREATE TABLE Feedback(
    FeedbackID INT NOT NULL AUTO_INCREMENT,
    FullName VARCHAR(25) NOT NULL,
    Email VARCHAR (50) NOT NULL,
    Messages VARCHAR (500) NOT NULL,
    MessageDate DATE NOT NULL,

    PRIMARY KEY(FeedbackID)
);

INSERT INTO Users (UserID, UserName, Pwd, isAdmin)
VALUES (1, 'Rawi', MD5('password123'), 1),
       (2, 'jane', MD5('password456'), 0),
       (3, 'bob', MD5('password789'), 0),
       (4, 'sarah', MD5('password101'), 0),
       (5, 'mike', MD5('password112'), 0);

INSERT INTO Orders (BookID, UserID, BookName, Quantity, FullPrice)
VALUES (1, 1, 'The Alchemist', 1, 10.99),
       (2, 2, 'To Kill a Mockingbird', 2, 17.98),
       (3, 3, 'Pride and Prejudice', 1, 9.99),
       (4, 4, 'The Great Gatsby', 3, 35.97),
       (5, 5, 'The Catcher in the Rye', 1, 7.99);

INSERT INTO Feedback (FullName, Email, Messages, MessageDate)
VALUES ('John Smith', 'johnsmith@email.com', 'I really enjoyed reading this book!', '2022-01-01'),
       ('Jane Smith', 'janesmith@email.com', 'I did not like this book very much.', '2022-01-02'),
       ('Bob Johnson', 'bobjohnson@email.com', 'This was a great book, I would recommend it to anyone.', '2022-01-03'),
       ('Sarah Williams', 'sarahwilliams@email.com', 'I thought the plot was a bit predictable, but overall it was a good read.', '2022-01-04'),
       ('Mike Thompson', 'mikethompson@email.com', 'I was really disappointed with this book. The characters were flat and the ending was unsatisfying.', '2022-01-05');

INSERT INTO Books (BookName, BookAuthor, BookPublished, BookPrice, BookImage, BookCategory, BookDescription) 
VALUES ('Sherlock Holmes','Arthur Conan Doyle','1986-12-12',50,"Sherlockholmes.jpg",'Fictions','The Complete Sherlock Holmes: All 4 Novels and 56 Short Stories'),
       ('The North Water','Ian McGuire','2021-01-01',40,"TheNorthWater.jpg",'Fictions',"Patrick Sumner (Jack O'Connell) a disgraced ex-army surgeon who sets sail on a whaling ship, essentially to forget his past."),
       ('The Last Gift','Abdulrazak Gurnah', '2012-06-01', 35, "TheLastGift.jpg",'Fictions','Takes on the themes of cultural identity and the weight of family secrets.'),
       ('No Longer Human', 'Osamu Dazai','2022-05-15', 80, "NoLongerHuman.jpg",'Fictions',' A young man who is caught between the breakup of the traditions of a northern Japanese aristocratic family and the impact of Western ideas.'),
       ('The Poppy War','R. F. Kuang','2018-03-01',70,"ThePoppyWar.png",'Fictions','Passionate yet ruthless Fang Runin, also known as Rin, who grows up poor, orphaned by a previous war.'),
       ('Muhammad Ali - The Tribute','Staffs of Sports Illustrateds','2016-12-1', 90,'MuhammadAli-TheTribute.jpg','Sports','The definitive tribute that celebrates the life and legacy of Muhammad Ali, an American original.'),
       ('The Empowered Manager','Peter Block','2016-04-01',60,'The Empowered Manager.jpg','Politics','Uncovers a roadmap to creating a more accountable culture'),
       ('Iran Supreme Leadership','Mohammed Alsulami','2021-09-11',40,'IranSupremeLeadership.jpg','Politics','Shiite Political Controversy Between Arab and Iranian'),
       ('Secret Empires','Peter Schweizer','2018-7-22',80,'SecretEmpires.jpg','Politics','Peter Schweizer has been fighting corruption—and winning—for years. In Throw Them All Out, he exposed insider trading by members of Congress'),
       ('The Secret History','Donna Tartt','2004-1-15',20,'TheSecretHistory','Novelties','an inverted detective story narrated by one of the six students, Richard Papen, who reflects years later upon the situation that led to the murder of their friend Edmund "Bunny" Corcoran')