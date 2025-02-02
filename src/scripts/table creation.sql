CREATE TABLE users (
  userID int(11) NOT NULL AUTO_INCREMENT
  , id varchar(10) NOT NULL
  , name varchar(100) NOT NULL
  , password varchar(255) NOT NULL
  , email varchar(100) NOT NULL
  , role enum('student', 'lecturer', 'admin') NOT NULL
  , filename varchar(50) DEFAULT 'Default_pfp.jpg'
  , PRIMARY KEY (userID)
);



CREATE TABLE lecturer (
  userID int(11) NOT NULL
  , lecturerID varchar(4) NOT NULL
  , position ENUM('Senior Lecturer', 'Associate Professor', 'Professor', 'Lecturer', 'Principal Lecturer') NOT NULL
  , PRIMARY KEY (userID)
  , FOREIGN KEY (userID) REFERENCES users(userID)
  ON DELETE CASCADE
);


CREATE TABLE student (
  userID int(11) NOT NULL
  , studentID varchar(10) NOT NULL
  , year int(11) NOT NULL
  , specialization enum(
    'Software Engineering'
    , 'Data Science'
    , 'Cybersecurity'
    , 'Game Development'
  ) NOT NULL
  , PRIMARY KEY (userID)
  , FOREIGN KEY (userID) REFERENCES users(userID)
  ON DELETE CASCADE
);


CREATE TABLE task (
  taskID int(11) NOT NULL AUTO_INCREMENT
  , taskName varchar(100) NOT NULL
  , taskDate date NOT NULL
  , userID int(11) NOT NULL
  , PRIMARY KEY (taskID)
  , FOREIGN KEY (userID) REFERENCES users(userID)
  ON DELETE CASCADE
);



CREATE TABLE announcement (
  announcementID int(11) NOT NULL AUTO_INCREMENT
  , datetime datetime NOT NULL
  , title varchar(255) NOT NULL
  , description text DEFAULT NULL
  , status enum('Active', 'Archived') DEFAULT NULL
  , userID int(11) NOT NULL
  , PRIMARY KEY (announcementID)
  , FOREIGN KEY (userID) REFERENCES users(userID)
  ON DELETE CASCADE
);


CREATE TABLE proposal (
  proposalID int(11) NOT NULL AUTO_INCREMENT
  , proposal_title varchar(100) NOT NULL
  , proposal_description text DEFAULT NULL
  , submission_date datetime NOT NULL
  , specialisation varchar(30) DEFAULT NULL
  , category enum(
    'application-based'
    , 'research-based'
    , 'application-research-based'
  ) NOT NULL
  , supervisorID int(11) NOT NULL
  , proposal_file varchar(255) DEFAULT NULL
  , PRIMARY KEY (proposalID)
  , FOREIGN KEY (supervisorID) REFERENCES lecturer(userID)
  ON DELETE CASCADE
);


CREATE TABLE proposal_status (
  proposal_statusID int(11) NOT NULL AUTO_INCREMENT
  , status enum('accepted', 'rejected', 'pending') NOT NULL
  , comment text DEFAULT NULL
  , updated_at datetime NOT NULL
  , proposalID int(11) NOT NULL
  , PRIMARY KEY (proposal_statusID)
  , FOREIGN KEY (proposalID) REFERENCES proposal(proposalID)
  ON DELETE CASCADE
);


CREATE TABLE project (
  projectID int(11) NOT NULL AUTO_INCREMENT
  , project_title varchar(100) NOT NULL
  , start_date date NOT NULL
  , end_date date DEFAULT NULL
  , project_description text NOT NULL
  , project_status enum('ongoing', 'submitted', 'approved') NOT NULL
  , studentID int(11) DEFAULT NULL
  , proposalID int(11) NOT NULL
  , PRIMARY KEY (projectID)
  , FOREIGN KEY (proposalID) REFERENCES proposal(proposalID)
  ON DELETE CASCADE
);


CREATE TABLE project_timeline (
  timelineID int(11) NOT NULL AUTO_INCREMENT
  , start_date date NOT NULL
  , end_date date NOT NULL
  , status enum('not-started', 'in-progress', 'completed') NOT NULL DEFAULT 'not-started'
  , milestone_title varchar(100) NOT NULL
  , projectID int(11) NOT NULL
  , gantt_chart_pdf varchar(255) DEFAULT NULL
  , flow_chart_pdf varchar(255) DEFAULT NULL
  , PRIMARY KEY (timelineID)
  , FOREIGN KEY (projectID) REFERENCES project(projectID)
  ON DELETE CASCADE
);


CREATE TABLE lecturer_project (
  projectID int(11) NOT NULL
  , lecturerID int(11) NOT NULL
  , lecturer_role enum('supervisor', 'moderator') NOT NULL
  , PRIMARY KEY (projectID, lecturerID)
  , FOREIGN KEY (projectID) REFERENCES project(projectID)
  ON DELETE CASCADE
  , FOREIGN KEY (lecturerID) REFERENCES lecturer(userID)
  ON DELETE CASCADE
);


CREATE TABLE milestone (
  milestoneID int(11) NOT NULL AUTO_INCREMENT
  , milestone_title varchar(100) NOT NULL
  , milestone_start_date date NOT NULL
  , milestone_end_date date NOT NULL
  , timelineID int(11) NOT NULL
  , milestone_description text DEFAULT NULL
  , PRIMARY KEY (milestoneID)
  , FOREIGN KEY (timelineID) REFERENCES project_timeline(timelineID)
  ON DELETE CASCADE
);


