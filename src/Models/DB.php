<?php

namespace App\Models;

class Db
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db_name = 'fypwise';
    public $conn;

    public function __construct() {
        $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function escapeString($sql) {
        return $this->conn->real_escape_string($sql);
    }

    public function close() {
        $this->conn->close();
    }

    public function __destruct(){
        $this->close();
    }
    
}