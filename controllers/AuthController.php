<?php
require_once __DIR__ . '/../vendor/autoload.php';

class AuthController {
     // Handle user login
     public function login($username, $password) {
        $user = User::findByUsername($username);
        if ($user && password_verify($password, $user->getPassword())) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['user_id'] = $user->getId();
            header('Location: /automobile/voitures/list');
            exit();
        } else {
            $this->redirectToLogin('Invalid credentials ');
        }
    }

    // Handle user logout
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        require_once __DIR__ . '/../views/login.php'; // Corrected path
        exit();
    }

    // Check if a user is authenticated
    public static function isAuthenticated() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    // Redirect to the login view
    public function redirectToLogin($error = null) {
        if (is_array($error)) {
            $error = null; // Handle route calls with no parameters
        }
        if ($error) {
            header('Location: ./views/login.php?error=' . urlencode($error));
        } else {
            require_once __DIR__ . '/../views/login.php';
        }
        exit();
    }

    // Handle user creation
    public function createUser($username, $password) {
        if (User::findByUsername($username)) {
            echo "Error: Username already exists.";
            return;
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $user = new User(null, $username, $hashedPassword);
        $user->create();
        $this->redirectToLogin('User created successfully. Please log in.');
    }

    // Render the add user view
    public function addUserView() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // if (!isset($_SESSION['user_id'])) {
        //     $this->redirectToLogin('You must be logged in to access this page.');
        // }
        require_once __DIR__ . '/../views/user/add.php';
        exit();
    }
}
?>
