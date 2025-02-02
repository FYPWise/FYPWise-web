<?php

namespace App\Models;
use App\Models\Db;

class Announcement{
    public $id;
    private $date;
    private $time;
    private $title;
    private $description;
    private $status;
    private $userID;
    private $db;
    private $shortDesc;

    public function __construct(){
        $this->db = new Db();
    }

    public function getDate(){
        return $this->date;
    }

    public function getTime(){
        return $this->time;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getUserID(){
        return $this->userID;
    }

    public function read($id){
        $sql = "SELECT * FROM announcement WHERE announcementID = $id";

        $result = $this->db->query($sql);

        if ($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $dateTime = new \DateTime($row['datetime']);
            $date = $dateTime->format('d-m-Y');
            $time = $dateTime->format('h:i:s A');

            $description = $row["description"];

            (strlen($description) > 50) ? $shortDesc = substr($description, 0, 50-3). '...' : $shortDesc = $description;

            $this->id = $row["announcementID"];
            $this->title = $row["title"];
            $this->description = $description;
            $this->shortDesc = $shortDesc;
            $this->date = $date;
            $this->time = $time;
            $this->status = $row["status"];
            $this->userID = $row["userID"];

            
        }
    }

    public function create($title, $description){
        $userId = $_SESSION['mySession'];
        
        $sql = "INSERT INTO `announcement`(`datetime`, `title`, `description`, `status`, `userID`) VALUES (NOW(), '$title', '$description', 'Active', $userId)";

        $result = $this->db->query($sql);

        if ($result){
            echo "created";
        }
    }

    public function find(){
        $sql = "SELECT announcementID from announcement";

        $result = $this->db->query($sql);

        $list = [];

        if ($result->num_rows > 0){
            while ($row = $result->fetch_array()) {
                $list[] = $row[0];
            }

            return $list;
        }else{
            return false;
        }
    }

    public function renderTable(){
        echo '

            <tr>
                <td><input title="'.$this->id.'" type="checkbox" class="row-checkbox" value="'.$this->id.'"></td>
                <td><a href="?view='.$this->id.'">'.$this->title.'</a></td>
                <td>'.$this->date.'</td>
                <td>'.$this->time.'</td>
                <td>'.$this->shortDesc.'</td>
                <td>
                    <p class="status">'.$this->status.'</p>
                </td>
                <td><button class="more-btn" type="button">⋮</button></td>
            </tr>

        ';
    }

    public function formView(){
        ?>
        <form class="proposal-form" id="proposalForm">
            <div class="form-group">
                <label for="announcement-id">Announcement ID</label>
                <p id="announcement-id" class="announcement-id"><?php echo $this->id ?></p>
            </div>

            <div class="form-group">
                <label for="announcement-title">Announcement Title</label>
                <input id="announcement-title" name="announcement-title" value="<?php echo $this->title ?>" disabled>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" id="description" name="description" disabled> <?php echo $this->description ?> </textarea>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <p id="date" name="date"><?php echo $this->date ?></p>
            </div>

            <div class="form-group">
                <label for="time">Time</label>
                <p id="time" name="time"><?php echo $this->time ?></p>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required disabled>
                    <option id="active" value="active" <?php echo $this->status=='Active' ? 'selected': ''  ?>> Active </option>
                    <option id="archived" value="archived" <?php echo $this->status=='Archived' ? 'selected': ''  ?>> Archived </option>
                </select>
            </div>

            <button>edit</button>
        </form>
        <?php
    }
}