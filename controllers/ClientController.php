<?php
require_once '../models/Client.php';

class ClientController {
    // Create a new client
    public function createClient($name, $phone) {
        $client = new Client(null, $name, $phone);
        $client->create();
        header('Location: ../public/client.php?action=listClients');
        return $client;
    }

    // Update a client
    public function updateClient($id, $name, $phone) {
        $client = Client::findById($id);
        if ($client) {
            $client->setName($name);
            $client->setPhone($phone);
            $client->update();
            header('Location: ../public/client.php?action=listClients');
            return $client;
        }
        return null;
    }

    // Delete a client
    public function deleteClient($id) {
        $client = Client::findById($id);
        if ($client) {
            $client->delete();
            header('Location: ../public/client.php?action=listClients');
            exit();
        }
        return false;
    }

    // Redirect to the add view
    public function addView() {
        require_once '../views/client/add.php';
        exit();
    }

    // Redirect to the update view
    public function updateView($id) {
        $client = Client::findById($id);
        if ($client) {
            require_once '../views/client/update.php';
        } else {
            header('Location: ../public/index.php?action=error&message=Client%20not%20found');
            exit();
        }
    }

    // Redirect to the delete view
    public function deleteView($id) {
        $client = Client::findById($id);
        if ($client) {
            require_once '../views/client/delete.php';
        } else {
            header('Location: ../public/index.php?action=error&message=Client%20not%20found');
            exit();
        }
    }

    // Redirect to the list view
    public function listClients() {
        $clients = Client::findAll();
        require_once '../views/client/list.php';
        exit();
    }
}
?>
