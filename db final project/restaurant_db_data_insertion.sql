USE `restaurant`;

-- --------------------------------------------------------

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`user_id`, `f_name`, `l_name`, `dob`, `username`, `email`) VALUES
(1230, 'Tris', 'Wilson', '1989-06-12', 'wilson', 'gfhrtr@gmail.com'),
(1243, 'Brian', 'Peterson', '1973-08-12', 'b_peter', 'pet@zzz.com'),
(1643, 'Joy', 'Miller', '1985-04-09', 'joy85', 'jhjhfb@gmail.com'),
(2869, 'Abraham', 'Roy', '1993-06-12', 'aroy', 'abc@yahoo.com'),
(3421, 'Samuel', 'Taylor', '1997-08-14', 'sam14', 'sam14@xyz.com'),
(5402, 'John', 'Clark', '1990-02-03', 'jclark', 'clar@yahoo.com'),
(6462, 'Chang', 'Lee', '1983-10-12', 'lee', 'hfgfe@gmail.com'),
(6868, 'Cali', 'Johnson', '1995-05-12', 'cal17', 'rst@rediff.com'),
(7178, 'Alex', 'Smith', '2000-11-11', 'alex007', 'alex007@xyz.com'),
(9476, 'Heather', 'Bell', '1983-08-12', 'belle', 'belle@belle.com');

-- --------------------------------------------------------

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`business_id`, `business_name`, `user_id`, `hours`, `contact_number`) VALUES
(1001, 'Viva Chicken', 5402, '11:00 am  9:00 pm', '9803350176'),
(1002, 'Good Food on Montford', 7178, '5:30 pm  11.00 pm', '7045250881'),
(1003, 'Seafood Connection', 1643, '11.00 am  11.00 pm', '7044304591'),
(1004, 'The Cellar At Duckworth’s', 2869, '5:00 pm to 2.00 am', '9803494078'),
(1005, 'The Fig Tree Restaurant', 6868, '5:00 pm to 11:00 pm', '7043323322'),
(1006, 'Haberdish', 1230, '11:00 am to 9:00 pm', '704 8171084'),
(1007, 'Yafo Kitchen', 3421, '11:00 am to 10.00 pm', '7043657130'),
(1008, 'Not Just Coffee  7th Street', 9476, '7:00 am to 8.00 pm', '7048173868'),
(1009, 'Culver’s', 1243, '10:30 am to 10.30 pm', '980 3487611'),
(1010, 'Dogwood Southern Table & Bar', 6462, '5:00 pm to 10:00 pm', '7049104919');

-- --------------------------------------------------------

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`business_id`, `review_id`, `user_id`, `content`, `published_date`, `stars`) VALUES
(1006, 12001, 9476, 'Completely ho-hum. Lovely restaurant, lovely setting, mediocre food. Nothing special about this place at all - the food is completely ho-hum. Had the grouper which was completely flavorless, and hubby had the pork chop, which was only slightly better than the grouper. The green chilis  were yummy', '2015-09-18 00:00:00', 4),
(1001, 15261, 1643, 'The best hands down. There food never disappoints. I just wish they were open daily. So that I can get it anytime. Once you ve tried it once you will definitely become addicted. Best seafood in Charlotte', '2017-04-03 00:00:00', 5),
(1005, 21323, 3421, 'Managers seem to check on you in the dining room and have all been very nice to make sure you got what you need. Interior is clean, open and vibrant. The flavors arent as deep as Jasmine Grill on South Boulevard, but the ambience, service, and area trump it.', '2016-10-15 00:00:00', 4),
(1003, 23283, 6868, 'Food was great. Chef was courteous and quick to get order to us! Would definitely recommend', '1905-07-09 00:00:00', 4),
(1007, 34399, 1243, 'The food here is awesome! I love the ice cream! The lines are a little long, but they move pretty quick. The employees are very friendly. Great place to take a family to dine.', '2017-03-28 00:00:00', 4),
(1002, 43284, 2869, 'Fast delivery, this food is to die for! The shrimp and grits is my absolute favorite. Im also a big fan of the crepedilla and the cowabunga burger. Lots of food for your buck! The owner is a really nice, dedicated guy', '2017-02-24 00:00:00', 5),
(1004, 45765, 1230, 'This is definitely one of my favorite restaurants! I m glad you enjoyed it', '2016-12-25 00:00:00', 4),
(1009, 77772, 5402, 'Their salads are also my favorite in the city - even their vegetarian options are probably the best you can find around the CLT', '2016-04-13 00:00:00', 5),
(1008, 82362, 6462, 'You would find a whole lot of mexican restaurants in town however this is on the top of my list. The dips that they serve along with the chips are Roasted red chilli, Green tomato salsa and regular salsa. The Green tomato salsa is to die for ! Its just the right amount of heat and tangy. We ordered the burittos, Enchilladas and chile relleno. Everyone just relished it. A must go place if you are in and around Palo Alto', '2017-02-01 00:00:00', 4),
(1010, 90818, 7178, 'The food has great pricing. The food portions are surprisingly and refreshingly small for an American Restaurant. I had the Salmon ramen. The ramen was more like linguine, so I was disappointed.The only one that I do have is that the drinks are overpriced.', '2017-01-16 00:00:00', 5);

