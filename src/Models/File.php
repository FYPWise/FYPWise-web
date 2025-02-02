<?php
    namespace App\Models;
    use App\Models\Db;

    class File{
        private $db;

        public function __construct() {
            $this->db = new Db();
        }

        public function form($type, $text){
            echo"
            <form id='UploadForm' method='post' enctype='multipart/form-data'>
                <input type='file' id='fileUpload' name='image' accept='$type' required>
                <button type='submit' name='file' id='fileUploadButton'>$text</button>
            </form>
            ";

            /* Types:
            1. images: 'images/*'  Images only
            2. pdf: 'application/pdf' pdf only
            3. doc: '.doc, .docx' Word documents (DOC, DOCX)
            */
        }

        public function uploadFile($fileInputName, $targetDir, $tableName, $columnName) {
            $id = $_SESSION['id'];

            $fileName = $fileInputName == 'image'? $id . ".png": $id.".pdf";
            $target = $targetDir . $fileName;

            $userId = $_SESSION['mySession'];
            $projectId = $_SESSION['projectID'];

            
            $sql = $fileInputName == 'image'? "UPDATE $tableName SET $columnName='$fileName' WHERE userID='$userId'": 
                                                "UPDATE $tableName SET $columnName='$fileName' WHERE projectID='$projectId'";
    
            if ($this->db->query($sql)) {
                if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $target)) {
                    $timestamp = time();
                    $_SESSION[$fileInputName] = $fileName . "?v=" . $timestamp;
                    return true;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    return false;
                }
            }
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
?>