<?php
    namespace App\Models;
    use App\Models\Db;

    class File{
        private $db;

        public function __construct() {
            $this->db = new Db();
        }

        public function uploadFile($fileInputName, $targetDir, $tableName, $columnName) {
            $id = $_SESSION['id'];
            if ($fileInputName == 'image') {
                $fileName = $id . ".png";
            }
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
            } else {
                echo "File is not the required type.";
                return false;
            }
        }
    }
?>