<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/php/header.php";
#Create database
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"]);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create database
    $sql = "CREATE DATABASE comp2411";
    if (mysqli_query($conn, $sql)) {
        echo "<br>Database created successfully";
    } else {
        echo "<br>Error creating database: " . mysqli_error($conn);
    }

    mysqli_close($conn);

#Create Table
    // Create connection
    $conn = new mysqli(MYSQL["host"], MYSQL["username"], MYSQL["password"], MYSQL["dbname"]);
    // Check connection
    if (!$conn) {
        die("<br>Connection failed: " . mysqli_connect_error());
    }


    // sql to create table Login
    $sql = "CREATE TABLE Login (
            UserId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            UserLoginId VARCHAR(28) NOT NULL,
            UserPassword VARCHAR(70) NOT NULL,
            UserType VARCHAR(5) NOT NULL
            )";

    if (mysqli_query($conn, $sql)) {
        echo "<br>Table Login created successfully";
    } else {
        echo "<br>Error creating table: " . mysqli_error($conn);
    }

    //admin account
    $sql = "INSERT INTO Login (UserLoginId, UserPassword, UserType) VALUES
            ('admin','admin','admin')";

    if (mysqli_query($conn, $sql)) {
        echo "<br>Create Admin ac successfully";
    } else {
        echo "<br>Error creating table: " . mysqli_error($conn);
    }

    // sql to create table Admin
    $sql = "CREATE TABLE Admin (
            MessageId INT(6) AUTO_INCREMENT PRIMARY KEY,
            UserId INT(6),
            Message VARCHAR(255) NOT NULL,
            MessageDate DATETIME
            )";
    //mysqli_query($conn, $sql);
    if (mysqli_query($conn, $sql)) {
        echo "<br>Table Admin created successfully";
    } else {
        echo "<br>Error creating table: " . mysqli_error($conn);
    }

    // sql to create table User
    $sql = "CREATE TABLE User (
            UserId INT(6) PRIMARY KEY,
            UserFirstName VARCHAR(16) NOT NULL,
            UserLastName VARCHAR(10) NOT NULL,
            UserGuardianName VARCHAR(20) NOT NULL,
            UserTotalBorrow INT(4),
            UserDateOfBirth Date,
            UserJoiningDate Date,
            UserAddress VARCHAR(255),
            UserPhone1 CHAR(8),
            UserPhone2 CHAR(8),
            UserEmail VARCHAR(50),
            UserGender CHAR(1)
            )";

    if (mysqli_query($conn, $sql)) {
        echo "<br>Table User created successfully";
    } else {
        echo "<br>Error creating table: " . mysqli_error($conn);
    }

    // sql to create table BookInventory
    $sql = "CREATE TABLE BookInventory (
            BookId INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            AuthorId INT(8),
            PubId INT(8),
            TypeId INT(8),
            BookTitle VARCHAR(255) NOT NULL,
            BookPublishedYear VARCHAR(4),
            Price VARCHAR(8),
            ISBN VARCHAR(13),
            Ebook BOOLEAN,
            Available BOOLEAN
            )";

    if (mysqli_query($conn, $sql)) {
        echo "<br>Table BookInventory created successfully";
    } else {
        echo "<br>Error creating table: " . mysqli_error($conn);
    }

    // sql to create table Publisher
    $sql = "CREATE TABLE Publisher (
            PubId INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            PubName VARCHAR(55) NOT NULL,
            PubAddress VARCHAR(255)
            )";

    if (mysqli_query($conn, $sql)) {
        echo "<br>Table Publisher created successfully";
    } else {
        echo "<br>Error creating table: " . mysqli_error($conn);
    }

    // sql to create table Author
    $sql = "CREATE TABLE Author (
            AuthorId INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            AuthorName VARCHAR(55) NOT NULL
            )";

    if (mysqli_query($conn, $sql)) {
        echo "<br>Table Author created successfully";
    } else {
        echo "<br>Error creating table: " . mysqli_error($conn);
    }

    // sql to create table BookType
    $sql = "CREATE TABLE BookType (
            TypeId INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            TypeName VARCHAR(55) NOT NULL
            )";

    if (mysqli_query($conn, $sql)) {
        echo "<br>Table BookType created successfully";
    } else {
        echo "<br>Error creating table: " . mysqli_error($conn);
    }

    // sql to create table BorrowedBook
    $sql = "CREATE TABLE BorrowedBook (
            BorrowId INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            UserId INT(8),
            BookId INT(8),
            BorrowDate DATETIME,
            BorrowCompleted BOOLEAN
            )";

    if (mysqli_query($conn, $sql)) {
        echo "<br>Table BorrowrdBook created successfully";
    } else {
        echo "<br>Error creating table: " . mysqli_error($conn);
    }

    // sql to create table Reservation
    $sql = "CREATE TABLE Reservation (
            RevId INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            UserId INT(8),
            BookId INT(8),
            RevDate DATETIME,
            RevCompleted BOOLEAN
            )";

    if (mysqli_query($conn, $sql)) {
        echo "<br>Table Reservation created successfully";
    } else {
        echo "<br>Error creating table: " . mysqli_error($conn);
    }

    mysqli_close($conn);
 ?>
