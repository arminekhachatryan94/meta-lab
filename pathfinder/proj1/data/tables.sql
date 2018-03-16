/* Creating the Database */
CREATE DATABASE IF NOT EXISTS metablog;
ALTER DATABASE metablog
	DEFAULT CHARACTER SET utf8
	DEFAULT COLLATE utf8_unicode_ci;

/* Creating the users table */
DROP TABLE IF EXISTS `metablog`.`users`;
CREATE TABLE `metablog`.`users` (
	`user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `first_name` varchar(255) NOT NULL,
    `last_name` varchar(255) NOT NULL,
	`username` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  	`updated_at` TIMESTAMP NULL DEFAULT NULL,
  	PRIMARY KEY (`user_id`),
  	UNIQUE (`username`)
);

/* Creating the user_roles table */
DROP TABLE IF EXISTS `metablog`.`user_roles`;
CREATE TABLE `metablog`.`user_roles` (
	`user_id` int(10) unsigned NOT NULL,
	`role` varchar(32) NOT NULL, /* user or admin */
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  	`updated_at` TIMESTAMP NULL DEFAULT NULL,
  	PRIMARY KEY (`user_id`),
	CONSTRAINT FK_User_Roles FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
);

/* Creating the posts table */
DROP TABLE IF EXISTS `metablog`.`posts`;
CREATE TABLE `metablog`.`posts` (
	`post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) unsigned NOT NULL,
	`post_title` varchar(255) NOT NULL,
    `post_body` text NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`post_id`),
	CONSTRAINT FK_User_Posts FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
);

/* Creating the comments table */
DROP TABLE IF EXISTS `metablog`.`comments`;
CREATE TABLE `metablog`.`comments` (
	`comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`post_id` int(10) unsigned NOT NULL,
	`commenter_id` int(10) unsigned NOT NULL,
    `body` text NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`comment_id`),
	CONSTRAINT FK_User_Comments FOREIGN KEY (`commenter_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
	CONSTRAINT FK_Post_Comments FOREIGN KEY (`post_id`) REFERENCES `posts`(`post_id`) ON DELETE CASCADE
);

/* Populate the users table */
INSERT INTO `metablog`.`users` (`first_name`, `last_name`, `username`, `email`, `password`)
VALUES
	('Armine', 'Khachatryan', 'armine', 'a@gmail.com', '1234');

/* Populate the user_roles table */
INSERT INTO `metablog`.`user_roles` (`user_id`, `role`)
VALUES
	(1, 'admin');
