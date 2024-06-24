<?php
require_once 'models/User.php';
require_once 'config/Database.php';

class UserController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function showRegisterForm() {
        include 'views/register.php';
    }

    public function register() {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            if($this->user->register()) {
                header("Location: login.php");
            } else {
                echo "Error registering user";
            }
        }
    }

    public function showLoginForm() {
        include 'views/login.php';
    }

    public function login() {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            $userId = $this->user->login();
            if($userId) {
                session_start();
                $_SESSION['user_id'] = $userId;
                header("Location: index.php");
            } else {
                echo "Invalid username or password";
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
    }
}
?>
