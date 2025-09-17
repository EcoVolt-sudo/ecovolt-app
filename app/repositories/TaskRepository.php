<?php
require_once 'app/models/Database.php';

class TaskRepository {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function findAll() {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM tasks");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function findById($id) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function addUserTask($userId, $taskId) {
        $stmt = $this->db->getConnection()->prepare("INSERT INTO user_tasks (user_id, task_id) VALUES (?, ?)");
        return $stmt->execute([$userId, $taskId]);
    }
    
    public function getUserCompletedTasks($userId) {
        $stmt = $this->db->getConnection()->prepare("
            SELECT t.*, ut.completed_at 
            FROM tasks t 
            JOIN user_tasks ut ON t.id = ut.task_id 
            WHERE ut.user_id = ? 
            ORDER BY ut.completed_at DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>