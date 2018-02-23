-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2017 at 08:03 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE database `restaurant`;
USE `restaurant`;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `business_id` int(10) UNSIGNED NOT NULL,
  `business_name` varchar(45) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT 'user_id of administrator',
  `hours` varchar(100) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `review_count` int(10) DEFAULT 0 COMMENT 'updated via trigger on review insert/delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `restaurant_type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `business_category_relation`
--

CREATE TABLE `business_category_relation` (
  `business_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cuisine`
--

CREATE TABLE `cuisine` (
  `cuisine_id` int(10) UNSIGNED NOT NULL,
  `nationality` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `business_cuisine_relation`
--

CREATE TABLE `business_cuisine_relation` (
  `business_id` int(10) UNSIGNED NOT NULL,
  `cuisine_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `business_location`
--

CREATE TABLE `business_location` (
  `business_location_id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) UNSIGNED NOT NULL,
  `street` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(30) DEFAULT NULL,
  `l_name` varchar(30) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `business_id` int(10) UNSIGNED NOT NULL,
  `review_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `content` longtext NOT NULL,
  `published_date` datetime DEFAULT NULL,
  `stars` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `vote_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `review_id` int(11) UNSIGNED DEFAULT NULL,
  `up_down` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`business_id`);

--
-- Indexes for table `business_category_relation`
--
ALTER TABLE `business_category_relation`
  ADD PRIMARY KEY (`business_id`,`category_id`),
  ADD KEY `fk_category_relation_category_id_idx` (`category_id`);

--
-- Indexes for table `business_cuisine_relation`
--
ALTER TABLE `business_cuisine_relation`
  ADD PRIMARY KEY (`business_id`,`cuisine_id`),
  ADD KEY `fk_cuisine_relation_cuisine_id_idx` (`cuisine_id`);

--
-- Indexes for table `business_location`
--
ALTER TABLE `business_location`
  ADD PRIMARY KEY (`business_location_id`),
  ADD UNIQUE KEY `business_location_id_UNIQUE` (`business_location_id`),
  ADD KEY `fk_business_idx` (`business_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `business_category_id_UNIQUE` (`category_id`),
  ADD UNIQUE KEY `restaurant_type_UNIQUE` (`restaurant_type`);

--
-- Indexes for table `cuisine`
--
ALTER TABLE `cuisine`
  ADD PRIMARY KEY (`cuisine_id`),
  ADD UNIQUE KEY `idbusiness_cuisine_id_UNIQUE` (`cuisine_id`),
  ADD UNIQUE KEY `nationality_UNIQUE` (`nationality`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD UNIQUE KEY `review_id_UNIQUE` (`review_id`),
  ADD KEY `fk_review_business_id_idx` (`business_id`),
  ADD KEY `fk_review_user_id_idx` (`user_id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`vote_id`),
  ADD UNIQUE KEY `vote_id_UNIQUE` (`vote_id`),
  ADD KEY `fk_vote_review_id_idx` (`review_id`),
  ADD KEY `fk_vote_user_id_idx` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `business_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;
--
-- AUTO_INCREMENT for table `business_location`
--
ALTER TABLE `business_location`
  MODIFY `business_location_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76769;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;
--
-- AUTO_INCREMENT for table `cuisine`
--
ALTER TABLE `cuisine`
  MODIFY `cuisine_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9477;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90819;
--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `vote_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_category_relation`
--
ALTER TABLE `business_category_relation`
  ADD CONSTRAINT `fk_category_relation_business_id` FOREIGN KEY (`business_id`) REFERENCES `business` (`business_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_category_relation_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `business_cuisine_relation`
--
ALTER TABLE `business_cuisine_relation`
  ADD CONSTRAINT `fk_cuisine_relation_business_id` FOREIGN KEY (`business_id`) REFERENCES `business` (`business_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cuisine_relation_cuisine_id` FOREIGN KEY (`cuisine_id`) REFERENCES `cuisine` (`cuisine_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `business_location`
--
ALTER TABLE `business_location`
  ADD CONSTRAINT `fk_location_business_id` FOREIGN KEY (`business_id`) REFERENCES `business` (`business_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review_business_id` FOREIGN KEY (`business_id`) REFERENCES `business` (`business_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_review_user_id` FOREIGN KEY (`user_id`) REFERENCES `person` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `fk_vote_review_id` FOREIGN KEY (`review_id`) REFERENCES `review` (`review_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vote_user_id` FOREIGN KEY (`user_id`) REFERENCES `person` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


--
-- increment review count on table `business` after a successful review insertion
--
DELIMITER $$
CREATE TRIGGER increment_business_review_count
	AFTER INSERT ON `review` FOR EACH ROW
		BEGIN
			UPDATE `business` 
			SET `business`.`review_count` = `business`.`review_count` + 1
			WHERE `business`.`business_id` = NEW.`business_id`;
        END$$
DELIMITER ;

--
-- decrement review count on table `business` after a successful review deletion
--
DELIMITER $$
CREATE TRIGGER decrement_business_review_count
	AFTER DELETE ON `review` FOR EACH ROW
		BEGIN
			UPDATE `business` 
			SET `business`.`review_count` = `business`.`review_count` - 1
			WHERE `business`.`business_id` = OLD.`business_id`;
        END$$
DELIMITER ;

--
-- retrieve review count for user based on user id
--
DELIMITER $$
USE `restaurant`$$
CREATE PROCEDURE `user_review_count` (IN usr_id int, OUT rvw_count int)
BEGIN
	SET rvw_count = (SELECT COUNT(review.review_id) FROM review WHERE review.user_id = usr_id);
END$$
DELIMITER ;



