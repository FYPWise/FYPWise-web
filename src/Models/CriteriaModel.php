<?php
namespace App\Models;

use App\Models\Db;

class CriteriaModel {
    private $db;

    public function __construct(Db $db) {
        $this->db = $db;
    }

    public function getCriteriaScoresByMarksheetID($marksheetID) {
        $sql = "SELECT * FROM criteria_score WHERE marksheetID = ?";
        
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $marksheetID);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new \Exception("Database query failed: " . $this->db->conn->error);
        }
    }

    public function insertCriteriaScore($score, $criteria, $comment, $marksheetID, $evaluatorID) {
        $sql = "INSERT INTO criteria_score (score, criteria, comment, marksheetID, evaluatorID) VALUES (?, ?, ?, ?, ?)";
        
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("isssi", $score, $criteria, $comment, $marksheetID, $evaluatorID);
            return $stmt->execute();
        } else {
            throw new \Exception("Database query failed: " . $this->db->conn->error);
        }
    }

    public function updateCriteriaScoreByMarksheet($marksheetID, $criteria, $score, $comment) {
        $sql = "UPDATE criteria_score SET score = ?, comment = ? WHERE marksheetID = ? AND criteria = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("isis", $score, $comment, $marksheetID, $criteria);
        return $stmt->execute();
    }
    
}
?>
