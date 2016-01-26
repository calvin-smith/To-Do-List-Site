CREATE TABLE User (
ID int(11) NOT NULL AUTO_INCREMENT,
Username varchar(50) COLLATE utf8_unicode_ci NOT NULL,
Password char(64) COLLATE utf8_unicode_ci NOT NULL,
Salt char(16) COLLATE utf8_unicode_ci NOT NULL,
Email varchar(127) COLLATE utf8_unicode_ci NOT NULL,
PRIMARY KEY (ID),
UNIQUE KEY Username (Username),
UNIQUE KEY Email (Email) ) 
ENGINE= InnoDB
DEFAULT CHARSET=utf8
COLLATE=utf8_unicode_ci
AUTOINCREMENT=1;

CREATE TABLE Tasklist (
Task_list_ID int NOT NULL AUTO_INCREMENT,
User_ID int,
Title varchar(30) NOT NULL,
PRIMARY KEY (Task_list_ID),
FOREIGN KEY (User_ID) REFERENCES User(ID)
); 

CREATE TABLE Task (
Task_ID int NOT NULL AUTO_INCREMENT,
Task_List int,
User_ID int,
Task_Name varchar(50) NOT NULL,
Task_Description varchar(200),
Complete boolean DEFAULT 0,
PRIMARY KEY (Task_ID),
FOREIGN KEY (User_ID) REFERENCES User(ID),
FOREIGN KEY (Task_List) REFERENCES Tasklist(Task_List_ID)
);