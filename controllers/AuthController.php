<?php
require_once '../vendor/autoload.php';

class AuthController {
    // Handle user login
    public function login($username, $password) {
        $user = User::findByUsername($username);
        if ($user && password_verify($password, $user->getPassword())) {
            session_start();
            $_SESSION['user_id'] = $user->getId();
            header('Location: ../public/index.php?action=list');
            exit();
        } else {
            $this->redirectToLogin('Invalid credentials ');
        }
    }

    // Handle user logout
    public function logout() {
        session_start();
        session_destroy();
        require_once '../views/login.php';
        exit();
    }

    // Check if a user is authenticated
    public static function isAuthenticated() {
        session_start();
        return isset($_SESSION['user_id']);
    }

    // Redirect to the login view
    public function redirectToLogin($error = null) {
        $location = '../views/login.php';
        if ($error) {
            $location .= '?error=' . urlencode($error);
        }
        header('Location: ' . $location);
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
        session_start();
        if (!isset($_SESSION['user_id'])) {
            $this->redirectToLogin('You must be logged in to access this page.');
        }
        require_once '../views/user/add.php';
        exit();
    }
}
?>
