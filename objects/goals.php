<?php
require('../config/Model.php');
class Goals extends Model {

    private $tableName = "Goal";

    public $id;
    public $userId;
    public $GoalName;
    public $GoalStart;
    public $GoalComplete;
    public $TargetKVI;
    public $CurrentKVI;

    public function read() {
        $goalsArray = array();
        $goalsArray["records"] = array();
        $sql = "SELECT * FROM " . $this->tableName . " WHERE userId = :userId;";
        $this->query($sql);
        $this->bind(":userId", $this->userId);
        $results = $this->resultSet();
        if ($this->getRowCount() > 0) {
            foreach ($results as $row) {
                extract($row);
                $goalItem = array(
                    "id" => $id,
                    "name" => $GoalName,
                    "start" => date('m-d-Y H:i:s', $GoalStart),
                    "complete" => date('m-d-Y H:i:s', $GoalComplete),
                    "targetKVI" => $TargetKVI,
                    "currentKVI" => $CurrentKVI
                );
                array_push($goalsArray["records"], $goalItem);
            }
            echo json_encode($goalsArray);
        } else {
            echo json_encode(
                array("message" => "No results found!")
            );
        }
    }

    public function create() {
        $this->GoalName = htmlspecialchars(strip_tags($this->GoalName));
        $this->TargetKVI = htmlspecialchars(strip_tags($this->TargetKVI));
        $this->CurrentKVI = htmlspecialchars(strip_tags($this->CurrentKVI));
        $sql = "INSERT INTO Goal (userId, GoalName, GoalStart, GoalComplete, TargetKVI, CurrentKVI) VALUES (:userId, :GoalName, :GoalStart, :GoalComplete, :TargetKVI, :CurrentKVI);";
        $this->query($sql);
        $this->bind(":userId", $this->userId);
        $this->bind(":GoalName", $this->GoalName);
        $this->bind(":GoalStart", $this->GoalStart);
        $this->bind(":GoalComplete", NULL);
        $this->bind(":TargetKVI", $this->TargetKVI);
        $this->bind(":CurrentKVI", $this->CurrentKVI);
        if ($this->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $this->id = htmlspecialchars(strip_tags($this->id));
        $sql = "DELETE FROM " . $this->tableName . " WHERE id = :id;";
        $this->query($sql);
        $this->bind(":id", $this->id);
        if ($this->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $this->GoalName = htmlspecialchars(strip_tags($this->GoalName));
        $this->GoalStart = htmlspecialchars(strip_tags($this->GoalStart));
        $this->GoalComplete = htmlspecialchars(strip_tags($this->GoalComplete));
        $this->TargetKVI = htmlspecialchars(strip_tags($this->TargetKVI));
        $this->CurrentKVI = htmlspecialchars(strip_tags($this->CurrentKVI));
        $sql = "UPDATE Goal SET userId = :userId, GoalStart = :GoalStart, GoalComplete = :GoalComplete, TargetKVI = :TargetKVI, CurrentKVI = :CurrentKVI WHERE id = :id;";
        $this->query($sql);
        $this->bind(":userId", $this->userId);
        $this->bind(":GoalStart", $this->GoalStart);
        $this->bind(":GoalComplete", $this->GoalComplete);
        $this->bind(":TargetKVI", $this->TargetKVI);
        $this->bind(":CurrentKVI", $this->CurrentKVI);
        $this->bind(":id", $this->id);
        if ($this->execute()) {
            return true;
        }
        return false;
    }

    public function read_one() {
        //sanitize input
        //return one record using ID from GET array
    }
}