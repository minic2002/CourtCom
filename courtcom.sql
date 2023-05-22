-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 12:07 AM
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
  `Booking_Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_coach`
--

INSERT INTO `book_coach` (`bcch_id`, `user_id`, `coach_id`, `Start_Time`, `End_Time`, `Booking_Date`, `Booking_Status`) VALUES
(8, 77, 6, '06:00:00', '21:00:00', '2023-05-31', 'Pending'),
(9, 29, 6, '09:00:00', '12:00:00', '2023-05-30', 'Pending'),
(10, 29, 5, '08:00:00', '09:00:00', '2023-05-25', 'Pending'),
(11, 29, 3, '14:00:00', '16:00:00', '2023-05-25', 'Pending'),
(13, 29, 4, '15:30:00', '17:00:00', '2023-05-24', 'Pending'),
(14, 37, 6, '06:00:00', '20:00:00', '2023-05-24', 'Pending'),
(15, 77, 3, '07:00:00', '08:00:00', '2023-05-31', 'Pending');

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
(57, 37, 13, '16:00:00', '17:00:00', '2023-05-24', 'Pending'),
(58, 29, 13, '10:00:00', '12:00:00', '2023-05-30', 'Pending'),
(59, 29, 7, '16:00:00', '18:00:00', '2023-05-24', 'Pending');

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
(16, 75, 'Dan Mark Gym', 'static/images/court_images/Dan Mark Gym-75.jpg', 'Sanciangko St. Cebu City', 'Practisanan sa mga gymnast', 'Gymnastics', 80, ' '),
(17, 79, 'Green Valley Court', 'static/images/court_images/Green Valley Court-79.jpg', 'Lomboy St. Banawa, Cebu City', 'Green Valley Court has various courts that users can utilize: Basketball, Volleyball, Swimming Pool, Oval, and Badminton', 'General', 80, ' ');

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

--
-- Dumping data for table `pay_booked_coach`
--

INSERT INTO `pay_booked_coach` (`pbcch_id`, `bcch_id`, `payment_type`, `payment_amount`, `payment_status`) VALUES
(1, 8, 'Walk-In Payment', 675, 'Walk-In Payment'),
(2, 9, 'Walk-In Payment', 135, 'Walk-In Payment'),
(3, 10, 'Walk-In Payment', 50, 'Walk-In Payment'),
(4, 11, 'Walk-In Payment', 200, 'Walk-In Payment'),
(5, 13, 'Walk-In Payment', 170, 'Walk-In Payment'),
(6, 14, 'Walk-In Payment', 630, 'Walk-In Payment'),
(7, 15, 'Walk-In Payment', 100, 'Walk-In Payment');

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

--
-- Dumping data for table `pay_booked_court`
--

INSERT INTO `pay_booked_court` (`pbcrt_id`, `bcrt_id`, `payment_type`, `payment_amount`, `payment_status`) VALUES
(7, 57, 'Walk-In Payment', 50, 'Walk-In Payment'),
(8, 58, 'Walk-In Payment', 100, 'Walk-In Payment'),
(9, 59, 'Walk-In Payment', 100, 'Walk-In Payment');

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
  `review_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_coach`
--

