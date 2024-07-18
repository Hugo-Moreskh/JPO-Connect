<?php

class JpoModel {
  private $conn;
  private $table_name = "jpo";

  public $id;
  public $title;
  public $date;
  public $description;
  public $location;
  public $capacity;
  public $participants;
  public $created_at;
  public $modified_at;

  public function __construct($db) {
      $this->conn = $db;
  }

  public function getTableName() {
    return $this->table_name;
  }

  public function read() {
    $query = "SELECT * FROM " . $this->table_name;

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  function getJpoById($id) {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function create() {
  $query = "INSERT INTO " . $this->getTableName() . " SET title = :title, date = :date, description = :description, location = :location, capacity = :capacity, created_at = NOW()";

  $stmt = $this->conn->prepare($query);

  $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
  $stmt->bindParam(":date", $this->date, PDO::PARAM_STR);
  $stmt->bindParam(":description", $this-> description, PDO::PARAM_STR);
  $stmt->bindParam(":location", $this->location, PDO::PARAM_STR);
  $stmt->bindParam(":capacity", $this->capacity, PDO::PARAM_STR);
  

  if ($stmt->execute()) {
      return true;
  } else {
      $errorInfo = $stmt->errorInfo();
      trigger_error("Error creating user: " . $errorInfo[2], E_USER_WARNING);
      return false;
  }
}
function update() {
  $query = "UPDATE " . $this->table_name . " SET title = :title, date = :date, description = :description, location = :location, capacity = :capacity, modified_at = NOW() WHERE id = :id";

  $stmt = $this->conn->prepare($query);


  $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
  $stmt->bindParam(":title", $this->title, PDO::PARAM_STR);
  $stmt->bindParam(":date", $this->date, PDO::PARAM_STR);
  $stmt->bindParam(":description", $this->description, PDO::PARAM_STR);
  $stmt->bindParam(":location", $this->location, PDO::PARAM_STR);
  $stmt->bindParam(":capacity", $this->capacity, PDO::PARAM_STR);

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


}
?>
