<?php
require_once '../vendor/autoload.php';

// Authentication check
if (!AuthController::isAuthenticated()) {
    $auth = new AuthController();
    $auth->redirectToLogin();
    exit();
}

$controller = new VoitureController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? $_GET['action'] : 'list'; // Default to 'list' if no action is provided
    switch ($action) {
        case 'list':
            $controller->listVoitures();
            break;
        case 'add':
            $controller->addView();
            break;
        case 'edit':
            if (isset($_GET['id'])) {
                $controller->updateView($_GET['id']);
            } else {
                echo "Error: 'id' parameter is required for 'updateView' action.";
            }
            break;
        case 'delete':
            if (isset($_GET['id'])) {
                $controller->deleteView($_GET['id']);
            } else {
                echo "Error: 'id' parameter is required for 'deleteView' action.";
            }
            break;
        case 'error':
            $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'An unknown error occurred.';
            echo "<h1>Error</h1><p>$message</p>";
            break;
        default:
            echo "Error: Unknown action.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                if (isset($_POST['modele']) && isset($_POST['prix']) && isset($_POST['client_id'])) {
                    $controller->createVoiture($_POST['modele'], $_POST['prix'], $_POST['client_id']);
                } else {
                    echo "Error: 'modele', 'prix', and 'client' parameters are required for 'create' action.";
                }
                break;
            case 'update':
                if (isset($_POST['id']) && isset($_POST['modele']) && isset($_POST['prix'])) {
                    $controller->updateVoiture($_POST['id'], $_POST['modele'], $_POST['prix'], $_POST['client_id']);
                } else {
                    echo "Error: 'id', 'modele', and 'prix' parameters are required for 'update' action.";
                }
                break;
            case 'remove':
                if (isset($_POST['id'])) {
                    $controller->deleteVoiture($_POST['id']);
                } else {
                    echo "Error: 'id' parameter is required for 'delete' action.";
                }
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
