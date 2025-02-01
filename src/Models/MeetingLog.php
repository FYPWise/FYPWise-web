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

    // Submit meeting log
    public function submitMeetingLog($supervisorID, $projectID, $meetingID, $fileInputName, $submissionDate) {
        // Escape inputs for security
        $supervisorID = $this->db->escapeString($supervisorID);
        $projectID = $this->db->escapeString($projectID);
        $meetingID = $this->db->escapeString($meetingID);
        $submissionDate = $this->db->escapeString($submissionDate);
        $studentID = $_SESSION['mySession'];
    
        // Handle file upload using the File class
        $targetDir = "uploads/";  
        $columnName = 'file_path'; 
        $tableName = 'meeting_log';
    
        // Check if the file input exists and handle the file upload
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
            $uploadSuccess = $this->uploadMLFile($fileInputName, $targetDir, $meetingID);
    
            if ($uploadSuccess) {
                // Insert the meeting log data
                $fileName = $uploadSuccess; // Use the file name returned from uploadMLFile
                $status = 'pending';  // Initial status == pending
                $sql = "INSERT INTO meeting_log (submission_date, file_path, status, updated_at, meetingID, studentID, projectID)
                        VALUES ('$submissionDate', '$fileName', '$status', NOW(), '$meetingID', '$studentID', '$projectID')";
    
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
}
?>