-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2014 at 06:15 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `frobi-online-examination`
--
CREATE DATABASE IF NOT EXISTS `frobi-online-examination` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `frobi-online-examination`;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `ans` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`,`qid`),
  KEY `userid_2` (`userid`),
  KEY `qid` (`qid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `userid`, `qid`, `ans`) VALUES
(4, 1, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(1, '1402858428'),
(1, '1402858626'),
(1, '1402858990'),
(1, '1402859003'),
(1, '1402915840'),
(1, '1402915903'),
(1, '1402916307'),
(1, '1402916311'),
(1, '1402916314'),
(1, '1402916318'),
(1, '1403170006');

-- --------------------------------------------------------

--
-- Table structure for table `passages`
--

CREATE TABLE IF NOT EXISTS `passages` (
  `id` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `passage` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `qid` (`qid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passages`
--

INSERT INTO `passages` (`id`, `qid`, `passage`) VALUES
(1, 34, '<strong>Read the following text and put correct answer on the answer sheet given:<br/></strong>A vexed enemy of mankind, as people have discovered, is not science, but war, Science merely reflects the prevailing social forces. It is found that, when there is peace, science is constructive ends. The weapons which science gives us do not necessarily cause war; they make war increasingly terrible. Till now, it has brought us to the doorstep of doom. Our main problem, therefore, is not to curb science, but to stop war-to substitute law for force, and international government for anarchy in the relations of one nation with another. That is a job in which   everybody must participate, including the scientists. But the bombing of Hiroshima suddenly woke us up to the fact that we have very little time. The hour is late and our work has scarcely begun. Now we are face with an urgent question -&quot;Can education and tolerance, understanding   and creative intelligence run fast enough to keep us abreast with our mounting capacity to destroy?&quot; That is the question which we shall have to answer one way or the other in our generation. Science must help us in arriving at the answer, but the main decision lies within ourselves.');

-- --------------------------------------------------------

--
-- Table structure for table `question_sets`
--

CREATE TABLE IF NOT EXISTS `question_sets` (
  `setid` int(11) NOT NULL AUTO_INCREMENT,
  `imagesfolder` varchar(100) NOT NULL,
  PRIMARY KEY (`setid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `question_sets`
--

INSERT INTO `question_sets` (`setid`, `imagesfolder`) VALUES
(1, '1acnsj'),
(2, '2acnsj');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `setid` int(11) NOT NULL,
  `sn` int(11) NOT NULL,
  `question` mediumtext NOT NULL,
  `optiona` mediumtext NOT NULL,
  `optionb` mediumtext NOT NULL,
  `optionc` mediumtext NOT NULL,
  `optiond` mediumtext NOT NULL,
  PRIMARY KEY (`qid`),
  KEY `setid` (`setid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `setid`, `sn`, `question`, `optiona`, `optionb`, `optionc`, `optiond`) VALUES
(10, 1, 1, 'The minimum value of n(A&#8745;B) when n(&#8746;) = 120, n(A) = 90, n(B) = 55 is ', '40', '25', '55', '30'),
(11, 1, 2, 'If <img src="images/1acnsj/2x0.png" style="vertical-align:middle;"/> then value of x =', '5', '25', '32', '64'),
(12, 1, 3, 'The equation | <img src="images/1acnsj/3x0.png" style="vertical-align:middle;"/>| = 5 represents', 'a circle', 'a st. line', 'sphere', 'ellipse'),
(13, 1, 4, 'The points (a,0), (0,b) and (1,1) are collinear if<br/>', 'a+b=ab  ', 'a -  b = ab', 'b-a=ab ', 'a + b+ ab= 0  '),
(14, 1, 5, 'Which of the following words does not receive stress on the first syllable?', 'Language', 'dreadful', 'photograph ', 'cigar'),
(15, 1, 6, 'The word &#39;knight&#39; has the same initial consonant sound as in the word __________.', 'king', 'know', 'kite', 'kindle'),
(16, 1, 7, 'Which of the following is not acceptable?', ' A religious war _________ bellicose.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'A well educated person _______erudite.', 'One who eats human flesh_____ cannibal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'Fear of the number 13______ triskaidekaphobia'),
(17, 1, 8, 'Which of the following is not synonym of &#39;Boisterous&#39;.', 'Clamorous ', 'vociferous', 'noisy', 'serene'),
(18, 1, 9, 'The distance covered by a particle as a function of time is given by x = 5t3 - 12t, the acceleration of particle.', 'remain constant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'increases with time', 'decreases with time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'first increases and then decreases with<br/>                  time.'),
(19, 1, 10, 'Large number of small drops of mercury coalesce to form a single drop then energy of drop.', 'Increases&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'Decreases', 'remain constant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'may increase or decrease'),
(20, 1, 11, 'On boiling water changes into steam, under this condition the specific heat of water is', 'zero', 'one&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'infinite', 'less than one'),
(21, 1, 12, 'Amount of energy radiated by a body depends on', 'area of its surface&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'temperature of its surface', 'the nature of Its surface&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'all of above'),
(22, 1, 13, 'The element that is the best reducing agent is', 'Ca', 'Cu', 'H', 'Fe'),
(23, 1, 14, 'Ionic compounds will conduct an electric current when they are', 'Solidified', 'molted', 'Frozen', 'dehydrated'),
(24, 1, 15, 'In the nth electronic shell the number of orbital&#39;s is', 'n2', 'n', '2n', '2n2'),
(25, 1, 16, 'Which of the following is the weakest acid?', 'HF', 'HCl', 'HBr', 'HI'),
(26, 1, 17, 'The domain of the function <img src="images/1acnsj/17x0.png" style="vertical-align:middle;"/> is', '[0,2]', '[-2,2]', '[4,0]', '[2,4]'),
(27, 1, 18, 'If <img src="images/1acnsj/18x0.png" style="vertical-align:middle;"/>; <img src="images/1acnsj/18x1.png" style="vertical-align:middle;"/> and <img src="images/1acnsj/18x2.png" style="vertical-align:middle;"/>then <img src="images/1acnsj/18x3.png" style="vertical-align:middle;"/>=', '6', '5', '4', '3'),
(28, 1, 19, 'If a â‰  b â‰  c then the value of x which satisfies <img src="images/1acnsj/19x0.png" style="vertical-align:middle;"/> is ', 'x = a', 'x = c', 'x = 0', 'x =1'),
(29, 1, 20, 'If one root of the quadratic equation ax2 + bx + c = 0 is equal to the nth power of the other then<img src="images/1acnsj/20x0.png" style="vertical-align:middle;"/>equals<br/>', '0', '1', '<img src="images/1acnsj/20x1.png" style="vertical-align:middle;"/>', '<img src="images/1acnsj/20x2.png" style="vertical-align:middle;"/>'),
(30, 1, 21, 'The coefficient of x5 in the expansion of <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(1+x2)5 (1+x)4 is', '40', '30', '50', '60'),
(31, 1, 22, 'If <img src="images/1acnsj/22x0.png" style="vertical-align:middle;"/> then <img src="images/1acnsj/22x1.png" style="vertical-align:middle;"/>=', '<img src="images/1acnsj/22x2.png" style="vertical-align:middle;"/>', '<img src="images/1acnsj/22x3.png" style="vertical-align:middle;"/>', '<img src="images/1acnsj/22x4.png" style="vertical-align:middle;"/>', '<img src="images/1acnsj/22x5.png" style="vertical-align:middle;"/>'),
(32, 1, 23, 'A diver at a depth of 12 cm in water (&#181; = ) sees the sky in a cone of semi vertex angle', '<img src="images/1acnsj/23x0.png" style="vertical-align:middle;"/>', '<img src="images/1acnsj/23x1.png" style="vertical-align:middle;"/>', '<img src="images/1acnsj/23x2.png" style="vertical-align:middle;"/>', '90&#176;'),
(33, 1, 24, 'A uniform wire of resistance R W is divided into ten equal parts and all of them are connected in parallel. The equivalent resistance will be ', '0.01 R', '0.1 R', '10 R', '100R'),
(34, 1, 25, 'According to the writer, the real enemy of mankind is not science but war, Because', 'science merely invents   the weapons with<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    which war is fought  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'science during wars becomes destructive', 'the weapons that science invents<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    necessarily lead to the war', 'the weapons invent by science do not cause<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   war, though  these make it more  destructive '),
(35, 1, 26, 'War can be stopped if____.', 'science is not allowed to lead us to utter<br/>              destruction', 'we replace force and lawlessness only by<br/>    law  and international government ', 'science is restricted to be utilized only<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    during war time  ', 'weapons invented by science are not used<br/>   to launch a war'),
(36, 1, 27, 'What is wrong on Front View of the given figure?<br/><img src="images/1acnsj/27x0.png" style="vertical-align:middle;"/>', 'A horizontal hidden (dash) line', 'A horizontal solid (visible) line', 'A vertical hidden (dash) line', 'A vertical solid (visible) line'),
(37, 1, 28, 'For the given figure, which of the following view/s have missing line/s?<br/><br/><img src="images/1acnsj/28x0.png" style="vertical-align:middle;"/><img src="images/1acnsj/28x1.png" style="vertical-align:middle;"/><br/>', 'Front view only   ', 'Top view only', 'Right side view only', 'Both front and top views'),
(38, 2, 1, 'If <img src="images/2acnsj/1x0.png" style="vertical-align:middle;"/> is symmetric, then x = ', '5', '7', '3', '2'),
(39, 2, 2, 'If(3 + i) is a root of x2 + ax + b = 0, then a = ', '3', '-3', '6', '-6'),
(40, 2, 3, 'The differential coefficient of aSin-1x w.r.t <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sin -1 x is', '2aSin-1x', '<img src="images/2acnsj/3x0.png" style="vertical-align:middle;"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '<img src="images/2acnsj/3x1.png" style="vertical-align:middle;"/>   ', '<img src="images/2acnsj/3x2.png" style="vertical-align:middle;"/>'),
(42, 2, 4, '<img src="images/2acnsj/4x0.png" style="vertical-align:middle;"/> is equal to ', 'log(1+e-x)+c', '-log(1 + e-x)+c', '- log(1+e-x)+c ', 'log(1 + e-x)+c'),
(43, 2, 5, 'The value of<img src="images/2acnsj/5x0.png" style="vertical-align:middle;"/> is', '<img src="images/2acnsj/5x1.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/5x2.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/5x3.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/5x4.png" style="vertical-align:middle;"/>'),
(44, 2, 6, 'Everyone should look ahead and save____ money each for when_____ retires.', 'a little, she', 'a little , he', 'a lot of, he', 'a few, he'),
(45, 2, 7, 'The meeting was held_________.', 'On July 25th', 'in 25th July', 'on July 25', 'date of 25th July'),
(46, 2, 8, 'The institute has had a successful year _________ some major financial problems.', ' However', 'Despite of', 'Even though', 'in spite of  '),
(47, 2, 9, 'The sentence &quot;people want their lawns to be insect-free so, many of them use chemical pesticides&quot; is example of a ___ sentence.', 'compound ', 'simple', 'complex', 'mixed'),
(48, 2, 10, 'The salary of professor is higher _______secretary.', 'than a', 'than that of a ', 'than of a ', 'than those of '),
(49, 2, 11, 'A piece of plane glass is placed on a wood with letters of different colors. The letters which appear minimum raised are', 'red', 'green', 'yellow', 'violet'),
(50, 2, 12, 'In a stretched string under tension and fixed at both ends, the length and radius both are doubled , the frequency becomes.', 'double ', 'half', 'one fourth', 'one sixth'),
(51, 2, 13, 'If a wire of resistivity ris stretched to double of its length then its new resistivity will ', 'be half', 'be double', 'be four times', 'not change'),
(52, 2, 14, 'A charge particle enters in a magnetic field at an angel of 45&#176; with the magnetic field. The path of the particle wire will be', 'straight line', 'circular', 'elliptical', 'helical'),
(53, 2, 15, 'Strongest bond is ', 'C-C                    ', 'C=C&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'C &#186; C           ', 'all are equally strong'),
(54, 2, 16, 'Which of following does not cause hardness of water', 'CaC<i>l</i>2', 'MgSO4', 'CaSO4', 'FeSO4'),
(55, 2, 17, 'During smelting an additional substance is added which combines with impurities to form a fusible product which is called', 'slag', 'flux', 'gangue', 'mud'),
(56, 2, 18, 'Which one of the following is not used in the conversion of iron to steel by the open- hearth process?', 'air&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'carbon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'oxygen&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'producer gas'),
(57, 2, 19, 'Which of the following is the most powerful oxidizing agent ?', 'H2SO4 ', 'H3BO3', 'HPO3', 'H3PO4'),
(58, 2, 20, 'Separation of the substance by fractional crystallization depends upon their difference in', 'crystalline', 'solubilities', 'molality', 'densities'),
(59, 2, 21, 'In the Boolean algebra which of the following is wrong', '1+0=1', '0+l=1', '1+1=1', 'none of the above'),
(60, 2, 22, 'The coefficient of x5 in the expansion of <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(1+x2)5 (1+x)4 is', '40', '30', '50', '60'),
(61, 2, 23, 'In âˆ†ABC, if <img src="images/2acnsj/23x0.png" style="vertical-align:middle;"/> , the triangle is', 'rt. angled âˆ† ', 'isosceles âˆ†', 'Equilateral âˆ†', 'Scalene âˆ†'),
(62, 2, 24, 'The side of an equilateral triangle is &#39;a&#39; units and is increasing at the rate of k units / sec then the rate of increase of its area is;', '<img src="images/2acnsj/24x0.png" style="vertical-align:middle;"/>ak', '<img src="images/2acnsj/24x1.png" style="vertical-align:middle;"/>ak', '<img src="images/2acnsj/24x2.png" style="vertical-align:middle;"/>ak', '4ak'),
(63, 2, 25, 'The general equation of 2nd degree in x and y i.e. ax2+2hxy+ by2+2gx+2fy+c = 0 represents a pair of parallel lines if:', 'g2= ab, h2=af&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'hg2 =af 2,h2 = ab&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'hg2 = bf 2, g2 = ab&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'h2 = ab, bg2 = af2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'),
(64, 2, 26, 'The equation 9Cos2q+4Sin2q = ', 'circle                        ', ' Ellipse&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'parabola                   ', 'Hyperbola'),
(65, 2, 27, 'The direction cosines of the normal to the plane 2x-3y+6z = 7 are:', '<img src="images/2acnsj/27x0.png" style="vertical-align:middle;"/>', '2, -3, 6', '<img src="images/2acnsj/27x1.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/27x2.png" style="vertical-align:middle;"/>'),
(66, 2, 28, '<img src="images/2acnsj/28x0.png" style="vertical-align:middle;"/> is equal to', '<img src="images/2acnsj/28x1.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/28x2.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/28x3.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/28x4.png" style="vertical-align:middle;"/>'),
(67, 2, 29, 'There charges + 2q, -q and -q are kept at the vertices of a triangle of side <i>l</i> then the electric field  intensity at the centroid of the triangle is ', '<img src="images/2acnsj/29x0.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/29x1.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/29x2.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/29x3.png" style="vertical-align:middle;"/>'),
(68, 2, 30, 'The half life of a radio isotope is 5 years. The fraction of atoms decayed in this substance after 1 years will be ', '<img src="images/2acnsj/30x0.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/30x1.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/30x2.png" style="vertical-align:middle;"/>', '<img src="images/2acnsj/30x3.png" style="vertical-align:middle;"/>'),
(69, 2, 31, 'The number of unpaired electrons present in Fe in complex ion [Fe ( CN)6]4.', '8', '6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', '4', '2'),
(70, 2, 32, 'Select the correct left side view of the given figure.<br/><br/><img src="images/2acnsj/32x0.png" style="vertical-align:middle;"/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/><br/><br/><img src="images/2acnsj/32x1.png" style="vertical-align:middle;"/><br/><br/>', 'Figure A', 'Figure B', 'Figure C', 'Figure D'),
(71, 2, 33, '<br/><img src="images/2acnsj/33x0.png" style="vertical-align:middle;"/><br/><br/>Select the correct object for given set of orthographic views.<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/><br/><br/><br/><br/><img src="images/2acnsj/33x1.png" style="vertical-align:middle;"/><br/><br/><br/>', 'Figure A', 'Figure B', 'Figure C', 'Figure D');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `question_set` int(11) NOT NULL,
  `exam_start_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `question_set`, `exam_start_time`) VALUES
(1, 'test_user', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef', 1, '2014-06-19 19:01:40');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`),
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `passages`
--
ALTER TABLE `passages`
  ADD CONSTRAINT `passages_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`setid`) REFERENCES `question_sets` (`setid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
