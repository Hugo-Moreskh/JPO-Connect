<?php

require_once './models/JpoModel.php';

// Enable CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *"); // ou spécifiez l'origine spécifique selon votre configuration
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");


$host = "localhost";
$dbname = "jpo";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    die();
}

$jpoModel = new JpoModel($conn);



$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

switch ($uri) {
    case '/jpo/read':
        if ($method == 'GET') {
            $stmt = $jpoModel->read();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($results);
        }
        break;

    case '/jpo/get':
        if ($method == 'GET' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $jpoModel->getJpoById($id);
            echo json_encode($result);
        }
        break;

    case '/JPO-Connect/backend/routes.php/jpo/create':
        if ($method == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $jpoModel->title = $data['title'];
            $jpoModel->date = $data['date'];
            $jpoModel->description = $data['description'];
            $jpoModel->location = $data['location'];
            $jpoModel->capacity = $data['capacity'];

            if ($jpoModel->create()) {
                echo json_encode(['message' => 'JPO created successfully.']);
            } else {
                echo json_encode(['message' => 'Failed to create JPO.']);
            }
        }

        break;

    case '/jpo/update':
        if ($method == 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);

            $jpoModel->id = $data['id'];
            $jpoModel->title = $data['title'];
            $jpoModel->date = $data['date'];
            $jpoModel->description = $data['description'];
            $jpoModel->location = $data['location'];
            $jpoModel->capacity = $data['capacity'];

            if ($jpoModel->update()) {
                echo json_encode(['message' => 'JPO updated successfully.']);
            } else {
                echo json_encode(['message' => 'Failed to update JPO.']);
            }
        }
        break;

    case '/jpo/delete':
        if ($method == 'DELETE') {
            $data = json_decode(file_get_contents('php://input'), true);

            $jpoModel->id = $data['id'];

            if ($jpoModel->delete()) {
                echo json_encode(['message' => 'JPO deleted successfully.']);
            } else {
                echo json_encode(['message' => 'Failed to delete JPO.']);
            }
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['message' => 'Route not found.']);
        break;
}
?>
