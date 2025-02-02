-- Set character encoding and collation to utf8mb4 for the connection
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Create a new database (optional)
CREATE DATABASE IF NOT EXISTS fypwise;

-- Select the database to work with
USE fypwise;

--
-- Database: `fypwise`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
CREATE table users(
    userID INT NOT NULL AUTO_INCREMENT,
    id VARCHAR(10) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL, -- Hashed password
    email VARCHAR(100) NOT NULL,
    role ENUM('student', 'lecturer', 'admin') NOT NULL,
    filename VARCHAR(50) DEFAULT 'Default_pfp.jpg',
    PRIMARY KEY (userID)
);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--
CREATE table lecturer(
    userID INT NOT NULL,
    lecturerID VARCHAR(4) NOT NULL UNIQUE,
    position ENUM('Senior Lecturer', 'Associate Professor', 'Professor', 'Lecturer', 'Principal Lecturer') NOT NULL,
    PRIMARY KEY (userID),
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE
);
-- --------------------------------------------------------

--
-- Table structure for table `student`
--
CREATE table student(
    userID INT NOT NULL,
    studentID VARCHAR(10) NOT NULL UNIQUE,
    year INT NOT NULL,
    specialization ENUM('Software Engineering', 'Data Science', 'Cybersecurity', 'Game Development') NOT NULL,
    PRIMARY KEY (userID),
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE
);
-- --------------------------------------------------------

--
-- Table structure for table `task`
--
CREATE TABLE task (
    taskID INT NOT NULL AUTO_INCREMENT,
    taskName VARCHAR(100) NOT NULL,
    taskDate DATE NOT NULL,
    userID INT NOT NULL,
    PRIMARY KEY (taskID),
    FOREIGN KEY (userID) REFERENCES users(userID) ON DELETE CASCADE
);
-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--
CREATE TABLE announcement (
    announcementID INT AUTO_INCREMENT PRIMARY KEY,
    datetime DATETIME NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status VARCHAR(50),
    userID INT NOT NULL,
    FOREIGN KEY (userID) REFERENCES `users`(userID)
);
-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--
CREATE TABLE proposal (
    proposalID INT NOT NULL AUTO_INCREMENT,
    proposal_title VARCHAR(100) NOT NULL,
    proposal_description TEXT,
    submission_date DATETIME NOT NULL,
    specialisation VARCHAR(30),
    category ENUM('application-based', 'research-based', 'application-research-based') NOT NULL,
    supervisorID INT NOT NULL,
    PRIMARY KEY (proposalID),
    FOREIGN KEY (supervisorID) REFERENCES lecturer(userID)
);
-- --------------------------------------------------------

--
-- Table structure for table `proposal_status`
--
CREATE TABLE proposal_status (
    proposal_statusID INT NOT NULL AUTO_INCREMENT,
    status ENUM('accepted', 'rejected', 'pending') NOT NULL,
    comment TEXT,
    updated_at DATETIME NOT NULL,
    proposalID INT NOT NULL,
    PRIMARY KEY (proposal_statusID),
    FOREIGN KEY (proposalID) REFERENCES proposal(proposalID)
);
-- --------------------------------------------------------

--
-- Table structure for table `project`
--
CREATE TABLE project (
    projectID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    project_title VARCHAR(100) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    project_description TEXT NOT NULL,
    project_status ENUM('ongoing', 'submitted', 'approved') NOT NULL,
    studentID INT,
    proposalID INT NOT NULL,
    FOREIGN KEY (studentID) REFERENCES student(userID),
    FOREIGN KEY (proposalID) REFERENCES proposal(proposalID)
);

-- --------------------------------------------------------

--
-- Table structure for table `project_timeline`
--
CREATE TABLE project_timeline (
    timelineID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('pending', 'in-progress', 'completed') NOT NULL,
    projectID INT NOT NULL,
    FOREIGN KEY (projectID) REFERENCES project(projectID)
);
-- --------------------------------------------------------

--
-- Table structure for table `lecturer_project`
--
CREATE TABLE lecturer_project (
    projectID INT NOT NULL,
    lecturerID INT NOT NULL,
    lecturer_role ENUM('supervisor', 'moderator') NOT NULL,
    PRIMARY KEY (projectID, lecturerID),
    FOREIGN KEY (projectID) REFERENCES project(projectID),
    FOREIGN KEY (lecturerID) REFERENCES lecturer(userID)
);

-- --------------------------------------------------------

--
-- Table structure for table `milestone`
--
CREATE TABLE milestone (
    milestoneID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    milestone_name VARCHAR(100) NOT NULL,
    milestone_start_date DATE NOT NULL,
    milestone_end_date DATE NOT NULL,
    timelineID INT NOT NULL,
    FOREIGN KEY (timelineID) REFERENCES project_timeline(timelineID)
);

-- --------------------------------------------------------

--
-- Table structure for table `timeline_file`
--
CREATE TABLE timeline_file (
    timeline_fileID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    filename VARCHAR(50) NOT NULL,
    file_type VARCHAR(10) NOT NULL,
    file_size BIGINT NOT NULL,
    file_category ENUM('gantt_chart', 'flow_chart', 'others') NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    uploaded_at DATETIME NOT NULL,
    edited_at DATETIME,
    timeline_ID INT NOT NULL,
    FOREIGN KEY (timeline_ID) REFERENCES project_timeline(timelineID)
);

