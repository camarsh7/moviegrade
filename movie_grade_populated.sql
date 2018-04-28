-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2018 at 07:14 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_grade`
--

-- --------------------------------------------------------

--
-- Table structure for table `actor`
--

CREATE TABLE `actor` (
  `actor_id` varchar(16) NOT NULL,
  `aname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actor`
--

INSERT INTO `actor` (`actor_id`, `aname`) VALUES
('1', 'Tom Hanks'),
('21', 'Emma Watson'),
('41', 'Angelina Jolie'),
('64', 'Dwayne Johnson'),
('91', 'Will Smith'),
('92', 'Jennifer Lawrence');

-- --------------------------------------------------------

--
-- Table structure for table `casts`
--

CREATE TABLE `casts` (
  `movie_id` varchar(16) NOT NULL,
  `actor_id` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `casts`
--

INSERT INTO `casts` (`movie_id`, `actor_id`) VALUES
('0', '41'),
('4', '92'),
('2', '1');

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `director_id` varchar(16) NOT NULL,
  `dname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`director_id`, `dname`) VALUES
('0', 'Steven Spielberg'),
('1', 'Tim Burton'),
('2', 'George Lucas'),
('3', 'Quentin Tarantino'),
('4', 'Walt Disney');

-- --------------------------------------------------------

--
-- Table structure for table `directs`
--

CREATE TABLE `directs` (
  `movie_id` varchar(16) NOT NULL,
  `director_id` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `directs`
--

INSERT INTO `directs` (`movie_id`, `director_id`) VALUES
('0', '4'),
('1', '0'),
('2', '0'),
('3', '1'),
('4', '2');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` varchar(16) NOT NULL,
  `gname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `gname`) VALUES
('0', 'Action'),
('1', 'Comedy'),
('2', 'Horror'),
('3', 'Romance'),
('4', 'Drama');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` varchar(16) NOT NULL,
  `genre_id` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `genre_id`) VALUES
('Admin', '0'),
('Admin', '2');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movie_id` varchar(16) NOT NULL,
  `title` varchar(64) NOT NULL,
  `avg_ranging` double DEFAULT NULL,
  `genre` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`movie_id`, `title`, `avg_ranging`, `genre`) VALUES
('0', 'The Little Mermaid', 0, '3'),
('1', 'Jaws', 0, '2'),
('2', 'Pulp Fiction', 0, '1'),
('3', 'Batman', 0, '0'),
('4', 'Star Wars', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `user_id` varchar(16) NOT NULL,
  `movie_id` varchar(16) NOT NULL,
  `review_rating` int(11) NOT NULL,
  `review_text` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `fname` varchar(64) DEFAULT NULL,
  `lname` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `fname`, `lname`) VALUES
('Admin', 'Admin', 'Default', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`actor_id`);

--
-- Indexes for table `casts`
--
ALTER TABLE `casts`
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `actor_id` (`actor_id`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`director_id`);

--
-- Indexes for table `directs`
--
ALTER TABLE `directs`
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `director_id` (`director_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `genre` (`genre`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `casts`
--
ALTER TABLE `casts`
  ADD CONSTRAINT `casts_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`),
  ADD CONSTRAINT `casts_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`actor_id`);

--
-- Constraints for table `directs`
--
ALTER TABLE `directs`
  ADD CONSTRAINT `directs_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`),
  ADD CONSTRAINT `directs_ibfk_2` FOREIGN KEY (`director_id`) REFERENCES `director` (`director_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`);

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`genre`) REFERENCES `genre` (`genre_id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
