<?php
namespace App\Models;

use App\Models\Db;
use App\Models\User;

class Project {
    private $db;

    public function __construct(Db $db) {
        $this->db = $db;
    }

    public function getAllProjects() {
        $sql = "SELECT 
                    p.projectID,
                    p.project_title,
                    p.project_description,
                    p.start_date,
                    p.end_date,
                    CASE 
                        WHEN u_student.name IS NOT NULL THEN u_student.name
                        WHEN s.userID IS NOT NULL THEN 'Unknown Student'
                        ELSE 'Unassigned'
                    END AS student_name,
                    u_supervisor.name AS supervisor_name,
                    p.project_status,
                    p.proposalID
                FROM 
                    project p
                LEFT JOIN 
                    student s ON p.studentID = s.userID
                LEFT JOIN 
                    users u_student ON s.userID = u_student.userID  
                LEFT JOIN 
                    proposal pr ON p.proposalID = pr.proposalID
                LEFT JOIN 
                    lecturer l ON pr.supervisorID = l.userID
                LEFT JOIN 
                    users u_supervisor ON l.userID = u_supervisor.userID 
                ORDER BY 
                    p.projectID ASC";
    
        $result = $this->db->query($sql);
    
        if (!$result) {
            throw new \Exception("Database query failed: " . mysqli_error($this->db->conn));
        }
    
        $projects = [];
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    
        return $projects;
    }
    

