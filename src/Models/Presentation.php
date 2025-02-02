<?php
namespace App\Models;

use App\Models\Db;

class Presentation {
    private $db;

    public function __construct(Db $db) {
        $this->db = $db;
    }

    // Create new presentation
    public function createPresentation($presentationTitle, $startTime, $endTime, $date, $mode, $location, $presentationURL, $status, $projectID) {
        // Escape inputs for security
        $presentationTitle = $this->db->escapeString($presentationTitle);
        $startTime = $this->db->escapeString($startTime);
        $endTime = $this->db->escapeString($endTime);
        $date = $this->db->escapeString($date);
        $mode = $this->db->escapeString($mode);
        $location = $this->db->escapeString($location);
        $presentationURL = $this->db->escapeString($presentationURL ?? '');
        $status = $this->db->escapeString($status);
        $projectID = $this->db->escapeString($projectID);

        // Insert the presentation data
        $sql = "INSERT INTO presentation (presentation_title, start_time, end_time, date, mode, location, presentation_URL, status, updated_at, projectID)
                VALUES ('$presentationTitle', '$startTime', '$endTime', '$date', '$mode', '$location', '$presentationURL', '$status', NOW(), '$projectID')";

        if ($this->db->query($sql)) {
            return "Presentation details inserted successfully.";
        } else {
            return "Error: " . $this->db->conn->error;
        }
    }
}
?>