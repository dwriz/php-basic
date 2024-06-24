<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'controllers/UserController.php';

$controller = new UserController();

$action = isset($_GET['action']) ? $_GET['action'] : 'showLoginForm';

switch($action) {
    case 'login':
        $controller->login();
        break;
    case 'logout':
        $controller->logout();
        break;
    default:
        $controller->showLoginForm();
        break;
}
?>
