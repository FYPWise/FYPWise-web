<?php
namespace App\Models;

use App\Models\Db;

class Proposal {
    private $db;

    public function __construct(Db $db) {
        $this->db = $db;
    }

    public function getAllProposals() {
        $sql = "SELECT 
                    p.proposalID,
                    p.proposal_title,
                    p.proposal_description,
                    p.submission_date,
                    p.supervisorID,
                    u.name AS supervisor_name,
                    ps.status,
                    ps.updated_at
                FROM 
                    proposal p
                JOIN 
                    lecturer l ON p.supervisorID = l.userID
                JOIN 
                    users u ON l.userID = u.userID
                LEFT JOIN 
                    proposal_status ps ON p.proposalID = ps.proposalID
                ORDER BY 
                    p.proposalID ASC;";
    
        $result = $this->db->query($sql);
    
        if (!$result) {
            throw new \Exception("Database query failed for query: $sql. Error: " . $this->db->conn->error);
        }
    
        $proposals = [];
        while ($row = $result->fetch_assoc()) {
            $proposals[] = $row;
        }
    
        return $proposals;
    } 
    
    public function getProposalByID($proposalID) {
        $sql = "SELECT 
                p.proposalID,
                p.proposal_title,
                p.proposal_description,
                p.submission_date,
                p.supervisorID,
                u.name AS supervisor_name,
                ps.status,
                ps.updated_at,
                p.specialisation,
                p.category,
                ps.comment,
                p.proposal_file
            FROM 
                proposal p
            JOIN 
                lecturer l ON p.supervisorID = l.userID
            JOIN 
                users u ON l.userID = u.userID
            LEFT JOIN 
                proposal_status ps ON p.proposalID = ps.proposalID
            WHERE 
                p.proposalID = ?";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $proposalID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                throw new \Exception("Proposal not found.");
            }
        } else {
            throw new \Exception("Database query failed: " . $stmt->error);
        }
    }

    public function createProposal($title, $description, $submissionDate, $specialisation, $category, $supervisorId, $proposal_file) {
        try {
            // Check if the file input exists and handle the file upload
            if (isset($proposal_file) && $proposal_file['error'] === UPLOAD_ERR_OK) {
                $uploadSuccess = $this->uploadProposalFile($_FILES['proposal_file'], 'uploads/proposals/', $title);
            
                if ($uploadSuccess) {
                    $fileName = $uploadSuccess;
    
                    // Insert the proposal data
                    $sql = "INSERT INTO proposal (proposal_title, proposal_description, submission_date, specialisation, category, supervisorID, proposal_file) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)";
                
                    if ($stmt = $this->db->prepare($sql)) {
                        $stmt->bind_param("sssssis", $title, $description, $submissionDate, $specialisation, $category, $supervisorId, $fileName);
                
                        if ($stmt->execute()) {
                            $proposalID = $stmt->insert_id;
    
                            // Insert status
                            $statusSql = "INSERT INTO proposal_status (status, updated_at, proposalID) VALUES ('pending', NOW(), ?)";
                            if ($statusStmt = $this->db->prepare($statusSql)) {
                                $statusStmt->bind_param("i", $proposalID);
    
                                if ($statusStmt->execute()) {
                                    return $proposalID;
                                } else {
                                    throw new \Exception("Failed to insert proposal status: " . $statusStmt->error);
                                }
                            } else {
                                throw new \Exception("Failed to prepare status statement: " . $this->db->conn->error);
                            }
                        } else {
                            throw new \Exception("Failed to insert proposal: " . $stmt->error);
                        }
                    } else {
                        throw new \Exception("Failed to prepare statement: " . $this->db->conn->error);
                    }
                } else {
                    throw new \Exception("File upload failed.");
                }
            } else {
                throw new \Exception("No file uploaded or there was an error with the file upload.");
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }    

    private function uploadProposalFile($file, $targetDir, $title) {
        if (isset($file) && isset($file['name'])) {
            $fileType = pathinfo($file["name"], PATHINFO_EXTENSION);
    
            // Ensure file is either PDF or image
            if (in_array($fileType, ["pdf", "png", "jpg", "jpeg"])) {
                $supervisorId = $_SESSION['mySession'] ?? 'unknown';
                $fileName = $supervisorId . "_" . $title . "_Proposal." . $fileType;
                $target = $targetDir . $fileName;
    
                // Move uploaded file
                if (move_uploaded_file($file["tmp_name"], $target)) {
                    return $fileName;
                } else {
                    return false;
                }
            } else {
                return false; // Invalid file type
            }
        }
        return false; // No file uploaded
    }    

    public function updateProposalStatus($proposalID, $status, $comment) {
        try {
            $sql = "UPDATE proposal_status 
                    SET status = ?, comment = ?, updated_at = NOW() 
                    WHERE proposalID = ?";
    
            if ($stmt = $this->db->prepare($sql)) {
                $stmt->bind_param("ssi", $status, $comment, $proposalID);
                if (!$stmt->execute()) {
                    throw new \Exception("Failed to update proposal status: " . $stmt->error);
                }
            } else {
                throw new \Exception("Failed to prepare statement: " . $this->db->conn->error);
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getAcceptedProposals() {
        $sql = "SELECT p.proposalID, p.proposal_title 
                FROM proposal p
                JOIN proposal_status ps ON p.proposalID = ps.proposalID
                WHERE ps.status = 'accepted'";
        return $this->db->query($sql);
    }
    
    
}
?>