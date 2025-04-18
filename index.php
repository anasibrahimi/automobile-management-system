<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/core/Router.php';

$router = new Router();

// Protect routes
if (!AuthController::isAuthenticated()) {
    $router->get('/', [AuthController::class, 'redirectToLogin']);
    $router->get('/getLoginForm', [AuthController::class, 'redirectToLogin']);
    $router->post('/login', [AuthController::class, 'login']);
} else {
    // Define routes
    $router->get('/', [VoitureController::class, 'listVoitures']);
    $router->get('/voitures/list', [VoitureController::class, 'listVoitures']);
    $router->get('/voitures/add', [VoitureController::class, 'addView']);
    $router->get('/voitures/edit/{id}', [VoitureController::class, 'updateView']);
    $router->get('/voitures/delete/{id}', [VoitureController::class, 'deleteView']);
    $router->post('/voitures/create', [VoitureController::class, 'createVoiture']);
    $router->post('/voitures/update', [VoitureController::class, 'updateVoiture']);
    $router->post('/voitures/remove', [VoitureController::class, 'deleteVoiture']);

    // Client routes
    $router->get('/clients', [ClientController::class, 'listClients']);
    $router->get('/clients/add', [ClientController::class, 'addView']);
    $router->get('/clients/edit/{id}', [ClientController::class, 'updateView']);
    $router->get('/clients/delete/{id}', [ClientController::class, 'deleteView']);
    $router->post('/clients/create', [ClientController::class, 'createClient']);
    $router->post('/clients/update', [ClientController::class, 'updateClient']);
    $router->post('/clients/remove', [ClientController::class, 'deleteClient']);

    // User routes
    $router->get('/users/add', [AuthController::class, 'addUserView']);
    $router->post('/users/create', [AuthController::class, 'createUser']);
    $router->get('/logout', [AuthController::class, 'logout']);
}

// Dispatch the request
$router->dispatch();
?>