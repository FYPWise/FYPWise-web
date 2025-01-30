<?php 
namespace App\Models;
use App\Models\Db;

class Register{
    private $db;

    public function __construct() {
        $this->db = new Db();
    }

    public function register() {
        $name = $this->db->escapeString($_POST['name']);
        $email = $this->db->escapeString($_POST['email']);
        $id = $this->db->escapeString($_POST['id']);
        $password = $this->db->escapeString($_POST['password']);
        $specialization = $this->db->escapeString($_POST['specialization']);
        $year = $this->db->escapeString($_POST['year']);

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (id, name, password, email, role) VALUES ('$id', '$name', '$hash', '$email', 'student')";

        if ($this->db->query($sql)) {

            $userId = $this->db->conn->insert_id;
            $studentSql = "INSERT INTO student (userID, studentID, year, specialization) VALUES ('$userId', '$id', '$year', '$specialization')";
            $this->db->query($studentSql);
            header('location:login');
        } else {
            echo "Error: " . $sql . "<br>" . $this->db->conn->error;
        }
    }
}

?>