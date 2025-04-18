<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/routes/web.php';



$action = $_GET['action'] ?? 'default';

switch ($action) {
    case 'view':
        // Code to handle 'view' action
        break;
    case 'edit':
        // Code to handle 'edit' action
        break;
    case 'delete':
        // Code to handle 'delete' action
        break;
    default:
        // Code to handle default action
        break;
}