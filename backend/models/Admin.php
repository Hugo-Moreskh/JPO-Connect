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
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function getUserByEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->getTableName() . " SET username = :username, email = :email, password = :password, role = :role, created_at = NOW()";

        $stmt = $this->conn->prepare($query);

        $this->sanitize();
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(":username", $this->username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(":role", $this->role, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            trigger_error("Error creating user: " . $errorInfo[2], E_USER_WARNING);
            return false;
        }
    }

    function update() {
        $query = "UPDATE " . $this->table_name . " SET username = :username, email = :email, password = :password, role = :role, modified_at = NOW() WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->sanitize();
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
        $stmt->bindParam(":username", $this->username, PDO::PARAM_STR);
        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(":role", $this->role, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            trigger_error("Error updating user: " . $errorInfo[2], E_USER_WARNING);
            return false;
        }
    }

    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            trigger_error("Error deleting user: " . $errorInfo[2], E_USER_WARNING);
            return false;
        }
    }
    
    function authenticate($email, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":email", $email, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
        } else {
            $errorInfo = $stmt->errorInfo();
            trigger_error("Error authenticating user: " . $errorInfo[2], E_USER_WARNING);
        }

        return false;
    }

    private function sanitize(){
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
    }
}
