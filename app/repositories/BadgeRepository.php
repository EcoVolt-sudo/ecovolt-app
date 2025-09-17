<?php
require_once 'app/models/Database.php';

class BadgeRepository {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function findAll() {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM badges ORDER BY points_required ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getUserBadges($userId) {
        $stmt = $this->db->getConnection()->prepare("
            SELECT b.* FROM badges b 
            JOIN user_badges ub ON b.id = ub.badge_id 
            WHERE ub.user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getEligibleBadges($points) {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM badges WHERE points_required <= ?");
        $stmt->execute([$points]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addUserBadge($userId, $badgeId) {
        $stmt = $this->db->getConnection()->prepare("INSERT INTO user_badges (user_id, badge_id) VALUES (?, ?)");
        return $stmt->execute([$userId, $badgeId]);
    }
    
    public function hasUserBadge($userId, $badgeId) {
        $stmt = $this->db->getConnection()->prepare("SELECT COUNT(*) FROM user_badges WHERE user_id = ? AND badge_id = ?");
        $stmt->execute([$userId, $badgeId]);
        return $stmt->fetchColumn() > 0;
    }
}
?>