CREATE TABLE project_submission (
  project_submissionID int(11) NOT NULL AUTO_INCREMENT
  , start_date date NOT NULL
  , end_date date NOT NULL
  , project_description text NOT NULL
  , project_status varchar(50) NOT NULL
  , project_category varchar(50) NOT NULL
  , studentID int(11) NOT NULL
  , projectID int(11) NOT NULL
  , project_file varchar(255) NOT NULL
  , PRIMARY KEY (project_submissionID)
  , FOREIGN KEY (studentID) REFERENCES student(userID)
  ON DELETE CASCADE
  , FOREIGN KEY (projectID) REFERENCES project(projectID)
  ON DELETE CASCADE
);


CREATE TABLE marksheet (
  marksheetID int(11) NOT NULL AUTO_INCREMENT
  , total_score bigint(20) NOT NULL
  , date datetime NOT NULL
  , projectID int(11) NOT NULL
  , PRIMARY KEY (marksheetID)
  , FOREIGN KEY (projectID) REFERENCES project(projectID)
  ON DELETE CASCADE
);


CREATE TABLE criteria_score (
  scoreID int(11) NOT NULL AUTO_INCREMENT
  , score bigint(20) NOT NULL
  , criteria enum(
    'project_mgt'
    , 'execution'
    , 'report'
    , 'oral_presentation'
    , 'research_paper'
    , 'commercialization_prpsl'
    , 'poster_presentation'
  ) NOT NULL
  , comment text NOT NULL
  , marksheetID int(11) DEFAULT NULL
  , evaluatorID int(11) DEFAULT NULL
  , PRIMARY KEY (scoreID)
  , FOREIGN KEY (marksheetID) REFERENCES marksheet(marksheetID)
  ON DELETE SET NULL
  , FOREIGN KEY (evaluatorID) REFERENCES users(userID)
  ON DELETE SET NULL
);


CREATE TABLE meeting (
  meetingID int(11) NOT NULL AUTO_INCREMENT
  , date date NOT NULL
  , start_time time NOT NULL
  , end_time time NOT NULL
  , mode enum('online', 'physical') NOT NULL
  , location varchar(50) DEFAULT NULL
  , meeting_title varchar(100) NOT NULL
  , meeting_description text DEFAULT NULL
  , meeting_URL text DEFAULT NULL
  , PRIMARY KEY (meetingID)
);


CREATE TABLE users_meeting (
  userID int(11) NOT NULL
  , meetingID int(11) NOT NULL
  , PRIMARY KEY (userID, meetingID)
  , FOREIGN KEY (userID) REFERENCES users(userID)
  ON DELETE CASCADE
  , FOREIGN KEY (meetingID) REFERENCES meeting(meetingID)
  ON DELETE CASCADE
);


CREATE TABLE meeting_log (
  meeting_logID int(11) NOT NULL AUTO_INCREMENT
  , submission_date datetime NOT NULL
  , file_path varchar(255) NOT NULL
  , status enum('submitted', 'pending', 'rejected', 'approved') NOT NULL
  , comment text DEFAULT NULL
  , updated_at datetime NOT NULL
  , meetingID int(11) NOT NULL
  , studentID int(11) NOT NULL
  , projectID int(11) NOT NULL
  , supervisorID int(11) DEFAULT NULL
  , PRIMARY KEY (meeting_logID)
  , FOREIGN KEY (meetingID) REFERENCES meeting(meetingID)
  ON DELETE CASCADE
  , FOREIGN KEY (studentID) REFERENCES student(userID)
  ON DELETE CASCADE
  , FOREIGN KEY (projectID) REFERENCES project(projectID)
  ON DELETE CASCADE
  , FOREIGN KEY (supervisorID) REFERENCES lecturer(userID)
  ON DELETE SET NULL
);


CREATE TABLE presentation (
  presentationID int(11) NOT NULL AUTO_INCREMENT
  , presentation_title varchar(50) NOT NULL
  , start_time time NOT NULL
  , end_time time NOT NULL
  , date date NOT NULL
  , mode enum('online', 'physical') NOT NULL
  , location varchar(50) DEFAULT NULL
  , presentation_URL text DEFAULT NULL
  , status enum('scheduled', 'postponed', 'presented') NOT NULL
  , updated_at datetime NOT NULL
  , projectID int(11) NOT NULL
  , PRIMARY KEY (presentationID)
  , FOREIGN KEY (projectID) REFERENCES project(projectID)
  ON DELETE CASCADE
);




CREATE TABLE group_chat (
  groupID int(11) NOT NULL AUTO_INCREMENT
  , groupName varchar(255) NOT NULL
  , createdAt datetime NOT NULL
  , createdBy int(11) NOT NULL
  , PRIMARY KEY (groupID)
  , FOREIGN KEY (createdBy) REFERENCES users(userID)
  ON DELETE CASCADE
);


CREATE TABLE message (
  messageID int(11) NOT NULL AUTO_INCREMENT
  , senderID int(11) NOT NULL
  , receiverID int(11) NULL
  , groupID int(11) DEFAULT NULL
  , messageContent text NOT NULL
  , timeStamp datetime NOT NULL
  , PRIMARY KEY (messageID)
  , FOREIGN KEY (senderID) REFERENCES users(userID)
  ON DELETE CASCADE
  , FOREIGN KEY (receiverID) REFERENCES users(userID)
  ON DELETE CASCADE
  , FOREIGN KEY (groupID) REFERENCES group_chat(groupID)
  ON DELETE SET NULL
);


CREATE TABLE user_group (
  userID int(11) NOT NULL
  , groupID int(11) NOT NULL
  , PRIMARY KEY (userID, groupID)
  , FOREIGN KEY (userID) REFERENCES users(userID)
  ON DELETE CASCADE
  , FOREIGN KEY (groupID) REFERENCES group_chat(groupID)
  ON DELETE CASCADE
);