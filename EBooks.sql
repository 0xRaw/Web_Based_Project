create DATABASE BookStore;

use bookstore;

CREATE TABLE Users(
    UserID int PRIMARY KEY,
    UserName VARCHAR(25),
    Pwd VARCHAR(255)

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

