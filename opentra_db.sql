-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2026 at 08:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opentra_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `eoi_id` int(11) NOT NULL,
  `status` enum('New','Current','Final') DEFAULT 'New',
  `jobref` enum('WD101','UX202') DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Female','Male','Other','Prefer not to say') DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `town` varchar(50) DEFAULT NULL,
  `state` text DEFAULT NULL,
  `postalcode` varchar(6) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `skills` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_ref` varchar(10) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_description` text NOT NULL,
  `salary` varchar(100) NOT NULL,
  `reports_to` varchar(100) NOT NULL,
  `responsibilities` text NOT NULL,
  `essential_requirements` text NOT NULL,
  `preferable_requirements` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_ref`, `job_title`, `job_description`, `salary`, `reports_to`, `responsibilities`, `essential_requirements`, `preferable_requirements`) VALUES
(1, 'WD101', 'Junior Web Developer', 'We are looking for a motivated Junior Web Developer to join our development team at Opentra. The successful candidate will assist in designing, developing and maintaining our online learning websites and digital platforms. This role involves creating responsive web pages, improving website functionality, identifying technical issues and working with other team members to deliver reliable and user-friendly digital learning experiences.', 'RM 3,000 - RM 4,000 per month', 'Senior Web Developer', 'Website Development: Develop, maintain and update website pages using HTML, CSS and JavaScript to ensure the platform remains functional and visually consistent.\nResponsive Design: Ensure websites are responsive and display correctly across different screen sizes, including desktops, tablets and mobile devices.\nTesting and Troubleshooting: Perform regular website testing to identify broken links, layout issues, coding errors and other technical problems, and assist in resolving them.\nWebsite Maintenance: Update existing website content, improve outdated features and ensure that website components continue to function properly.\nPerformance Improvement: Assist in improving website loading speed, usability and overall performance to provide visitors with a smooth browsing experience.\nTeam Collaboration: Work closely with designers, senior developers and other team members to understand project requirements and implement suitable technical solutions.\nDocumentation: Maintain basic technical documentation and record development changes to support future maintenance and improvements.', 'Educational Background: Diploma or Bachelor\'s Degree in Computer Science, Information Technology, Software Engineering or a related field.\nProgramming Knowledge: Basic to intermediate understanding of HTML, CSS and JavaScript, with the ability to create and modify website components.\nWeb Development Fundamentals: Understanding of website structure, responsive web design, browser compatibility and basic front-end development principles.\nProblem-Solving Skills: Ability to identify coding errors, analyse technical issues and apply logical approaches to troubleshooting.\nCommunication Skills: Good written and verbal communication skills to explain technical issues and collaborate effectively with team members.\nTeamwork: Ability to work independently when assigned tasks and cooperate with other developers and designers to complete projects.\nWillingness to Learn: Demonstrates initiative and a willingness to learn new programming languages, development tools and technologies.', 'Familiarity with PHP and MySQL for developing dynamic websites and managing database-related information.\nExperience using Git or GitHub for source code management and collaboration.\nBasic understanding of web security practices, including input validation and protection against common website vulnerabilities.\nKnowledge of web accessibility guidelines and techniques for making websites usable by individuals with different needs.\nExperience developing personal, academic or internship-based web development projects.\nFamiliarity with development environments such as Visual Studio Code and browser developer tools.'),
(2, 'UX202', 'UX/UI Designer', 'Opentra is seeking a creative and detail-oriented UX/UI Designer to help improve the design and usability of our online learning platform. The successful candidate will be responsible for creating intuitive, visually appealing and accessible user interfaces that meet the needs of students, educators and other platform users. This role involves researching user needs, developing design concepts, creating prototypes and collaborating with developers to transform ideas into effective digital experiences.', 'RM 3,500 - RM 4,500 per month', 'Product Design Lead', 'Interface Design: Design visually appealing and user-friendly website interfaces, ensuring that layouts, colours, typography, icons and other visual elements remain consistent with Opentra\'s brand identity.\nWireframing and Prototyping: Create wireframes, mock-ups and interactive prototypes to demonstrate website layouts, navigation structures and proposed user interactions before development begins.\nUser Experience Improvement: Evaluate existing website interfaces and identify areas where navigation, content organisation and overall usability can be improved.\nUser Research: Gather and analyse feedback from students, educators and other users to better understand their needs, preferences and difficulties when using the platform.\nResponsive Interface Design: Design interfaces that provide a consistent and accessible experience across different devices, including desktop computers, tablets and mobile phones.\nAccessibility Considerations: Ensure that interface designs consider readability, colour contrast, clear navigation and other accessibility principles to support users with different needs.\nDesign Collaboration: Work closely with web developers, project managers and other team members to communicate design requirements and ensure that the final website reflects the approved designs.\nDesign Documentation: Organise design files, maintain reusable design components and document interface guidelines to support consistency across future projects.', 'Educational Background: Diploma or Bachelor\'s Degree in Graphic Design, Multimedia Design, Digital Media, Human-Computer Interaction or a related field.\nUX/UI Knowledge: Understanding of user experience and user interface design principles, including usability, visual hierarchy, consistency and user-centred design.\nVisual Design Skills: Ability to create clean, organised and visually appealing layouts using suitable colours, typography, spacing and graphic elements.\nPrototyping Knowledge: Understanding of wireframing, mock-up creation and prototyping processes for planning and presenting website interfaces.\nUser-Centred Thinking: Ability to consider user needs and behaviours when making design decisions and improving digital experiences.\nCommunication Skills: Good communication and presentation skills to explain design concepts, receive feedback and work effectively with different teams.\nAttention to Detail: Ability to maintain consistency across design elements and identify visual or usability issues before implementation.\nTime Management: Ability to organise design tasks, meet project deadlines and manage multiple design requirements effectively.', 'Practical experience using Figma, Adobe XD or other professional UI/UX design tools.\nFamiliarity with user research methods, including surveys, interviews and usability testing.\nUnderstanding of responsive web design principles and mobile-first design approaches.\nBasic knowledge of HTML and CSS to better understand how interface designs are translated into working websites.\nFamiliarity with WCAG (Web Content Accessibility Guidelines) and accessible interface design practices.\nExperience creating design portfolios, website prototypes or previous academic and personal design projects.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`eoi_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`),
  ADD UNIQUE KEY `job_ref` (`job_ref`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `eoi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
