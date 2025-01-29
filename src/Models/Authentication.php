<?php

namespace App\Models;

use App\Models\Db;

class Authentication{
    private $db;

    public function __construct() {
        $this->db = new Db();
    }

    public function login(){
        if(isset($_POST['id'])){
        $id = $this->db->escapeString($_POST['id']);
        $password = $this->db->escapeString($_POST['password']);

        // Retrieve user data from 'users' table
        $usersSql = "SELECT * from users where id='$id' and password='$password'";
        $users = $this->db->query($usersSql);
        $usersRowcount = mysqli_num_rows($users);

        

        if($usersRowcount == 1){
            $row = mysqli_fetch_array($users);
            $_SESSION["mySession"] = $row['userID'];
            $_SESSION["name"] = $row['name'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["image"] = $row['filename'];

            $_SESSION["role"] = $row['role'];

            if($_SESSION["role"]  == 'student') {
                header('location:dashboard');
            }
        } else {
            $_SESSION["Invalid"] = true;
        }
    }
    }

    public function logout(){
        unset( $_SESSION["mySession"] );
        unset( $_SESSION["name"] );
        unset( $_SESSION["email"] );
        unset( $_SESSION["role"] );
        header('location:/FYPWise-Web');
    }

    public function authenticate(){
        if(isset($_SESSION['mySession'])){
            return true;
        }else{
            return false;
        }
    }
}