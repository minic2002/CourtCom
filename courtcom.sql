-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 01:33 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courtcom`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_coach`
--

CREATE TABLE `book_coach` (
  `bcch_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `coach_id` int(6) NOT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL,
  `Booking_Date` date NOT NULL,
  `Booking_Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_court`
--

CREATE TABLE `book_court` (
  `bcrt_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `court_id` int(6) NOT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL,
  `Booking_Date` date NOT NULL,
  `Booking_Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_court`
--

INSERT INTO `book_court` (`bcrt_id`, `user_id`, `court_id`, `Start_Time`, `End_Time`, `Booking_Date`, `Booking_Status`) VALUES
(31, 29, 12, '13:00:00', '04:00:00', '2023-05-17', 'Pending'),
(34, 29, 7, '06:00:00', '08:00:00', '2023-05-13', 'Pending'),
(35, 29, 14, '07:00:00', '08:00:00', '2023-05-24', 'Pending'),
(40, 29, 16, '09:00:00', '12:00:00', '2023-05-26', 'Pending'),
(41, 70, 16, '12:00:00', '16:00:00', '2023-06-09', 'Pending'),
(43, 29, 13, '09:00:00', '12:00:00', '2023-05-21', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `coach_ID` int(6) NOT NULL,
  `user_ID` int(6) NOT NULL,
  `sport_type` varchar(50) NOT NULL,
  `RPH` double NOT NULL,
  `coach_desc` varchar(300) NOT NULL,
  `availability` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`coach_ID`, `user_ID`, `sport_type`, `RPH`, `coach_desc`, `availability`) VALUES
(3, 55, 'Badminton', 100, 'Hi! My Name is Doja Cat. I am able to assist you and coach you for your badminton tryouts.', ' '),
(4, 56, 'Gymnastics', 100, 'Gymnast Coach', ' '),
(5, 64, 'Volleyball', 50, 'I am a renowned volleyball player. I won a lot of awards. I can coach and assist you in volleyball.', ' '),
(6, 69, 'Basketball', 45, 'blah blah blah kuan', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `court`
--

CREATE TABLE `court` (
  `court_ID` int(6) NOT NULL,
  `user_ID` int(6) NOT NULL,
  `court_name` varchar(50) NOT NULL,
  `court_image` varchar(100) NOT NULL,
  `court_address` varchar(50) NOT NULL,
  `court_desc` varchar(300) NOT NULL,
  `court_type` varchar(50) NOT NULL,
  `rph` double NOT NULL,
  `Availability` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `court`
--

INSERT INTO `court` (`court_ID`, `user_ID`, `court_name`, `court_image`, `court_address`, `court_desc`, `court_type`, `rph`, `Availability`) VALUES
(7, 62, 'Folklore Badminton', 'static/images/court_images/Folklore Badminton-62.jpg', 'L. Flores St. Pasil, Cebu City', 'A badminton court for everyone', 'Badminton', 50, ' '),
(8, 63, 'Basket Baron', 'static/images/court_images/Basket Baron-63.jpg', 'L. Flores St. Pasil, Cebu City', 'basketball court para sa tanan', 'Basketball', 50, ' '),
(9, 65, 'Katy Kourt', 'static/images/court_images/Katy Kourt-65.jpg', 'Sanciangko St. Cebu City', 'Katy Kourt is a tennis court for everyone who is tennis enthusiast.', 'Tennis', 60, ' '),
(10, 66, 'Anuada Basketanan', 'static/images/court_images/Anuada Basketanan-66.jpg', 'OsmeÃ±a Blvd. Cebu City', 'Ang description ani kay kuan', 'Basketball', 10, ' '),
(12, 68, 'Mardon Table Tennis', 'static/images/court_images/Mardon Table Tennis-68.jpg', 'Sanciangko St. Cebu City', 'Table Tennis dapit sa Sanciangko unya barato ra siya periodt.', 'Table tennis', 50, ' '),
(13, 71, 'Waren Swim Training', 'static/images/court_images/Waren Swim Training-71.jpg', 'Sanciangko St. Cebu City', 'Waren Swim Training is a pool training facility for people who love to practice swimming.', 'Swimming', 50, ' '),
(14, 73, 'Queen Volleyballanan', 'static/images/court_images/Queen Volleyballanan-73.jpg', 'OsmeÃ±a Blvd. Cebu City', 'Pull up in the monster automobile gangster. With a bad bitch that came from Sri Lanka.', 'Volleyball', 500, ' '),
(15, 74, 'Janine DaGym', 'static/images/court_images/Janine DaGym-74.jpg', 'OsmeÃ±a Blvd. Cebu City', 'Practisanan og sayaw', 'Dance', 30, ' '),
(16, 75, 'Dan Mark Gym', 'static/images/court_images/Dan Mark Gym-75.jpg', 'Sanciangko St. Cebu City', 'Practisanan sa mga gymnast', 'Gymnastics', 80, ' ');

-- --------------------------------------------------------

--
-- Table structure for table `pay_booked_coach`
--

CREATE TABLE `pay_booked_coach` (
  `pbcch_id` int(6) NOT NULL,
  `bcch_id` int(6) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_amount` double NOT NULL,
  `payment_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pay_booked_court`
--

CREATE TABLE `pay_booked_court` (
  `pbcrt_id` int(6) NOT NULL,
  `bcrt_id` int(6) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `payment_amount` double NOT NULL,
  `payment_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review_coach`
--

CREATE TABLE `review_coach` (
  `review_coach_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `coach_id` int(6) NOT NULL,
  `review_text` varchar(300) NOT NULL,
  `rate` int(5) NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review_court`
--

CREATE TABLE `review_court` (
  `review_court_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `court_id` int(6) NOT NULL,
  `review_text` varchar(300) NOT NULL,
  `rate` int(5) NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(6) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `user_pic` varchar(300) NOT NULL,
  `usertype` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pnumber` varchar(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `user_pic`, `usertype`, `email`, `pnumber`, `password`) VALUES
(29, 'Heather', 'Johnson', 'static/images/profile_pictures/HeatherJohnson09876540123.jpg', 'User', 'heatherjohnson@gmail.com', '09876540123', '202cb962ac59075b964b07152d234b70'),
(37, 'Zach ', 'Rockwell', 'static/images/profile_pictures/ZachRockwell09990011110.jpg', 'User', 'zachrock@gmail.com', '09990011110', '202cb962ac59075b964b07152d234b70'),
(55, 'Doja ', 'Cat', '', 'Coach', 'dojacat@gmail.com', '09563451234', '202cb962ac59075b964b07152d234b70'),
(56, 'Randall Iverson', 'Dela Pisa', '', 'Coach', 'sire@gmail.com', '09352347865', '202cb962ac59075b964b07152d234b70'),
(62, 'Taylor', 'Swift', '', 'Court Owner', 'taylorswift@uc.edu.ph', '09435672312', '202cb962ac59075b964b07152d234b70'),
(63, 'Baron', 'Green', '', 'Court Owner', 'baron_green@gmail.com', '09643346537', '202cb962ac59075b964b07152d234b70'),
(64, 'Ariana', 'Grande', '', 'Coach', 'arianagrande@gmail.com', '09893345645', '202cb962ac59075b964b07152d234b70'),
(65, 'Katy', 'Perry', '', 'Court Owner', 'katycat@gmail.com', '09232241234', '202cb962ac59075b964b07152d234b70'),
(66, 'Ericson', 'Anuada', '', 'Court Owner', 'anuadaericson@gmail.com', '09345673421', '202cb962ac59075b964b07152d234b70'),
(68, 'Mardon', 'Dela PeÃ±a', '', 'Court Owner', 'mardondelapena@gmail.com', '09436567768', '202cb962ac59075b964b07152d234b70'),
(69, 'Christ Rile', 'Parinasan', '', 'Coach', 'rile@gmail.com', '09342257867', '202cb962ac59075b964b07152d234b70'),
(70, 'Chandler', 'Brown', '', 'User', 'chandlerbrown@gmail.com', '09435576578', '202cb962ac59075b964b07152d234b70'),
(71, 'Waren', 'Auman', '', 'Court Owner', 'warenauman@gmail.com', '09342215678', '202cb962ac59075b964b07152d234b70'),
(73, 'Nicki', 'Minaj', 'static/images/profile_pictures/NickiMinaj09342285643.jpg', 'Court Owner', 'onickamaraj@gmail.com', '09342285643', '202cb962ac59075b964b07152d234b70'),
(74, 'Janine', 'Ubal', 'static/images/profile_pictures/JanineUbal09884565577.jpg', 'Court Owner', 'ninbal@gmail.com', '09884565577', '202cb962ac59075b964b07152d234b70'),
(75, 'Dan Mark', 'Sandigan', '', 'Court Owner', 'dms@gmail.com', '09545543423', '202cb962ac59075b964b07152d234b70'),
(76, 'Gerda', 'Bagahansol', 'static/images/profile_pictures/GerdaBagahansol09342212121.jpeg', 'User', 'gerdabagahansol@gmail.com', '09342212121', '202cb962ac59075b964b07152d234b70'),
(77, 'Dominic', 'Navos', 'static/images/profile_pictures/DominicNavos09994096196.jpg', 'User', 'dominicnavos@gmail.com', '09994096196', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_coach`
--
ALTER TABLE `book_coach`
  ADD PRIMARY KEY (`bcch_id`),
  ADD KEY `book_coach_ibfk_1` (`coach_id`),
  ADD KEY `book_coach_ibfk_2` (`user_id`);

--
-- Indexes for table `book_court`
--
ALTER TABLE `book_court`
  ADD PRIMARY KEY (`bcrt_id`),
  ADD KEY `book_court_ibfk_1` (`user_id`),
  ADD KEY `book_court_ibfk_2` (`court_id`);

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`coach_ID`),
  ADD KEY `coach_ibfk_1` (`user_ID`);

--
-- Indexes for table `court`
--
ALTER TABLE `court`
  ADD PRIMARY KEY (`court_ID`),
  ADD KEY `court_ibfk_1` (`user_ID`);

--
-- Indexes for table `pay_booked_coach`
--
ALTER TABLE `pay_booked_coach`
  ADD PRIMARY KEY (`pbcch_id`),
  ADD KEY `pay_booked_coach_ibfk_1` (`bcch_id`);

--
-- Indexes for table `pay_booked_court`
--
ALTER TABLE `pay_booked_court`
  ADD PRIMARY KEY (`pbcrt_id`),
  ADD KEY `pay_booked_court_ibfk_1` (`bcrt_id`);

--
-- Indexes for table `review_coach`
--
ALTER TABLE `review_coach`
  ADD PRIMARY KEY (`review_coach_id`),
  ADD KEY `review_coach_ibfk_1` (`coach_id`),
  ADD KEY `review_coach_ibfk_2` (`user_id`);

--
-- Indexes for table `review_court`
--
ALTER TABLE `review_court`
  ADD PRIMARY KEY (`review_court_id`),
  ADD KEY `review_court_ibfk_1` (`user_id`),
  ADD KEY `review_court_ibfk_2` (`court_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_coach`
--
ALTER TABLE `book_coach`
  MODIFY `bcch_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_court`
--
ALTER TABLE `book_court`
  MODIFY `bcrt_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `coach_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `court`
--
ALTER TABLE `court`
  MODIFY `court_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pay_booked_coach`
--
ALTER TABLE `pay_booked_coach`
  MODIFY `pbcch_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_booked_court`
--
ALTER TABLE `pay_booked_court`
  MODIFY `pbcrt_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_coach`
--
ALTER TABLE `review_coach`
  MODIFY `review_coach_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_court`
--
ALTER TABLE `review_court`
  MODIFY `review_court_id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_coach`
--
ALTER TABLE `book_coach`
  ADD CONSTRAINT `book_coach_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `coach` (`coach_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_coach_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_court`
--
ALTER TABLE `book_court`
  ADD CONSTRAINT `book_court_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_court_ibfk_2` FOREIGN KEY (`court_id`) REFERENCES `court` (`court_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coach`
--
ALTER TABLE `coach`
  ADD CONSTRAINT `coach_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `court`
--
ALTER TABLE `court`
  ADD CONSTRAINT `court_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pay_booked_coach`
--
ALTER TABLE `pay_booked_coach`
  ADD CONSTRAINT `pay_booked_coach_ibfk_1` FOREIGN KEY (`bcch_id`) REFERENCES `book_coach` (`bcch_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pay_booked_court`
--
ALTER TABLE `pay_booked_court`
  ADD CONSTRAINT `pay_booked_court_ibfk_1` FOREIGN KEY (`bcrt_id`) REFERENCES `book_court` (`bcrt_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review_coach`
--
ALTER TABLE `review_coach`
  ADD CONSTRAINT `review_coach_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `coach` (`coach_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_coach_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review_court`
--
ALTER TABLE `review_court`
  ADD CONSTRAINT `review_court_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_court_ibfk_2` FOREIGN KEY (`court_id`) REFERENCES `court` (`court_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
