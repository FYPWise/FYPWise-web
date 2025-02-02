<?php

namespace App\Models;

use App\Models\Db;

class Marksheet {
    private $db;

    public function __construct(Db $db) {
        $this->db = $db;
    }

    // Fetch all marksheets and dynamically calculate total scores
    public function getAllMarksheet() {
        $sql = "SELECT m.*, COALESCE(SUM(cs.score), 0) AS total_score
                FROM marksheet m
                LEFT JOIN criteria_score cs ON m.marksheetID = cs.marksheetID
                GROUP BY m.marksheetID
                ORDER BY m.date DESC";

        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get a specific marksheet by ID
    public function getMarksheetById($marksheetID) {
        $sql = "SELECT * FROM marksheet WHERE marksheetID = ?";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $marksheetID);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } else {
            throw new \Exception("Database query failed: " . $this->db->getError());
        }
    }

    // Get total score for a specific marksheet
    public function getTotalScore($marksheetID) {
        $sql = "SELECT SUM(score) AS total FROM criteria_score WHERE marksheetID = ?";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $marksheetID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            return $row['total'] ?? 0; // Return total score or 0 if none found
        } else {
            throw new \Exception("Database query failed: " . $this->db->getError());
        }
    }
    
    // Function to update total score in marksheet table (if needed)
    public function updateTotalScore($marksheetID) {
        $totalScore = $this->getTotalScore($marksheetID);
        $sql = "UPDATE marksheet SET total_score = ? WHERE marksheetID = ?";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("ii", $totalScore, $marksheetID);
            return $stmt->execute();
        } else {
            throw new \Exception("Database query failed: " . $this->db->getError());
        }
    }
}
