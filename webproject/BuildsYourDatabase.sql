CREATE TABLE `adminpassword`  (
  `adminID` int NOT NULL,
  `username` varchar(255) NULL,
  `password` varchar(255) NULL,
  `userFK` varchar(255) NULL,
  PRIMARY KEY (`adminID`)
);

CREATE TABLE `bookinfo`  (
  `serial` varchar(255) NOT NULL,
  `title` varchar(255) NULL,
  `author` varchar(255) NULL,
  `userBookInfoFk` varchar(255) NULL,
  PRIMARY KEY (`serial`)
);

CREATE TABLE `requestedbooks`  (
  `requestID` int NOT NULL,
  `bookNAme` varchar(255) NULL,
  `userBookFK` varchar(255) NULL,
  PRIMARY KEY (`requestID`)
);

CREATE TABLE `student`  (
  `studentID` int NOT NULL,
  `studentName` varchar(255) NULL,
  `userStudentFK` varchar(255) NULL,
  PRIMARY KEY (`studentID`)
);

CREATE TABLE `userinfo`  (
  `userID` int NOT NULL AUTO_INCREMENT,
  `finame` varchar(255) NULL,
  `laname` varchar(255) NULL,
  `loadd` varchar(255) NULL,
  `ltadd` varchar(255) NULL,
  `phone` varchar(255) NULL,
  `mail` varchar(255) NULL,
  `password` varchar(255) NULL,
  PRIMARY KEY (`userID`)
);

ALTER TABLE `adminpassword` ADD CONSTRAINT `fk_adminpassword_userinfo_1` FOREIGN KEY (`userFK`) REFERENCES `userinfo` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `bookinfo` ADD CONSTRAINT `fk_bookinfo_userinfo_1` FOREIGN KEY (`userBookInfoFk`) REFERENCES `userinfo` (`userID`);
ALTER TABLE `requestedbooks` ADD CONSTRAINT `fk_requestedbooks_userinfo_1` FOREIGN KEY (`userBookFK`) REFERENCES `userinfo` (`userID`);
ALTER TABLE `student` ADD CONSTRAINT `fk_student_userinfo_1` FOREIGN KEY (`userStudentFK`) REFERENCES `userinfo` (`userID`);
