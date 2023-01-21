create DATABASE BookStore;

use bookstore;

CREATE TABLE Users(
    UserID int PRIMARY KEY,
    UserName VARCHAR(25),
    Pwd VARCHAR(255),
    isAdmin BOOLEAN

);

CREATE Table Books(
    BookID int PRIMARY KEY,
    BookName VARCHAR(50),
    BookAuthor VARCHAR(50),
    BookPublished DATE,
    BookPrice FLOAT,
    BookImage VARCHAR(2000),
    BookCategory VARCHAR(25),
    BookDescription VARCHAR(150)
);


CREATE TABLE Orders(
    BookID1 int,
    UserID1 int,
    BookName VARCHAR(50),
    Quantity int,
    FullPrice int,
    FOREIGN KEY (BookID1) REFERENCES Books(BookID),
    FOREIGN KEY (UserID1) REFERENCES Users(UserID)
);


CREATE TABLE Feedback(
    FeedbackID int PRIMARY KEY,
    FullName VARCHAR(25),
    Email VARCHAR (50),
    Messages VARCHAR (500),
    MessageDate DATE
);

INSERT INTO Users (UserID, UserName, Pwd, isAdmin)
VALUES (1, 'Rawi', MD5('password123'), 1),
       (2, 'jane', MD5('password456'), 0),
       (3, 'bob', MD5('password789'), 0),
       (4, 'sarah', MD5('password101'), 0),
       (5, 'mike', MD5('password112'), 0);

INSERT INTO Books (BookID, BookName, BookAuthor, BookPublished, BookPrice, BookImage, BookCategory, BookDescription)
VALUES (1, 'The Alchemist', 'Paulo Coelho', '1988-08-01', 10.99, 'alchemist', 'Fiction', 'A story about a shepherd boy who dreams of finding a treasure.'),
       (2, 'To Kill a Mockingbird', 'Harper Lee', '1960-07-11', 8.99, 'mockingbird', 'Fiction', 'A story about racism and injustice in a small town in the US.'),
       (3, 'Pride and Prejudice', 'Jane Austen', '1813-01-28', 9.99, 'pride.jpg', 'Fiction', 'A story about the relationships and misunderstandings among the upper class in early 19th century England.'),
       (4, 'The Great Gatsby', 'F. Scott Fitzgerald', '1925-04-10', 11.99, 'gatsby', 'Fiction', 'A story about the decadence and excess of the Roaring Twenties in the US.'),
       (5, 'The Catcher in the Rye', 'J.D. Salinger', '1951-07-16', 7.99, 'catcher', 'Fiction', 'A story about a teenage boy who is kicked out of prep school and wanders around New York City.');

INSERT INTO Orders (BookID1, UserID1, BookName, Quantity, FullPrice)
VALUES (1, 1, 'The Alchemist', 1, 10.99),
       (2, 2, 'To Kill a Mockingbird', 2, 17.98),
       (3, 3, 'Pride and Prejudice', 1, 9.99),
       (4, 4, 'The Great Gatsby', 3, 35.97),
       (5, 5, 'The Catcher in the Rye', 1, 7.99);

INSERT INTO Feedback (FeedbackID, FullName, Email, Messages, MessageDate)
VALUES (1, 'John Smith', 'johnsmith@email.com', 'I really enjoyed reading this book!', '2022-01-01'),
       (2, 'Jane Smith', 'janesmith@email.com', 'I did not like this book very much.', '2022-01-02'),
       (3, 'Bob Johnson', 'bobjohnson@email.com', 'This was a great book, I would recommend it to anyone.', '2022-01-03'),
       (4, 'Sarah Williams', 'sarahwilliams@email.com', 'I thought the plot was a bit predictable, but overall it was a good read.', '2022-01-04'),
       (5, 'Mike Thompson', 'mikethompson@email.com', 'I was really disappointed with this book. The characters were flat and the ending was unsatisfying.', '2022-01-05');

INSERT INTO Books (BookID, BookName, BookAuthor, BookPublished, BookPrice, BookImage, BookCategory, BookDescription) 
VALUES (6,'Sherlock Holmes','Arthur Conan Doyle','1986-12-12',50,"Sherlockholmes.jpg",'Fiction','The Complete Sherlock Holmes: All 4 Novels and 56 Short Stories'),
       (7,'The North Water','Ian McGuire','2021-01-01',40,"TheNorthWater.jpg",'Fiction',"Patrick Sumner (Jack O'Connell) a disgraced ex-army surgeon who sets sail on a whaling ship, essentially to forget his past."),
       (8, 'The Last Gift','Abdulrazak Gurnah', '2012-06-01', 35, "TheLastGift.jpg",'Fiction','Takes on the themes of cultural identity and the weight of family secrets.'),
       (9, 'No Longer Human', 'Osamu Dazai','2022-05-15', 80, "NoLongerHuman.jpg",'Fiction',' A young man who is caught between the breakup of the traditions of a northern Japanese aristocratic family and the impact of Western ideas.'),
       (10, 'The Poppy War','R. F. Kuang','2018-03-01',70,"ThePoppyWar.png",'Fiction','Passionate yet ruthless Fang Runin, also known as Rin, who grows up poor, orphaned by a previous war.'),
       (11,'Muhammad Ali - The Tribute','Staffs of Sports Illustrated','2016-12-1', 90,'MuhammadAli-TheTribute.jpg','sport','The definitive tribute that celebrates the life and legacy of Muhammad Ali, an American original.'),
       (12,'The Empowered Manager','Peter Block','2016-04-01',60,'The Empowered Manager.jpg','politics','Uncovers a roadmap to creating a more accountable culture'),
       (13,'Iran Supreme Leadership','Mohammed Alsulami','2021-09-11',40,'IranSupremeLeadership.jpg','politics','Shiite Political Controversy Between Arab and Iranian');