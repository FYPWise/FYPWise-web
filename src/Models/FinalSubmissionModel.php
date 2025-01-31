<?php
namespace App\Models;

use App\Models\Db;
use PDO;
use PDOException;

class FinalSubmissionModel {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getStudentDetails($userID) {
        try {
            $sql = "SELECT u.name, s.studentID, p.project_title
                    FROM users u
                    JOIN student s ON u.userID = s.userID
                    -- LEFT JOIN project_submission ps ON s.studentID = ps.studentID
                    LEFT JOIN project p ON s.userID = p.studentID
                    WHERE u.userID = :userID";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }

    public function submitFinalReport($studentID, $filePath) {
        try {
            $sql = "INSERT INTO final_report (studentID, report_file, submission_date) 
                    VALUES (:studentID, :filePath, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':studentID', $studentID, PDO::PARAM_INT);
            $stmt->bindParam(':filePath', $filePath, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Submission error: " . $e->getMessage());
            die("<script>alert('Database error: Unable to submit file. Check logs.');</script>");
        }
    }
    
}
