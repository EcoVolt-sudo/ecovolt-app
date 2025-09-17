<?php
require_once 'app/repositories/UserRepository.php';

class AuthService {
    private $userRepository;
    
    public function __construct() {
        $this->userRepository = new UserRepository();
    }
    
    public function register($username, $password) {
        if (empty($username) || empty($password)) {
            return false;
        }
        
        if ($this->userRepository->findByUsername($username)) {
            return false;
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->userRepository->create($username, $hashedPassword);
    }
    
    public function login($username, $password) {
        $user = $this->userRepository->findByUsername($username);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }
    
    public function getUserById($id) {
        return $this->userRepository->findById($id);
    }
}
?>