<?php

namespace App\Models;

use App\Models\Db;

class Message{
    private $messageId;
    private $senderId;
    private $receiverId;
    private $groupId;
    private $messageContent;
    private $time;
    private $date;
    private $db;

    public function __construct($messageId = null){
        $this->db = new Db();
        if ($messageId != null) $this->read($messageId);
    }

    public function getMessageId(){
        return $this->messageId;
    }

    public function getSenderId(){
        return $this->senderId;
    }

    public function getReceiverId(){
        return $this->receiverId;
    }

    public function getGroupId(){
        return $this->groupId;
    }

    public function getContent(){
        return $this->messageContent;
    }

    public function getTime(){
        return $this->time;        
    }

    public function getDate(){
        return $this->date;
    }

    public function read($messageId){
        $sql = "SELECT * FROM message WHERE messageID = $messageId";
        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                
                $dateTime = new \DateTime($row['timeStamp']);
                $date = $dateTime->format('d-m-Y');
                $time = $dateTime->format('h:i:s A');

                $this->messageId = $row["messageID"];
                $this->senderId = $row["senderID"];
                $this->receiverId = $row["receiverID"];
                $this->groupId = $row["groupID"];
                $this->messageContent = $row["messageContent"];
                $this->time = $time;
                $this->date = $date;
            }
        }
    }
    
}
?>