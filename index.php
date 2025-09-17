<?php
session_start();
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/DashboardController.php';
require_once 'app/controllers/GameController.php';

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'register':
        $controller = new AuthController();
        $controller->register();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'dashboard':
        $controller = new DashboardController();
        $controller->index();
        break;
    case 'game':
        $controller = new GameController();
        $controller->index();
        break;
    case 'ranking':
        $controller = new GameController();
        $controller->ranking();
        break;
    case 'complete_task':
        $controller = new GameController();
        $controller->completeTask();
        break;
    default:
        header('Location: ?action=login');
        break;
}
?>