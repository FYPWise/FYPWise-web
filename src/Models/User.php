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

}