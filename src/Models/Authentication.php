<?php

namespace App\Models;

use App\Models\Db;

class Authentication{
    private $db;

    public function __construct() {
        $this->db = new Db();
    }

    public function login(){
        if(isset($_POST['login'])){
        $id = $this->db->escapeString($_POST['id']);
        $password = $this->db->escapeString($_POST['password']);

        // Retrieve user data from 'users' table
        $usersSql = "SELECT * from users where id='$id'";
        $users = $this->db->query($usersSql);
        $usersRowcount = mysqli_num_rows($users);

        if($usersRowcount == 1){
            $row = mysqli_fetch_array($users);
            if (password_verify($password, $row['password'])) {
                $_SESSION["mySession"] = $row['userID'];
                $_SESSION["id"] = $row['id'];
                $_SESSION["name"] = $row['name'];
                $_SESSION["email"] = $row['email'];
                $_SESSION["image"] = $row['filename'];
    
                $_SESSION["role"] = $row['role'];
    
                if($_SESSION["role"]  == 'student') {
                    $studentSql = "SELECT * from student where studentID='$id'";
                    $studentRes = $this->db->query($studentSql);
                    $row = mysqli_fetch_array($studentRes);
                    $_SESSION["specialization"] = $row['specialization'];
                    $_SESSION["year"] = $row['year'];
                    
                } elseif($_SESSION["role"]  == 'lecturer') {
                    $lecturerSql = "SELECT * from lecturer where lecturerID='$id'";
                    $lecturerRes = $this->db->query($lecturerSql);
                    $row = mysqli_fetch_array($lecturerRes);
                    $_SESSION["position"] = $row['position'];
                }

                // Fetch project data
                $projectSql = "SELECT * FROM project WHERE studentID = '{$_SESSION["mySession"]}'";
                $projectRes = $this->db->query($projectSql);
                if ($projectRow = mysqli_fetch_array($projectRes)) {
                    $_SESSION["projectID"] = $projectRow['projectID'];
                    $_SESSION["project_title"] = $projectRow['project_title'];
                    $_SESSION["project_start_date"] = $projectRow['start_date'];
                    $_SESSION["project_end_date"] = $projectRow['end_date'];
                    $_SESSION["project_description"] = $projectRow['project_description'];
                    $_SESSION["project_status"] = $projectRow['project_status'];
                    $_SESSION["project_proposalID"] = $projectRow['proposalID'];
                }  else {
                    $_SESSION["projectID"] = 0;
                }

                header('location:dashboard');
            } else {
                $_SESSION["Invalid"] = true;
            }
        } else {
            $_SESSION["Invalid"] = true;
        }
    }
    }

    public function logout(){
        session_destroy();
        header('location:login');
    }

    public function authenticate(){
        return isset($_SESSION['mySession']);
    }
}