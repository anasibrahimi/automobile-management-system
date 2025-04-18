<?php
require_once __DIR__ . '/../vendor/autoload.php';

class User {
    private $id;
    private $username;
    private $password;

    public function __construct($id, $username, $password) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    // Getter for id
    public function getId() {
        return $this->id;
    }

    // Getter for username
    public function getUsername() {
        return $this->username;
    }

    // Getter for password
    public function getPassword() {
        return $this->password;
    }

    // Setter for id
    public function setId($id) {
        $this->id = $id;
    }

    // Setter for username
    public function setUsername($username) {
        $this->username = $username;
    }

    // Setter for password
    public function setPassword($password) {
        $this->password = $password;
    }

    // Create a new user record in the database
    public function create() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO `users` (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $this->username, $this->password);
        $stmt->execute();
        $this->id = $stmt->insert_id;
        $stmt->close();
    }

    // Read a user record from the database by id
    public static function findById($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM `users` WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        if ($data) {
            return new User($data['id'], $data['username'], $data['password']);
        }
        return null;
    }

    // Find a user record from the database by username
    public static function findByUsername($username) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM `users` WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        if ($data) {
            return new User($data['id'], $data['username'], $data['password']);
        }
        return null;
    }

    // Retrieve all user records from the database
    public static function findAll() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM `users`");
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($data = $result->fetch_assoc()) {
            $users[] = new User($data['id'], $data['username'], $data['password']);
        }

        $stmt->close();
        return $users;
    }

    // Update an existing user record in the database
    public function update() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE `users` SET username = ?, password = ? WHERE id = ?");
        $stmt->bind_param("ssi", $this->username, $this->password, $this->id);
        $stmt->execute();
        $stmt->close();
    }

    // Delete a user record from the database
    public function delete() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM `users` WHERE id = ?");
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $stmt->close();
    }
}