<?php
require_once 'app/repositories/UserRepository.php';
require_once 'app/repositories/TaskRepository.php';
require_once 'app/repositories/BadgeRepository.php';

class DashboardService {
    private $userRepository;
    private $taskRepository;
    private $badgeRepository;
    
    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->taskRepository = new TaskRepository();
        $this->badgeRepository = new BadgeRepository();
    }
    
    public function getDashboardData($userId) {
        $user = $this->userRepository->findById($userId);
        $tasks = $this->taskRepository->findAll();
        $completedTasks = $this->taskRepository->getUserCompletedTasks($userId);
        $badges = $this->badgeRepository->getUserBadges($userId);
        
        return [
            'user' => $user,
            'tasks' => $tasks,
            'completedTasks' => $completedTasks,
            'badges' => $badges,
            'consumptionData' => $this->getConsumptionData(),
            'alerts' => $this->getAlerts($user)
        ];
    }
    
    private function getConsumptionData() {
        return [
            ['Janeiro', 150],
            ['Fevereiro', 140],
            ['Março', 130],
            ['Abril', 125],
            ['Maio', 120],
            ['Junho', 115]
        ];
    }
    
    private function getAlerts($user) {
        $alerts = [];
        
        if ($user['points'] > 100) {
            $alerts[] = ['type' => 'success', 'message' => 'Parabéns! Você economizou 15% este mês!'];
        }
        
        $alerts[] = ['type' => 'warning', 'message' => 'Consumo alto detectado ontem às 14h'];
        
        return $alerts;
    }
}
?>