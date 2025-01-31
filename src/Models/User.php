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

    public function __construct($userID = null) {
        $this->db = new Db();
        $this->readId($userID);
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

    public function getNewLecturerID(){
        $sql = "SELECT lecturerID FROM `lecturer` ORDER BY `lecturer`.`lecturerID` DESC";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0 ){
            $row = $result->fetch_row();
            $id = explode("L", $row[0]);
            $id = intval( $id[1] );

            if ($id < 10){
                $head = "L00";
            }elseif ($id <100){
                $head = "L0";
            }else{
                $head = "L";
            }

            $newID = $head . strval($id+1);
            
            
            return $newID;
        }
    }

    public function create($role){
        $name = $this->db->escapeString($_POST['name']);
        $email = $this->db->escapeString($_POST['email']);
        $id = $this->db->escapeString($_POST['id']);
        $password = $this->db->escapeString($_POST['password']);
        $hash = password_hash($password, PASSWORD_DEFAULT);

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
        } else {
            echo "Error: " . $sql . "<br>" . $this->db->conn->error;
        }
    }

    public function update($updates, $role){
        switch ($updates) {
            case "profile":
                $name = $this->db->escapeString($_POST['name']);
                $email = $this->db->escapeString($_POST['email']);
                $id = $this->db->escapeString($_POST['student-id']);
                $userId = $_SESSION['mySession'];

                // Password
                $password = $this->db->escapeString($_POST['password']);
                $hash = password_hash($password, PASSWORD_DEFAULT);

                switch ($role) {
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
                break;

            case "image":
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
                break;
            }
    }

}