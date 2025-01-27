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
    userID VARCHAR(10) NOT NULL,
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
    lecturerID VARCHAR(4) NOT NULL,
    position VARCHAR(50) NOT NULL,
    PRIMARY KEY (lecturerID)
);
-- --------------------------------------------------------

--
-- Table structure for table `student`
--
CREATE table student(
    studentID VARCHAR(10) NOT NULL,
    year INT NOT NULL,
    specialization VARCHAR(50) NOT NULL,
    PRIMARY KEY (studentID),
    FOREIGN KEY (studentID) REFERENCES users(userID)
);
-- --------------------------------------------------------

--
-- Table structure for table `task`
--
CREATE TABLE task (
    taskID INT NOT NULL AUTO_INCREMENT,
    taskName VARCHAR(100) NOT NULL,
    taskDate DATE NOT NULL,
    userID VARCHAR(10) NOT NULL,
    PRIMARY KEY (taskID),
    FOREIGN KEY (userID) REFERENCES users(userID)
);
-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

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
    supervisorID VARCHAR(4) NOT NULL,
    PRIMARY KEY (proposalID),
    FOREIGN KEY (supervisorID) REFERENCES lecturer(lecturerID)
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
    PRIMARY KEY (proposal_statusID),
    FOREIGN KEY (proposalID) REFERENCES proposal(proposalID)
);
-- --------------------------------------------------------

CREATE TABLE project (
    projectID INT NOT NULL PRIMARY KEY,
    project_title VARCHAR(100) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    project_description TEXT NOT NULL,
    project_status ENUM('ongoing', 'submitted', 'approved') NOT NULL,
    studentID VARCHAR(5) NOT NULL,
    proposalID VARCHAR(5) NOT NULL,
    supervisorID VARCHAR(4) NOT NULL,
    FOREIGN KEY (studentID) REFERENCES student(studentID),
    FOREIGN KEY (proposalID) REFERENCES proposal(proposalID),
    FOREIGN KEY (supervisorID) REFERENCES user(userID)
);

-- --------------------------------------------------------


CREATE TABLE project_timeline (
    timelineID INT NOT NULL PRIMARY KEY,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('pending', 'in-progress', 'completed') NOT NULL,
    projectID VARCHAR(6) NOT NULL,
    FOREIGN KEY (projectID) REFERENCES project(projectID)
);

--
-- Table structure for table `lecturer_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_timeline`
--

-- --------------------------------------------------------

CREATE TABLE milestone (
    milestoneID INT NOT NULL PRIMARY KEY,
    milestone_name VARCHAR(100) NOT NULL,
    milestone_start_date DATE NOT NULL,
    milestone_end_date DATE NOT NULL,
    timelineID VARCHAR(5) NOT NULL,
    FOREIGN KEY (timelineID) REFERENCES project_timeline(timelineID)
);

-- --------------------------------------------------------

CREATE TABLE timeline_file (
    timeline_fileID INT NOT NULL PRIMARY KEY,
    filename VARCHAR(50) NOT NULL,
    file_type VARCHAR(10) NOT NULL,
    file_size BIGINT NOT NULL,
    file_category ENUM('gantt_chart', 'flow_chart', 'others') NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    uploaded_at DATETIME NOT NULL,
    edited_at DATETIME,
    timeline_ID VARCHAR(5) NOT NULL,
    FOREIGN KEY (timeline_ID) REFERENCES project_timeline(timelineID)
);

-- --------------------------------------------------------

--
-- Table structure for table `project_submission`
--

-- --------------------------------------------------------

CREATE TABLE marksheet (
    marksheetID INT NOT NULL PRIMARY KEY,
    total_score BIGINT NOT NULL,
    date DATETIME NOT NULL,
    projectID VARCHAR(6) NOT NULL,
    FOREIGN KEY (projectID) REFERENCES project(projectID)
);

-- --------------------------------------------------------

CREATE TABLE criteria_score (
    scoreID INT NOT NULL PRIMARY KEY,
    score BIGINT NOT NULL,
    criteria ENUM('project_mgt', 'execution', 'report', 'oral_presentation', 
                  'research_paper', 'commercialization_prpsl', 
                  'poster_presentation') NOT NULL,
    comment TEXT NOT NULL,
    marksheetID VARCHAR(6) NOT NULL,
    evaluatorID VARCHAR(4) NOT NULL,
    FOREIGN KEY (marksheetID) REFERENCES marksheet(marksheetID),
    FOREIGN KEY (evaluatorID) REFERENCES user(userID)
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
    supervisorID INT NOT NULL,
    student_meetingID INT NOT NULL,
    PRIMARY KEY (meetingID),
    FOREIGN KEY (supervisorID) REFERENCES lecturer(lecturerID),
);
-- --------------------------------------------------------

--
-- Table structure for table `student_meeting`
--
CREATE TABLE student_meeting (
    meetingID INT NOT NULL,
    studentID INT NOT NULL,
    PRIMARY KEY (meetingID, studentID),
    FOREIGN KEY (meetingID) REFERENCES meeting(meetingID),
    FOREIGN KEY (studentID) REFERENCES student(studentID)
);
-- --------------------------------------------------------

--
-- Table structure for table `meeting_log`
--
CREATE TABLE meeting_log (
    meeting_logID INT NOT NULL AUTO_INCREMENT,
    submission_date DATETIME NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    status ENUM('submitted', 'pending', 'rejected', 'approved') NOT NULL,
    comment TEXT,
    updated_at DATETIME NOT NULL,
    meetingID INT NOT NULL,
    studentID INT NOT NULL,
    projectID INT NOT NULL,
    PRIMARY KEY (meeting_logID),
    FOREIGN KEY (meetingID) REFERENCES meeting(meetingID),
    FOREIGN KEY (studentID) REFERENCES student(studentID),
    FOREIGN KEY (projectID) REFERENCES project(projectID)
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
    location VARCHAR(50) NOT NULL,
    presentation_URL TEXT,
    status ENUM('scheduled', 'postponed', 'presented') NOT NULL,
    updated_at DATETIME NOT NULL,
    projectID INT NOT NULL,
    FOREIGN KEY (projectID) REFERENCES project(projectID)
);
-- --------------------------------------------------------

--
-- Table structure for table `message`
--

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

-- --------------------------------------------------------