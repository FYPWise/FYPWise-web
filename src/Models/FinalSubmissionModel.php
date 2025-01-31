<?php
namespace App\Models;

use App\Models\Db;
use PDO;
use PDOException;

class FinalSubmissionModel {
    private $db;

    public function __construct(Db $db) {
        $this->db = $db;
    }

    public function getStudentDetails($userID) {
        try {
            $sql = "SELECT u.full_name, s.student_id, p.project_id 
                    FROM users u
                    JOIN student s ON u.userID = s.userID
                    LEFT JOIN project_submission ps ON s.student_id = ps.student_id
                    LEFT JOIN project p ON ps.project_id = p.project_id
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
            $sql = "INSERT INTO final_report (student_id, report_file, submission_date) 
                    VALUES (:studentID, :filePath, NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':studentID', $studentID, PDO::PARAM_INT);
            $stmt->bindParam(':filePath', $filePath, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Submission error: " . $e->getMessage());
        }
    }
}
