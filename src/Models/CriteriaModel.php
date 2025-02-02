<?php

namespace App\Models;

use App\Models\Db;

class CriteriaModel {
    private $db;

    public function __construct(Db $db) {
        $this->db = $db;
    }

    public function getAllCriteriaScores() {
        $sql = "SELECT * FROM criteria_score";
        return $this->db->query($sql);
    }

    public function getCriteriaScoreById($scoreID) {
        $scoreID = $this->db->escapeString($scoreID);
        $sql = "SELECT * FROM criteria_score WHERE scoreID = '$scoreID'";
        return $this->db->query($sql);
    }

    public function insertCriteriaScore($score, $criteria, $comment, $marksheetID, $evaluatorID) {
        $score = $this->db->escapeString($score);
        $criteria = $this->db->escapeString($criteria);
        $comment = $this->db->escapeString($comment);
        $marksheetID = $this->db->escapeString($marksheetID);
        $evaluatorID = $this->db->escapeString($evaluatorID);

        $sql = "INSERT INTO criteria_score (score, criteria, comment, marksheetID, evaluatorID) 
                VALUES ('$score', '$criteria', '$comment', '$marksheetID', '$evaluatorID')";
        return $this->db->query($sql);
    }

    public function updateCriteriaScore($scoreID, $score, $criteria, $comment) {
        $scoreID = $this->db->escapeString($scoreID);
        $score = $this->db->escapeString($score);
        $criteria = $this->db->escapeString($criteria);
        $comment = $this->db->escapeString($comment);

        $sql = "UPDATE criteria_score 
                SET score = '$score', criteria = '$criteria', comment = '$comment' 
                WHERE scoreID = '$scoreID'";
        return $this->db->query($sql);
    }

    public function deleteCriteriaScore($scoreID) {
        $scoreID = $this->db->escapeString($scoreID);
        $sql = "DELETE FROM criteria_score WHERE scoreID = '$scoreID'";
        return $this->db->query($sql);
    }


    public function getCriteriaScoresByMarksheetID($marksheetID) {
    $sql = "SELECT * FROM criteria_score WHERE marksheetID = ?";
    
    if ($stmt = $this->db->prepare($sql)) {
        $stmt->bind_param("s", $marksheetID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        throw new \Exception("Database query failed: " . $this->db->getError());
    }
}
}

?>
