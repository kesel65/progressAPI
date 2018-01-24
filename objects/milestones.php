<?php
require("../config/Model.php");
class Milestones extends Model {
    private $tableName = 'Milestone';

    public $userId;
    public $id;
    public $GoalId;
    public $KVITypeId;
    public $name;
    public $description;
    public $TargetKVI;
    public $CurrentKVI;
    public $TargetDate;
    public $CompletedDate;
    public $cap;

    public function read() {
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $sql = "SELECT * FROM " . $this->tableName . " INNER JOIN Goal ON Goal.id = Milestone.GoalId WHERE Goal.userId = :userId;";
        $this->query($sql);
        $this->bind(":userId", $this->userId);
        $results = $this->resultSet();
        if ($this->getRowCount() > 0) {
            foreach ($results as $row) {
                extract($row);
                // populate array according to DB structure
                $goalItem = array(
                    "id" => $id,
                    "name" => $MilestoneName,
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
}