
--Source: W12Sample-PHPHPB, modified by Minh Hoang Tran
-- Database: `assignment2` and php web application user
CREATE DATABASE assignment2;
GRANT USAGE ON *.* TO 'appuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON assignment2.* TO 'appuser'@'localhost';
FLUSH PRIVILEGES;

USE assignment2;
--
-- Table structure for table `entities`
--

CREATE TABLE IF NOT EXISTS `entities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` int(10) NOT NULL,
  `photoName` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `entities`
--

INSERT INTO `entities` (`id`, `name`, `address`, `salary`,`photoName`) VALUES
(1, 'Roland Mendel', 'C/ Araquil, 67, Madrid', 5000,'a.jpg'),
(2, 'Victoria Ashworth', '35 King George, London', 6500,'b.jpg'),
(3, 'Martin Blank', '25, Rue Lauriston, Paris', 8000,'c.jpg');

