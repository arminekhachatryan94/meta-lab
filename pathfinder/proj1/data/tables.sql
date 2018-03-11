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

/* Creating the posts table */
DROP TABLE IF EXISTS `metablog`.`posts`;
CREATE TABLE `metablog`.`posts` (
	`post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` int(10) NOT NULL,
	`post_title` varchar(255) NOT NULL,
    `post_body` text NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`post_id`, `user_id`)
);

/* Creating the comments table */
DROP TABLE IF EXISTS `metablog`.`comments`;
CREATE TABLE `metablog`.`comments` (
	`comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`post_id` int(10) NOT NULL,
    `body` text NOT NULL,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`comment_id`, `post_id`)
);

/* Creating the user_roles table */
DROP TABLE IF EXISTS `metablog`.`user_roles`;
CREATE TABLE `metablog`.`user_roles` (
	`user_id` int(10) unsigned NOT NULL,
	`role` varchar(32) NOT NULL, /* user or admin */
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  	`updated_at` TIMESTAMP NULL DEFAULT NULL,
  	PRIMARY KEY (`user_id`)
);

/* Populate the users table */
INSERT INTO `metablog`.`users` (`user_id`, `first_name`, `last_name`, `username`, `email`, `password`)
VALUES
	(1, 'Armine', 'Khachatryan', 'armine', 'a@gmail.com', '1234')

/* Populate the user_roles table */
INSERT INTO `metablog`.`user_roles` (`user_id`, `role`)
VALUES
	(1, 'admin')

