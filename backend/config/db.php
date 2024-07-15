<?php
$host = "localhost";
$dbname = "jpo";
$username = "root";
$password = "";

try {
    // Créer la connexion PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}
?>
