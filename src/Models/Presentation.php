<?php
namespace App\Models;

use App\Models\Db;

class Presentation {
    private $db;

    public function __construct(Db $db) {
        $this->db = $db;
    }

    // Create new presentation
    public function createPresentation($presentationTitle, $startTime, $endTime, $date, $mode, $location, $presentationURL, $status, $projectID) {
        // Escape inputs for security
        $presentationTitle = $this->db->escapeString($presentationTitle);
        $startTime = $this->db->escapeString($startTime);
        $endTime = $this->db->escapeString($endTime);
        $date = $this->db->escapeString($date);
        $mode = $this->db->escapeString($mode);
        $location = $this->db->escapeString($location);
        $presentationURL = $this->db->escapeString($presentationURL ?? '');
        $status = $this->db->escapeString($status);
        $projectID = $this->db->escapeString($projectID);

        // Insert the presentation data
        $sql = "INSERT INTO presentation (presentation_title, start_time, end_time, date, mode, location, presentation_URL, status, updated_at, projectID)
                VALUES ('$presentationTitle', '$startTime', '$endTime', '$date', '$mode', '$location', '$presentationURL', '$status', NOW(), '$projectID')";

        if ($this->db->query($sql)) {
            return "Presentation details inserted successfully.";
        } else {
            return "Error: " . $this->db->conn->error;
        }
    }

    public function getPresentationsByUserID($userID) {
        $userID = $this->db->escapeString($userID);

        $sql = "SELECT * FROM presentation WHERE projectID IN (SELECT projectID FROM project WHERE studentID = '$userID')";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function getAllPresentations() {
        $sql = "SELECT * FROM presentation";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    public function getPresentationByID($presentationID) {
        $presentationID = $this->db->escapeString($presentationID);
    
        $sql = "SELECT 
                    p.*, 
                    pr.projectID, 
                    pr.studentID, 
                    u1.name AS studentName,
                    lp.lecturerID AS moderatorID, 
                    u2.name AS moderatorName,
                    l2.userID AS supervisorID,
                    u3.name AS supervisorName
                FROM presentation p
                INNER JOIN project pr ON p.projectID = pr.projectID
                INNER JOIN users u1 ON pr.studentID = u1.userID
                LEFT JOIN lecturer_project lp ON pr.projectID = lp.projectID AND lp.lecturer_role = 'moderator'
                LEFT JOIN users u2 ON lp.lecturerID = u2.userID
                INNER JOIN lecturer_project l ON pr.projectID = l.projectID AND l.lecturer_role = 'supervisor'
                INNER JOIN lecturer l2 ON l.lecturerID = l2.userID
                LEFT JOIN users u3 ON l2.userID = u3.userID
                WHERE p.presentationID = '$presentationID'";
    
        $result = $this->db->query($sql);
    
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }    

    public function updatePresentationStatus($presentationID, $status) {
        $presentationID = $this->db->escapeString($presentationID);
        $status = $this->db->escapeString($status);

        $sql = "UPDATE presentation SET status = '$status' WHERE presentationID = '$presentationID'";

        if ($this->db->query($sql)) {
            return "Presentation status updated successfully.";
        } else {
            return "Error: " . $this->db->conn->error;
        }
    }
}
?>