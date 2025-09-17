<?php
class Database {
    private $pdo;
    
    public function __construct() {
        $this->pdo = new PDO('sqlite:database/ecovolt.db');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->createTables();
        $this->insertSampleData();
    }
    
    public function getConnection() {
        return $this->pdo;
    }
    
    private function createTables() {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT UNIQUE NOT NULL,
                password TEXT NOT NULL,
                points INTEGER DEFAULT 0,
                level INTEGER DEFAULT 1,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS tasks (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT NOT NULL,
                points INTEGER NOT NULL,
                description TEXT
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS user_tasks (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER,
                task_id INTEGER,
                completed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (task_id) REFERENCES tasks(id)
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS badges (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                description TEXT,
                points_required INTEGER NOT NULL
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS user_badges (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER,
                badge_id INTEGER,
                earned_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id),
                FOREIGN KEY (badge_id) REFERENCES badges(id)
            )
        ");
    }
    
    private function insertSampleData() {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM tasks");
        $stmt->execute();
        if ($stmt->fetchColumn() == 0) {
            $tasks = [
                ['Desligar luzes desnecessárias', 10],
                ['Usar escada em vez do elevador', 15],
                ['Desconectar aparelhos da tomada', 20],
                ['Usar ventilador em vez do ar condicionado', 25],
                ['Tomar banho em 5 minutos', 30],
                ['Usar transporte público', 35],
                ['Secar roupa no varal', 20],
                ['Usar lâmpadas LED', 40]
            ];
            
            foreach ($tasks as $task) {
                $this->pdo->prepare("INSERT INTO tasks (title, points) VALUES (?, ?)")
                          ->execute($task);
            }
        }
        
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM badges");
        $stmt->execute();
        if ($stmt->fetchColumn() == 0) {
            $badges = [
                ['Iniciante', 'Primeiros passos na economia', 50],
                ['Economizador', 'Já está pegando o jeito', 150],
                ['Eco Warrior', 'Verdadeiro defensor do meio ambiente', 300],
                ['Mestre da Economia', 'Expert em economia de energia', 500],
                ['Lenda Verde', 'O maior economizador de todos', 1000]
            ];
            
            foreach ($badges as $badge) {
                $this->pdo->prepare("INSERT INTO badges (name, description, points_required) VALUES (?, ?, ?)")
                          ->execute($badge);
            }
        }
    }
}
?>