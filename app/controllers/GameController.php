<?php
require_once 'app/services/GameService.php';
require_once 'app/repositories/TaskRepository.php';

class GameController {
    private $gameService;
    private $taskRepository;
    
    public function __construct() {
        $this->gameService = new GameService();
        $this->taskRepository = new TaskRepository();
    }
    
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?action=login');
            exit;
        }
        
        $stats = $this->gameService->getUserStats($_SESSION['user_id']);
        $tasks = $this->taskRepository->findAll();
        
        $user = $stats['user'];
        $badges = $stats['badges'];
        
        include 'app/views/game/index.php';
    }
    
    public function completeTask() {
        if (!isset($_SESSION['user_id']) || !isset($_POST['task_id'])) {
            header('Location: ?action=game');
            exit;
        }
        
        $taskId = $_POST['task_id'];
        $newBadges = $this->gameService->completeTask($_SESSION['user_id'], $taskId);
        
        if (!empty($newBadges)) {
            $_SESSION['new_badges'] = $newBadges;
        }
        
        header('Location: ?action=game');
        exit;
    }
    
    public function ranking() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?action=login');
            exit;
        }
        
        $ranking = $this->gameService->getRanking();
        include 'app/views/game/ranking.php';
    }
}
?>