<?php
namespace App\Models;

use App\Models\Db;
use App\Models\File;

class MeetingLog {
    private $db;
    private $file;

    public function __construct(Db $db) {
        $this->db = $db;
        $this->file = new File();
    }

    // Retrieve meeting logs by userID
    public function getMeetingLogsByUserID($userID) {
        $userID = $this->db->escapeString($userID);
        $sql = "SELECT * FROM meeting_log WHERE studentID = '$userID'";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // Retrieve meeting logs by userID (supervisor)
    public function getMeetingLogsBySupervisorID($supervisorID) {
        $supervisorID = $this->db->escapeString($supervisorID);
        $sql = "SELECT * FROM meeting_log WHERE supervisorID = '$supervisorID'";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    // Submit meeting log
    public function submitMeetingLog($supervisorID, $projectID, $meetingID, $fileInputName, $submissionDate) {
        // Escape inputs for security
        $supervisorID = $this->db->escapeString($supervisorID);
        $projectID = $this->db->escapeString($projectID);
        $meetingID = $this->db->escapeString($meetingID);
        $submissionDate = $this->db->escapeString($submissionDate);
        $studentID = $_SESSION['mySession'];
    
        // Handle file upload using the File class
        $targetDir = "uploads/meeting-logs/";  
    
        // Check if the file input exists and handle the file upload
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
            $uploadSuccess = $this->uploadMLFile($fileInputName, $targetDir, $meetingID);
    
            if ($uploadSuccess) {
                // Insert the meeting log data
                $fileName = $uploadSuccess; // Use the file name returned from uploadMLFile
                $status = 'pending';  // Initial status == pending
                $sql = "INSERT INTO meeting_log (submission_date, file_path, status, updated_at, meetingID, studentID, projectID, supervisorID)
                        VALUES ('$submissionDate', '$fileName', '$status', NOW(), '$meetingID', '$studentID', '$projectID', '$supervisorID')";
    
                if ($this->db->query($sql)) {
                    return "Meeting log submitted successfully.";
                } else {
                    return "Error: " . $this->db->conn->error;
                }
            } else {
                return "File upload failed.";
            }
        } else {
            return "No file uploaded or there was an error with the file upload.";
        }
    }    

    // Handle file upload
    private function uploadMLFile($fileInputName, $targetDir, $meetingID) {
        if (isset($_FILES[$fileInputName])) {
            $file = $_FILES[$fileInputName];
            $fileType = pathinfo($file["name"], PATHINFO_EXTENSION);

            // Ensure file is either PDF or image
            if ($fileType == "pdf" || $fileType == "png" || $fileType == "jpg" || $fileType == "jpeg") {
                $studentId = $_SESSION['mySession'];
                $fileName = $meetingID."_". $studentId . "_MeetingLog"."." . $fileType;
                $target = $targetDir . $fileName;

                // Move uploaded file
                if (move_uploaded_file($file["tmp_name"], $target)) {
                    return $fileName; // Return the file name to be used in the database insert
                } else {
                    return false;
                }
            } else {
                return false; // Invalid file type
            }
        }
        return false; // No file uploaded
    }

    // Retrieve meeting log details by meeting_logID
    public function getMeetingLogDetails($meeting_logID) {
        $meeting_logID = $this->db->escapeString($meeting_logID);
        $sql = "SELECT * FROM meeting_log WHERE meeting_logID = '$meeting_logID'";
        $result = $this->db->query($sql);
    
        if (!$result) {
            die("Database error: " . $this->db->conn->error);
        }
    
        $data = $result->fetch_assoc();
        if (!$data) {
            die("No meeting log found for ID: " . htmlspecialchars($meeting_logID));
        }
        
        return $data;
    }
    

    // Update meeting log status & comment
    public function updateMeetingLogStatus($meeting_logID, $status, $comment) {
        $meeting_logID = $this->db->escapeString($meeting_logID);
        $status = $this->db->escapeString($status);
        $comment = $this->db->escapeString($comment);
        $sql = "UPDATE meeting_log SET status = '$status', comment = '$comment' WHERE meeting_LogID = '$meeting_logID'";
        return $this->db->query($sql);
    }
}
?>