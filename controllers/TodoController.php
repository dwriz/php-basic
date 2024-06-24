<?php
require_once 'models/Todo.php';
require_once 'config/Database.php';

class TodoController {
    private $db;
    private $todo;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $database = new Database();
        $this->db = $database->getConnection();
        $this->todo = new Todo($this->db);
    }

    public function index() {
        echo "Index method called<br>";

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit;
        }

        $stmt = $this->todo->read();
        if ($stmt === false) {
            echo "Error in query: " . $this->db->errorInfo()[2];
            exit;
        }

        $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($todos === false) {
            echo "Error fetching todos: " . $this->db->errorInfo()[2];
            exit;
        }

        include 'views/todo.php';
    }

    // Create a new todo
    public function create() {
        echo "Create method called<br>";

        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php");
            exit;
        }

        if (isset($_POST['task'])) {
            $this->todo->task = $_POST['task'];
            $this->todo->status = 'pending';
            $this->todo->user_id = $_SESSION['user_id'];

            if ($this->todo->create()) {
                header("Location: index.php");
            } else {
                echo "Error creating todo";
            }
        }
    }
}
?>
