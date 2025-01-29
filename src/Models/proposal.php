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
                    proposal_status ps ON p.proposalID = ps.proposalID;";
    
        $result = $this->db->query($sql);
    
        if (!$result) {
            throw new \Exception("Database query failed for query: $sql. Error: " . $this->db->getError());
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
                ps.comment
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

    public function createProposal($title, $description, $submissionDate, $specialisation, $category, $supervisorId) {
        
        $sql = "INSERT INTO proposal (proposal_title, proposal_description, submission_date, specialisation, category, supervisorID) 
                VALUES (?, ?, ?, ?, ?, ?)";
    
        // Prepare the statement
        if ($stmt = $this->db->prepare($sql)) {
            // Bind parameters to the prepared statement
            $stmt->bind_param("sssssi", $title, $description, $submissionDate, $specialisation, $category, $supervisorId);
    
            // Execute the statement
            if ($stmt->execute()) {
                // Return the ID of the newly inserted proposal
                return $stmt->insert_id;
            } else {
                throw new \Exception("Failed to insert proposal: " . $stmt->error);
            }
        } else {
            throw new \Exception("Failed to prepare statement: " . $stmt->error);
        }
    }
    
}
?>