INSERT INTO `review_coach` (`review_coach_id`, `user_id`, `coach_id`, `review_text`, `rate`, `review_date`) VALUES
(2, 77, 6, 'He\'s a nice coach', 5, '2023-05-21 02:59:22'),
(5, 77, 5, 'She is the best singer', 5, '2023-05-21 03:21:11'),
(6, 29, 6, 'Maayo kaayo siya nga coach', 5, '2023-05-21 21:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `review_court`
--

CREATE TABLE `review_court` (
  `review_court_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `court_id` int(6) NOT NULL,
  `review_text` varchar(300) NOT NULL,
  `rate` float NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_court`
--

INSERT INTO `review_court` (`review_court_id`, `user_id`, `court_id`, `review_text`, `rate`, `review_date`) VALUES
(1, 77, 7, 'nindot ra mn siya', 4, '2023-05-20 23:40:30'),
(3, 29, 7, 'Actually it\'s good but layo kaayo', 5, '2023-05-21 00:18:08'),
(5, 37, 10, 'pagkawalay ayong basketanan, duol kaayo sa kanal pirmi mahog sa kanal ang bola giatay kaayo', 1, '2023-05-21 00:26:42'),
(6, 37, 7, 'it is a good court, it is named after my favorite album by my favorite artist. and I\'m shock that she also owned this court as well', 5, '2023-05-21 00:39:42'),
(7, 70, 16, 'nindot kaayo iyahang gym, daghan kaayog equipments nice', 5, '2023-05-21 00:42:26'),
(8, 70, 10, 'mao diayng tag 10 ra ang oras kay bati diay kaayo shuta', 1, '2023-05-21 00:43:51'),
(9, 77, 15, 'limpyo kaayo ilang gym nya makapractice tag sayaw og tarong', 5, '2023-05-21 01:02:25'),
(11, 70, 7, 'the court is ok for me', 3, '2023-05-21 02:02:27'),
(12, 70, 13, 'nindot kaayo ang swimming pool', 5, '2023-05-21 02:13:33'),
(15, 77, 13, 'limpyo kaayo ang swimming pool, nindot kaayo practisanan og langoy2x', 5, '2023-05-21 03:35:37'),
(16, 78, 7, 'This court is so good', 5, '2023-05-21 04:28:15'),
(17, 78, 13, 'My experience in this court is so wonderful', 4, '2023-05-21 04:38:40'),
(18, 78, 15, 'Mobalik jd ko diri og book kay nindot kaayo facility and it\'s so clean', 5, '2023-05-21 05:08:33'),
(19, 78, 8, 'this basketball court is so good', 5, '2023-05-21 05:19:16'),
(20, 37, 16, 'ganahan ko diri nga gym', 4, '2023-05-21 06:20:46'),
(21, 37, 8, 'this basketball is ok', 3, '2023-05-21 10:32:56'),
(22, 37, 15, 'nice kaayo ang dance gym barato ra kaayo ', 5, '2023-05-21 10:52:01'),
(23, 29, 13, 'naka suway na mig practice diri, to tell you honestly, nice kaayo diri jd promise', 5, '2023-05-21 12:16:38'),
(24, 77, 10, 'ang nakanindot ani kay barato ra jd kaayo pero dili ko ganahan sa environment sa place', 3, '2023-05-21 19:49:47');

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
(55, 'Doja ', 'Cat', 'static/images/profile_pictures/DojaCar09563451234.jpg', 'Coach', 'dojacat@gmail.com', '09563451234', '202cb962ac59075b964b07152d234b70'),
(56, 'Randall', 'Dela Pisa', 'static/images/profile_pictures/RandallIversonDelaPisa09352347865.jpg', 'Coach', 'sire@gmail.com', '09352347865', '202cb962ac59075b964b07152d234b70'),
(62, 'Taylor', 'Swift', '', 'Court Owner', 'taylorswift@uc.edu.ph', '09435672312', '202cb962ac59075b964b07152d234b70'),
(63, 'Baron', 'Green', '', 'Court Owner', 'baron_green@gmail.com', '09643346537', '202cb962ac59075b964b07152d234b70'),
(64, 'Ariana', 'Grande', 'static/images/profile_pictures/ArianaGrande09893345645.jpg', 'Coach', 'arianagrande@gmail.com', '09893345645', '202cb962ac59075b964b07152d234b70'),
(65, 'Katy', 'Perry', '', 'Court Owner', 'katycat@gmail.com', '09232241234', '202cb962ac59075b964b07152d234b70'),
(66, 'Ericson', 'Anuada', 'static/images/profile_pictures/EricsonAnuada09345673421.jpg', 'Court Owner', 'anuadaericson@gmail.com', '09345673421', '202cb962ac59075b964b07152d234b70'),
(68, 'Mardon', 'Dela PeÃ±a', 'static/images/profile_pictures/MardonDelaPena09436567768.jpg', 'Court Owner', 'mardondelapena@gmail.com', '09436567768', '202cb962ac59075b964b07152d234b70'),
(69, 'Christ Rile', 'Parinasan', 'static/images/profile_pictures/ChristRile09352347865.jpg', 'Coach', 'rile@gmail.com', '09342257867', '202cb962ac59075b964b07152d234b70'),
(70, 'Chandler', 'Brown', 'static/images/profile_pictures/ChandlerBrown09435576578.jpg', 'User', 'chandlerbrown@gmail.com', '09435576578', '202cb962ac59075b964b07152d234b70'),
(71, 'Waren', 'Auman', '', 'Court Owner', 'warenauman@gmail.com', '09342215678', '202cb962ac59075b964b07152d234b70'),
(73, 'Nicki', 'Minaj', 'static/images/profile_pictures/NickiMinaj09342285643.jpg', 'Court Owner', 'onickamaraj@gmail.com', '09342285643', '202cb962ac59075b964b07152d234b70'),
(74, 'Janine', 'Ubal', 'static/images/profile_pictures/JanineUbal09884565577.jpg', 'Court Owner', 'ninbal@gmail.com', '09884565577', '202cb962ac59075b964b07152d234b70'),
(75, 'Dan Mark', 'Sandigan', '', 'Court Owner', 'dms@gmail.com', '09545543423', '202cb962ac59075b964b07152d234b70'),
(76, 'Gerda', 'Bagahansol', 'static/images/profile_pictures/GerdaBagahansol09342212121.jpeg', 'User', 'gerdabagahansol@gmail.com', '09342212121', '202cb962ac59075b964b07152d234b70'),
(77, 'Dominic', 'Navos', 'static/images/profile_pictures/DominicNavos09994096196.jpg', 'User', 'dominicnavos@gmail.com', '09994096196', '202cb962ac59075b964b07152d234b70'),
(78, 'Camila', 'Cabello', 'static/images/profile_pictures/CamilaCabello09992341214.jpg', 'User', 'camilacabello@gmail.com', '09992341214', '202cb962ac59075b964b07152d234b70'),
(79, 'Rihanna', 'Rocky', 'static/images/profile_pictures/RihannaRocky09329231221.jpg', 'Court Owner', 'riri@gmail.com', '09329231221', '202cb962ac59075b964b07152d234b70');

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
  MODIFY `bcch_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `book_court`
--
ALTER TABLE `book_court`
  MODIFY `bcrt_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `coach_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `court`
--
ALTER TABLE `court`
  MODIFY `court_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pay_booked_coach`
--
ALTER TABLE `pay_booked_coach`
  MODIFY `pbcch_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pay_booked_court`
--
ALTER TABLE `pay_booked_court`
  MODIFY `pbcrt_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `review_coach`
--
ALTER TABLE `review_coach`
  MODIFY `review_coach_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `review_court`
--
ALTER TABLE `review_court`
  MODIFY `review_court_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

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
