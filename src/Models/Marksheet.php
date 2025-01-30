<?php

namespace App\Models;

use App\Models\Db;

class Marksheet {
    private $db;

    public function __construct() {
        require_once 'DB.php';
        $this->db = new Db();
    }

   
    public function getAllMarksheet() {
        $sql = "SELECT * FROM marksheet";
        return $this->db->query($sql);
    }

    public function getMarksheetById($marksheetID) {
        $marksheetID = $this->db->escapeString($marksheetID);
        $sql = "SELECT * FROM marksheet WHERE marksheetID = '$marksheetID'";
        return $this->db->query($sql);
    }

 
    public function insertMarksheet($totalScore, $date, $projectID) {
        $totalScore = $this->db->escapeString($totalScore);
        $date = $this->db->escapeString($date);
        $projectID = $this->db->escapeString($projectID);

        $sql = "INSERT INTO marksheet (total_score, date, projectID) VALUES ('$totalScore', '$date', '$projectID')";
        return $this->db->query($sql);
    }


    public function updateMarksheet($marksheetID, $totalScore) {
        $marksheetID = $this->db->escapeString($marksheetID);
        $totalScore = $this->db->escapeString($totalScore);

        $sql = "UPDATE marksheet SET total_score = '$totalScore' WHERE marksheetID = '$marksheetID'";
        return $this->db->query($sql);
    }


    public function deleteMarksheet($marksheetID) {
        $marksheetID = $this->db->escapeString($marksheetID);
        $sql = "DELETE FROM marksheet WHERE marksheetID = '$marksheetID'";
        return $this->db->query($sql);
    }
}

?>
