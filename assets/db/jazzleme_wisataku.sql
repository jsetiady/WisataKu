-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2017 at 07:58 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jazzleme_wisataku`
--

-- --------------------------------------------------------

--
-- Table structure for table `ws_location`
--

CREATE TABLE `ws_location` (
  `loc_id` int(11) NOT NULL,
  `loc_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_location`
--

INSERT INTO `ws_location` (`loc_id`, `loc_name`) VALUES
(1, 'Bandung'),
(2, 'Surabaya'),
(3, 'Semarang'),
(4, 'Bali'),
(5, 'Lombok'),
(6, 'Komodo'),
(7, 'Yogyakarta'),
(8, 'Pangandaran'),
(9, 'Medan'),
(10, 'Ambon'),
(11, 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `ws_status`
--

CREATE TABLE `ws_status` (
  `status_id` int(11) NOT NULL,
  `status_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_status`
--

INSERT INTO `ws_status` (`status_id`, `status_desc`) VALUES
(0, 'unpaid'),
(1, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `ws_tour`
--

CREATE TABLE `ws_tour` (
  `tour_id` int(11) NOT NULL,
  `tour_name` varchar(100) NOT NULL,
  `tour_desc` varchar(200) NOT NULL,
  `tour_min_person` int(3) NOT NULL,
  `tour_max_person` int(11) NOT NULL,
  `tour_start_date` date NOT NULL,
  `tour_end_date` date NOT NULL,
  `tour_duration` int(3) NOT NULL,
  `tour_type` varchar(50) NOT NULL,
  `tour_tc` text NOT NULL,
  `tour_price` double NOT NULL,
  `tour_points` int(5) NOT NULL,
  `tour_created_date` date NOT NULL,
  `tour_loc_id` int(11) NOT NULL,
  `tour_user_admin_id` int(11) NOT NULL,
  `tour_image_filename` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_tour`
--

