INSERT INTO `users` (`userID`, `id`, `name`, `password`, `email`, `role`, `filename`) VALUES
 (1, '1211101935', 'Mohamed Imran Bin Mohamed Yunus', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1211101935@student.mmu.edu.my', 'student', '1211101935.png'),
 (2, '1211103220', 'Muhammad Firzan Ruzain Bin Firdus', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1211103220@student.mmu.edu.my', 'student', 'Default_pfp.jpg'),
 (3, '1211103194', 'Nur Farahiya Aida Binti Abd Razak', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1211103194@student.mmu.edu.my', 'student', 'Default_pfp.jpg'),
 (4, '1211104230', 'Nur Aisyah Nabila Binti Nahar', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1211104230@student.mmu.edu.my', 'student', 'Default_pfp.jpg'),
 (5, '1211017635', 'Ahmad Abu', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1211017635@student.mmu.edu.my', 'student', 'Default_pfp.jpg'),
 (6, '1209115403', 'Ali Naki', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1209115403@student.mmu.edu.my', 'student', 'Default_pfp.jpg'),
 (7, '1212003221', 'Sarah Humaira', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1212003221@student.mmu.edu.my', 'student', 'Default_pfp.jpg'),
 (8, '1213567211', 'Nurul Aliya', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', '1213567211@student.mmu.edu.my', 'student', 'Default_pfp.jpg'),
 (9, 'L001', 'Chan Wai Ti', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L011@mmu.edu.my', 'lecturer', 'Default_pfp.jpg'),
 (10, 'L002', 'Alif Zulfakar Bin Pokaad', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L002@mmu.edu.my', 'lecturer', 'L002.png'),
 (11, 'L003', 'Ervina Efzan Binti Mhd Noor', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L003@mmu.edu.my', 'lecturer', 'Default_pfp.jpg'),
 (12, 'L004', 'Em Poh Ping', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L004@mmu.edu.my', 'lecturer', 'Default_pfp.jpg'),
 (13, 'L005', 'Ganesh Kumar A/L Krishnan', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L005@mmu.edu.my', 'lecturer', 'Default_pfp.jpg'),
 (14, 'L006', 'Jee Kian Siong', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L006@mmu.edu.my', 'lecturer', 'Default_pfp.jpg'),
 (15, 'L007', 'Logah A/L Perumal', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L007@mmu.edu.my', 'lecturer', 'Default_pfp.jpg'),
 (16, 'L008', 'Muharniza Azinita Binti Musa', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'L008@mmu.edu.my', 'lecturer', 'Default_pfp.jpg'),
 (17, 'A001', 'Ng Hu', '$2a$12$6ZeKG2MvTrC3DkHUfSNn3ePaIjI4jtPo1VkcH6HGb0luvZ8ttyFtq', 'A001@mmu.edu.my', 'admin', 'A001.png');


INSERT INTO `lecturer` (`userID`, `lecturerID`, `position`) VALUES
 (9, 'L001', 'Senior Lecturer'),
 (10, 'L002', 'Associate Professor'),
 (11, 'L003', 'Professor'),
 (12, 'L004', 'Lecturer'),
 (13, 'L005', 'Senior Lecturer'),
 (14, 'L006', 'Associate Professor'),
 (15, 'L007', 'Professor'),
 (16, 'L008', 'Lecturer');

INSERT INTO `student` (`userID`, `studentID`, `year`, `specialization`) VALUES
 (1, '1211101935', 3, 'Software Engineering'),
 (2, '1211103220', 3, 'Software Engineering'),
 (3, '1211103194', 3, 'Software Engineering'),
 (4, '1211104230', 3, 'Software Engineering'),
 (5, '1211017635', 4, 'Data Science'),
 (6, '1209115403', 5, 'Cybersecurity'),
 (7, '1212003221', 2, 'Game Development'),
 (8, '1213567211', 3, 'Data Science');

INSERT INTO `task` (`taskID`, `taskName`, `taskDate`, `userID`) VALUES
 (1, 'Design Database', '2025-01-10', 9),
 (2, 'Develop API', '2025-01-15', 10),
 (3, 'Create Frontend', '2025-01-20', 11),
 (4, 'Write Documentation', '2025-01-25', 9),
 (5, 'Test Application', '2025-01-30', 13),
 (6, 'Deploy to Server', '2025-02-05', 14),
 (7, 'Conduct User Training', '2025-02-10', 15),
 (8, 'Gather Feedback', '2025-02-15', 16),
 (9, 'Research on AI', '2025-02-20', 1),
 (10, 'Develop Machine Learning Model', '2025-02-25', 1),
 (11, 'Analyze Data', '2025-03-01', 3),
 (12, 'Prepare Presentation', '2025-03-05', 4),
 (13, 'Write Research Paper', '2025-03-10', 1),
 (14, 'Create Prototype', '2025-03-15', 6),
 (15, 'Test Prototype', '2025-03-20', 7),
 (16, 'Finalize Project', '2025-03-25', 8);


INSERT INTO announcement (announcementID, datetime, title, description, status, userID)
VALUES 
(1, '2025-02-03 09:00:00', 'Project Update', 'Project milestone has been completed successfully.', 'Active', 17),
(2, '2025-02-04 10:30:00', 'Meeting Reminder', 'Reminder for the team meeting scheduled tomorrow.', 'Active', 17),
(3, '2025-02-05 11:45:00', 'System Maintenance', 'System will be under maintenance from 2 AM to 4 AM.', 'Archived', 17),
(4, '2025-02-06 14:20:00', 'Workshop Announcement', 'Join the upcoming workshop on AI technologies.', 'Active', 17),
(5, '2025-02-07 16:00:00', 'Deadline Extension', 'Submission deadline has been extended by one week.', 'Active', 17),
(6, '2025-02-08 12:15:00', 'Policy Update', 'New guidelines have been introduced for project submissions.', 'Archived', 17),
(7, '2025-02-08 13:15:00', 'Welcome to THE ULTIMATE FYPWise Revolution, Crafted by Four Visionaries!', 'Behold! The culmination of countless hours, boundless creativity, and an unwavering commitment to innovation. This masterpiece, forged by four unstoppable minds, will change the landscape forever. Through trials, triumphs, and the relentless pursuit of perfection, they’ve created something that transcends ordinary limits. Welcome to a new era—where ideas break barriers, and every moment is a testament to their genius. Prepare yourself for the extraordinary, the unimaginable, and the unbeatable FYPWise experience!', 'Active', 17);

INSERT INTO `proposal` (`proposalID`, `proposal_title`, `proposal_description`, `submission_date`, `specialisation`, `category`, `supervisorID`, `proposal_file`) VALUES
 (1, 'AI Chatbot', 'Proposal for developing an AI chatbot for customer service', '2025-01-05 00:00:00', 'Software Engineering', 'application-based', 9, '9_AI_Chatbot_Proposal.pdf'),
 (2, 'E-Commerce Platform', 'Proposal for building an e-commerce platform for small businesses', '2025-02-10 00:00:00', 'Software Engineering', 'application-based', 10, '10_E-Commerce_Platform_Proposal.pdf'),
 (3, 'IoT Smart Home', 'Proposal for creating an IoT-based smart home system', '2025-03-15 00:00:00', 'Software Engineering', 'application-based', 11, '11_IoT_Smart_Home_Proposal.pdf'),
 (4, 'Blockchain Wallet', 'Proposal for developing a secure blockchain wallet', '2025-04-20 00:00:00', 'Software Engineering', 'application-based', 12, '12_Blockchain_Wallet_Proposal.pdf'),
 (5, 'Data Analysis Tool', 'Proposal for designing a data analysis tool for researchers', '2025-05-25 00:00:00', 'Data Science', 'research-based', 13, '13_Data_Analysis_Tool_Proposal.pdf'),
 (6, 'Virtual Reality Game', 'Proposal for creating a VR game for education', '2025-06-30 00:00:00', 'Game Development', 'application-based', 14, '14_Virtual_Reality_Game_Proposal.pdf'),
 (7, 'Fitness Tracker App', 'Proposal for developing a fitness tracker mobile app', '2025-07-05 00:00:00', 'Software Engineering', 'application-based', 15, '15_Fitness-Tracker_App_Proposal.pdf'),
 (8, 'Online Learning Portal', 'Proposal for building an online learning portal for schools', '2025-08-10 00:00:00', 'Software Engineering', 'application-based', 16, '16_Online-Learning-Portal_Proposal.pdf'),
 (9, 'Track My Meals: Mobile App for Health Tracking', 'Proposal for creating a mobile app for meal tracking', '2025-09-15 00:00:00', 'Software Engineering', 'application-based', 9, '9_Track_My_Meals_Mobile_App_for_Health _Tracking_Proposal.pdf'),
 (10, 'Cloud Computing', 'Proposal for developing a cloud computing platform', '2025-10-20 00:00:00', 'Software Engineering', 'research-based', 10, '10_Cloud_Computing_Proposal.pdf'),
 (11, 'Big Data Analytics for LLM', 'Proposal for building a big data analytics tool for LLMs', '2025-11-25 00:00:00', 'Data Science', 'research-based', 11, '11_Big_Data_Analytics_For_LLM_Proposal.pdf'),
 (15, 'IntelliTraffic : A smart traffic management system powered by AI', 'This project proposes to develop an AI-powered traffic management system that uses real-time traffic data and machine learning to optimize traffic flow, reduce congestion, and enhance public transportation efficiency in urban areas.', '2025-01-29 00:00:00', 'Artificial Intelligence', 'application-research-based', 14, NULL),
 (19, 'Zakat Finder', 'A modern app for zakat', '2025-02-02 00:00:00', 'Software Engineering', 'application-research-based', 10, '10_Zakat Finder_Proposal.pdf'),
 (20, 'Smart Attendance System Using Facial Recognition', 'Traditional attendance systems rely on manual input or RFID-based solutions, which can be time-consuming and prone to errors. This project proposes the development of a Smart Attendance System that utilizes facial recognition technology to automate attendance tracking in classrooms and workplaces.', '2025-02-02 00:00:00', 'Software Engineering', 'application-research-based', 9, '9_Smart Attendance System Using Facial Recognition_Proposal.pdf');

INSERT INTO `proposal_status` (`proposal_statusID`, `status`, `comment`, `updated_at`, `proposalID`) VALUES
 (1, 'accepted', 'Proposal accepted with minor revisions', '2025-01-10 10:00:00', 1),
 (2, 'accepted', NULL, '2025-02-15 11:30:00', 2),
 (3, 'accepted', NULL, '2025-03-20 09:45:00', 3),
 (4, 'accepted', NULL, '2025-04-25 14:00:00', 4),
 (5, 'accepted', 'Proposal accepted with major revisions', '2025-05-30 16:15:00', 5),
 (6, 'accepted', NULL, '2025-06-05 13:20:00', 6),
 (7, 'accepted', NULL, '2025-07-10 08:30:00', 7),
 (8, 'accepted', 'Proposal accepted with minor revisions', '2025-08-15 12:45:00', 8),
 (9, 'accepted', NULL, '2025-09-20 10:50:00', 9),
 (10, 'pending', 'Review title', '2025-01-29 22:11:07', 10),
 (11, 'rejected', 'Too vague', '2025-01-29 22:03:42', 11),
 (13, 'rejected', 'No proposal file uploaded', '2025-02-02 18:14:15', 15),
 (16, 'accepted', '', '2025-02-02 21:06:54', 19),
 (17, 'accepted', '', '2025-02-02 20:50:24', 20);

INSERT INTO `project` (`projectID`, `project_title`, `start_date`, `end_date`, `project_description`, `project_status`, `studentID`, `proposalID`) VALUES
 (1, 'AI Chatbot', '2025-01-01', '2025-06-30', 'Developing an AI chatbot for customer service', 'ongoing', 1, 1),
 (2, 'E-Commerce Platform', '2025-02-01', '2025-07-31', 'Building an e-commerce platform for small businesses', 'submitted', 2, 2),
 (3, 'IoT Smart Home', '2025-03-01', '2025-09-30', 'Creating an IoT-based smart home system', 'submitted', 3, 3),
 (4, 'Blockchain Wallet', '2025-04-01', '2025-10-31', 'Developing a secure blockchain wallet', 'ongoing', 4, 4),
 (5, 'Data Analysis Tool', '2025-05-01', NULL, 'Designing a data analysis tool for researchers', 'ongoing', 5, 5),
 (6, 'Virtual Reality Game', '2025-06-01', '2025-12-31', 'Creating a VR game for education', 'submitted', 6, 6),
 (7, 'Fitness Tracker App', '2025-02-02', '2025-02-08', 'Developing a fitness tracker mobile app', 'approved', 7, 7),
 (8, 'Online Learning Portal', '2025-08-01', '2026-01-31', 'Building an online learning portal for schools', 'ongoing', 8, 8);

INSERT INTO `project_timeline` (`timelineID`, `start_date`, `end_date`, `status`, `milestone_title`, `projectID`, `gantt_chart_pdf`, `flow_chart_pdf`) VALUES
 (1, '2025-01-01', '2025-01-31', 'in-progress', '', 1, NULL, NULL),
 (2, '2025-02-01', '2025-02-28', 'completed', '', 2, NULL, NULL),
 (3, '2025-03-01', '2025-03-31', 'not-started', '', 3, '1211103194.pdf', '1211103194.pdf'),
 (4, '2025-04-01', '2025-04-30', 'completed', '', 4, NULL, NULL),
 (5, '2025-05-01', '2025-05-31', 'not-started', '', 5, NULL, NULL),
 (6, '2025-06-01', '2025-06-30', 'in-progress', '', 6, NULL, NULL),
 (7, '2025-07-01', '2025-07-31', 'not-started', '', 7, NULL, NULL),
 (8, '2025-08-01', '2025-08-31', 'completed', '', 8, NULL, NULL);

INSERT INTO lecturer_project (projectID, lecturerID, lecturer_role) VALUES
(1, 9, 'supervisor'),
(2, 9, 'supervisor'),
(3, 9, 'supervisor'),
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

INSERT INTO `milestone` (`milestoneID`, `milestone_title`, `milestone_start_date`, `milestone_end_date`, `timelineID`, `milestone_description`) VALUES
 (1, 'Requirement Analysis', '2025-01-01', '2025-01-10', 1, 'Identify and gather detailed requirements from stakeholders, define project scope, objectives, and functional needs. Perform feasibility studies and document system requirements.'),
 (2, 'Design Phase', '2025-01-11', '2025-01-20', 2, 'Develop system architecture, create wireframes and prototypes, and define database schemas. Establish UI/UX design guidelines and finalize technical stack.'),
 (3, 'Prototype Development', '2025-01-21', '2025-01-30', 3, 'Build an initial prototype demonstrating core functionalities. Gather user feedback and make necessary improvements before full development.'),
 (4, 'Testing', '2025-02-01', '2025-02-10', 4, 'Conduct unit, integration, and system testing to identify and fix bugs. Perform user acceptance testing (UAT) to ensure the system meets business requirements.'),
 (5, 'Deployment', '2025-02-11', '2025-02-20', 5, 'Deploy the project to a staging or production environment. Ensure proper configuration, optimize performance, and conduct final security checks.'),
 (6, 'Documentation', '2025-03-01', '2025-03-10', 6, 'Prepare technical and user documentation, including API references, installation guides, and maintenance procedures. Ensure all aspects of the system are well documented.'),
 (7, 'Initial Review', '2025-03-11', '2025-03-20', 7, 'Conduct a preliminary evaluation of the project. Gather feedback from stakeholders, address potential issues, and refine the system before the final review.'),
 (8, 'Final Review', '2025-03-21', '2025-03-31', 8, 'Conduct the final project assessment, ensuring all requirements are met. Prepare final reports and demonstrate the system to stakeholders for approval.'),
 (17, 'create prototype', '2025-02-01', '2025-02-28', 8, 'aaa');

INSERT INTO `project_submission` (`project_submissionID`, `start_date`, `end_date`, `project_description`, `project_status`, `project_category`, `project_file`, `studentID`, `projectID`) VALUES
 (16, '0000-00-00', '2025-02-02', 'Developing an AI chatbot for customer service', 'submitted', 'final-report', '1211101935.pdf', 1, 1);

INSERT INTO `marksheet` (`marksheetID`, `total_score`, `date`, `projectID`) VALUES
 (1, 85, '2025-01-31 15:00:00', 1),
 (2, 90, '2025-02-28 15:00:00', 2);

INSERT INTO criteria_score (scoreID, score, criteria, comment, marksheetID, evaluatorID) VALUES
(2, 30, 'execution', 'Excellent execution of tasks', 1, 2),
(3, 20, 'report', 'Good but needs improvement', 2, 3);

INSERT INTO meeting (meetingID, date, start_time, end_time, mode, location, meeting_title, meeting_description, meeting_URL) VALUES
(1, '2025-01-10', '10:00:00', '11:00:00', 'online', NULL, 'Initial Project Discussion', 'Discuss project requirements and initial plans', 'https://example.com/meeting1'),
(2, '2025-02-15', '14:00:00', '15:00:00', 'physical', 'Room 101', 'Mid-Project Review', 'Review project progress and address any issues', NULL),
(3, '2025-03-20', '09:00:00', '10:00:00', 'online', NULL, 'Final Review Preparation', 'Prepare for the final project review', 'https://example.com/meeting3'),
(4, '2025-04-25', '13:00:00', '14:00:00', 'physical', 'Room 202', 'Project Wrap-Up', 'Discuss project completion and final deliverables', NULL),
(10, '2025-02-02', '12:30:00', '13:30:00', 'physical', 'Room 2002', 'FYP Meeting 1', 'Discuss project overview', ''),
(11, '2025-02-09', '09:00:00', '10:00:00', 'physical', 'Room 2002', 'Report Review', 'Review interim report and turnitin', '');

INSERT INTO users_meeting (userID, meetingID) VALUES
(1, 1),
(5, 1),
(9, 1),
(10, 1),
(2, 2),
(6, 2),
(11, 2),
(12, 2),
(3, 3),
(7, 3),
(13, 3),
(14, 3),
(4, 4),
(8, 4),
(12, 4),
(13, 4),
(1, 10),
(13, 10),
(4, 11),
(13, 11);

INSERT INTO meeting_log (meeting_logID, submission_date, file_path, status, comment, updated_at, meetingID, studentID, projectID, supervisorID) VALUES
(8, '2025-02-02 00:00:00', '4_4_MeetingLog.pdf', 'approved', '', '2025-02-02 12:05:42', 4, 4, 5, 13),
(9, '2025-02-02 00:00:00', '11_4_MeetingLog.pdf', 'pending', NULL, '2025-02-02 20:18:52', 11, 4, 5, 13);

INSERT INTO `presentation` (`presentationID`, `presentation_title`, `start_time`, `end_time`, `date`, `mode`, `location`, `presentation_URL`, `status`, `updated_at`, `projectID`) VALUES
 (1, 'Final Presentation', '10:00:00', '11:00:00', '2025-01-15', 'online', NULL, 'https://example.com/presentation1', 'scheduled', '2025-01-10 09:00:00', 1),
 (2, 'Final Presentation', '14:00:00', '15:00:00', '2025-03-15', 'physical', 'Room 101', NULL, 'scheduled', '2025-03-10 13:00:00', 2);

INSERT INTO group_chat(groupName, createdAt, createdBy) VALUES
('Student Chan Wai Ti', NOW(), 9);

INSERT INTO message(senderID, receiverID, groupID, messageContent, timeStamp) VALUES
(2, 9, NULL, 'Hello Sir.', '2025-01-01 09:00:00'),
(9, 2, NULL, 'Hello kid.', '2025-01-01 11:00:00'),
(2, NULL, 1, 'Do we have presentation today?', '2025-02-02 09:00:00'),
(3, NULL, 1, 'I dont think so bro.', '2025-02-03 11:00:00');

INSERT INTO user_group(userID, groupID) VALUES
(9,1),
(1,1),
(2,1),
(3,1);