<?php
require_once 'config.php';

class User {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function register($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $hashedPassword);
        
        return $stmt->execute();
    }
    
    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // Verify password
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        
        return false;
    }
    
    public function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }
    
    public function logout() {
        // Unset all session variables
        session_unset();
        
        // Destroy the session
        session_destroy();
    }
}
?>
