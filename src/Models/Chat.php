<?php

namespace App\Models;

use App\Models\Db;

class Chat{
    private $db;

    public function __construct() {
      $this->db = new Db();
    }

    public function getGroups($userId){
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

    public function getChat(User $user){
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

        $groups = $this->getGroups($user->getUserID());

        if ($groups) {
            foreach ($groups as $group) {
                $chats[] = ['type'=> 'group','name' => $group['groupName'], 'id' => $group['groupID']];
            }
        }

        $chats[] = ['type'=> 'admin','name' => $admin->getName(), 'id' => $admin->getId()];

        return $chats;
    }
}