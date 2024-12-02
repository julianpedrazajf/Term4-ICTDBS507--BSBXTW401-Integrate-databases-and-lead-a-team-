-- Crear la base de datos todf
CREATE DATABASE todf;

-- Seleccionar la base de datos para usar
USE todf;

-- Crear la tabla 'Category'
CREATE TABLE Category (
    CategoryId INT AUTO_INCREMENT PRIMARY KEY,
    CategoryName VARCHAR(255) NOT NULL
);

-- Crear la tabla 'SubCategory'
CREATE TABLE SubCategory (
    SubCategoryId INT AUTO_INCREMENT PRIMARY KEY,
    SubCategoryName VARCHAR(255) NOT NULL,
    CategoryId INT,
    FOREIGN KEY (CategoryId) REFERENCES Category(CategoryId)
);

-- Crear la tabla 'Member'
CREATE TABLE Member (
    MemberId INT AUTO_INCREMENT PRIMARY KEY,
    LastName VARCHAR(255) NOT NULL,
    FirstName VARCHAR(255) NOT NULL,
    EmailAddress VARCHAR(255) NOT NULL,
    UserName VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    memberImageFilename VARCHAR(255)
);

-- Crear la tabla 'Question'
CREATE TABLE Question (
    QuestionId INT AUTO_INCREMENT PRIMARY KEY,
    QuestionDetails TEXT NOT NULL,
    QuestionDate DATETIME NOT NULL,
    QuestionStatus VARCHAR(50) NOT NULL,
    CategoryId INT,
    SubCategoryId INT,
    MemberId INT,
    FOREIGN KEY (CategoryId) REFERENCES Category(CategoryId),
    FOREIGN KEY (SubCategoryId) REFERENCES SubCategory(SubCategoryId),
    FOREIGN KEY (MemberId) REFERENCES Member(MemberId)
);

-- Crear la tabla 'AnswerLine'
CREATE TABLE AnswerLine (
    AnswerId INT AUTO_INCREMENT PRIMARY KEY,
    AnswerDate DATETIME NOT NULL,
    Answer TEXT NOT NULL,
    MemberId INT,
    QuestionId INT,
    FOREIGN KEY (MemberId) REFERENCES Member(MemberId),
    FOREIGN KEY (QuestionId) REFERENCES Question(QuestionId)
);

-- Crear la tabla 'QuestionDraft'
CREATE TABLE QuestionDraft (
    QuestionDraftId INT AUTO_INCREMENT PRIMARY KEY,
    QuestionDraft TEXT NOT NULL,
    QuestionDraftDetails TEXT,
    QuestionDraftCreationDate DATETIME NOT NULL,
    QuestionDraftAproval VARCHAR(50),
    CategoryId INT,
    SubCategoryId INT,
    QuestionId INT,
    MemberId INT,
    FOREIGN KEY (CategoryId) REFERENCES Category(CategoryId),
    FOREIGN KEY (SubCategoryId) REFERENCES SubCategory(SubCategoryId),
    FOREIGN KEY (QuestionId) REFERENCES Question(QuestionId),
    FOREIGN KEY (MemberId) REFERENCES Member(MemberId)
);

-- Crear la tabla 'AnswerDraftLine'
CREATE TABLE AnswerDraftLine (
    AnswerDraftId INT AUTO_INCREMENT PRIMARY KEY,
    AnswerDraftDate DATETIME NOT NULL,
    AnswerDraftApproval VARCHAR(50),
    AnswerDraft TEXT NOT NULL,
    MemberId INT,
    QuestionId INT,
    AnswerId INT,
    FOREIGN KEY (MemberId) REFERENCES Member(MemberId),
    FOREIGN KEY (QuestionId) REFERENCES Question(QuestionId),
    FOREIGN KEY (AnswerId) REFERENCES AnswerLine(AnswerId)
);

-- Crear la tabla 'Employee'
CREATE TABLE Employee (
    EmployeeId INT AUTO_INCREMENT PRIMARY KEY,
    LastName VARCHAR(255) NOT NULL,
    FirstName VARCHAR(255) NOT NULL,
    EmailAddress VARCHAR(255) NOT NULL,
    UserName VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Role VARCHAR(100) NOT NULL
);
