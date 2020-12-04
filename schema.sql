DROP DATABASE IF EXISTS Bugme;
CREATE DATABASE BugMe;
USE BugMe;





DROP TABLE IF EXISTS `Issue`;

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
	`id` int NOT NULL AUTO_INCREMENT,
	`firstname` varchar(255) NOT NULL,
	`lastname` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL UNIQUE,
	`date_joined` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);
CREATE TABLE `Issue` (
	`id` int NOT NULL AUTO_INCREMENT,
	`title` varchar(255),
	`description` TEXT(255),
	`type` varchar(255),
	`priority` varchar(255),
	`status` varchar(255),
	`assigned_to` int NOT NULL,
	`created_by` int NOT NULL,
	`created` DATETIME NOT NULL,
	`updated` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);



/* Foreign keys creation for Created_By and Assigned_To to be referenced in the User table */
ALTER TABLE `Issue` ADD CONSTRAINT `Issue_fk0` FOREIGN KEY (`assigned_to`) REFERENCES `User`(`id`);

ALTER TABLE `Issue` ADD CONSTRAINT `Issue_fk1` FOREIGN KEY (`created_by`) REFERENCES `User`(`id`);


/* Initialize Admin Credentials (Password hashed using MD5) */
INSERT INTO User(firstname,lastname, password, email, date_joined) values('Admin', ' ', 'afc285bebb3dd733796cb06db01cd59a', 'admin@project2.com', '2020-12-01');
