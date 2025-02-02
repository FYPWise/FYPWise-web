<?php
namespace App\Models;

use App\Models\Db;

class ProposalFetcher {
    private $db;

    public function __construct(Db $db) {
        $this->db = $db;
    }

    public function fetchProposalByID($proposalID) {
        $sql = "SELECT 
                    proposalID,
                    proposal_title,
                    proposal_description,
                    submission_date,
                    supervisorID,
                    specialisation,
                    category,
                    proposal_file 
                FROM proposal 
                WHERE proposalID = ?";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $proposalID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null; // No proposal found
            }
        } else {
            throw new \Exception("Database query failed: " . $this->db->conn->error);
        }
    }
}
?>
