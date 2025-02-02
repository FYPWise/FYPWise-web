<?php
namespace App\Models;
use App\Models\Db;

class task{
    private $db;
    public function __construct() {
        $this->db = new Db();
    }

    public function addTask(){
        $taskName = $this->db->escapeString($_POST['taskName']);
        $taskDate = $this->db->escapeString($_POST['taskDate']);
        $userId = $_SESSION['mySession'];

        $sql = "INSERT INTO task (taskName, taskDate, userID) VALUES ('$taskName', '$taskDate', '$userId')";
        if ($this->db->query($sql)) {
            header("Location:dashboard");
        } else {
            echo "Error: " . $sql . "<br>" . $this->db->conn->error;
        }
    }

    public function completeTask(){
        $tasks = $_POST['tasks'];
        foreach ($tasks as $taskId) {
            $taskId = $this->db->escapeString($taskId);
            $sql = "DELETE FROM task WHERE taskID = '$taskId' AND userID = '{$_SESSION['mySession']}'";
            $this->db->query($sql);
            
        }
        header("Location:dashboard");
    }
}
?>