    public function getProjectById($projectID) {
        $sql = "SELECT 
                    p.projectID,
                    p.project_title,
                    p.project_description,
                    p.start_date,
                    p.end_date,
                    COALESCE(s.name, 'Unassigned') AS student_name,
                    u.name AS supervisor_name,
                    p.project_status,
                    u_moderator.name AS moderator_name
                FROM 
                    project p
                LEFT JOIN 
                    student s ON p.studentID = s.userID
                LEFT JOIN 
                    users u_student ON s.userID = u_student.userID 
                LEFT JOIN 
                    proposal pr ON p.proposalID = pr.proposalID
                LEFT JOIN 
                    lecturer l ON pr.supervisorID = l.userID
                LEFT JOIN 
                    users u ON l.userID = u.userID
                WHERE p.projectID = ?;";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $projectID);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } else {
            throw new \Exception("Database query failed: " . mysqli_error($this->db->conn));
        }
    }



    // Add a new project
    public function addProject($title, $description, $start_date, $end_date, $supervisorID) {
        $sql = "INSERT INTO project (project_title, project_description, start_date, end_date, supervisorID) VALUES (?, ?, ?, ?, ?);";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssi", $title, $description, $start_date, $end_date, $supervisorID);
        $stmt->execute();
        $projectId = $stmt->insert_id;
        $timelineSql = "(`start_date`, `end_date`, `status`, `projectID`, `gantt_chart_pdf`, `flow_chart_pdf`) VALUES ('$start_date', '$end_date', 'pending', $projectId);";
    }

    // Update an existing project
    public function updateProject($projectID, $title, $description, $start_date, $end_date, $supervisorID) {
        $sql = "UPDATE project SET project_title = ?, project_description = ?, start_date = ?, end_date = ?, supervisorID = ? WHERE projectID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssii", $title, $description, $start_date, $end_date, $supervisorID, $projectID);
        return $stmt->execute();
    }

    // Delete a project
    public function deleteProject($projectID) {
        $sql = "DELETE FROM project WHERE projectID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $projectID);
        return $stmt->execute();
    }

    // Retrieve all milestones by project ID
    public function getMilestonesByProject($projectID) {
        $sql = "SELECT * FROM milestone WHERE projectID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $projectID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Retrieve all milestones
    public function getAllMilestones() {
        $sql = "SELECT * FROM milestone ORDER BY milestoneID ASC";
        $result = $this->db->query($sql);
    
        if (!$result) {
            throw new \Exception("Database Query Failed");
        }
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Add a new milestone
    public function addMilestone($projectID, $description, $start_date, $end_date) {
        $sql = "INSERT INTO milestone (projectID, description, start_date, end_date) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isss", $projectID, $description, $start_date, $end_date);
        return $stmt->execute();
    }

    // Update milestone status
    public function updateMilestoneStatus($milestoneID, $status) {
        $sql = "UPDATE project_timeline SET status = ? WHERE timelineID = ?";
        
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("si", $status, $milestoneID);
            return $stmt->execute();
        } else {
            throw new \Exception("Database query failed: " . $this->db->getError());
        }
    }

    // Retrieve all project assignments
    public function getAllProjectAssignments() {
        $sql = "SELECT * FROM student_project_assignment ORDER BY assignmentID ASC";
        $result = $this->db->query($sql);
    
        if (!$result) {
            throw new \Exception("Database Query Failed");
        }
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Assign a student to a project
    public function assignStudentToProject($studentID, $projectID) {
        $sql = "INSERT INTO student_project_assignment (studentID, projectID) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $studentID, $projectID);
        return $stmt->execute();
    }

    // Update project approval status
    public function updateProjectApprovalStatus($projectID, $status) {
        $sql = "UPDATE project_status SET status = ? WHERE projectID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $status, $projectID);
        return $stmt->execute();
    }
    public function updateProjectAssignment($projectID, $startDate, $endDate, $userID) {
        $sql = "UPDATE project 
                SET start_date = ?, end_date = ?, studentID = ? 
                WHERE projectID = ?";
    
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("ssii", $startDate, $endDate, $userID, $projectID);
    
            if ($stmt->execute()) {
                echo "<pre>✅ SUCCESS: Project updated successfully!</pre>";
                return true;
            } else {
                echo "<pre>❌ ERROR: SQL execution failed - " . $stmt->error . "</pre>";
            }
        } else {
            echo "<pre>❌ ERROR: Query preparation failed - " . $this->db->getError() . "</pre>";
        }
        return false;
    }
    
    
    public function getAllProjectTimelines() {
        $sql = "SELECT 
                    pt.timelineID,
                    pt.start_date,
                    pt.end_date,
                    pt.status,
                    m.milestone_title,
                    COALESCE(u_student.name, 'Unassigned') AS student_name
                FROM project_timeline pt
                LEFT JOIN milestone m ON pt.timelineID = m.timelineID
                LEFT JOIN project p ON pt.projectID = p.projectID
                LEFT JOIN student s ON p.studentID = s.userID
                LEFT JOIN users u_student ON s.userID = u_student.userID
                ORDER BY pt.start_date ASC";
    
        $result = $this->db->query($sql);
    
        if (!$result) {
            throw new \Exception("Database query failed: " . mysqli_error($this->db->conn));
        }
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    

    // Upload Gantt Chart & Flow Chart PDFs
    public function uploadProjectFiles($timelineID, $ganttChartPath, $flowChartPath) {
        $sql = "UPDATE project_timeline 
                SET gantt_chart_pdf = ?, flow_chart_pdf = ? 
                WHERE timelineID = ?";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("ssi", $ganttChartPath, $flowChartPath, $timelineID);
            return $stmt->execute();
        } else {
            throw new \Exception("Error updating project files: " . $this->db->getError());
        }
    }
    
    public function getMilestoneByID($milestoneID) {
        $sql = "SELECT milestoneID, milestone_title, milestone_description, milestone_start_date, milestone_end_date 
                FROM milestone 
                WHERE milestoneID = ?";
        
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $milestoneID);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } else {
            throw new \Exception("Database query failed: " . $this->db->getError());
        }
    }
    
    
    public function saveMilestone($milestoneTitle, $milestoneDescription, $startDate, $endDate, $timelineID) {
        $sql = "INSERT INTO milestone (milestone_title, milestone_description, milestone_start_date, milestone_end_date, timelineID) 
                VALUES (?, ?, ?, ?, ?)";
    
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("ssssi", $milestoneTitle, $milestoneDescription, $startDate, $endDate, $timelineID);
            if ($stmt->execute()) {
                return true;
            } else {
                die("<pre>❌ ERROR: SQL execution failed - " . $stmt->error . "</pre>");
            }
        } else {
            die("<pre>❌ ERROR: Query preparation failed - " . $this->db->getError() . "</pre>");
        }
    }
    
    
    
    public function getNextMilestoneID() {
        $sql = "SELECT MAX(milestoneID) AS lastID FROM milestone";
        $result = $this->db->query($sql);
    
        if ($row = $result->fetch_assoc()) {
            return $row['lastID'] ? $row['lastID'] + 1 : 1; // Start from 1 if no milestones exist
        }
        return 1;
    }
    
    

    public function getSubmittedMilestones($userId=null) {


        $sql = "SELECT 
                    m.milestoneID, 
                    m.milestone_title,  
                    m.milestone_description,  
                    m.milestone_start_date, 
                    m.milestone_end_date,
                    COALESCE(pt.status, 'not-started') AS status 
                FROM milestone m
                LEFT JOIN project_timeline pt ON m.timelineID = pt.timelineID
                ORDER BY m.milestoneID ASC";  // Ensure all milestones are retrieved

        if ($userId !== null){
            $sql = "SELECT m.milestoneID, 
                        m.milestone_description, 
                        m.milestone_start_date, 
                        m.milestone_end_date
                    FROM milestone m
                    JOIN project_timeline pt ON m.timelineID = pt.timelineID
                    JOIN project p ON pt.projectID = p.projectID
                    WHERE p.studentID = '$userId';";
        }
        
        $result = $this->db->query($sql);
        
        if (!$result) {
            throw new \Exception("Database query failed: " . mysqli_error($this->db->conn));
        }
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    

public function getTimelineFiles()
{
    $sql = "SELECT timeline_ID, filename, file_category, file_path, uploaded_at 
            FROM timeline_file 
            ORDER BY uploaded_at DESC";

    $result = $this->db->query($sql);

    if (!$result) {
        throw new \Exception("Database query failed: " . mysqli_error($this->db->conn));
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

public function getStudentIDByUserID($studentID) {
    $sql = "SELECT studentID FROM student WHERE studentID = ?";

    if ($stmt = $this->db->prepare($sql)) {
        $stmt->bind_param("s", $studentID); 
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row ? $row['studentID'] : null;
    } else {
        throw new \Exception("Database query failed: " . $this->db->getError());
    }
}

public function getUserIDByStudentID($studentID) {
    $sql = "SELECT userID FROM student WHERE studentID = ?";

    if ($stmt = $this->db->prepare($sql)) {
        $stmt->bind_param("s", $studentID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row ? $row['userID'] : null;
    } else {
        throw new \Exception("Database query failed: " . $this->db->getError());
    }
}

public function updateProjectTimelineStatus($timelineID, $status) {
    $sql = "UPDATE project_timeline SET status = ? WHERE timelineID = ?";

    if ($stmt = $this->db->prepare($sql)) {
        $stmt->bind_param("si", $status, $timelineID);

        if ($stmt->execute()) {
            // Fetch the updated row to confirm the update
            $check_sql = "SELECT status FROM project_timeline WHERE timelineID = ?";
            $check_stmt = $this->db->prepare($check_sql);
            $check_stmt->bind_param("i", $timelineID);
            $check_stmt->execute();
            $result = $check_stmt->get_result();
            $updated_row = $result->fetch_assoc();

            echo "<pre>✅ SUCCESS: Timeline ID $timelineID updated to $status</pre>";
            echo "<pre>🔍 CHECK: New status in DB: " . ($updated_row['status'] ?? 'Not Found') . "</pre>";

            return true;
        } else {
            echo "<pre>❌ ERROR: SQL execution failed - " . $stmt->error . "</pre>";
        }
    } else {
        echo "<pre>❌ ERROR: Query preparation failed - " . $this->db->getError() . "</pre>";
    }
    return false;
}

public function getLatestTimelineID() {
    $sql = "SELECT timelineID FROM project_timeline ORDER BY timelineID DESC LIMIT 1";
    $result = $this->db->query($sql);
    $row = $result->fetch_assoc();
    return $row ? $row['timelineID'] : null;
}

public function createNewProject($proposalID, $projectTitle, $startDate, $endDate, $projectDescription) {
    $sql = "INSERT INTO project (proposalID, project_title, start_date, end_date, project_description, project_status) 
            VALUES (?, ?, ?, ?, ?, 'approved')";
    
    if ($stmt = $this->db->prepare($sql)) {
        $stmt->bind_param("issss", $proposalID, $projectTitle, $startDate, $endDate, $projectDescription);
        return $stmt->execute();
    } else {
        return false;
    }
}


public function getAcceptedProposals() {
    $sql = "
        SELECT p.proposalID, p.proposal_title, ps.status 
        FROM proposal p
        JOIN proposal_status ps ON p.proposalID = ps.proposalID
        WHERE ps.status = 'accepted'
    ";
    return $this->db->query($sql);
}

public function createProject($proposalID, $projectTitle, $startDate, $endDate, $projectDescription) {
    if (empty($proposalID) || $proposalID == 0) {
        throw new \Exception("❌ Error: Proposal ID cannot be empty.");
    }

    $sql = "INSERT INTO project (proposalID, project_title, start_date, end_date, project_description, project_status) 
            VALUES (?, ?, ?, ?, ?, 'approved')";
    
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("issss", $proposalID, $projectTitle, $startDate, $endDate, $projectDescription);
    
    return $stmt->execute();
}


public function assignAdvisee($projectID, $studentID) {
    $sql = "UPDATE project SET studentID = ?, project_status = 'ongoing' WHERE projectID = ?";
    
    if ($stmt = $this->db->prepare($sql)) {
        $stmt->bind_param("ii", $studentID, $projectID);
        return $stmt->execute();
    } else {
        return false;
    }
}

public function submitFinalReport($projectID) {
    $sql = "UPDATE project SET project_status = 'submitted' WHERE projectID = ?";
    
    if ($stmt = $this->db->prepare($sql)) {
        $stmt->bind_param("i", $projectID);
        return $stmt->execute();
    } else {
        return false;
    }
}

public function getModerator($id){
    $sql = "SELECT lp.lecturerID
            FROM `lecturer_project`lp
            JOIN project p ON lp.projectID = p.projectID
            WHERE p.projectID = $id ;";

    $result = $this->db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_array();
        $user = new User();
        $user->readUserId($row[0]);

        return $user->getId();
    }else{
        return null;
    }
}

public function assignModerator($id, $projectID){
    $user = new User();

    if($user->readId($id) && $user->getRole() == "lecturer"){
        $userID = $user->getUserID();

        $sql = "INSERT INTO `lecturer_project`(`projectID`, `lecturerID`, `lecturer_role`) VALUES ('$projectID','$userID','moderator')";

        $result = $this->db->query($sql);

        if ($result){
            return true;
        }else{
            return "sql error";
        }
    }else{
        return $user->getRole();
    }

    
}


}
