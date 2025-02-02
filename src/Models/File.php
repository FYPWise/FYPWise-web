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
            $sql = "UPDATE $tableName SET $columnName='$fileName' WHERE userID='$userId'";
    
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

        public function ganttChart(){
            $studentID = $_SESSION['id'];
            $projectId = $_SESSION['projectID'];

            $newFileName = $studentID . ' gc.pdf';
            $uploadFileDir = './uploads/Gantt Chart/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($_FILES['gantt_chart']['tmp_name'], $dest_path)) {

                // Insert into database
                $sql = "UPDATE project_timeline SET gantt_chart_pdf = '$newFileName' WHERE projectID = '$projectId' ";
                
                if ($this->db->query($sql)) {
                    echo "File is successfully uploaded and data is inserted into the database.";
                } else {
                    echo  "There was an error inserting the data into the database.";
                }
            }
        }

        public function flowChart(){
            $studentID = $_SESSION['id'];
            $projectId = $_SESSION['projectID'];

            $newFileName = $studentID . ' fc.pdf';
            $uploadFileDir = './uploads/Flow Chart/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($_FILES['flow_chart']['tmp_name'], $dest_path)) {

                // Insert into database
                $sql = "UPDATE project_timeline SET flow_chart_pdf = '$newFileName' WHERE projectID = '$projectId' ";
                
                if ($this->db->query($sql)) {
                    echo "<script>alert('File is successfully uploaded and data is inserted into the database.')</script>";
                } else {
                    echo  "There was an error inserting the data into the database.";
                }
            }
            
        }
    }
?>