DROP DATABASE IF EXISTS gym_book;
CREATE DATABASE IF NOT EXISTS gym_book;

USE gym_book;

CREATE TABLE IF NOT EXISTS Role (
    roleID INT PRIMARY KEY,
    roleName VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Users (
    userID INT Auto_increment PRIMARY KEY ,
    username VARCHAR(255),
    passwd VARCHAR(255),
    email VARCHAR(255),
    roleID INT,
    date_of_birth DATE,
    residence VARCHAR(255),
    fitness_goal VARCHAR(255),
    FOREIGN KEY (roleID) REFERENCES Role(roleID)
);

CREATE TABLE IF NOT EXISTS GymInstructors (
    instructorID INT PRIMARY KEY,
    instructorName VARCHAR(255),
    time_available VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Equipment (
    equipmentID INT PRIMARY KEY,
    equipment_name VARCHAR(255),
    statusEquip VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS Bookings (
    bookingID INT PRIMARY KEY,
    userID INT,
    instructorID INT,
    date DATE,
    time_slot TIME,
    status VARCHAR(50),
    FOREIGN KEY (userID) REFERENCES Users(userID),
    FOREIGN KEY (instructorID) REFERENCES GymInstructors(instructorID)
);

CREATE TABLE IF NOT EXISTS Feedback (
    feedbackID INT PRIMARY KEY,
    userID INT,
    feedback_type VARCHAR(50),
    senderID INT,
    receiverID INT,
    message TEXT,
    date DATE,
    FOREIGN KEY (userID) REFERENCES Users(userID),
    FOREIGN KEY (senderID) REFERENCES Users(userID),
    FOREIGN KEY (receiverID) REFERENCES Users(userID)
);

CREATE TABLE IF NOT EXISTS Notification (
    notificationID INT PRIMARY KEY,
    userID INT,
    timestamp TIMESTAMP,
    senderID INT,
    receiverID INT
);

ALTER TABLE Notification
ADD FOREIGN KEY (userID) REFERENCES Users(userID),
ADD FOREIGN KEY (senderID) REFERENCES Users(userID),
ADD FOREIGN KEY (receiverID) REFERENCES Users(userID);

INSERT INTO `Role` (`roleID`, `roleName`) VALUES ('1', 'Student'), ('2', 'Faulty'), ('3', 'Admin');