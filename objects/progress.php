<?php
require("../config/Model.php");
class Progress extends Model {
    private $tableName = "Progress";

    public $id;
    public $MilestoneId;
    public $InputValue;
    public $KVIValue;
    public $OccurrenceDate;

    public function read() {

    }

    public function create() {

    }

    public function update() {

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