<?php
require_once 'app/repositories/UserRepository.php';
require_once 'app/repositories/TaskRepository.php';
require_once 'app/repositories/BadgeRepository.php';

class GameService {
    private $userRepository;
    private $taskRepository;
    private $badgeRepository;
    
    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->taskRepository = new TaskRepository();
        $this->badgeRepository = new BadgeRepository();
    }
    
    public function completeTask($userId, $taskId) {
        $task = $this->taskRepository->findById($taskId);
        if (!$task) {
            return false;
        }
        
        $this->taskRepository->addUserTask($userId, $taskId);
        $this->userRepository->updatePoints($userId, $task['points']);
        
        $user = $this->userRepository->findById($userId);
        $newLevel = floor($user['points'] / 100) + 1;
        $this->userRepository->updateLevel($userId, $newLevel);
        
        return $this->checkNewBadges($userId);
    }
    
    public function checkNewBadges($userId) {
        $user = $this->userRepository->findById($userId);
        $eligibleBadges = $this->badgeRepository->getEligibleBadges($user['points']);
        $newBadges = [];
        
        foreach ($eligibleBadges as $badge) {
            if (!$this->badgeRepository->hasUserBadge($userId, $badge['id'])) {
                $this->badgeRepository->addUserBadge($userId, $badge['id']);
                $newBadges[] = $badge;
            }
        }
        
        return $newBadges;
    }
    
    public function getUserStats($userId) {
        $user = $this->userRepository->findById($userId);
        $badges = $this->badgeRepository->getUserBadges($userId);
        $completedTasks = $this->taskRepository->getUserCompletedTasks($userId);
        
        return [
            'user' => $user,
            'badges' => $badges,
            'completedTasks' => $completedTasks,
            'nextLevelPoints' => ($user['level'] * 100) - $user['points']
        ];
    }
    
    public function getRanking() {
        return $this->userRepository->getTopUsers(10);
    }
}
?>