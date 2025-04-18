<?php
require_once __DIR__ . '/../vendor/autoload.php';

class Client {
    private $id;
    private $name;
    private $phone;

    public function __construct($id, $name, $phone) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
    }

    // Getter for id
    public function getId() {
        return $this->id;
    }

    // Getter for name
    public function getName() {
        return $this->name;
    }

    // Getter for phone
    public function getPhone() {
        return $this->phone;
    }

    // Setter for id
    public function setId($id) {
        $this->id = $id;
    }

    // Setter for name
    public function setName($name) {
        $this->name = $name;
    }

    // Setter for phone
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    // Create a new client record in the database
    public function create() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO client (name, phone) VALUES (?, ?)");
        $stmt->bind_param("ss", $this->name, $this->phone);
        $stmt->execute();
        $this->id = $stmt->insert_id;
        $stmt->close();
    }

    // Read a client record from the database by id
    public static function findById($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM client WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        if ($data) {
            return new Client($data['id'], $data['name'], $data['phone']);
        }
        return null;
    }

    // Read a client record from the database by name
    public static function findByName($name) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM client WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        if ($data) {
            return new Client($data['id'], $data['name'], $data['phone']);
        }
        return null;
    }

    // Retrieve all client records from the database
    public static function findAll() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM client");
        $stmt->execute();
        $result = $stmt->get_result();

        $clients = [];
        while ($data = $result->fetch_assoc()) {
            $clients[] = new Client($data['id'], $data['name'], $data['phone']);
        }

        $stmt->close();
        return $clients;
    }

    // Update an existing client record in the database
    public function update() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE client SET name = ?, phone = ? WHERE id = ?");
        $stmt->bind_param("ssi", $this->name, $this->phone, $this->id);
        $stmt->execute();
        $stmt->close();
    }

    // Delete a client record from the database
    public function delete() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM client WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $stmt->close();
    }

    // Retrieve all voitures associated with this client
    public function getVoitures() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM voiture WHERE client_id = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();

        $voitures = [];
        while ($data = $result->fetch_assoc()) {
            $voitures[] = new Voiture($data['id'], $data['modele'], $data['prix']);
        }

        $stmt->close();
        return $voitures;
    }

    // Associate a voiture with this client
    public function addVoiture(Voiture $voiture) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE voiture SET client_id = ? WHERE id = ?");
        $stmt->bind_param("ii", $this->id, $voiture->getId());
        $stmt->execute();
        $stmt->close();
    }

    // Remove the association of a voiture with this client
    public function removeVoiture(Voiture $voiture) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE voiture SET client_id = NULL WHERE id = ?");
        $stmt->bind_param("i", $voiture->getId());
        $stmt->execute();
        $stmt->close();
    }
}
?>
