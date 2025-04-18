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
INSERT INTO users (id, name, password, email, role) VALUES
('1211101935', 'Mohamed Imran Bin Mohamed Yunus', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1211101935@student.mmu.edu.my', 'student'),
('1211103220', 'Muhammad Firzan Ruzain Bin Firdus', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1211103220@student.mmu.edu.my', 'student'),
('1211103194', 'Nur Farahiya Aida Binti Abd Razak', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1211103194@student.mmu.edu.my', 'student'),
('1211104230', 'Nur Aisyah Nabila Binti Nahar', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1211104230@student.mmu.edu.my', 'student'),
('1211017635', 'Ahmad Abu', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1211017635@student.mmu.edu.my', 'student'),
('1209115403', 'Ali Naki', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1209115403@student.mmu.edu.my', 'student'),
('1212003221', 'Sarah Humaira', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1212003221@student.mmu.edu.my', 'student'),
('1213567211', 'Nurul Aliya', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1213567211@student.mmu.edu.my', 'student'),
('L001', 'Chan Wai Ti', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L001@mmu.edu.my', 'lecturer'),
('L002', 'Alif Zulfakar Bin Pokaad', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L002@mmu.edu.my', 'lecturer'),
('L003', 'Ervina Efzan Binti Mhd Noor', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L003@mmu.edu.my', 'lecturer'),
('L004', 'Em Poh Ping', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L004@mmu.edu.my', 'lecturer'),
('L005', 'Ganesh Kumar A/L Krishnan', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L005@mmu.edu.my', 'lecturer'),
('L006', 'Jee Kian Siong', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L006@mmu.edu.my', 'lecturer'),
('L007', 'Logah A/L Perumal', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L007@mmu.edu.my', 'lecturer'),
('L008', 'Muharniza Azinita Binti Musa', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L008@mmu.edu.my', 'lecturer'),
('A001', 'Ng Hu', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'A001@mmu.edu.my', 'admin');
-- --------------------------------------------------------

--
-- Insert sample data  for table `lecturer`
--
INSERT INTO lecturer (userID, lecturerID, position) VALUES
(9, 'L001', 'Senior Lecturer'),
(10, 'L002', 'Associate Professor'),
(11, 'L003', 'Professor'),
(12, 'L004', 'Lecturer'),
(13, 'L005', 'Senior Lecturer'),
(14, 'L006', 'Associate Professor'),
(15, 'L007', 'Professor'),
(16, 'L008', 'Lecturer');

-- --------------------------------------------------------

--
-- Insert sample data  for table `student`
--
INSERT INTO student (userID, studentID, year, specialization) VALUES
(1, '1211101935', 3, 'Software Engineering'),
(2, '1211103220', 3, 'Software Engineering'),
(3, '1211103194', 3, 'Software Engineering'),
(4, '1211104230', 3, 'Software Engineering'),
(5, '1211017635', 4, 'Data Science'),
(6, '1209115403', 5, 'Cybersecurity'),
(7, '1212003221', 2, 'Game Development'),
(8, '1213567211', 3, 'Data Science');
-- --------------------------------------------------------

--
-- Insert sample data  for table `task`
--
INSERT INTO task (taskName, taskDate, userID) VALUES
('Design Database', '2025-01-10', '9'),
('Develop API', '2025-01-15', '10'),
('Create Frontend', '2025-01-20', '11'),
('Write Documentation', '2025-01-25', '9'),
('Test Application', '2025-01-30', '13'),
('Deploy to Server', '2025-02-05', '14'),
('Conduct User Training', '2025-02-10', '15'),
('Gather Feedback', '2025-02-15', '16'),
('Research on AI', '2025-02-20', '1'),
('Develop Machine Learning Model', '2025-02-25', '1'),
('Analyze Data', '2025-03-01', '3'),
('Prepare Presentation', '2025-03-05', '4'),
('Write Research Paper', '2025-03-10', '1'),
('Create Prototype', '2025-03-15', '6'),
('Test Prototype', '2025-03-20', '7'),
('Finalize Project', '2025-03-25', '8');
-- --------------------------------------------------------

--
-- Insert sample data  for table `announcement`
--

-- --------------------------------------------------------
--
-- Insert sample data  for table `proposal`
--
INSERT INTO proposal (proposal_title, proposal_description, submission_date, specialisation, category, supervisorID)
VALUES 
('AI Chatbot', 'Proposal for developing an AI chatbot for customer service', '2025-01-05', 'Software Engineering', 'application-based', 9),
('E-Commerce Platform', 'Proposal for building an e-commerce platform for small businesses', '2025-02-10', 'Software Engineering', 'application-based', 10),
('IoT Smart Home', 'Proposal for creating an IoT-based smart home system', '2025-03-15', 'Software Engineering', 'application-based', 11),
('Blockchain Wallet', 'Proposal for developing a secure blockchain wallet', '2025-04-20', 'Software Engineering', 'application-based', 12),
('Data Analysis Tool', 'Proposal for designing a data analysis tool for researchers', '2025-05-25', 'Data Science', 'research-based', 13),
('Virtual Reality Game', 'Proposal for creating a VR game for education', '2025-06-30', 'Game Development', 'application-based', 14),
('Fitness Tracker App', 'Proposal for developing a fitness tracker mobile app', '2025-07-05', 'Software Engineering', 'application-based', 15),
('Online Learning Portal', 'Proposal for building an online learning portal for schools', '2025-08-10', 'Software Engineering', 'application-based', 16),
('Track My Meals: Mobile App for Health Tracking', 'Proposal for creating a mobile app for meal tracking', '2025-09-15', 'Software Engineering', 'application-based', 9),
('Cloud Computing', 'Proposal for developing a cloud computing platform', '2025-10-20', 'Software Engineering', 'research-based', 10),
('Big Data Analytics for LLM', 'Proposal for building a big data analytics tool for LLMs', '2025-11-25', 'Data Science', 'research-based', 11);
-- --------------------------------------------------------

--
-- Insert sample data  for table `proposal_status`
--
INSERT INTO proposal_status (status, comment, updated_at, proposalID) VALUES
('accepted', 'Proposal accepted with minor revisions', '2025-01-10 10:00:00', 1),
('accepted', NULL, '2025-02-15 11:30:00', 2),
('accepted', NULL, '2025-03-20 09:45:00', 3),
('accepted', NULL, '2025-04-25 14:00:00', 4),
('accepted', 'Proposal accepted with major revisions', '2025-05-30 16:15:00', 5),
('accepted', NULL, '2025-06-05 13:20:00', 6),
('accepted', NULL, '2025-07-10 08:30:00', 7),
('accepted', 'Proposal accepted with minor revisions', '2025-08-15 12:45:00', 8),
('accepted', NULL, '2025-09-20 10:50:00', 9),
('rejected', 'Review title', '2025-10-25 15:00:00', 10),
('pending', 'Proposal under review', '2025-11-30 17:10:00', 11);

-- --------------------------------------------------------

INSERT INTO project (project_title, start_date, end_date, project_description, project_status, studentID, proposalID)
VALUES 
('AI Chatbot', '2025-01-01', '2025-06-30', 'Developing an AI chatbot for customer service', 'ongoing', 1211101935, 1),
('E-Commerce Platform', '2025-02-01', '2025-07-31', 'Building an e-commerce platform for small businesses', 'submitted', 1211103220, 2),
('IoT Smart Home', '2025-03-01', '2025-09-30', 'Creating an IoT-based smart home system', 'approved', 1211103194, 3),
('Blockchain Wallet', '2025-04-01', '2025-10-31', 'Developing a secure blockchain wallet', 'ongoing', 1211104230, 4),
('Data Analysis Tool', '2025-05-01', NULL, 'Designing a data analysis tool for researchers', 'ongoing', 1211017635, 5),
('Virtual Reality Game', '2025-06-01', '2025-12-31', 'Creating a VR game for education', 'submitted', 1209115403, 6),
('Fitness Tracker App', '2025-07-01', NULL, 'Developing a fitness tracker mobile app', 'approved', 1212003221, 7),
('Online Learning Portal', '2025-08-01', '2026-01-31', 'Building an online learning portal for schools', 'ongoing', 1213567211, 8);

-- --------------------------------------------------------

--
-- Insert sample data  for table `project_timeline`
--
INSERT INTO project_timeline (timelineID, start_date, end_date, status, projectID, gantt_chart_pdf, flow_chart_pdf)
VALUES 
(1, '2025-01-01', '2025-01-31', 'completed', 1, NULL,NULL),
(2, '2025-02-01', '2025-02-28', 'in-progress', 2, NULL, NULL),
(3, '2025-03-01', '2025-03-31', 'pending', 3, NULL, NULL),
(4, '2025-04-01', '2025-04-30', 'completed', 4, NULL, NULL),
(5, '2025-05-01', '2025-05-31', 'pending', 5, NULL, NULL),
(6, '2025-06-01', '2025-06-30', 'in-progress', 6, NULL, NULL),
(7, '2025-07-01', '2025-07-31', 'pending', 7, NULL, NULL),
(8, '2025-08-01', '2025-08-31', 'completed', 8, NULL,NULL);

-- --------------------------------------------------------

--
-- Insert sample data for table `lecturer_project`
--
INSERT INTO lecturer_project (projectID, lecturerID, lecturer_role) VALUES
(1, 9, 'supervisor'),
(2, 10, 'supervisor'),
(3, 11, 'supervisor'),
(4, 12, 'supervisor'),
(5, 13, 'supervisor'),
(6, 14, 'supervisor'),
(7, 15, 'supervisor'),
(8, 16, 'supervisor'),
(2, 11, 'moderator'),
(3, 12, 'moderator'),
(4, 13, 'moderator'),
(5, 14, 'moderator'),
(6, 15, 'moderator'),
(7, 16, 'moderator'),
(8, 9, 'moderator');
-- --------------------------------------------------------

--
-- Insert sample data  for table `milestone`
--
INSERT INTO milestone (milestoneID, milestone_title, milestone_description, milestone_start_date, milestone_end_date, timelineID)
VALUES 
(1, 'Requirement Analysis', 'Gather the project requirements and finalize scope', '2025-01-01', '2025-01-10', 1),
(2, 'Design Phase', 'Create wireframes, UI/UX design, and system architecture', '2025-01-11', '2025-01-20', 2),
(3, 'Prototype Development', 'Build an initial working prototype of the system', '2025-01-21', '2025-01-30', 3),
(4, 'Testing', 'Conduct software testing and fix bugs', '2025-02-01', '2025-02-10', 4),
(5, 'Deployment', 'Deploy the project to a staging or production environment', '2025-02-11', '2025-02-20', 5),
(6, 'Documentation', 'Prepare technical and user documentation, including manuals', '2025-03-01', '2025-03-10', 6),
(7, 'Initial Review', 'Conduct a preliminary evaluation of the project', '2025-03-11', '2025-03-20', 7),
(8, 'Final Review', 'Conduct the final project assessment, ensuring all requirements are met', '2025-03-21', '2025-03-31', 8);

-- --------------------------------------------------------

--
-- Insert sample data  for table `timeline_file`
--
INSERT INTO timeline_file (timeline_fileID, filename, file_type, file_size, file_category, file_path, uploaded_at, edited_at, timeline_ID)
VALUES 
(1, 'gantt_chart.png', 'image', 2048, 'gantt_chart', '/files/gantt_chart.png', '2025-01-05 10:00:00', NULL, 1),
(2, 'flow_chart.pdf', 'pdf', 1024, 'flow_chart', '/files/flow_chart.pdf', '2025-01-15 14:30:00', '2025-01-20 09:00:00', 2),
(3, 'design_doc.docx', 'docx', 3072, 'others', '/files/design_doc.docx', '2025-01-25 16:00:00', NULL, 3),
(4, 'test_plan.pdf', 'pdf', 512, 'others', '/files/test_plan.pdf', '2025-02-05 11:15:00', NULL, 4),
(5, 'deployment_notes.txt', 'txt', 256, 'others', '/files/deployment_notes.txt', '2025-02-15 13:00:00', NULL, 5),
(6, 'doc_manual.pdf', 'pdf', 1024, 'others', '/files/doc_manual.pdf', '2025-03-05 09:45:00', NULL, NULL),
(7, 'final_review_notes.docx', 'docx', 2048, 'others', '/files/final_review_notes.docx', '2025-03-25 14:30:00', NULL, 6),
(8, 'initial_review.png', 'image', 1024, 'others', '/files/initial_review.png', '2025-03-15 10:00:00', NULL, 7);
-- --------------------------------------------------------

INSERT INTO project_submission (start_date, end_date, project_description, project_status, project_category, studentID, projectID.project_file)
VALUES
('2025-01-01', '2025-06-30', 'Developing an AI chatbot for customer service', 'submitted', 'Software Engineering', 1, 1,NULL),
('2025-02-01', '2025-07-31', 'Building an e-commerce platform for small businesses', 'approved', 'E-commerce', 2, 2,NULL),
('2025-03-01', '2025-09-30', 'Creating an IoT-based smart home system', 'pending', 'Internet of Things', 3, 3,NULL),
('2025-04-01', '2025-10-31', 'Developing a secure blockchain wallet', 'submitted', 'Blockchain', 4, 4,NULL),
('2025-05-01', '2025-11-30', 'Designing a data analysis tool for researchers', 'rejected', 'Data Science', 5, 5,NULL),
('2025-06-01', '2025-12-31', 'Creating a VR game for education', 'approved', 'Game Development', 6, 6,NULL),
('2025-07-01', '2026-01-31', 'Developing a fitness tracker mobile app', 'pending', 'Health & Fitness', 7, 7,NULL),
('2025-08-01', '2026-02-28', 'Building an online learning portal for schools', 'submitted', 'Education', 8, 8,NULL);

-- --------------------------------------------------------

--
-- Insert sample data  for table `marksheet`
--
INSERT INTO marksheet (marksheetID, total_score, date, projectID)
VALUES 
(1, 85, '2025-01-31 15:00:00', 1),
(2, 90, '2025-02-28 15:00:00', 2),
(3, 88, '2025-03-31 15:00:00', 3),
(4, 80, '2025-04-30 15:00:00', 4),
(5, 95, '2025-05-31 15:00:00', 5),
(6, 78, '2025-06-30 15:00:00', 6),
(7, 82, '2025-07-31 15:00:00', 7),
(8, 89, '2025-08-31 15:00:00', 8);

-- --------------------------------------------------------

--
-- Insert sample data  for table `criteria_score`
--
INSERT INTO criteria_score (scoreID, score, criteria, comment, marksheetID, evaluatorID)
VALUES 
(1, 25, 'project_mgt', 'Well-organized project management', 1, NULL),
(2, 30, 'execution', 'Excellent execution of tasks', 2, NULL),
(3, 20, 'report', 'Good but needs improvement', 3, NULL),
(4, 15, 'oral_presentation', 'Clear presentation', 4, NULL),
(5, 10, 'research_paper', 'Requires further detail', 5, NULL),
(6, 25, 'project_mgt', 'Satisfactory management', 6, NULL),
(7, 28, 'execution', 'Great execution', 7, NULL),
(8, 20, 'poster_presentation', 'Engaging and creative', 8, NULL);

-- --------------------------------------------------------

--
-- Insert sample data  for table `meeting`
--
INSERT INTO meeting (date, start_time, end_time, mode, location, meeting_title, meeting_description, meeting_URL) VALUES
('2025-01-10', '10:00:00', '11:00:00', 'online', NULL, 'Initial Project Discussion', 'Discuss project requirements and initial plans', 'https://example.com/meeting1'),
('2025-02-15', '14:00:00', '15:00:00', 'physical', 'Room 101', 'Mid-Project Review', 'Review project progress and address any issues', NULL),
('2025-03-20', '09:00:00', '10:00:00', 'online', NULL, 'Final Review Preparation', 'Prepare for the final project review', 'https://example.com/meeting3'),
('2025-04-25', '13:00:00', '14:00:00', 'physical', 'Room 202', 'Project Wrap-Up', 'Discuss project completion and final deliverables', NULL);
-- --------------------------------------------------------

--
-- Insert sample data  for table `users_meeting`
--
INSERT INTO users_meeting (meetingID, userID) VALUES
(1, 9),
(1, 10),
(2, 11),
(2, 12),
(3, 13),
(3, 14),
(4, 15),
(4, 16),
(1, 1),
(1, 5),
(2, 2),
(2, 6),
(3, 3),
(3, 7),
(4, 4),
(4, 8);
-- --------------------------------------------------------

--
-- Insert sample data  for table `meeting_log`
--
-- data will be insterted through the system
-- --------------------------------------------------------

--
-- Insert sample data  for table `presentation`
--
INSERT INTO presentation (presentation_title, start_time, end_time, date, mode, location, presentation_URL, status, updated_at, projectID) VALUES
('Final Presentation', '10:00:00', '11:00:00', '2025-01-15', 'online', NULL, 'https://example.com/presentation1', 'scheduled', '2025-01-10 09:00:00', 1),
('Final Presentation', '14:00:00', '15:00:00', '2025-03-15', 'physical', 'Room 101', NULL, 'scheduled', '2025-03-10 13:00:00', 2);

-- --------------------------------------------------------

--
-- Insert sample data  for table `group_chat`
--
INSERT INTO group_chat (groupID, groupName, createdAt, createdBy) VALUES
(1, 'Group 1', '2025-01-01 20:18:42', 17),
(2, 'Group 2', '2025-01-05 20:18:42', 9),
(3, 'Group 3', '2025-01-31 20:18:42', 16);
-- --------------------------------------------------------

--
-- Insert sample data  for table `user_group`
--
INSERT INTO user_group (userID, groupID) VALUES
(17, 1),
(9, 2),
(16, 3),
(1, 1),
(2, 1),
(6, 2),
(3, 3),
(4, 3),
(7, 3);
-- --------------------------------------------------------

--
-- Insert sample data  for table `message`
--
INSERT INTO messages (senderID, receiverID, messageContent, timeStamp) VALUES
(2, 9, 'testing bossku', '2025-01-01 20:18:42'),
(9, 2, 'hello hello', '2025-01-01 20:18:48');

INSERT INTO messages (senderID, groupID, messageContent, timeStamp) VALUES
(17, 1, 'testing bossku', '2025-01-01 20:18:42'),
(1, 1, 'hello hello', '2025-01-01 20:20:00');
-- --------------------------------------------------------