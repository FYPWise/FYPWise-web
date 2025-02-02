<?php

namespace App\Models;

use App\Models\Db;
use App\Models\User;

class Chat{
    private $db;
    private $thisUser;
    public $messages = [];

    public function __construct($id = null) {
      $this->db = new Db();
      $this->thisUser = new User($_SESSION['id']);
      if ($id != null) $this->loadChat($id);
    }

    public function getGroups(){
        $userId = $this->thisUser->getUserID();
        $groups = [];
        $sql = "SELECT DISTINCT gc.groupID, gc.groupName
                FROM `group_chat` gc
                JOIN user_group ug ON gc.groupID = ug.groupID
                where ug.userID = '$userId';";

        $result = $this->db->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $groups[] = $row;
            }
        }

        return $groups;
    }

    public function loadChat($id){
        $user = new User();

        if ($user->readId($id)){
            $thisId = $_SESSION['mySession'];
            $otherId = $user->getUserID();
            $sql = "SELECT messageID FROM `message` WHERE (senderID = $thisId AND receiverID = $otherId) OR (senderID = $otherId AND receiverID = $thisId) ORDER BY `message`.`timeStamp` ASC";
        }else{
            $sql = "SELECT messageID FROM `message` WHERE groupID = $id ORDER BY `message`.`timeStamp` ASC";
        }

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                $this->messages[] = new Message($row[0]);
            }
            return true;
        }else{
            return false;
        }

    }

    public function getChat(){
        $user = $this->thisUser;
        $role = $user->getRole();
        $admin = new User($user->getAdminID());
        $chats = [];

        switch ($role) {
            case "student":
                $supervisor = new User($user->getSupervisorID());
                $chats[] = ['type'=>'sv', 'name' => $supervisor->getName(), 'id' => $supervisor->getId()];
                break;
            case "lecturer":
                $superviseesIds = $user->getSuperviseeIDs();
                foreach ($superviseesIds as $superviseId) {
                    $supervisee = new User($superviseId);
                    $chats[] = ['type'=> 'stud','name' => $supervisee->getName(), 'id' => $supervisee->getId()];
                }
                break;
        }

        $groups = $this->getGroups();

        if ($groups) {
            foreach ($groups as $group) {
                $chats[] = ['type'=> 'group','name' => $group['groupName'], 'id' => $group['groupID']];
            }
        }

        $chats[] = ['type'=> 'admin','name' => $admin->getName(), 'id' => $admin->getId()];

        return $chats;
    }

    public function newMessageReceived($id){
        $newChat = new Chat($id);

        return count($newChat->messages) == count($this->messages);
    }

    public function getLatestMessage(){
        if($this->messages){
            $latestMessage = end($this->messages);
            return $latestMessage->getMessageId();
        }else{
            return "null";
        }
        
    }
}