<?php
require('config.php');
abstract class Model{

    protected $dbh;
    protected $stmt;

    public function __construct(){
        try {
            $this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            echo "Connection Failed! " . $e->getMessage();
        }

    }

    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    //Binds the prep statement

    public function bind($param, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        $this->stmt->execute();
    }

    public function resultSet(){
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }

    public function getRowCount() {
        return $this->stmt->rowCount();
    }

    public function single(){
        $this->stmt->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function errorInfo() {
        return $this->stmt->errorInfo();
    }

    public function printStmt() {
        return $this->stmt->debugDumpParams();
    }

}