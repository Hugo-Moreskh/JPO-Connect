<?php
class Admin {
    private $conn;
    private $table_name = "admin";

    public $id;
    public $username;
    public $email;
    public $password;
    public $role;
    public $created_at;
    public $modified_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTableName() {
        return $this->table_name;
    }

    function read() {
        $query = "SELECT id, username, email, role FROM " . $this->table_name;
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt;
    }
    

    function getUserByEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->getTableName() . " (username, email, password, role) VALUES (:username, :email, :password, :role)";
    
        $stmt = $this->conn->prepare($query);
    
        $this->sanitize();
    
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);
    
        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            trigger_error("Error creating admin: " . $errorInfo[2], E_USER_WARNING);
            return false;
        }
    }
    

    function update() {
        $query = "UPDATE " . $this->table_name . " SET username = :username, email = :email, password = :password, role = :role WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->sanitize();

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":role", $this->role);

        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            trigger_error("Error updating admin: " . $errorInfo[2], E_USER_WARNING);
            return false;
        }
    }

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            trigger_error("Error deleting admin: " . $errorInfo[2], E_USER_WARNING);
            return false;
        }
    }
    
    
    
    function authenticate($email, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email,);
    
        if ($stmt->execute()) {
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($admin) {
                $hashedPassword = $admin['password'];
                if (password_verify($password, $hashedPassword)) {
                    return $admin;
                }
            }
        } else {
            $errorInfo = $stmt->errorInfo();
            trigger_error("Error authenticating admin: " . $errorInfo[2], E_USER_WARNING);
        }
    
        return false; // Return false if authentication fails
    }
    
    
    

    private function sanitize() {
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        var_dump($this->password);
    }
    
}
// $2y$10$eQIjonmSk6zjrUP1zMqyZOKTm5eZ8rb6rdHPd9Uq3.fBSQHsRtszy
// $2y$10$eQIjonmSk6zjrUP1zMqyZOKTm5eZ8rb6rdHPd9Uq3.f...