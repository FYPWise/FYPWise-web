<?php

namespace App\Models;
use App\Models\Db;

class User{

    private $db;
    protected $userID;
    protected $id;
    protected $name;
    protected $email;
    protected $role;

    public function __construct($id = null) {
        $this->db = new Db();
        $this->readId($id);
    }

    public function getUserID(){
        return $this->userID;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getRole(){ 
        return $this->role;
    }

    public function setUserID($userID){
        $this->userID = $userID;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function find($id){
        $id = $this->db->escapeString($id);
        $userSql = "SELECT * from users where id LIKE '$id%' ";
        $result = $this->db->query($userSql);

        if($result->num_rows > 0){ 
            $usersArr = [];
            while($users = $result->fetch_array(MYSQLI_ASSOC)){
                $usersArr[] = $users;
            };
            return $usersArr;
        }else{
            return false;
        }
    }

    public function readId($id){
        $id = $this->db->escapeString($id);
        $userSql = "SELECT * from users where id='$id' ";
        $result = $this->db->query($userSql);

        if ($result->num_rows == 1){
            $user = $result->fetch_object();
            $this->id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->userID = $user->userID;
            return 1;
        }else{
            return false;
        }
    }

    public function readUserId($userId){
        $userId = $this->db->escapeString($userId);
        $userSql = "SELECT * from users where userID='$userId' ";
        $result = $this->db->query($userSql);

        if ($result->num_rows == 1){
            $user = $result->fetch_object();
            $this->id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->userID = $user->userID;
            return 1;
        }else{
            return false;
        }
    }

    public function getNewLecturerID(){
        $sql = "SELECT lecturerID FROM `lecturer` ORDER BY `lecturer`.`lecturerID` DESC";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0 ){
            $row = $result->fetch_row();
            $id = explode("L", $row[0]);
            $id = intval( $id[1] );
            $id++;
            if ($id < 10){
                $head = "L00";
            }elseif ($id <100){
                $head = "L0";
            }else{
                $head = "L";
            }

            $newID = $head . strval($id);
            
            
            return $newID;
        }
    }

    public function create($role){
        $name = $this->db->escapeString($_POST['name']);
        $email = $this->db->escapeString($_POST['email']);
        $id = $this->db->escapeString($_POST['id']);
        $password = $this->db->escapeString($_POST['password']);
        $hash = password_hash($password, PASSWORD_DEFAULT);

        if ($this->readId($id) ){
            return false;
        }else{

        switch ($role) {
            case 'student':
                $specialization = $this->db->escapeString($_POST['specialization']);
                $year = $this->db->escapeString($_POST['year']);
                break;
            case 'lecturer':
                $position = $this->db->escapeString($_POST['position']);
                break;
        }
        $sql = "INSERT INTO users (id, name, password, email, role) VALUES ('$id', '$name', '$hash', '$email', '$role')";

        if ($this->db->query($sql)) {
            $userId = $this->db->conn->insert_id;

            $tableSql = match ($role) {
                'student' => "INSERT INTO student (userID, studentID, year, specialization) VALUES ('$userId', '$id', '$year', '$specialization')",
                'lecturer' => "INSERT INTO lecturer (userID, lecturerID, position) VALUES ('$userId', '$id', '$position')"
            };
            
            $this->db->query($tableSql);
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->db->conn->error;
        }
        }
    }

    public function getSupervisorID(){
        $userId = $this->userID;

        $sql = "SELECT l.lecturerID FROM lecturer_project lp JOIN lecturer l ON lp.lecturerID = l.userID JOIN users u ON l.userID = u.userID JOIN project p ON lp.projectID = p.projectID
        WHERE p.studentID = '$userId' AND lp.lecturer_role = 'supervisor';";
        $result = $this->db->query($sql);

        if ($result->num_rows == 1) {
             $row = $result->fetch_row();
             return $row[0];
        }else{
            return false;
        }
    }

    public function getAdminID(){
        $sql = "SELECT id FROM `users` WHERE role = 'admin'";
        $result = $this->db->query($sql);

        if ($result->num_rows == 1) {
             $row = $result->fetch_row();
             return $row[0];
        }else{
            return false;
        }

    }

    public function getSuperviseeIDs(){
        $id = $this->id;
        $superviseeIDs = [];

        $sql = "SELECT DISTINCT s.studentID
        FROM student s
        JOIN project p ON s.userID = p.studentID
        JOIN lecturer_project lp ON p.projectID = lp.projectID
        JOIN lecturer l ON lp.lecturerID = l.userID
        WHERE lp.lecturer_role = 'supervisor' 
        AND l.lecturerID = '$id';";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0 ) {
             while ($row = $result->fetch_assoc()) {
                $superviseeIDs[] = $row['studentID'];
             }
             return $superviseeIDs;
        }else{
            return false;
        }
    }

