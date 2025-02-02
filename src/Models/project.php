<?php
namespace App\Models;

use App\Models\Db;

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
                    COALESCE(u_student.name, 'Unassigned') AS student_name,
                    u_supervisor.name AS supervisor_name,
                    p.project_status
                FROM 
                    project p
                LEFT JOIN 
                    student s ON p.studentID = s.userID
                LEFT JOIN 
                    users u_student ON s.userID = u_student.userID  -- Fetch student name correctly
                LEFT JOIN 
                    proposal pr ON p.proposalID = pr.proposalID
                LEFT JOIN 
                    lecturer l ON pr.supervisorID = l.userID
                LEFT JOIN 
                    users u_supervisor ON l.userID = u_supervisor.userID -- Fetch supervisor name correctly
                ORDER BY 
                    p.projectID ASC;";
    
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
                    proposal pr ON p.proposalID = pr.proposalID
                LEFT JOIN 
                    lecturer l ON pr.supervisorID = l.userID
                LEFT JOIN 
                    users u ON l.userID = u.userID
                LEFT JOIN
                    lecturer_project lp ON p.projectID = lp.projectID
                LEFT JOIN
                    users u_moderator ON lp.lecturerID = u_moderator.userID
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
        $sql = "INSERT INTO project (project_title, project_description, start_date, end_date, supervisorID) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssi", $title, $description, $start_date, $end_date, $supervisorID);
        return $stmt->execute();
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
        $sql = "UPDATE milestone SET status = ? WHERE milestoneID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $status, $milestoneID);
        return $stmt->execute();
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
}
