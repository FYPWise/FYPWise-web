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
    status ENUM('application-based', 'research-based', 'application-research-based') NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `student_meeting`
--

-- --------------------------------------------------------

--
-- Table structure for table `meeting_log`
--

-- --------------------------------------------------------

--
-- Table structure for table `presentation`
--

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