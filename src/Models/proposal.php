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
            throw new \Exception("Database query failed: " . $this->db->error);
        }
    
        $proposals = [];
        while ($row = $result->fetch_assoc()) {
            $proposals[] = $row;
        }
    
        return $proposals;
    }   
}
?>