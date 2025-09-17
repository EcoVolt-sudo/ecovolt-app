<?php
require_once 'app/services/AuthService.php';

class AuthController {
    private $authService;
    
    public function __construct() {
        $this->authService = new AuthService();
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $user = $this->authService->login($username, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ?action=dashboard');
                exit;
            } else {
                $error = 'Usuário ou senha inválidos';
            }
        }
        
        include 'app/views/auth/login.php';
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            if ($this->authService->register($username, $password)) {
                header('Location: ?action=login');
                exit;
            } else {
                $error = 'Erro ao registrar usuário';
            }
        }
        
        include 'app/views/auth/register.php';
    }
    
    public function logout() {
        session_destroy();
        header('Location: ?action=login');
        exit;
    }
}
?>