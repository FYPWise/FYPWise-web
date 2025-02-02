CREATE TABLE `announcement` (
   `announcementID` int(11) NOT NULL,
   `datetime` datetime NOT NULL,
   `title` varchar(255) NOT NULL,
   `description` text DEFAULT NULL,
   `status` varchar(50) DEFAULT NULL,
   `userID` int(11) NOT NULL
 ); 

CREATE TABLE `criteria_score` (
   `scoreID` int(11) NOT NULL,
   `score` bigint(20) NOT NULL,
   `criteria` enum('project_mgt','execution','report','oral_presentation','research_paper','commercialization_prpsl','poster_presentation') NOT NULL,
   `comment` text NOT NULL,
   `marksheetID` int(11) DEFAULT NULL,
   `evaluatorID` int(11) DEFAULT NULL
 ); 

CREATE TABLE `group_chat` (
   `groupID` int(11) NOT NULL,
   `groupName` varchar(255) NOT NULL,
   `createdAt` datetime NOT NULL,
   `createdBy` int(11) NOT NULL
 ); 

CREATE TABLE `lecturer` (
   `userID` int(11) NOT NULL,
   `lecturerID` varchar(4) NOT NULL,
   `position` varchar(50) NOT NULL
 ); 

CREATE TABLE `lecturer_project` (
   `projectID` int(11) NOT NULL,
   `lecturerID` int(11) NOT NULL,
   `lecturer_role` enum('supervisor','moderator') NOT NULL
 ); 

CREATE TABLE `marksheet` (
   `marksheetID` int(11) NOT NULL,
   `total_score` bigint(20) NOT NULL,
   `date` datetime NOT NULL,
   `projectID` int(11) NOT NULL
 ); 

CREATE TABLE `meeting` (
   `meetingID` int(11) NOT NULL,
   `date` date NOT NULL,
   `start_time` time NOT NULL,
   `end_time` time NOT NULL,
   `mode` enum('online','physical') NOT NULL,
   `location` varchar(50) DEFAULT NULL,
   `meeting_title` varchar(100) NOT NULL,
   `meeting_description` text DEFAULT NULL,
   `meeting_URL` text DEFAULT NULL
 ); 

CREATE TABLE `meeting_log` (
   `meeting_logID` int(11) NOT NULL,
   `submission_date` datetime NOT NULL,
   `file_path` varchar(255) NOT NULL,
   `status` enum('submitted','pending','rejected','approved') NOT NULL,
   `comment` text DEFAULT NULL,
   `updated_at` datetime NOT NULL,
   `meetingID` int(11) NOT NULL,
   `studentID` int(11) NOT NULL,
   `projectID` int(11) NOT NULL,
   `supervisorID` int(11) DEFAULT NULL
 ); 

CREATE TABLE `message` (
   `messageID` int(11) NOT NULL,
   `senderID` int(11) NOT NULL,
   `receiverID` int(11) NOT NULL,
   `groupID` int(11) DEFAULT NULL,
   `messageContent` text NOT NULL,
   `timeStamp` datetime NOT NULL
 ); 

CREATE TABLE `milestone` (
   `milestoneID` int(11) NOT NULL,
   `milestone_title` varchar(100) NOT NULL,
   `milestone_start_date` date NOT NULL,
   `milestone_end_date` date NOT NULL,
   `timelineID` int(11) NOT NULL,
   `milestone_description` text DEFAULT NULL
 ); 

CREATE TABLE `presentation` (
   `presentationID` int(11) NOT NULL,
   `presentation_title` varchar(50) NOT NULL,
   `start_time` time NOT NULL,
   `end_time` time NOT NULL,
   `date` date NOT NULL,
   `mode` enum('online','physical') NOT NULL,
   `location` varchar(50) DEFAULT NULL,
   `presentation_URL` text DEFAULT NULL,
   `status` enum('scheduled','postponed','presented') NOT NULL,
   `updated_at` datetime NOT NULL,
   `projectID` int(11) NOT NULL
 ); 

