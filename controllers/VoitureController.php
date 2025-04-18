<?php
require_once __DIR__ . '/../vendor/autoload.php';

class VoitureController {
    // Create a new voiture
    public function createVoiture($modele, $prix, $clientId) {
        $voiture = new Voiture(null, $modele, $prix, $clientId);
        $voiture->create();
        header('Location: /automobile/voitures/list');
        return $voiture;
    }

    // Update a voiture
    public function updateVoiture($id, $modele, $prix, $clientId) {
        $voiture = Voiture::findById($id);
        if ($voiture) {
            $voiture->setModele($modele);
            $voiture->setPrix($prix);
            $voiture->setClientId($clientId);
            $voiture->update();
            header('Location: /automobile/voitures/list');
            return $voiture;
        }
        return null;
    }

    // Delete a voiture
    public function deleteVoiture($id) {
        $voiture = Voiture::findById($id);
        if ($voiture) {
            $voiture->delete();
            header('Location: /automobile/voitures/list');
            exit();
        }
        return false;
    }

    // Redirect to the add view
    public function addView() {
        $clients = Client::findAll(); // Fetch all clients
        require_once __DIR__ . '/../views/voiture/add.php';
        exit();
    }

    // Redirect to the update view
    public function updateView($id) {
        $voiture = Voiture::findById($id);
        $clients = Client::findAll(); // Fetch all clients
        require_once __DIR__ . '/../views/voiture/update.php';
        exit();
    }

    // Redirect to the delete view
    public function deleteView($id) {
        $voiture = Voiture::findById($id);
        require_once __DIR__ . '/../views/voiture/delete.php';
        exit();
    }

    // Redirect to the list view
    public function listVoitures() {
        $voitures = Voiture::findAll();
        require_once __DIR__ . '/../views/voiture/list.php'; // Corrected path
        exit();
    }
}
?>
