<?php
require_once 'app/services/DashboardService.php';

class DashboardController {
    private $dashboardService;
    
    public function __construct() {
        $this->dashboardService = new DashboardService();
    }
    
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?action=login');
            exit;
        }
        
        $data = $this->dashboardService->getDashboardData($_SESSION['user_id']);
        
        $user = $data['user'];
        $tasks = $data['tasks'];
        $completedTasks = $data['completedTasks'];
        $badges = $data['badges'];
        $consumptionData = $data['consumptionData'];
        
        include 'app/views/dashboard/index.php';
    }
}
?>