INSERT INTO `ws_tour` (`tour_id`, `tour_name`, `tour_desc`, `tour_min_person`, `tour_max_person`, `tour_start_date`, `tour_end_date`, `tour_duration`, `tour_type`, `tour_tc`, `tour_price`, `tour_points`, `tour_created_date`, `tour_loc_id`, `tour_user_admin_id`, `tour_image_filename`) VALUES
(1, 'Sailing Trip Komodo', '3D2N Saling Trip in Pulau Komodo', 1, 10, '2017-06-25', '2017-06-30', 5, 'p', '1. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.?<br>2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.? <br> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 3750000, 450, '2017-04-25', 6, 1, ''),
(2, 'Bandung - Tebing Keraton', 'Trip ke Tebing Keraton atau Tembing Instagram di Bandung', 10, 15, '2017-06-25', '2017-06-25', 1, 'g', '1. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.?2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.?3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 75000, 40, '2017-04-25', 1, 1, ''),
(3, 'Sailing Trip Komodo', 'Sailing Trip Komodo untuk Group 10 orang', 10, 10, '2017-06-25', '2017-06-30', 5, 'g', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 2900000, 3500, '2017-04-25', 6, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `ws_tour_itinerary`
--

CREATE TABLE `ws_tour_itinerary` (
  `itinerary_tour_id` int(11) NOT NULL,
  `itinerary_seq` int(2) NOT NULL,
  `itinerary_title` varchar(200) NOT NULL,
  `itinerary_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_tour_itinerary`
--

INSERT INTO `ws_tour_itinerary` (`itinerary_tour_id`, `itinerary_seq`, `itinerary_title`, `itinerary_desc`) VALUES
(1, 1, 'Day 1: Jakarta - Denpasar - Labuan Bajo - Pulau Sebayur', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(1, 2, 'Day 2: Pulau Rinca - Pulau Komodo - Pink Beach - Manta Point - Pulau Kanawa', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(1, 3, 'Day 3: Trekking Gili Laba - Snorkeling - Pulau Padar - Labuan Bajo', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(1, 4, 'Day 4: City tour labuan bajo - back to Jakarta', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(2, 1, '05:00 - Kumpul di Tahura Bandung', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(2, 2, '05:30 - Mulai jalan kaki ke Tebing Keraton', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(2, 3, '06:30 - Sampai di Tebing Keraton', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(2, 4, '09:00 - Kembali ke Tahura', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(3, 1, 'Day 1: Jakarta – Denpasar – Labuan Bajo – Pulau Sebayur', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(3, 2, 'Day 2: Pulau Rinca – Pulau Komodo – Pink Beach – Manta Point - Pulau Kanawa', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(3, 3, 'Day 3: Trekking Gili Laba – Snorkeling – Pulau Padar - Labuan Bajo', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(3, 4, 'Day 4: City tour labuan bajo - back to Jakarta', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.');

-- --------------------------------------------------------

--
-- Table structure for table `ws_transaction_rent_vehicle`
--

CREATE TABLE `ws_transaction_rent_vehicle` (
  `trans_veh_trans_id` int(11) NOT NULL,
  `trans_veh_plate_no` varchar(12) NOT NULL,
  `trans_veh_start_date` date NOT NULL,
  `trans_veh_end_date` date NOT NULL,
  `trans_veh_desc` text NOT NULL,
  `trans_veh_pickup_addr` text NOT NULL,
  `trans_veh_return_addr` text NOT NULL,
  `trans_veh_total_day` int(11) NOT NULL,
  `trans_veh_price` double NOT NULL,
  `trans_veh_total_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ws_transaction_souvenir`
--

CREATE TABLE `ws_transaction_souvenir` (
  `trans_sov_id` int(11) NOT NULL,
  `trans_sov_user_id` int(11) NOT NULL,
  `trans_sov_date` date NOT NULL,
  `trans_sov_price` int(11) NOT NULL,
  `trans_sov_deliv_addr` text NOT NULL,
  `trans_sov_contact_no` varchar(15) NOT NULL,
  `trans_sov_total_qty` int(11) NOT NULL,
  `trans_sov_invoice_no` varchar(20) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ws_transaction_tour`
--

CREATE TABLE `ws_transaction_tour` (
  `trans_id` int(11) NOT NULL,
  `trans_user_id` int(11) NOT NULL,
  `trans_user_telp` varchar(15) NOT NULL,
  `trans_total_person` int(11) NOT NULL,
  `trans_pref_startdate` date NOT NULL,
  `trans_pref_enddate` date NOT NULL,
  `trans_price_person` double NOT NULL,
  `trans_date` int(11) NOT NULL,
  `trans_total_price` double NOT NULL,
  `trans_payment_type` varchar(1) NOT NULL,
  `trans_payment_acc_no` varchar(30) NOT NULL,
  `trans_payment_date` date NOT NULL,
  `trans_expired_date` date NOT NULL,
  `trans_tour_id` int(11) NOT NULL,
  `trans_invoice_no` double NOT NULL,
  `trans_status_id` int(11) NOT NULL,
  `trans_notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ws_user`
--

CREATE TABLE `ws_user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(30) NOT NULL,
  `user_password` varchar(200) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_isAdmin` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ws_user`
--

INSERT INTO `ws_user` (`user_id`, `user_username`, `user_password`, `user_name`, `user_isAdmin`) VALUES
(1, 'jeje', '59d01563571125ccdcc8c85a63350809', 'Jessie Setiady', 'N'),
(2, 'michael', '59d01563571125ccdcc8c85a63350809', 'Michael Suryadi', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ws_location`
--
ALTER TABLE `ws_location`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `ws_status`
--
ALTER TABLE `ws_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `ws_tour`
--
ALTER TABLE `ws_tour`
  ADD PRIMARY KEY (`tour_id`),
  ADD KEY `loc_id` (`tour_loc_id`),
  ADD KEY `tour_user_admin_id` (`tour_user_admin_id`);

--
-- Indexes for table `ws_tour_itinerary`
--
ALTER TABLE `ws_tour_itinerary`
  ADD PRIMARY KEY (`itinerary_tour_id`,`itinerary_title`) USING BTREE;

--
-- Indexes for table `ws_transaction_rent_vehicle`
--
ALTER TABLE `ws_transaction_rent_vehicle`
  ADD PRIMARY KEY (`trans_veh_trans_id`,`trans_veh_plate_no`,`trans_veh_start_date`) USING BTREE;

--
-- Indexes for table `ws_transaction_souvenir`
--
ALTER TABLE `ws_transaction_souvenir`
  ADD PRIMARY KEY (`trans_sov_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `trans_sov_user_id` (`trans_sov_user_id`);

--
-- Indexes for table `ws_transaction_tour`
--
ALTER TABLE `ws_transaction_tour`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `user_id` (`trans_user_id`),
  ADD KEY `status_id` (`trans_status_id`),
  ADD KEY `tour_id` (`trans_tour_id`),
  ADD KEY `trans_user_id` (`trans_user_id`);

--
-- Indexes for table `ws_user`
--
ALTER TABLE `ws_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`user_username`),
  ADD KEY `id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ws_location`
--
ALTER TABLE `ws_location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ws_status`
--
ALTER TABLE `ws_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ws_tour`
--
ALTER TABLE `ws_tour`
  MODIFY `tour_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ws_transaction_rent_vehicle`
--
ALTER TABLE `ws_transaction_rent_vehicle`
  MODIFY `trans_veh_trans_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ws_transaction_souvenir`
--
ALTER TABLE `ws_transaction_souvenir`
  MODIFY `trans_sov_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ws_transaction_tour`
--
ALTER TABLE `ws_transaction_tour`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ws_user`
--
ALTER TABLE `ws_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ws_tour`
--
ALTER TABLE `ws_tour`
  ADD CONSTRAINT `ws_tour_ibfk_1` FOREIGN KEY (`tour_loc_id`) REFERENCES `ws_location` (`loc_id`),
  ADD CONSTRAINT `ws_tour_ibfk_2` FOREIGN KEY (`tour_user_admin_id`) REFERENCES `ws_user` (`user_id`);

--
-- Constraints for table `ws_tour_itinerary`
--
ALTER TABLE `ws_tour_itinerary`
  ADD CONSTRAINT `ws_tour_itinerary_ibfk_1` FOREIGN KEY (`itinerary_tour_id`) REFERENCES `ws_tour` (`tour_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ws_transaction_rent_vehicle`
--
ALTER TABLE `ws_transaction_rent_vehicle`
  ADD CONSTRAINT `ws_transaction_rent_vehicle_ibfk_1` FOREIGN KEY (`trans_veh_trans_id`) REFERENCES `ws_transaction_tour` (`trans_id`);

--
-- Constraints for table `ws_transaction_souvenir`
--
ALTER TABLE `ws_transaction_souvenir`
  ADD CONSTRAINT `ws_transaction_souvenir_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `ws_status` (`status_id`),
  ADD CONSTRAINT `ws_transaction_souvenir_ibfk_3` FOREIGN KEY (`trans_sov_user_id`) REFERENCES `ws_user` (`user_id`);

--
-- Constraints for table `ws_transaction_tour`
--
ALTER TABLE `ws_transaction_tour`
  ADD CONSTRAINT `ws_transaction_tour_ibfk_2` FOREIGN KEY (`trans_status_id`) REFERENCES `ws_status` (`status_id`),
  ADD CONSTRAINT `ws_transaction_tour_ibfk_3` FOREIGN KEY (`trans_tour_id`) REFERENCES `ws_tour` (`tour_id`),
  ADD CONSTRAINT `ws_transaction_tour_ibfk_4` FOREIGN KEY (`trans_user_id`) REFERENCES `ws_user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
