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

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
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
)
-- --------------------------------------------------------

--
-- Table structure for table `proposal_status`
--
CREATE TABLE proposal (
    proposal_statusID INT NOT NULL AUTO_INCREMENT,
    status ENUM('accepted', 'rejected', 'pending') NOT NULL,
    comment TEXT,
    updated_at DATETIME NOT NULL,
    PRIMARY KEY (proposal_statusID),
    FOREIGN KEY (proposalID) REFERENCES proposal(proposalID)
)
-- --------------------------------------------------------

--
-- Table structure for table `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_timeline`
--

-- --------------------------------------------------------

--
-- Table structure for table `milestone`
--

-- --------------------------------------------------------

--
-- Table structure for table `timeline_file`
--

-- --------------------------------------------------------

--
-- Table structure for table `project_submission`
--

-- --------------------------------------------------------

--
-- Table structure for table `marksheet`
--

-- --------------------------------------------------------

--
-- Table structure for table `criteria_score`
--

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
    meeting_description TEXT NOT NULL,
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
    comment TEXT NOT NULL,
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