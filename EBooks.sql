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
VALUES (1, 'The Alchemist', 'Paulo Coelho', '1988-08-01', 10.99, 'alchemist.jpg', 'Fiction', 'A story about a shepherd boy who dreams of finding a treasure.'),
       (2, 'To Kill a Mockingbird', 'Harper Lee', '1960-07-11', 8.99, 'mockingbird.jpg', 'Fiction', 'A story about racism and injustice in a small town in the US.'),
       (3, 'Pride and Prejudice', 'Jane Austen', '1813-01-28', 9.99, 'pride.jpg', 'Fiction', 'A story about the relationships and misunderstandings among the upper class in early 19th century England.'),
       (4, 'The Great Gatsby', 'F. Scott Fitzgerald', '1925-04-10', 11.99, 'gatsby.jpg', 'Fiction', 'A story about the decadence and excess of the Roaring Twenties in the US.'),
       (5, 'The Catcher in the Rye', 'J.D. Salinger', '1951-07-16', 7.99, 'catcher.jpg', 'Fiction', 'A story about a teenage boy who is kicked out of prep school and wanders around New York City.');

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
