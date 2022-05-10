-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2021 at 10:44 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `history`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(50) NOT NULL,
  `address_one` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zip_code` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address_one`, `city`, `country`, `zip_code`, `user_email`) VALUES
(47, 'Box 567', 'SWANSEA', 'Malawi', 'SA1 2DN                            ', 'gibson.dzimbiri@gmail.com'),
(51, 'Here is th eaddress', 'SWANSEA', 'West Glamorgan', 'SA1 2DN', 'john@aol.com'),
(52, 'Here is th eaddress', 'SWANSEA', 'West Glamorgan', 'SA1 2DN', 'john@aol.com'),
(53, 'Here is th eaddress', 'SWANSEA', 'West Glamorgan', 'SA1 2DN', 'john@aol.com'),
(54, 'Here is th eaddress', 'SWANSEA', 'West Glamorgan', 'SA1 2DN', 'john@aol.com'),
(55, 'Here is th eaddress', 'SWANSEA', 'West Glamorgan', 'SA1 2DN', 'john@aol.com'),
(56, 'Here is th eaddress', 'SWANSEA', 'West Glamorgan', 'SA1 2DN   ', 'john@aol.com'),
(58, 'Malawi Institute of Education\r\nP.O. Box 50 Domasi', 'Zomba', 'N/A', '265', 'admin@localhost.local'),
(59, 'Malawi Institute of Education\r\nP.O. Box 50 Domasi', 'Zomba', 'N/A', '265', 'admin@localhost.local'),
(60, 'Malawi Institute of Education\r\nP.O. Box 50 Domasi', 'Zomba', 'N/A', '265', 'admin@localhost.local'),
(64, 'Flat 41\r\nBlock A St. Davids\r\nNew Cut Road', 'SWANSEA', 'United Kingdom', 'SA1 2DN', 'gibsonmbiri@gmail.com'),
(65, 'Flat 41\r\nBlock A St. Davids\r\nNew Cut Road', 'SWANSEA', 'United Kingdom', 'SA1 2DN        ', 'gibsonmbiri@gmail.com'),
(72, 'Malawi Institute of Education\r\nHouse#: S/20', 'Zomba', 'Malawi', '435', 'kata@ffff.com'),
(75, 'Malawi Institute of Education\r\nHouse#: S/20', 'Zomba', 'Malawi', '435', 'sulani@eth.com'),
(77, 'Flat 41\r\nBlock A St. Davids\r\nNew Cut Road', 'SWANSEA', 'Tuvalu', 'SA1 2DN', 'diolos@hom.com'),
(78, 'Flat 41\r\nBlock A St. Davids\r\nNew Cut Road', 'SWANSEA', 'United Kingdom', 'SA1 2DN  ', 'grame@sd.jk'),
(79, 'Malawi Institute of Education\r\nHouse#: S/20', 'Zomba', 'Malawi', '435', 'hfhf@gmg.com'),
(80, 'Malawi Institute of Education\r\nHouse#: S/20', 'Zomba', 'Malawi', '435', 'getrude@gmail.com'),
(81, 'Malawi Institute of Education\r\nHouse#: S/20\r\nDomas', 'Zomba', 'Malawi', '265', 'hfhf@gmg.com');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` longtext NOT NULL,
  `content` longtext NOT NULL,
  `country` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `modifiedDate` datetime DEFAULT NULL,
  `status` enum('pending','approved','featured') NOT NULL DEFAULT 'pending',
  `feature` enum('featured','none') NOT NULL DEFAULT 'none',
  `caption` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `visits` int(100) NOT NULL,
  `category` enum('Software','Hardware','Internet','Course','Smartphone','Web','Other','Programming','Phone') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `country`, `image`, `date`, `modifiedDate`, `status`, `feature`, `caption`, `author`, `visits`, `category`) VALUES
(30, 'Computing 1993 to 1996', '<p>The researcher conducted interviews with former university and college students. The oldest university university in the country is university of Malawi and it is the same university which was the first to use computers and software in the country. Therefore students and lecturers from various constituent colleges under the umbrella of university Malawi possess rich knowledge on the development of computing. The first interview was conducted at Malawi institutite of education with one of the curriculum specialist in languges who was a former student with Univerity of Malawi at Chancellor collge from 1993 to 1996. He testified that by then the university had computers but in terms of access they were not allowed do so. In his narration he said &ldquo;In 1993, during my time at Chancellor College which was the constituent college of the University of Malawi we only had acces to computer through the departmental secretary. You could be given a particular period to type your document. For those who did not know to type they paid the secretary to do the typing for them&rdquo;, Mr Gama, 2021, personal interview. In general the college had computers but ordinary students were not llowed to use them because they were only used by the computer science students. His ordeal concurs with another respondent who was a former student in the Education science department from 1989 to 1993. He said that students from other courses except the computer science course were not allowed to use the computer laboratory. They were to submit their assignment hand written.</p>\r\n', 'Malawi', 'Weit Wetzlar Projector1.jpg', '2021-06-27 23:00:00', '2021-10-01 12:05:46', 'approved', 'featured', '', 'gibson.dzimbiri@gmail.com', 123, 'Hardware'),
(33, 'Malawi Institute of Education', '<p>Malawi Institute of Education (MIE) is a parastatal institution under the comptroller of statutory corporations. It is a National Curriculum Development Center mandated to design, develop, monitor, and evaluate the national school and primary teacher education curricula and provide continuing professional development to education personnel to ensure that education provided responds to society&#39;s current and future needs. Furthermore, the Institute is mandated to publish and evaluate curriculum materials for schools in the country.</p>\n\n<p>The use of computing at MIE began around 1988 when the institution was using golf typewriters. These devices were used for typing teaching and learning materials for the primary, secondary and teacher training college curriculum. In 1991 the institute started to use one-line screenwriters for the same job.<br />\nBetween 1994 and 1995, there was a tremendous shift when MIE got a donation of Macintosh computers from the Canadian International Development Agency (CIDA). The Macintosh computers were installed with a word processor, adobe Photoshop and PageMaker, the powerful tools designed to produce electronic textbooks ready for printing. The mentioned pieces of software were the primary applications used by typesetters to type, design and generate the final blueprint of a textbook ready for printing.&nbsp;</p>\n\n<p>MIE has played a vital role in developing the curriculum for computer studies for secondary schools. Since computer studies was introduced in schools in 2005, it is surprising that the institution has never recruited an ICT curriculum specialist. Similarly, the institution does not have a website for its online presence. &nbsp;<br />\n&nbsp;</p>\n', 'Malawi', 'IMG_20210601_111502_7.jpg', '2021-06-27 23:00:00', '2021-10-05 09:28:20', 'approved', 'none', '', 'gibson.dzimbiri@gmail.com', 11, 'Other'),
(34, 'The dawn of the Internet in the Education System in Malawi', '<p>Since Malawi&#39;s return to multi-party democracy in May 1994 there have been major changes in broadcasting, telecommunications and value added services such as internet and emil ervices. For instance, in 1994 internet and e-mail services were almost non-existent, there was no cellphone operator, there was one government radio station (MBC) and a Christian frequency modulation (FM) station (Cammack, 1998).</p>\r\n\r\n<p>The preparation for the introduction&nbsp; of the Internet in Malawi&nbsp; starts way way back in 1996 when Dr Paulos Nyirenda and Professor Joseph Uta conducted a visibility study in the same year for the introduction of Internet services in Malawi. The study followed Dr Nyirenda&rsquo;s&nbsp; research in the physics department while working as a lecturer a Chancellor College, University Malawi.&nbsp; Dr Paulos Nyirenda graduated from the University of Malawi in 1979, and he joined the physics department as a staff associate in the same year.&nbsp;</p>\r\n\r\n<p>Under that arrangement Nyirenda started a project called E-net. The Fidonet was an implementation of E-net for email services. Under UNIMA E-net they looked for a platform where they could start email services in Malawi and Fidonet was the best which they could use. Fidonet was the largest email network in the world. You should also note that there was no internet for the web around that time in Malawi.</p>\r\n\r\n<p>There was a very wide Fidonet Internet connection, in that they installed Fidonet email system in government hospitals in all districts in Malawi. It was the largest email system in Malawi at that time and it was the first in the country. UNIMA was the first email hub in Malawi within the physics department.</p>\r\n\r\n<p>Based on that project, the United Nations Development Programme (UNDP) put out a consultancy request publication, Dr Nyirenda and Professor Uta applied for that consultancy.&nbsp; Joseph Uta who at that time was a librarian was on the social side of the network while Nyirenda&rsquo;s investigation was on the scientific part. As you know the beginning of the Internet has the social aspect as well as network aspect.</p>\r\n\r\n<p>In 1996 the report was submitted to UNDP and was approved. They started the project in 1998. It was also the time when the Malawi Communications Act was passed. The act created Malawi Communications Regulatory Authority (MACRA). Around 1998 the first Internet Service Provider (ISP) in Malawi was Malawi Net and it was later followed by SDNP as the second ISP. All these events took place around 1998.</p>\r\n\r\n<p>Before the Internet came to Malawi SDNP as a project migrated from Fidonet to Unix to Unix Copy Program (UUCP). Fidonet was a store and forward email system, where you could type in your email, store it submit it through your modem. Those days they were using 9.6 kbps modem to submit the email to the server and the server forwards it to the next server and so forth. It was all running in the old Microsoft DOS Operating system before windows 3.1 came.</p>\r\n\r\n<p>When SDNP was established around 1998 they installed UNIX operating system, and it was Red Hat Linux. Using that they could then send international emails directly to New York. SDNP had a hub in Blantyre at the Polytechnic which was also a constituent college of the University of Malawi and the Uplink was at UNDP headquarters in New York. They could send UUCP packets to distribute mail around the world using UUCP. UUCP was a major improvement over Fidonet in terms of reliability and security. When SDNP experienced UUCP for a year after the Communications act and when they gave the company an Internet licence they could have an Internet connection between SDNP Malawi and New York. At that time the service provider was UUNET. That is how it all started.</p>\r\n\r\n<p>&#39;</p>\r\n', 'Malawi', 'tower.jpeg', '2021-06-28 23:00:00', '2021-09-17 00:00:00', 'approved', 'featured', '', 'gibson.dzimbiri@gmail.com', 90, 'Internet'),
(37, 'Development of the Internet in Zambia', '<p>In Zambia the very first development of the Internet started in 1991 when the university of Zambia (UNZA) received a microcomputer and modem to provide the &quot;host&quot; of the first University email system from the International Development Research Centre (IDRC)-funded ESANET project (Mambwe, 2015). The first recorded message through this system was sent to the Baobab, an African interests network based in Washington, D.C. in the United States, on 30 September 1991. Eventaully according to Mambwe Zambia became the fifth country in Africa, the first in the entire Sub-Saharan Africa, aside from South Africa, to have full access to the Internet on 22 November 1994.</p>\n', 'Zambia', 'zambina-internet.png', '2021-07-05 23:00:00', '2021-10-05 10:39:06', 'approved', 'none', '', 'gibson.dzimbiri@gmail.com', 40, 'Internet'),
(38, 'Information and Communication Technology Course at Mzuzu University', '<p>Mzuzu University is the second public university with one campus. The university s situated in the northern part of Malawi in the northern city Mzuzu. The university was established in 1997 by an act of parliament (Mzuzu University Central Registry Records). Since 1997 the university has so far produced over 17000 graduate and it has a community of 18000 alumni.</p>\n\n<p><img alt=\"\" src=\"blob:http://localhost/8665b503-2a83-4350-86c6-0eae23588151\" style=\"width:308px\" />In the case of ICT courses at Mzuzu University we interviewed one of the former employee of MZUZU University who was part of the team that developed the curriculum of Bachelors Degree in Information and Communication Technology. In his statement he mentioned that the ICT course was development and introduced in March 2005 and the first students were recruited in July the same, Seyani Nayeja, zoom personal interview 12 July, 2021 9:00 AM. The main aim of introducing the course was to meet the shortage of IT experts in the country. The ICT course at Mzuzu University was different from other ICT courses at Chancellor College and the polytechnic because it included other aspects which were not there in other courses. Such aspects include entrepreneurship and managerial skills in IT. The courses at the two colleges were more into technical and could not address the issue of information technology for management.</p>\n', 'Malawi', '133476_120815094943_9FM32U3.jpg', '2021-07-14 23:00:00', '2021-10-06 16:17:22', 'approved', 'featured', '', 'gibson.dzimbiri@gmail.com', 19, 'Course'),
(39, 'People behind computer science, University of Malawi', '<p>Everyting has a source when it comes to developing it. There people who have the love and the zeal to help others by bringing something new which never existed. Here we are talking abot the man who decided to come change Malawi to produce its own graduates in the area of computer science.</p>\r\n<p>Have you ever thought of anyone in your mind as to the person who introduced the course. If never thought about this, here is the story.</p>\r\n<p>The computer science course started in 197.. to meet the needs of information technology experts in the country. Garrth MacFarren is the man behind this development. He is originally from Canada but now is based in Norway.</p>\r\n<p>He came to Malawi in 19...&nbsp;</p>', 'Zambia', 'computer-hope.jpg', '2021-07-24 23:00:00', '2021-07-28 00:00:00', 'pending', 'none', '', 'gibson.dzimbiri@gmail.com', 3, 'Hardware'),
(43, 'The birth of Computer Science at Chancelllor College, Univerity of Malawi', '<p>Computing in the University of Malawi started in the mathematics department at Chancellor College around the late 1970s. Chancellor College was the main college of all the constituent colleges under the University of Malawi before they were disbanded into separate universities in 2021. The university office was also situated in Zomba, where Chancellor College is based, currently named the University of Malawi.</p>\n\n<p>Glen Farley founded the computer science course in 1981. He is a Canadian information technology professional, project manager and artist. Farley was a lecturer at the University of Malawi, Chancellor College from 1981-1983. He set up the first Computer Science Programme under the Mathematics Department led by the late Paddy Ewer, designed and taught courses to second, third and fourth-year students and acquired the first computer equipment and facilities. (Farley, 2021)</p>\n\n<p><img alt=\"\" src=\"/history/uploads/farley.jpg\" style=\"height:360px; width:600px\" /></p>\n\n<p><span style=\"font-size:11px\">Glen Farley with computer science staff at Chancellor College (Image source: Farley)</span></p>\n\n<p>The objective for introducing the course was to train computer experts to help the computing needs of the country. However, before the course was introduced, the mathematics department initially offered a programming course in Basic Programming language and statistical analysis using computers. The modules&#39; purpose was to help produce graduates to work at the National statistical office (Nyirenda, 2021). &nbsp;Later the computer science department was established under the faculty of sciences. It was a generalist program by then, and students did not have any specific area in which they could major.</p>\n\n<p><img alt=\"\" src=\"/history/uploads/Farley%20Scholarsh%20(5).png\" style=\"height:188px; width:600px\" /></p>\n\n<p style=\"text-align:justify\"><span style=\"font-size:12px\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#44546a\"><span style=\"color:black\">First computer room at Chancellor College 1982&nbsp;(Image source: <a href=\"https://glenfarley.com/scholarship/#main\">Farley</a>)</span></span></span></span></p>\n\n<p>The first-year students were admitted into general science courses where they studied science modules such as mathematics, physics, chemistry and biology. Those who wanted to take the route of computer science started to study it in the second year after scoring an average score of 63% in their first year at college (Kanjo, 2021). The students came from the general mathematics programme in the first year (the second year) of the computer course. It was an introduction to many things in computing, such as computing as a profession, introduction to programming (Basic, FORTRAN, Pascal and COBOL programming languages) and introduction to database design. The second year was the third year for students, and they studied more specialised courses such as project management of computing projects and advanced courses in system design and programming(Farley, 2021). Farley adds that in the third year, he had twenty students; some of the students had dropped out.&nbsp;</p>\n\n<p><br />\nIn the early 1980s, students used TRS-80 computers (Figure 4.3) in their computer science-related projects. Initially, they were ten of them, and later the university acquired ICL computers with 286 Operating System (OS). The TRS-80s were ordinary terminals connected to the main computer somewhere in the computer laboratory.&nbsp;<br />\n&nbsp;</p>\n', 'Malawi', '133476_120815094943_9FM32U3.jpg', '2021-08-16 23:00:00', '2021-10-06 09:48:36', 'approved', 'featured', '', 'gibson.dzimbiri@gmail.com', 95, 'Course'),
(45, 'A History of Apple Computers', '<p style=\"margin-left:.625rem; margin-right:.625rem\">Before it became one of the wealthiest companies in the world, Apple Inc. was a tiny start-up in Los Altos, California. Co-founders&nbsp;<a href=\"https://www.thoughtco.com/steve-jobs-biography-1991928\" style=\"box-sizing: inherit; margin: 0px -1px; padding: 0px 1px; vertical-align: baseline; background: linear-gradient(to right, #dcd8a0 100%, #ffffff 0px) 0px 80% / 100% 23% repeat-x; color: #282828; text-decoration-line: none; outline: 0px; transition: none 0s ease 0s; box-shadow: none;\">Steve Jobs</a>&nbsp;and&nbsp;<a href=\"https://www.thoughtco.com/steve-wozniak-biography-1991136\" style=\"box-sizing: inherit; margin: 0px -1px; padding: 0px 1px; vertical-align: baseline; background: linear-gradient(to right, #dcd8a0 100%, #ffffff 0px) 0px 80% / 100% 23% repeat-x; color: #282828; text-decoration-line: none; outline: 0px; transition: none 0s ease 0s; box-shadow: none;\">Steve Wozniak</a>, both college dropouts, wanted to develop the world&#39;s first user-friendly personal computer. Their work ended up revolutionizing the computer industry and changing the face of consumer technology. Along with tech giants like Microsoft and IBM, Apple helped make computers part of everyday life, ushering in the Digital Revolution and the Information Age.</p>\n\n<div class=\"comp mntl-block mntl-sc-block mntl-sc-block-adslot\" id=\"mntl-sc-block_1-0-1\" style=\"background:0px 0px #ffffff; border:0px; box-sizing:inherit; color:#282828; font-family:Georgia,Times,\'Times New Roman\',serif; font-size:17px; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; padding:0px; vertical-align:baseline\">\n<div class=\"comp mntl-block\" id=\"mntl-block_5-0\" style=\"background:0px 0px; border:0px; box-sizing:inherit; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; padding:0px; vertical-align:baseline\">\n<div class=\"comp mntl-sc-sticky-billboard ref-billboard1-sticky-dynamic right-rail__item scads-ad-placed scads-stick-in-parent scads-to-load\" id=\"ref-billboard1-sticky-dynamic_1-0\" style=\"background:0px 0px; border:0px; box-sizing:inherit; height:1050px; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; padding:0px; position:absolute; right:-320px; top:141px; vertical-align:baseline; width:300px\">\n<div class=\"billboard comp dynamic gpt js-immediate-ad mntl-billboard mntl-dynamic-billboard mntl-gpt-adunit mntl-gpt-dynamic-adunit mntl-sc-sticky-billboard-ad\" id=\"mntl-sc-sticky-billboard-ad_1-0\" style=\"background:0px 0px; border:0px; box-sizing:inherit; clear:both; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; max-width:none; min-height:calc(310px); min-width:300px; padding:0px; text-align:center; transform:translateY(740px); vertical-align:baseline\">\n<div class=\"wrapper\" id=\"billboard\" style=\"-webkit-box-align:center; -webkit-box-direction:normal; -webkit-box-orient:vertical; -webkit-box-pack:center; align-items:center; background:0px 0px; border:0px; box-sizing:inherit; display:flex; flex-direction:column; justify-content:center; margin-bottom:0; margin-left:auto; margin-right:auto; margin-top:0; min-height:calc(250px + 1.75rem); padding:0px; vertical-align:baseline; width:300px\">\n<div id=\"google_ads_iframe_/479/thoughtco/tho_inventions/billboard_0__container__\" style=\"background:0px 0px; border:0pt none; box-sizing:inherit; display:inline-block; height:250px; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; padding:0px; vertical-align:baseline; width:300px\"><iframe frameborder=\"0\" height=\"250\" id=\"google_ads_iframe_/479/thoughtco/tho_inventions/billboard_0\" name=\"\" scrolling=\"no\" src=\"https://dff1fa9eeb5157be917dd068d8b9a08e.safeframe.googlesyndication.com/safeframe/1-0-38/html/container.html\" style=\"box-sizing: inherit; margin: 0px auto; padding: 0px; border-width: 0px; border-style: initial; vertical-align: bottom; background: 0px 0px;\" title=\"3rd party ad content\" width=\"300\"></iframe></div>\n</div>\n</div>\n</div>\n</div>\n</div>\n\n<h2 style=\"margin-left:0; margin-right:0\">The Early Years</h2>\n\n<p style=\"margin-left:.625rem; margin-right:.625rem\">Apple Inc. &mdash; originally known as Apple Computers &mdash; began in 1976. Founders Steve Jobs and Steve Wozniak worked out of Jobs&#39; garage at his home in Los Altos, California. On April 1, 1976, they debuted the Apple 1, a desktop computer that came as a single motherboard, pre-assembled, unlike other personal computers of that era.</p>\n\n<div class=\"comp mntl-block mntl-sc-block mntl-sc-block-adslot\" id=\"mntl-sc-block_1-0-4\" style=\"background:0px 0px #ffffff; border:0px; box-sizing:inherit; color:#282828; font-family:Georgia,Times,\'Times New Roman\',serif; font-size:17px; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; padding:0px; vertical-align:baseline\">\n<div class=\"comp mntl-block\" id=\"mntl-block_6-0\" style=\"background:0px 0px; border:0px; box-sizing:inherit; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; padding:0px; vertical-align:baseline\">\n<div class=\"comp mntl-sc-sticky-billboard ref-billboard2-sticky-dynamic right-rail__item scads-ad-placed scads-stick-in-parent scads-to-load\" id=\"ref-billboard2-sticky-dynamic_1-0\" style=\"background:0px 0px; border:0px; box-sizing:inherit; height:600px; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; padding:0px; position:absolute; right:-320px; top:1291px; vertical-align:baseline; width:300px\">\n<div class=\"billboard comp dynamic gpt js-immediate-ad mntl-billboard mntl-dynamic-billboard mntl-gpt-adunit mntl-gpt-dynamic-adunit mntl-sc-sticky-billboard-ad\" id=\"mntl-sc-sticky-billboard-ad_3-0\" style=\"background:0px 0px; border:0px; box-sizing:inherit; clear:both; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; max-width:none; min-height:calc(310px); min-width:300px; padding:0px; position:sticky; text-align:center; top:85px; vertical-align:baseline\">\n<div class=\"wrapper\" id=\"billboard2\" style=\"-webkit-box-align:center; -webkit-box-direction:normal; -webkit-box-orient:vertical; -webkit-box-pack:center; align-items:center; background:0px 0px; border:0px; box-sizing:inherit; display:flex; flex-direction:column; justify-content:center; margin-bottom:0; margin-left:auto; margin-right:auto; margin-top:0; min-height:calc(250px + 1.75rem); padding:0px; vertical-align:baseline; width:300px\">\n<div id=\"google_ads_iframe_/479/thoughtco/tho_inventions/billboard2_0__container__\" style=\"background:0px 0px; border:0pt none; box-sizing:inherit; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; padding:0px; vertical-align:baseline\"><iframe frameborder=\"0\" height=\"250\" id=\"google_ads_iframe_/479/thoughtco/tho_inventions/billboard2_0\" name=\"google_ads_iframe_/479/thoughtco/tho_inventions/billboard2_0\" scrolling=\"no\" style=\"box-sizing: inherit; margin: 0px auto; padding: 0px; border-width: 0px; border-style: initial; vertical-align: bottom; background: 0px 0px;\" title=\"3rd party ad content\" width=\"300\"></iframe></div>\n</div>\n</div>\n</div>\n</div>\n</div>\n\n<p style=\"margin-left:.625rem; margin-right:.625rem\">The Apple II was introduced about a year later. The upgraded machine included an integrated keyboard and case, along with expansion slots for attaching floppy disk drives and other components. The Apple III was released in 1980, one year before IBM released the IBM Personal Computer. Technical failures and other problems with the machine resulted in recalls and damage to Apple&#39;s reputation.</p>\n\n<div class=\"comp mntl-block mntl-sc-block mntl-sc-block-adslot\" id=\"mntl-sc-block_1-0-6\" style=\"background:0px 0px #ffffff; border:0px; box-sizing:inherit; color:#282828; font-family:Georgia,Times,\'Times New Roman\',serif; font-size:17px; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; padding:0px; vertical-align:baseline\">\n<div class=\"comp mntl-block\" id=\"mntl-block_7-0\" style=\"background:0px 0px; border:0px; box-sizing:inherit; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; padding:0px; vertical-align:baseline\">\n<div class=\"comp mntl-native\" id=\"mntl-native_2-0\" style=\"--native-ad-height:auto; background:0px 0px; border:0px; box-sizing:inherit; height:var(--native-ad-height); margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; padding:0px; vertical-align:baseline; width:648px\">\n<div class=\"comp dynamic gpt js-immediate-ad mntl-gpt-adunit mntl-gpt-dynamic-adunit mntl-native__adunit native scads-ad-placed scads-to-load\" id=\"mntl-native__adunit_2-0\" style=\"background:0px 0px; border:0px; box-sizing:inherit; margin-bottom:0; margin-left:0; margin-right:0; margin-top:0; max-width:none; padding:0px; text-align:center; vertical-align:baseline\">&nbsp;</div>\n</div>\n</div>\n</div>\n\n<p>&nbsp;</p>\n\n<p style=\"margin-left:.625rem; margin-right:.625rem\">The first home computer with a GUI, or graphical user interface &mdash; an interface that allows users to interact with visual icons &mdash; was the Apple Lisa. The very first graphical interface was developed by the Xerox Corporation at its Palo Alto Research Center (PARC) in the 1970s. Steve Jobs visited PARC in 1979 (after buying Xerox stock) and was impressed and highly influenced by the Xerox Alto, the first computer to feature a GUI. This machine, though, was quite large. Jobs adapted the technology for the Apple Lisa, a computer small enough to fit on a desktop.</p>\n', 'Other', 'babbage.jpg', '2021-08-16 23:00:00', '2021-10-12 16:10:32', 'approved', 'none', '', 'gibson.dzimbiri@gmail.com', 0, 'Hardware'),
(47, 'Development of the Internet in Malawi', '<p>Malawi&#39;s return to multi-party democracy in May 1994 brought&nbsp; major changes in broadcasting, telecommunications and value added services such as internet and email services. For instance, in 1994 internet and e-mail services were almost non-existent, there was no cellphone operator, there was one government radio station, Malawi Broadcast Coorporation (MBC) and a Christian frequency modulation (FM) station (Cammack, 1998).</p>\n\n<p>The preparation for the introduction of the Internet in Malawi started in 1996 when Dr Paulos Nyirenda and Professor Joseph Uta conducted a visibility study in the same year for the introduction of Internet services in Malawi. The study followed Dr Nyirenda&rsquo;s research in the physics department while working as a lecturer at Chancellor College, University of&nbsp; Malawi.&nbsp; Dr Paulos Nyirenda graduated from the University of Malawi in 1979, and he joined the physics department as a staff associate in the same year.&nbsp;</p>\n\n<p>Under that arrangement Nyirenda implemented a project called E-net. The Fidonet was an implementation of E-net for email services. Under UNIMA E-net, they looked for a platform where they could start email services in Malawi, and Fidonet was the best which they could use. Fidonet was the largest email network in the world in the early 1980s to early 1990s. You should also note that there was web surfing using the internet around that time in Malawi.</p>\n\n<p>There was a very wide Fidonet Internet connection, in that they installed Fidonet email system in government hospitals in all districts in Malawi. It was the largest email system in Malawi at that time and it was the first in the country. UNIMA was the first email hub in Malawi within the physics department.</p>\n\n<p>Based on that project, the United Nations Development Programme (UNDP) put out a consultancy request publication, in which Dr Nyirenda and Professor Uta applied for that consultancy.&nbsp; Joseph Uta who at that time was a librarian was on the social side of the network while Nyirenda&rsquo;s investigation was on the scientific part. As you know the beginning of the Internet has the social aspect as well as network aspect.</p>\n\n<p>In 1996 the report was submitted to UNDP and was approved. They started the project in 1998. It was also the time when the Malawi Communications Act was passed. The act created Malawi Communications Regulatory Authority (MACRA). Around 1998 the first Internet Service Provider (ISP) in Malawi was Malawi Net and it was later followed by SDNP as the second ISP. All these events took place around 1998.</p>\n\n<p>Before the Internet came to Malawi SDNP as a project migrated from Fidonet to Unix to Unix Copy Program (UUCP). Fidonet was a store and forward email system, where you could type in your email, store it submit it through your modem. Those days they were using 9.6 kbps modem to submit the email to the server and the server forwards it to the next server and so forth. It was all running in the old Microsoft DOS Operating system before windows 3.1 came.</p>\n\n<p>When SDNP was established around 1998 they installed UNIX operating system, and it was Red Hat Linux. Using that they could then send international emails directly to New York. SDNP had a hub in Blantyre at the Polytechnic which was also a constituent college of the University of Malawi and the Uplink was at UNDP headquarters in New York. They could send UUCP packets to distribute mail around the world using UUCP. UUCP was a major improvement over Fidonet in terms of reliability and security. When SDNP experienced UUCP for a year after the Communications act and when they gave the company an Internet licence they could have an Internet connection between SDNP Malawi and New York. At that time the service provider was UUNET. That is how the internet came to exist in Malawi.</p>\n\n<p>Since then the use of the internet has been slowly growing. According to the Gloabal Economy (2021) the number of interet users in Malawi came clear in mid 2006&nbsp;</p>\n\n<p>&nbsp;</p>\n', 'Malawi', 'african_man_smartphone_600.jpg', '2021-09-12 23:00:00', '2021-10-07 15:34:26', 'approved', 'featured', '', 'gibson.dzimbiri@gmail.com', 124, 'Internet'),
(48, 'Brief History of the Internet in South Africa ', '<p>The emergence and development of the Internet in Africa had not been smooth due to&nbsp; strong political resistance.&nbsp; According to Terry (2021) in the 1990s the use of the Internet was very limited in South Africa to start with for political reasons. The ability to get into international networks was very limited. Rhodes University was one of the leaders in the game, but they had to send messages through a certain gateway in the USA using Fidonet which was hooked to another modem that linked the international network. &ldquo;The email link used the Fidonet mailing system as a transport mechanism to exchange email between the Control Data Cyber computer at Rhodes University and a Fidonet gateway run by Randy Bush of Portland, Oregon, in the USA. The Fidonet system in the USA had a gateway into the Internet, and to many people&#39;s amazement, including the group at Rhodes, the system worked and stayed working&rdquo; (Lawrie, 1997). Terry continues to say that in the meantime, the South African political landscape was changing tremendously, which helped to put efforts to have the international network. In 1991 the university connected to the Internet proper, and the TCP/IP network became firmly established. It was also the time when Nelson Mandela was released from prison, and it made South Africa accessible to the world again.&nbsp;</p>\n\n<p><strong>In 1988</strong>,</p>\n\n<p>There are three incredible individuals named Francois Guilarmod, Mike Lawrie, and Dave Wilson, who established an internet link using email. The purpose was to exchange an email between the Control Data Cyber computer at the university and what was called Fidonet gateway in Portland, Oregon. For further clarification, Fidonet is a computer network that is used for communicating between bulletin board systems. The 1990&rsquo;s Though it was just one email at that moment in time, it was the stepping stone that launched a rapid wave for the internet to begin growing and thriving in South Africa. Just one short year later, a dial-up internet system was implemented, which gave even more access and opportunities.</p>\n\n<p><strong>Then, fast forwarding to 199</strong>1, South Africa had a full internet connection that operated over a leased line. Even as great as this was, most of this internet development occurred within academic institutions, and it was not until a bit later that it was pushed to the broader commercial world. Once the public, small business owners and corporate leaders saw what the internet was capable of, the race was on. South Africa&#39;s first commercial ISP (Internet Service Provider) was The Internetworking Company, which was established in November of 1993. Nearly a dozen commercial companies had access to the internet within the first month and began widening internet availability throughout the nation. One of these early customers was TIS (The Internet Solution), which was an internet provider that commercialized and broadened South Africa&#39;s access to the internet. Heading into the year 1997, 56kpbs dial-up connections began to become more present, and products like MWEB&#39;s Big Black Box brought on many new subscribers.</p>\n\n<p>&nbsp;</p>\n', 'South Africa', 'south-africas-internet-history.jpg', '2021-09-12 23:00:00', '2021-10-06 08:16:13', 'approved', 'none', '', 'gibson.dzimbiri@gmail.com', 13, 'Internet'),
(49, 'Software development', '<p>The Internet of Things (IoT) is a grid of things (objects/sensors) that contain embedded software to communicate and interact with their internal states or the external environment. These IoT Sensors have ability to collect and transfer data over a network without manual intervention. The connecting of assets, processes and personnel enables individuals/ enterprises in learning the behavior and usage, achieve predictive analytics and re-engineer business processes. The IoT is a foundational capability for the creation of a digital business.</p>\r\n', 'Malawi', '1004.jpg', '2021-09-13 23:00:00', NULL, 'pending', 'none', '', 'gibson.dzimbiri@gmail.com', 0, 'Software'),
(51, 'Development of computing schools', '<p>The emergence of digital computers spread in schools around 2005 when the school curriculum introduced computing as a subject. Malawi has a national policy for ICT, which emphasizes the introduction of computer lessons in education at primary and secondary levels. In response to this, 16 years ago, the Government of Malawi introduced Computer Studies as an optional subject at the senior secondary level. The rationale for this decision was that computer literacy was becoming essential in everyday life and as such Malawian secondary school students needed to have the skills to use computers so that they could be of benefit in the present social, economic environment in terms of self-employment, entrepreneurship and further education. The computer studies subject was only available in senior secondary classes (form 3 and 4).</p>\n\n<p>The introduction of computer studies came with its associated challenges. The first challenge was the lack of computer studies teachers in schools to teach the subject because at that time, there was no single qualified teacher explicitly trained to teach the subject. It was and is taught by teachers from mathematics and other science subjects, and primarily those interested in computing. These teachers occasionally struggle to understand and analyse certain content concepts from the textbooks to deliver lessons professionally.&nbsp;</p>\n\n<p>You must also note that the secondary school computer studies textbooks are written by local authors who are not professionals in computing in general and computing education. Nansalagwa, one of the authors whose textbooks have been reviewed and approved by the Ministry of Education and Malawi Institute of Education, said that it was not easy to write computer studies books because we are not professionals in the area. Most of the textbooks&rsquo; content was referenced from other resources from abroad, for instance, European Computer Driving Licence, Log on Computer studies from Kenya, and the Internet. Therefore it was not an easy job to translate the content to suit the Malawian curriculum.<br />\n&nbsp;</p>\n', 'Malawi', 'senior.png', '2021-10-04 12:56:44', '2021-10-11 16:30:50', 'approved', 'none', '', 'gibson.dzimbiri@gmail.com', 0, 'Course');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(50) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `contentcategory`
--

CREATE TABLE `contentcategory` (
  `id` int(50) NOT NULL,
  `contentID` int(50) DEFAULT NULL,
  `categoryID` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `id` int(50) NOT NULL,
  `counter` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id`, `counter`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `email_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`email_id`, `email`) VALUES
(1, 'jaydeepnashit@gmail.com'),
(2, 'asasasa@asas.com'),
(3, 'gibson.dzimbiri@gmail.com'),
(4, 'gibso@hotmail.com'),
(5, 'gibson@gmail.com'),
(6, 'gibson.dzimbiri@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(50) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `mime` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` enum('pending','approved','waiting','') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `file_path`, `mime`, `created_date`, `status`) VALUES
(4, 'Course', 'CS Project Manager - Feedback_.pdf', 'application/pdf', '2021-09-22 10:54:05', 'approved'),
(5, 'The internet in South Africa', 'Dale- CS Illuminated ( PDFDrive ).pdf', 'application/pdf', '2021-09-22 14:04:23', 'pending'),
(6, 'History of computing', '920768.pdf', 'application/pdf', '2021-09-22 21:43:49', 'pending'),
(7, 'The Internet in South Africa', 'cw_feedback (2).pdf', 'application/pdf', '2021-09-22 23:01:36', 'approved'),
(8, 'How was the Internet introduced in Malawi', 'request for consent.pdf', 'application/pdf', '2021-09-24 14:49:55', 'approved'),
(9, 'History of computing', '9207168.pdf', 'application/pdf', '2021-09-24 14:51:04', 'approved'),
(10, 'Development of ICT', 'research paper on development  ICT in Malawi.pdf', 'application/pdf', '2021-09-24 14:53:18', 'approved'),
(11, 'History of computing education in Malawi', '920768.pdf', 'application/pdf', '2021-09-27 16:01:28', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `g_user`
--

CREATE TABLE `g_user` (
  `id` int(11) NOT NULL,
  `oauth_provider` enum('google','facebook','twitter','linkedin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'google',
  `oauth_uid` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `path` text NOT NULL,
  `uploaded_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `title`, `description`, `path`, `uploaded_date`) VALUES
(4, 'Chancellor college Library', 'This is the library at Chancellor College which serves student studying various courses at the college. It is one the state of the art library which has served many students since 1975.', 'IMG_20210630_100857_7.jpg', '2021-07-01 08:58:29'),
(18, 'Computer in the 1980s', 'The is the computer room at Chancellor College. It was used by computer science students in the 1980s. The photo was taken in 1982 (Image source: Farley)', 'Farley Scholarsh (5).png', '2021-10-05 11:26:35'),
(19, 'UNIVAC 1004', 'The first computer was procured in Malawi was for the National Statistical Office and was first used to conduct a population census in 1966. This first machine was a UNIVAC 1004. By the late 1980s, around ten large machines and over one hundred microcomputers were installed in various government ministries and departments ', '1004.jpg', '2021-10-11 12:20:52'),
(20, 'Glen Farley', 'The photo show Glen Farley who founded the computer science course in 1981. He is a Canadian information technology professional, project manager and artist. Farley was a lecturer at the University of Malawi, Chancellor College from 1981-1983. He set up the first Computer Science Programme under the Mathematics Department led by the late Paddy Ewer, designed and taught courses to second, third and fourth-year students and acquired the first computer equipment and facilities. ', 'farley.jpg', '2021-10-11 12:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `password_recovery_token` varchar(255) NOT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `is_valid` tinyint(4) NOT NULL,
  `expired_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user1`
--

CREATE TABLE `user1` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user1`
--

INSERT INTO `user1` (`id`, `name`, `password`) VALUES
(1, 'Gibson', '578ad8e10dc4edb52ff2bd4ec9bc93a3'),
(2, 'Gibson', '578ad8e10dc4edb52ff2bd4ec9bc93a3'),
(3, '', 'd41d8cd98f00b204e9800998ecf8427e'),
(4, '', 'd41d8cd98f00b204e9800998ecf8427e'),
(5, 'Frank', '35f4a8d465e6e1edc05f3d8ab658c551'),
(6, 'Frank', 'bb6b07f0fd4afe38c61f232bbb693fd7'),
(15, 'qwqe', '68053af2923e00204c3ca7c6a3150cf7'),
(16, 'qwqe', '68053af2923e00204c3ca7c6a3150cf7'),
(17, 'qwqe', '68053af2923e00204c3ca7c6a3150cf7'),
(18, 'qwqe', '68053af2923e00204c3ca7c6a3150cf7'),
(19, 'qwqe', '68053af2923e00204c3ca7c6a3150cf7'),
(20, 'qwqe', '68053af2923e00204c3ca7c6a3150cf7'),
(21, 'qwqe', '68053af2923e00204c3ca7c6a3150cf7'),
(22, 'qwqe', '68053af2923e00204c3ca7c6a3150cf7'),
(23, 'qwqe', '68053af2923e00204c3ca7c6a3150cf7'),
(24, 'qwqe', '68053af2923e00204c3ca7c6a3150cf7'),
(25, 'qwqe', '68053af2923e00204c3ca7c6a3150cf7'),
(26, 'qwqe', '68053af2923e00204c3ca7c6a3150cf7'),
(27, 'gibso23606', '81dc9bdb52d04dc20036dbd8313ed055'),
(28, 'Gib', '202cb962ac59075b964b07152d234b70'),
(29, 'Frank', '81dc9bdb52d04dc20036dbd8313ed055'),
(30, 'gibso23606', '202cb962ac59075b964b07152d234b70'),
(31, '', 'd41d8cd98f00b204e9800998ecf8427e'),
(32, '', '36347412c7d30ae6fde3742bbc4f21b9'),
(33, '', '36347412c7d30ae6fde3742bbc4f21b9'),
(34, '', '36347412c7d30ae6fde3742bbc4f21b9'),
(35, '', '36347412c7d30ae6fde3742bbc4f21b9'),
(36, '1111', 'b59c67bf196a4758191e42f76670ceba');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile_image` text NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `designation` varchar(50) NOT NULL,
  `type` enum('admin','user','editor','') NOT NULL DEFAULT 'user',
  `status` enum('pending','active') DEFAULT 'pending',
  `time_stamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `password`, `profile_image`, `gender`, `contact`, `designation`, `type`, `status`, `time_stamp`) VALUES
(144, 'Dzimbiri', 'Gibson', 'gibson.dzimbiri@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '135687189_3863801757073905_3395250027300170408_o.jpg', 'female', '45896511366', 'Developer', 'admin', 'active', '2021-09-08 21:02:11'),
(148, 'Jerald', 'John', 'john@aol.com', '857e96a043eb31f1d06aab7971b2ed73', 'african_man_smartphone_600.jpg', 'male', '', 'Developer', 'editor', 'active', '2021-09-13 09:53:44'),
(155, 'Admin', 'Owner', 'admin@localhost.local', '827ccb0eea8a706c4c34a16891f84e7b', 'profile1.png', 'other', '0883325705', 'Engineer', 'admin', 'active', '2021-09-27 08:00:10'),
(163, 'Dzimbiri', 'Gibson', 'gibsonmbiri@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'BH884378_0fc82a.jpg', 'male', '', 'Designer', 'user', 'pending', '2021-10-08 13:44:46'),
(171, 'Ketura', 'Kata', 'kata@ffff.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Untitled-1.png', 'male', NULL, 'Engineer', 'user', 'pending', '2021-10-08 21:14:11'),
(174, 'Sphiwe ', 'Sulani', 'sulani@eth.com', '827ccb0eea8a706c4c34a16891f84e7b', '12919828_1179908948700521_1863592233993554963_n.jpg', 'female', NULL, 'Designer', 'user', 'pending', '2021-10-09 09:50:08'),
(176, 'Ambert', 'Diolos', 'diolos@hom.com', '827ccb0eea8a706c4c34a16891f84e7b', '12919828_1179908948700521_1863592233993554963_n.jpg', 'female', NULL, 'Developer', 'user', 'pending', '2021-10-09 09:59:14'),
(177, 'Ashermbault', 'Grame', 'grame@sd.jk', '827ccb0eea8a706c4c34a16891f84e7b', '12919828_1179908948700521_1863592233993554963_n.jpg', 'male', '', 'Developer', 'user', 'pending', '2021-10-09 10:07:52'),
(178, 'Happy', 'hdhdfd', 'hfhf@gmg.com', '827ccb0eea8a706c4c34a16891f84e7b', 'BH884378_1c478f.jpg', 'male', NULL, 'Designer', 'user', 'pending', '2021-10-11 16:11:58'),
(179, 'Dingase', 'Gtrude', 'getrude@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'BH884378_1c478f.jpg', 'male', NULL, 'Developer', 'user', 'pending', '2021-10-11 16:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `web_content`
--

CREATE TABLE `web_content` (
  `id` int(50) NOT NULL,
  `title` text NOT NULL,
  `page` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `athing_fk1` (`user_email`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`) USING HASH,
  ADD KEY `FK_ArticleEmail` (`author`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contentcategory`
--
ALTER TABLE `contentcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contentID` (`contentID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `g_user`
--
ALTER TABLE `g_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user1`
--
ALTER TABLE `user1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `web_content`
--
ALTER TABLE `web_content`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contentcategory`
--
ALTER TABLE `contentcategory`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `g_user`
--
ALTER TABLE `g_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user1`
--
ALTER TABLE `user1`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `web_content`
--
ALTER TABLE `web_content`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `athing_fk1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contentcategory`
--
ALTER TABLE `contentcategory`
  ADD CONSTRAINT `contentcategory_ibfk_1` FOREIGN KEY (`contentID`) REFERENCES `article` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `contentcategory_ibfk_2` FOREIGN KEY (`categoryID`) REFERENCES `category` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
