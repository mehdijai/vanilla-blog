-- Active: 1670332519346@@127.0.0.1@3306
use vanilla_blog;

CREATE TABLE `authors`(
	`id` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`name` VARCHAR(255) NOT NULL,
	`username` VARCHAR(255) NOT NULL UNIQUE,
	`email` VARCHAR(255) NOT NULL UNIQUE,
	`password` VARCHAR(255) NOT NULL,
	`email_verified` BOOL DEFAULT 0,
	`profile_picture` varchar(255) NOT NULL DEFAULT '/static/default_profile_picture.jpg',
	`cover` VARCHAR(255),
	`social_media` JSON,
	`about` TEXT(255),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
);

CREATE TABLE `categories`(
	`id` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
	`slug` VARCHAR(255) NOT NULL UNIQUE,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE `modules`(
	`id` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
	`thumbnail` VARCHAR(255) NOT NULL,
	`slug` VARCHAR(255) NOT NULL UNIQUE,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE `posts`(
	`id` INT NOT NULL AUTO_INCREMENT UNIQUE,
    `author_id` INT,
    `module_id` INT NULLABLE,
	`title` VARCHAR(255) NOT NULL,
    `body` TEXT(1000) NOT NULL,
    `description` TEXT(500) NOT NULL,
	`thumbnail` VARCHAR(255) NOT NULL DEFAULT '/static/default_image.png',
	`slug` VARCHAR(255) NOT NULL UNIQUE,
	`draft` tinyint(1) NOT NULL DEFAULT '1',
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
    FOREIGN KEY (`author_id`) REFERENCES authors(id) ON DELETE SET NULL,
    FOREIGN KEY (`module_id`) REFERENCES modules(id) ON DELETE SET NULL
);

CREATE TABLE `category_post`(
	`id` INT NOT NULL AUTO_INCREMENT UNIQUE,
    `category_id` INT,
    `post_id` INT,
	`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
    FOREIGN KEY (`category_id`) REFERENCES categories(id) ON DELETE CASCADE,
    FOREIGN KEY (`post_id`) REFERENCES posts(id) ON DELETE CASCADE
);

-- A view to return all posts with author included and categories names
CREATE VIEW V_AllPosts AS
SELECT
    posts.*,
    authors.name AS author,
    authors.profile_picture AS profile_picture,
	authors.username AS author_username,
    IF(COUNT(categories.title) = 0, '[]', JSON_ARRAYAGG(JSON_OBJECT('title', categories.title, 'slug', categories.slug))) AS post_categories
FROM
    posts
    INNER JOIN authors ON posts.author_id = authors.id
    LEFT JOIN category_post ON posts.id = category_post.post_id
    LEFT JOIN categories ON category_post.category_id = categories.id
WHERE
	posts.draft = 0
GROUP BY
    posts.id
ORDER BY
	posts.created_at
DESC;