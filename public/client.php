<?php
require_once '../controllers/ClientController.php';

$controller = new ClientController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = isset($_GET['action']) ? $_GET['action'] : 'listClients'; // Default to 'listClients' if no action is provided
    switch ($action) {
        case 'listClients':
            $controller->listClients();
            break;
        case 'addClient':
            $controller->addView();
            break;
        case 'editClient':
            if (isset($_GET['id'])) {
                $controller->updateView($_GET['id']);
            } else {
                echo "Error: 'id' parameter is required for 'editClient' action.";
            }
            break;
        case 'deleteClient':
            if (isset($_GET['id'])) {
                $controller->deleteView($_GET['id']);
            } else {
                echo "Error: 'id' parameter is required for 'deleteClient' action.";
            }
            break;
        default:
            echo "Error: Unknown action.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'createClient':
                if (isset($_POST['name']) && isset($_POST['phone'])) {
                    $controller->createClient($_POST['name'], $_POST['phone']);
                } else {
                    echo "Error: 'name' and 'phone' parameters are required for 'createClient' action.";
                }
                break;
            case 'updateClient':
                if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['phone'])) {
                    $controller->updateClient($_POST['id'], $_POST['name'], $_POST['phone']);
                } else {
                    echo "Error: 'id', 'name', and 'phone' parameters are required for 'updateClient' action.";
                }
                break;
            case 'removeClient':
                if (isset($_POST['id'])) {
                    $controller->deleteClient($_POST['id']);
                } else {
                    echo "Error: 'id' parameter is required for 'removeClient' action.";
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