    public function update(){
        $name = $this->db->escapeString($_POST['name']);
        $email = $this->db->escapeString($_POST['email']);
        $id = $this->db->escapeString($_POST['student-id']);
        $userId = $_SESSION['mySession'];

        // Password
        $password = $this->db->escapeString($_POST['password']);
        $hash = password_hash($password, PASSWORD_DEFAULT);

        switch ($_SESSION['role']) {
            case 'student':
                $specialization = $this->db->escapeString($_POST['specialization']);
                $year = $this->db->escapeString($_POST['year']);
                break;
            case 'lecturer':
                $position = $this->db->escapeString($_POST['position']);
                break;
        }

        if($password == "") {
            $sql = "UPDATE users SET id='{$id}', name='{$name}', email='{$email}' WHERE userID='{$userId}'";
        } else {
            $sql = "UPDATE users SET id='{$id}', name='{$name}', email='{$email}', password='{$hash}' WHERE userID='{$userId}'";
        }
        if ($this->db->query($sql)) {
            if ($_SESSION['role'] == 'student') {
                $sql = "UPDATE student SET specialization='$specialization', year='$year', studentID='$id' WHERE userID='$userId'";
                $this->db->query($sql);
                $_SESSION['specialization'] = $specialization;
                $_SESSION['year'] = $year;
            } elseif ($_SESSION['role'] == 'lecturer') {
                $sql = "UPDATE lecturer SET lecturerID='$id', position='$position' WHERE userID='$userId'";
                $_SESSION['position'] = $position;
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

    public function projectProgress($userID, $role){

        // Base query
        $sql = "SELECT p.project_title, m.milestone_title,
        DATE_FORMAT(m.milestone_start_date, '%d %b') AS milestone_start_date, 
        DATE_FORMAT(m.milestone_end_date, '%d %b') AS milestone_end_date, 
        pt.status 
        FROM project p
        JOIN project_timeline pt ON p.projectID = pt.projectID
        JOIN milestone m ON pt.timelineID = m.timelineID";

        // Modify WHERE clause based on role
        if ($role == 'student') {
        $sql .= " WHERE p.studentID = $userID";
        } elseif ($role == 'lecturer') {
        $sql .= " JOIN lecturer_project lp ON p.projectID = lp.projectID
            WHERE lp.lecturerID = $userID";
        }

        // Add ORDER BY clause for sorting by milestone end date (if needed)
        $sql .= " ORDER BY milestone_end_date ASC";

        $result = $this->db->query($sql . " LIMIT 5");

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function submissionUpdates($userID, $role) {
        if ($role == 'student') {
            $query = "SELECT p.project_title, 
                        ps.project_description, 
                        ps.project_status, 
                        ps.project_category,
                        DATE_FORMAT(ps.end_date , '%d %b') AS end_date
                    FROM project_submission ps
                    JOIN project p ON ps.projectID = p.projectID
                    WHERE ps.studentID = $userID;
                    ";
        } elseif ($role == 'lecturer') {
            $query = "SELECT u.name, p.project_title, ps.project_status, ps.project_category, 
                        DATE_FORMAT(ps.end_date , '%d %b') AS end_date
                    FROM project_submission ps
                    JOIN project p ON ps.projectID = p.projectID
                    JOIN student s ON ps.studentID = s.userID
                    JOIN users u ON s.userID = u.userID
                    JOIN lecturer_project lp ON p.projectID = lp.projectID
                    WHERE lp.lecturerID = $userID";
        } elseif ($role == 'admin') {
            $query = "SELECT u.name, p.project_title, ps.project_status, ps.project_category, ps.end_date 
                    FROM project_submission ps
                    JOIN project p ON ps.projectID = p.projectID
                    JOIN student s ON ps.studentID = s.userID
                    JOIN users u ON s.userID = u.userID";
        }

        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    

}
?>