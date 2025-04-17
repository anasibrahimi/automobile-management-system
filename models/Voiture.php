<?php
require_once '../vendor/autoload.php';

class Voiture {
    private $id;
    private $modele;
    private $prix;
    private $client_id;

    public function __construct($id, $modele, $prix, $client_id = null) {
        $this->id = $id;
        $this->modele = $modele;
        $this->prix = $prix;
        $this->client_id = $client_id;
    }
    
    // Getter for id
    public function getId() {
        return $this->id;
    }

    // Getter for modele
    public function getModele() {
        return $this->modele;
    }

    // Getter for prix
    public function getPrix() {
        return $this->prix;
    }

    // Getter for client_id
    public function getClientId() {
        return $this->client_id;
    }

    // Setter for id
    public function setId($id) {
        $this->id = $id;
    }

    // Setter for modele
    public function setModele($modele) {
        $this->modele = $modele;
    }

    // Setter for prix
    public function setPrix($prix) {
        $this->prix = $prix;
    }

    // Setter for client_id
    public function setClientId($client_id) {
        $this->client_id = $client_id;
    }

    // Create a new voiture record in the database
    public function create() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO voiture (modele, prix, id_client) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $this->modele, $this->prix, $this->client_id);
        $stmt->execute();
        $this->id = $stmt->insert_id;
        $stmt->close();
    }

    // Read a voiture record from the database by id
    public static function findById($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM voiture WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        if ($data) {
            return new Voiture($data['id'], $data['modele'], $data['prix'], $data['id_client']);
        }
        return null;
    }

    // Retrieve all voiture records from the database
    public static function findAll() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM voiture");
        $stmt->execute();
        $result = $stmt->get_result();

        $voitures = [];
        while ($data = $result->fetch_assoc()) {
            $voiture = new Voiture($data['id'], $data['modele'], $data['prix'], $data['id_client']);
            $client = $voiture->getClient();
            $voitures[] = [
                'voiture' => $voiture,
                'client_name' => $client ? $client->getName() : null
            ];
        }

        $stmt->close();
        return $voitures;
    }

    // Update an existing voiture record in the database
    public function update() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE voiture SET modele = ?, prix = ?, id_client = ? WHERE id = ?");
        $stmt->bind_param("sdii", $this->modele, $this->prix, $this->client_id, $this->id);
        $stmt->execute();
        $stmt->close();
    }

    // Delete a voiture record from the database
    public function delete() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM voiture WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $stmt->close();
    }

    // Retrieve the associated client
    public function getClient() {
        if ($this->client_id) {
            return Client::findById($this->client_id);
        }
        return null;
    }

    // Associate this voiture with a client
    public function associateClient(Client $client) {
        $this->client_id = $client->getId();
        $this->update();
    }

    // Remove the association with a client
    public function dissociateClient() {
        $this->client_id = null;
        $this->update();
    }
}
?>
