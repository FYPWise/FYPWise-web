<?php
namespace App\Models;

use App\Models\Db;

class FinalSubmissionModel {
    private $db;

    public function __construct() {
        $this->db = new Db();
    }
    
    public function submitFinalReport() {
        if (isset($_POST['submit_report'])){
            $userID = $_SESSION['mySession'];
            $studentID = $_SESSION['id'];
            $projectID = $_SESSION['projectID'];
            $projectStartDate = $_SESSION["project_start_date"];
            $projectDescription = $_SESSION["project_description"];
            $projectStatus = "submitted";
            $projectCategory = "final-report";
    
            $newFileName = $studentID . '.pdf';
            $uploadFileDir = './uploads/Final Submission/';
            $dest_path = $uploadFileDir . $newFileName;
    
            if (move_uploaded_file($_FILES['report_file']['tmp_name'], $dest_path)) {
                // Insert into database
                $sql = "INSERT INTO project_submission (start_date, end_date, project_description, project_status, project_category, project_file, studentID, projectID) 
                        VALUES ('$projectStartDate', NOW(), '$projectDescription', '$projectStatus', '$projectCategory', '$newFileName', '$userID', '$projectID')";
    
                if ($this->db->query($sql)) {
                    // ✅ Call the new function to update project status
                    $this->updateProjectStatusToSubmitted($projectID);
    
                    $message = "✅ File is successfully uploaded, and project status updated to 'submitted'.";
                } else {
                    $message =  "❌ There was an error inserting the data into the database.";
                }
            } else {
                $message =  "❌ There was an error moving the uploaded file.";
            }
            return $message;
        }
    }
    

    public function updateProjectStatusToSubmitted($projectID) {
        $sql = "UPDATE project SET project_status = 'submitted' WHERE projectID = ?";
        
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $projectID);
            return $stmt->execute();
        } else {
            return false;
        }
    }
    
    public function hasSubmittedFinalReport($studentID) {
        $sql = "SELECT project_file FROM project_submission WHERE studentID = ? AND project_category = 'final-report'";
        
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("s", $studentID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            return $row ? $row['project_file'] : false; // Returns file name if exists, false otherwise
        }
        return false;
    }
    
}
?>