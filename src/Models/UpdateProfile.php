<?php 
namespace App\Models; 
use App\Models\Db;

class UpdateProfile {
    private $db;

    public function __construct() {
        $this->db = new Db();
    }

    public function profile() {
        if(isset($_POST['profile'])) {
            $name = $this->db->escapeString($_POST['name']);
            $email = $this->db->escapeString($_POST['email']);
            $id = $this->db->escapeString($_POST['student-id']);
            $password = $this->db->escapeString($_POST['password']);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $userId = $_SESSION['mySession'];

            // Student
            $specialization = $this->db->escapeString($_POST['specialization']);
            $year = $this->db->escapeString($_POST['year']);

            // Lecturer
            $position = $this->db->escapeString($_POST['position']);

            if($password == "") {
                $sql = "UPDATE users SET id='{$id}', name='{$name}', email='{$email}' WHERE userID='{$userId}'";
            } else {
                $sql = "UPDATE users SET id='{$id}', name='{$name}', email='{$email}', password='{$hash}' WHERE userID='{$userId}'";
            }
            if ($this->db->query($sql)) {
                if ($_SESSION['role'] == 'student') {
                    $sql = "UPDATE student SET studentID='$id',year='$year', specialization='$specialization' WHERE userID='$userId'";
                    $this->db->query($sql);
                    $_SESSION['specialization'] = $specialization;
                    $_SESSION['year'] = $year;
                } elseif ($_SESSION['role'] == 'lecturer') {
                    $sql = "UPDATE lecturer SET lecturerID='$id', position='$position' WHERE userID='$userId'";
                    $this->db->query($sql);
                }
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $id;
                header('location:profilemanagement');
            } else {
                echo "Error: " . $sql . "<br>" . $this->db->conn->error;
            }
        }
    }

    public function image() {
        $userId = $_SESSION['mySession'];
        $id = $_SESSION['id'];
        $imageName = $id . ".png";
        $target = "./src/assets/pfp/" . $imageName;
        $sql = "UPDATE users SET filename='$imageName' WHERE userID='$userId'";

        if ($this->db->query($sql)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target)) {

                $timestamp = time();
                $_SESSION['image'] = $imageName. "?v=" . $timestamp;
                header('location:profilemanagement');

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "File is not an image.";
        }
    }
}
?>