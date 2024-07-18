<!-- <?php

// require_once 'models/JpoModel.php';

// class JpoController {
//   private $database;
//   private $jpo;
//   private $admin;
//   public $id;

//   public function __construct($db) {
//       $this->database = $db;
//       $this->jpo = new JpoModel($db);
//   }
//   public function getAllJpo() {
//     $stmt = $this->jpo->read();
//     $jpo = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     return $jpo;
// }
// public function getJpoById($id) {
//   $admin = $this->admin->getJpoById($id);
//   return $admin;
// }
// public function createJpo($title, $date, $description, $location, $capacity) {
//   $this->admin->title = $title;
//   $this->admin->date = $date;
//   $this->admin->description = $description;
//   $this->admin->location = $location;
//   $this->admin->capacity = $capacity;

//   if ($this->admin->create()) {
//       return true;
//   } else {
//       return false;
//   }
// }
// public function updateJpo($id, $title, $date, $description, $location, $capacity) {
//   $this->admin->id = $id;
//   $this->admin->title = $title;
//   $this->admin->date = $date;
//   $this->admin->description = $description;
//   $this->admin->location = $location;
//   $this->admin->capacity = $capacity;

//   if ($this->admin->update()) {
//       return true;
//   } else {
//       return false;
//   }
// }
// public function deleteAdmin($id) {
//   $this->admin->id = $id;

//   if ($this->admin->delete()) {
//       return true;
//   } else {
//       return false;
//   }
// }
// }

?> -->