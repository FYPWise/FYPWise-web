<?php
namespace App\Models;

use App\Models\Db;

class Meeting {
    private $db;

    public function __construct(Db $db) {
        $this->db = $db;
    }

    // Retrieve all meetings
    public function getAllMeetings() {
        $sql = "SELECT * FROM meeting ORDER BY date DESC, start_time ASC";
        $result = $this->db->query($sql);
        
        if (!$result) {
            throw new \Exception("Database query failed: " . $this->db->getError());
        }
        
        $meetings = [];
        while ($row = $result->fetch_assoc()) {
            $meetings[] = $row;
        }
        
        return $meetings;
    }

    // Retrieve a meeting by its ID
    public function getMeetingByID($meetingID) {
        $sql = "SELECT * FROM meeting WHERE meetingID = ?";
        
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $meetingID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                throw new \Exception("Meeting not found.");
            }
        } else {
            throw new \Exception("Database query failed: " . $this->db->getError());
        }
    }
    // Retrieve meetings by user ID
    public function getMeetingsByUserID($userID) {
        $sql = "SELECT m.* 
                FROM meeting m
                JOIN users_meeting um ON m.meetingID = um.meetingID
                WHERE um.userID = ?
                ORDER BY m.date DESC, m.start_time ASC";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $userID);
            $stmt->execute();
            $result = $stmt->get_result();

            $meetings = [];
            while ($row = $result->fetch_assoc()) {
                $meetings[] = $row;
            }
            return $meetings;
        } else {
            throw new \Exception("Failed to prepare statement: " . $this->db->getError());
        }
    }

    // Create a new meeting
    public function createMeeting($date, $startTime, $endTime, $mode, $location, $title, $description, $meetingURL, $participants = []) {
        // insert into meeting table
        $sql = "INSERT INTO meeting (date, start_time, end_time, mode, location, meeting_title, meeting_description, meeting_URL)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $this->db->prepare($sql)) {
            // Bind the parameters for the meeting
            $stmt->bind_param("ssssssss", $date, $startTime, $endTime, $mode, $location, $title, $description, $meetingURL);
            
            // Execute the query
            if (!$stmt->execute()) {
                throw new \Exception("Failed to create meeting: " . $stmt->error);
            }
            
            // Get the ID of the newly inserted meeting
            $meetingID = $stmt->insert_id;
        } else {
            throw new \Exception("Failed to prepare statement: " . $this->db->getError());
        }

        // Add participants to the users_meeting table
        if (!empty($participants)) {
            $sql = "INSERT INTO users_meeting (userID, meetingID) VALUES (?, ?)";
        
            foreach ($participants as $userID) {
                if ($stmt = $this->db->prepare($sql)) {
                    $stmt->bind_param("ii", $userID, $meetingID);
                    
                    // Execute the query for each participant
                    if (!$stmt->execute()) {
                        throw new \Exception("Failed to add participant to meeting: " . $stmt->error);
                    }
                } else {
                    throw new \Exception("Failed to prepare statement for adding participant: " . $this->db->getError());
                }
            }
        }
        return $meetingID;
    }

    // Update an existing meeting
    public function updateMeeting($meetingID, $date, $startTime, $endTime, $mode, $location, $title, $description, $meetingURL) {
        $sql = "UPDATE meeting 
                SET date = ?, start_time = ?, end_time = ?, mode = ?, location = ?, meeting_title = ?, meeting_description = ?, meeting_URL = ?
                WHERE meetingID = ?";

        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("ssssssssi", $date, $startTime, $endTime, $mode, $location, $title, $description, $meetingURL, $meetingID);
            
            if (!$stmt->execute()) {
                throw new \Exception("Failed to update meeting: " . $stmt->error);
            }
        } else {
            throw new \Exception("Failed to prepare statement: " . $this->db->getError());
        }
    }

    // Delete a meeting
    public function deleteMeeting($meetingID) {
        $sql = "DELETE FROM meeting WHERE meetingID = ?";
        
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $meetingID);
            
            if (!$stmt->execute()) {
                throw new \Exception("Failed to delete meeting: " . $stmt->error);
            }
        } else {
            throw new \Exception("Failed to prepare statement: " . $this->db->getError());
        }
    }

    // Add a user to a meeting
    public function addUserToMeeting($userID, $meetingID) {
        $sql = "INSERT INTO users_meeting (userID, meetingID) VALUES (?, ?)";
        
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("ii", $userID, $meetingID);
            
            if (!$stmt->execute()) {
                throw new \Exception("Failed to add user to meeting: " . $stmt->error);
            }
        } else {
            throw new \Exception("Failed to prepare statement: " . $this->db->getError());
        }
    }

    // Remove a user from a meeting
    public function removeUserFromMeeting($userID, $meetingID) {
        $sql = "DELETE FROM users_meeting WHERE userID = ? AND meetingID = ?";
        
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("ii", $userID, $meetingID);
            
            if (!$stmt->execute()) {
                throw new \Exception("Failed to remove user from meeting: " . $stmt->error);
            }
        } else {
            throw new \Exception("Failed to prepare statement: " . $this->db->getError());
        }
    }

    // Get users attending a specific meeting
    public function getUsersForMeeting($meetingID) {
        $sql = "SELECT u.userID, u.name, u.email, u.role 
                FROM users u
                JOIN users_meeting um ON u.userID = um.userID
                WHERE um.meetingID = ?";
    
        if ($stmt = $this->db->prepare($sql)) {
            $stmt->bind_param("i", $meetingID);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Debugging: Check if there are any rows returned
            if ($result->num_rows > 0) {
                $users = [];
                while ($row = $result->fetch_assoc()) {
                    $users[] = $row;
                }
                return $users;
            } else {
                // No users found for this meeting
                return [];  // Empty array if no users
            }
        } else {
            throw new \Exception("Failed to prepare statement: " . $this->db->getError());
        }
    }
    
}
?>
