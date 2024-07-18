<?php
require_once '../models/Admin.php';
require_once '../../vendor/autoload.php';
use Firebase\JWT\JWT;


class AdminController {
    private $database;
    private $admin;

    public function __construct($db) {
        $this->database = $db;
        $this->admin = new Admin($db);
    }

    public function getAllUsers() {
        $stmt = $this->admin->read();
        $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $admins;
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
    private $secretKey = 'lzeorhiozcnurgyzioutyrzcaoituycazoirtxhzefh';

    public function generateJWT($userId, $role) {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // Token will expire in 1 hour

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'userId' => $userId,
            'role' => $role,
        ];

        $jwt = JWT::encode($payload, $this->secretKey, 'HS256');

        return $jwt;
    }

    public function authenticateAdmin($email, $password) {
        $admin = $this->admin->authenticate($email, $password);
    
        if ($admin) {
            $jwt = $this->generateJWT($admin['id'], $admin['role']);
            
            return $jwt;
        }
    
        return false;
    }
    
}
