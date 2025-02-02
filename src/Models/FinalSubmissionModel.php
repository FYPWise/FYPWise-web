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
                        VALUES ($projectStartDate, NOW(), '$projectDescription', '$projectStatus', '$projectCategory', '$newFileName', '$userID', '$projectID')";
                
                if ($this->db->query($sql)) {
                    $message = "File is successfully uploaded and data is inserted into the database.";
                } else {
                    $message =  "There was an error inserting the data into the database.";
                }
            } else {
                $message =  "There was an error moving the uploaded file.";
            }
            return $message;
        }
    }
}