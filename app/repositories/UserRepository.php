<?php
require_once 'app/models/Database.php';

class UserRepository {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function create($username, $hashedPassword) {
        $stmt = $this->db->getConnection()->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        return $stmt->execute([$username, $hashedPassword]);
    }
    
    public function findByUsername($username) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function findById($id) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updatePoints($userId, $points) {
        $stmt = $this->db->getConnection()->prepare("UPDATE users SET points = points + ? WHERE id = ?");
        return $stmt->execute([$points, $userId]);
    }
    
    public function updateLevel($userId, $level) {
        $stmt = $this->db->getConnection()->prepare("UPDATE users SET level = ? WHERE id = ?");
        return $stmt->execute([$level, $userId]);
    }
    
    public function getTopUsers($limit = 10) {
        $stmt = $this->db->getConnection()->prepare("SELECT username, points, level FROM users ORDER BY points DESC LIMIT ?");
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>