CREATE TABLE `project` (
   `projectID` int(11) NOT NULL,
   `project_title` varchar(100) NOT NULL,
   `start_date` date NOT NULL,
   `end_date` date DEFAULT NULL,
   `project_description` text NOT NULL,
   `project_status` enum('ongoing','submitted','approved') NOT NULL,
   `studentID` int(11) DEFAULT NULL,
   `proposalID` int(11) NOT NULL
 ); 

CREATE TABLE `project_submission` (
   `project_submissionID` int(11) NOT NULL,
   `start_date` date NOT NULL,
   `end_date` date NOT NULL,
   `project_description` text NOT NULL,
   `project_status` varchar(50) NOT NULL,
   `project_category` varchar(50) NOT NULL,
   `studentID` int(11) NOT NULL,
   `projectID` int(11) NOT NULL,
   `project_file` varchar(255) NOT NULL
 ); 

CREATE TABLE `project_timeline` (
   `timelineID` int(11) NOT NULL,
   `start_date` date NOT NULL,
   `end_date` date NOT NULL,
   `status` enum('not-started','in-progress','completed') NOT NULL DEFAULT 'not-started',
   `milestone_title` varchar(100) NOT NULL,
   `projectID` int(11) NOT NULL,
   `gantt_chart_pdf` varchar(255) DEFAULT NULL,
   `flow_chart_pdf` varchar(255) DEFAULT NULL
 ); 

CREATE TABLE `proposal` (
   `proposalID` int(11) NOT NULL,
   `proposal_title` varchar(100) NOT NULL,
   `proposal_description` text DEFAULT NULL,
   `submission_date` datetime NOT NULL,
   `specialisation` varchar(30) DEFAULT NULL,
   `category` enum('application-based','research-based','application-research-based') NOT NULL,
   `supervisorID` int(11) NOT NULL,
   `proposal_file` varchar(255) DEFAULT NULL
 ); 

CREATE TABLE `proposal_status` (
   `proposal_statusID` int(11) NOT NULL,
   `status` enum('accepted','rejected','pending') NOT NULL,
   `comment` text DEFAULT NULL,
   `updated_at` datetime NOT NULL,
   `proposalID` int(11) NOT NULL
 ); 

CREATE TABLE `student` (
   `userID` int(11) NOT NULL,
   `studentID` varchar(10) NOT NULL,
   `year` int(11) NOT NULL,
   `specialization` enum('Software Engineering','Data Science','Cybersecurity','Game Development') NOT NULL
 ); 

CREATE TABLE `task` (
   `taskID` int(11) NOT NULL,
   `taskName` varchar(100) NOT NULL,
   `taskDate` date NOT NULL,
   `userID` int(11) NOT NULL
 ); 

CREATE TABLE `timeline_file` (
   `timeline_fileID` int(11) NOT NULL,
   `filename` varchar(50) NOT NULL,
   `file_type` varchar(10) NOT NULL,
   `file_size` bigint(20) NOT NULL,
   `file_category` enum('gantt_chart','flow_chart','others') NOT NULL,
   `file_path` varchar(255) NOT NULL,
   `uploaded_at` datetime NOT NULL,
   `edited_at` datetime DEFAULT NULL,
   `timeline_ID` int(11) NOT NULL
 ); 

CREATE TABLE `users` (
   `userID` int(11) NOT NULL,
   `id` varchar(10) NOT NULL,
   `name` varchar(100) NOT NULL,
   `password` varchar(255) NOT NULL,
   `email` varchar(100) NOT NULL,
   `role` enum('student','lecturer','admin') NOT NULL,
   `filename` varchar(50) DEFAULT 'Default_pfp.jpg'
 ); 

CREATE TABLE `users_meeting` (
   `userID` int(11) NOT NULL,
   `meetingID` int(11) NOT NULL
 ); 

CREATE TABLE `user_group` (
   `userID` int(11) NOT NULL,
   `groupID` int(11) NOT NULL
 ); 