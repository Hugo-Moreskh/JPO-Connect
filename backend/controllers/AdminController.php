<?php
require_once 'models/Admin.php';

class AdminController {
    private $database;
    private $admin;

    public function __construct($db) {
        $this->database = $db;
        $this->admin = new Admin($db);
    }

    public function getAllUsers() {
        $stmt = $this->admin->read();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function getUserByEmail($email) {
        $admin = $this->admin->getUserByEmail($email);
        return $admin;
    }

    public function createAdmin($username, $email, $password, $role) {
        $this->admin->username = $username;
        $this->admin->email = $email;
        $this->admin->password = $password;
        $this->admin->role = $role;

        if ($this->admin->create()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateAdmin($id, $username, $email, $password, $role) {
        $this->admin->id = $id;
        $this->admin->username = $username;
        $this->admin->email = $email;
        $this->admin->password = $password;
        $this->admin->role = $role;

        if ($this->admin->update()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteAdmin($id) {
        $this->admin->id = $id;

        if ($this->admin->delete()) {
            return true;
        } else {
            return false;
        }
    }

    public function authenticateAdmin($email, $password) {
        $admin = $this->admin->authenticate($email, $password);
        return $admin;
    }
}
