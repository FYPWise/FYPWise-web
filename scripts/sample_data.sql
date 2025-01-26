-- Select the database to work with
USE fypwise;

-- Set character encoding and collation to utf8mb4 for the connection
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fypwise`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `user`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `lecturer`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `student`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `announcement`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `task`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `proposal`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `proposal_status`
--

-- --------------------------------------------------------

INSERT INTO project (projectID, project_title, start_date, end_date, project_description, project_status, studentID, proposalID, supervisorID)
VALUES 
(1, 'AI Chatbot', '2025-01-01', '2025-06-30', 'Developing an AI chatbot for customer service', 'ongoing', NULL, NULL, NULL),
(2, 'E-Commerce Platform', '2025-02-01', '2025-07-31', 'Building an e-commerce platform for small businesses', 'submitted', NULL, NULL, NULL),
(3, 'IoT Smart Home', '2025-03-01', '2025-09-30', 'Creating an IoT-based smart home system', 'approved', NULL, NULL, NULL),
(4, 'Blockchain Wallet', '2025-04-01', '2025-10-31', 'Developing a secure blockchain wallet', 'ongoing', NULL, NULL, NULL),
(5, 'Data Analysis Tool', '2025-05-01', NULL, 'Designing a data analysis tool for researchers', 'ongoing', NULL, NULL, NULL),
(6, 'Virtual Reality Game', '2025-06-01', '2025-12-31', 'Creating a VR game for education', 'submitted', NULL, NULL, NULL),
(7, 'Fitness Tracker App', '2025-07-01', NULL, 'Developing a fitness tracker mobile app', 'approved', NULL, NULL, NULL),
(8, 'Online Learning Portal', '2025-08-01', '2026-01-31', 'Building an online learning portal for schools', 'ongoing', NULL, NULL, NULL);

-- --------------------------------------------------------


INSERT INTO project_timeline (timelineID, start_date, end_date, status, projectID)
VALUES 
(1, '2025-01-01', '2025-01-31', 'completed', NULL),
(2, '2025-02-01', '2025-02-28', 'in-progress', NULL),
(3, '2025-03-01', '2025-03-31', 'pending', NULL),
(4, '2025-04-01', '2025-04-30', 'completed', NULL),
(5, '2025-05-01', '2025-05-31', 'pending', NULL),
(6, '2025-06-01', '2025-06-30', 'in-progress', NULL),
(7, '2025-07-01', '2025-07-31', 'pending', NULL),
(8, '2025-08-01', '2025-08-31', 'completed', NULL);

--
-- Table structure for table `lecturer_project`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `project_timeline`
--


-- --------------------------------------------------------

INSERT INTO milestone (milestoneID, milestone_name, milestone_start_date, milestone_end_date, timelineID)
VALUES 
(1, 'Requirement Analysis', '2025-01-01', '2025-01-10', NULL),
(2, 'Design Phase', '2025-01-11', '2025-01-20', NULL),
(3, 'Prototype Development', '2025-01-21', '2025-01-30', NULL),
(4, 'Testing', '2025-02-01', '2025-02-10', NULL),
(5, 'Deployment', '2025-02-11', '2025-02-20', NULL),
(6, 'Documentation', '2025-03-01', '2025-03-10', NULL),
(7, 'Initial Review', '2025-03-11', '2025-03-20', NULL),
(8, 'Final Review', '2025-03-21', '2025-03-31', NULL);


-- --------------------------------------------------------

--
-- Insert sample data  for table `timeline_file`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `project_submission`
--

-- --------------------------------------------------------

INSERT INTO marksheet (marksheetID, total_score, date, projectID)
VALUES 
(1, 85, '2025-01-31 15:00:00', NULL),
(2, 90, '2025-02-28 15:00:00', NULL),
(3, 88, '2025-03-31 15:00:00', NULL),
(4, 80, '2025-04-30 15:00:00', NULL),
(5, 95, '2025-05-31 15:00:00', NULL),
(6, 78, '2025-06-30 15:00:00', NULL),
(7, 82, '2025-07-31 15:00:00', NULL),
(8, 89, '2025-08-31 15:00:00', NULL);

-- --------------------------------------------------------

INSERT INTO criteria_score (scoreID, score, criteria, comment, marksheetID, evaluatorID)
VALUES 
(1, 25, 'project_mgt', 'Well-organized project management', NULL, NULL),
(2, 30, 'execution', 'Excellent execution of tasks', NULL, NULL),
(3, 20, 'report', 'Good but needs improvement', NULL, NULL),/
(4, 15, 'oral_presentation', 'Clear presentation', NULL, NULL),
(5, 10, 'research_paper', 'Requires further detail', NULL, NULL),
(6, 25, 'project_mgt', 'Satisfactory management', NULL, NULL),
(7, 28, 'execution', 'Great execution', NULL, NULL),
(8, 20, 'poster_presentation', 'Engaging and creative', NULL, NULL);

-- --------------------------------------------------------

--
-- Insert sample data  for table `meeting`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `student_meeting`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `meeting_log`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `presentation`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `message`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `group`
--

-- --------------------------------------------------------

--
-- Insert sample data  for table `user_group`
--

-- --------------------------------------------------------