-- --------------------------------------------------------

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`vote_id`, `user_id`, `review_id`, `up_down`) VALUES
(4, 5402, 77772, 1),
(8, 7178, 90818, 0),
(9, 1243, 34399, 1),
(11, 1643, 15261, 1),
(23, 9476, 12001, 0),
(36, 6868, 23283, 1),
(45, 3421, 21323, 0),
(56, 2869, 43284, 1),
(67, 6462, 82362, 1),
(90, 1230, 45765, 0);

-- --------------------------------------------------------

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `restaurant_type`) VALUES
(1006, 'Diner'),
(1010, 'Pub'),
(1002, 'Bar'),
(1003, 'Steakhouse'),
(1005, 'Cafe'),
(1008, 'Cafeteria'),
(1004, 'Fast Food'),
(1001, 'Sandwhich Shop'),
(1007, 'Gastropub'),
(1009, 'Restaurant'),
(1011, 'Fast Casual Restaurant');

-- --------------------------------------------------------

--
-- Dumping data for table `business_category_relation`
--

INSERT INTO `business_category_relation` (`business_id`, `category_id`) VALUES
(1001, 1011),
(1002, 1009),
(1003, 1009),
(1004, 1002),
(1005, 1009),
(1006, 1007),
(1007, 1011),
(1008, 1005),
(1009, 1004),
(1010, 1007);

-- --------------------------------------------------------

--
-- Dumping data for table `cuisine`
--

INSERT INTO `cuisine` (`cuisine_id`, `nationality`) VALUES
(1, 'American'),
(9, 'Cajun/Creole'),
(20, 'Coffee & Tea'),
(2, 'Fast food'),
(4, 'French'),
(8, 'Indian'),
(15, 'Middle Eastern'),
(11, 'Peruvian'),
(7, 'Seafood'),
(6, 'Southern'),
(3, 'Thai');

-- --------------------------------------------------------

--
-- Dumping data for table `business_category_relation`
--

INSERT INTO `business_cuisine_relation` (`business_id`, `cuisine_id`) VALUES
(1001, 11),
(1002, 1),
(1002, 6),
(1003, 7),
(1004, 1),
(1005, 1),
(1006, 1),
(1006, 6),
(1007, 15),
(1008, 20),
(1009, 1),
(1010, 6);

-- --------------------------------------------------------

--
-- Dumping data for table `business_location`
--

INSERT INTO `business_location` (`business_location_id`, `business_id`, `street`, `city`, `state`, `zip`) VALUES
(1435, 1007, '720 Governor Morrison St', 'Charlotte', 'NC', '28211'),
(8975, 1005, '1601 E 7th St', 'Charlotte', 'NC', '28204'),
(12232, 1009, '7031 University City Blvd', 'Charlotte', 'NC', '28262'),
(12435, 1006, '3106 N Davidson St', 'Charlotte', 'NC', '28205'),
(14324, 1001, '1617 Elizabeth Ave', 'Charlotte', 'NC', '28204'),
(35231, 1002, '	1701 Montford Dr', '	Charlotte', 'NC', '28209'),
(45277, 1003, '5546 Albemarle Rd', 'Charlotte', 'NC', '28212'),
(56768, 1004, '330 N Tryon St', 'Charlotte', 'NC', '28202'),
(76768, 1008, '224 E 7th St', 'Charlotte', 'NC', '28202');

-- --------------------------------------------------------



