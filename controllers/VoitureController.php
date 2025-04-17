<?php
require_once '../vendor/autoload.php';

class VoitureController {
    // Create a new voiture
    public function createVoiture($modele, $prix, $clientId) {
        $voiture = new Voiture(null, $modele, $prix, $clientId);
        $voiture->create();
        header('Location: ../public/index.php?action=list');
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
            header('Location: ../public/index.php?action=list');
            return $voiture;
        }
        return null;
    }

    // Delete a voiture
    public function deleteVoiture($id) {
        $voiture = Voiture::findById($id);
        if ($voiture) {
            $voiture->delete();
            header('Location: ../public/index.php?action=list');
            exit();
        }
        return false;
    }

    // Redirect to the add view
    public function addView() {
        $clients = Client::findAll(); // Fetch all clients
        require_once '../views/voiture/add.php';
        exit();
    }

    // Redirect to the update view
    public function updateView($id) {
        $voiture = Voiture::findById($id);
        $clients = Client::findAll(); // Fetch all clients
        require_once '../views/voiture/update.php';
        exit();
    }

    // Redirect to the delete view
    public function deleteView($id) {
        $voiture = Voiture::findById($id);
        require_once '../views/voiture/delete.php';
        exit();
    }

    // Redirect to the list view
    public function listVoitures() {
        $voitures = Voiture::findAll();
        require_once '../views/voiture/list.php';
        exit();
    }
}
?>
