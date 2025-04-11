<?php
require_once '../controllers/AuthController.php';

$authController = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'login':
                if (isset($_POST['username']) && isset($_POST['password'])) {
                    $authController->login($_POST['username'], $_POST['password']);
                } else {
                    $authController->redirectToLogin('Missing credentials');
                }
                break;
            case 'createUser':
                if ($authController->isAuthenticated()) { // Check if authenticated
                    if (isset($_POST['username']) && isset($_POST['password'])) {
                        $authController->createUser($_POST['username'], $_POST['password']);
                    } else {
                        echo "Error: Missing username or password.";
                    }
                } else {
                    header('Location: ../views/login.php');
                }
                break;
            default:
                echo "Error: Unknown action.";
        }
    } else {
        echo "Error: 'action' parameter is required.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'logout':
                $authController->logout();
                break;
            case 'login':
                $authController->redirectToLogin(); // Assuming this method exists to display the login form
                break;
            default:
                echo "Error: Unknown action.";
        }
    } else {
        echo "Error: 'action' parameter is required.";
    }
} else {
    echo "Error: Unsupported request method.";
}
?>
