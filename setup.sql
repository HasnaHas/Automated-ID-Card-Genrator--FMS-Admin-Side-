CREATE DATABASE FMS_idcard;

-- Table structure for table `administration_users`
CREATE TABLE `administration_users` (
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert statement for administration_users table
INSERT INTO `administration_users` (`email`, `password`) VALUES ('admin@fms.com', '98ZwvMHSUvkZ');

-- Table structure for table `student`
CREATE TABLE `student` (
  `FIRSTNAME` varchar(50) NOT NULL,
  `LASTNAME` varchar(50) NOT NULL,
  `REGNO` int(11) NOT NULL,
  `INDEXNO` varchar(20) NOT NULL,
  `GENDER` enum('MALE','FEMALE') NOT NULL,
  `BATCH` varchar(10) NOT NULL,
  `DEPARTMENT` enum('ICT','EGT','BST') NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PHONENUMBER` varchar(10) NOT NULL,
  `IMAGE` varchar(200) NOT NULL,
  `BARCODE` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `STATUS` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`REGNO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;