-- --------------------------------------------------------

--
-- Table structure for table `project_submission`
--
CREATE TABLE project_submission (
    project_submissionID INT AUTO_INCREMENT PRIMARY KEY,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    project_description TEXT NOT NULL,
    project_status VARCHAR(50) NOT NULL,
    project_category VARCHAR(50) NOT NULL,
    project_file VARCHAR(255) NOT NULL,
    studentID INT NOT NULL,
    projectID INT NOT NULL,
    FOREIGN KEY (studentID) REFERENCES student(userID),
    FOREIGN KEY (projectID) REFERENCES project(projectID)
);
-- --------------------------------------------------------

--
-- Table structure for table `marksheet`
--
CREATE TABLE marksheet (
    marksheetID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    total_score BIGINT NOT NULL,
    date DATETIME NOT NULL,
    projectID INT NOT NULL,
    FOREIGN KEY (projectID) REFERENCES project(projectID)
);

-- --------------------------------------------------------

--
-- Table structure for table `criteria_score`
--
CREATE TABLE criteria_score (
    scoreID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    score BIGINT NOT NULL,
    criteria ENUM('project_mgt', 'execution', 'report', 'oral_presentation', 
                  'research_paper', 'commercialization_prpsl', 
                  'poster_presentation') NOT NULL,
    comment TEXT NOT NULL,
    marksheetID INT NOT NULL,
    evaluatorID INT NOT NULL,
    FOREIGN KEY (marksheetID) REFERENCES marksheet(marksheetID),
    FOREIGN KEY (evaluatorID) REFERENCES users(userID)
);

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--
CREATE TABLE meeting (
    meetingID INT NOT NULL AUTO_INCREMENT,
    date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    mode ENUM('online', 'physical') NOT NULL,
    location VARCHAR(50),
    meeting_title VARCHAR(100) NOT NULL,
    meeting_description TEXT,
    meeting_URL TEXT,
    PRIMARY KEY (meetingID)
);
-- --------------------------------------------------------

--
-- Table structure for table `users_meeting`
--
CREATE TABLE users_meeting (
    userID INT NOT NULL,
    meetingID INT NOT NULL,
    PRIMARY KEY (meetingID, userID),
    FOREIGN KEY (meetingID) REFERENCES meeting(meetingID),
    FOREIGN KEY (userID) REFERENCES users(userID)
);
-- --------------------------------------------------------

--
-- Table structure for table `meeting_log`
--
CREATE TABLE meeting_log (
    meeting_logID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    submission_date DATETIME NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    status ENUM('submitted', 'pending', 'rejected', 'approved') NOT NULL,
    comment TEXT,
    updated_at DATETIME NOT NULL,
    meetingID INT NOT NULL,
    studentID INT NOT NULL,
    projectID INT NOT NULL,
    supervisorID INT NOT NULL,
    FOREIGN KEY (meetingID) REFERENCES meeting(meetingID),
    FOREIGN KEY (studentID) REFERENCES student(userID),
    FOREIGN KEY (projectID) REFERENCES project(projectID),
    FOREIGN KEY (supervisorID) REFERENCES lecturer(userID)
);
-- --------------------------------------------------------

--
-- Table structure for table `presentation`
--
CREATE TABLE presentation (
    presentationID INT AUTO_INCREMENT PRIMARY KEY,
    presentation_title VARCHAR(50) NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    date DATE NOT NULL,
    mode ENUM('online', 'physical') NOT NULL,
    location VARCHAR(50),
    presentation_URL TEXT,
    status ENUM('scheduled', 'postponed', 'presented') NOT NULL,
    updated_at DATETIME NOT NULL,
    projectID INT NOT NULL,
    FOREIGN KEY (projectID) REFERENCES project(projectID)
);
-- --------------------------------------------------------

--
-- Table structure for table `group`
--
CREATE TABLE group_chat (
    groupID INT AUTO_INCREMENT PRIMARY KEY,
    groupName VARCHAR(255) NOT NULL,
    createdAt DATETIME NOT NULL,
    createdBy INT NOT NULL,
    FOREIGN KEY (createdBy) REFERENCES users(userID)
);
-- --------------------------------------------------------

--
-- Table structure for table `message`
--
CREATE TABLE message (
    messageID INT AUTO_INCREMENT PRIMARY KEY,
    senderID INT NOT NULL,
    receiverID INT,
    groupID INT,
    messageContent TEXT NOT NULL,
    timeStamp DATETIME NOT NULL,
    FOREIGN KEY (senderID) REFERENCES users(userID),
    FOREIGN KEY (receiverID) REFERENCES users(userID),
    FOREIGN KEY (groupID) REFERENCES group_chat(groupID)
);

-- --------------------------------------------------------
--
-- Table structure for table `user_group`
--
CREATE TABLE user_group (
    userID INT NOT NULL,
    groupID INT NOT NULL,
    PRIMARY KEY (userID, groupID),
    FOREIGN KEY (userID) REFERENCES users(userID),
    FOREIGN KEY (groupID) REFERENCES group_chat(groupID)
);
-- --------------------------------------------------------