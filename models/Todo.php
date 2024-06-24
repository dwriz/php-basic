<?php
class Todo {
    private $conn;
    private $table_name = "todos";

    public $id;
    public $task;
    public $status;
    public $user_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if (!$stmt->execute()) {
            return false;
        }

        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET task=:task, status=:status, user_id=:user_id";
        $stmt = $this->conn->prepare($query);

        $this->task = htmlspecialchars(strip_tags($this->task));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        $stmt->bindParam(":task", $this->task);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":user_id", $this->user_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
