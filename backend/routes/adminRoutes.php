<?php
function handleAdminRoutes($adminController) {
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'GET':
            handleGetAdmins($adminController);
            break;
        case 'POST':
            handleCreateAdmin($adminController);
            break;
        case 'PUT':
            handleUpdateAdmin($adminController);
            break;
        case 'DELETE':
            handleDeleteAdmin($adminController);
            break;
        default:
            http_response_code(405);
            echo "Method Not Allowed";
            break;
    }
}

function handleGetAdmins($adminController) {
    $admins = $adminController->getAllUsers();
    $adminArray = array();
    $adminArray["admins"] = array();

    foreach ($admins as $row) {
        $adminItem = array(
            "id" => $row['id'],
            "username" => $row['username'],
            "email" => $row['email'],
            "role" => $row['role']
        );
        array_push($adminArray["admins"], $adminItem);
    }

    http_response_code(200);
    echo json_encode($adminArray);
}



function handleCreateAdmin($adminController) {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->username) && !empty($data->email) && !empty($data->password) && !empty($data->role)) {
        $success = $adminController->createAdmin($data->username, $data->email, $data->password, $data->role);

        if ($success) {
            http_response_code(201);
            echo "Admin created successfully";
        } else {
            http_response_code(500);
            echo "Failed to create admin";
        }
    } else {
        http_response_code(400);
        echo "Missing required fields";
    }
}

function handleAuthenticateAdmin($adminController){
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->email) && !empty($data->password)) {
        $success = $adminController->authenticateAdmin($data->email, $data->password);
        if ($success) {
            $jwt = $adminController->authenticateAdmin($data->email, $data->password);
            http_response_code(200);
            echo json_encode(array("token" => $jwt));
        } else {
            http_response_code(401);
            echo "Invalid credentials";
        }
    }
}

function handleUpdateAdmin($adminController) {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id) && (!empty($data->username) || !empty($data->email) || !empty($data->password) || !empty($data->role))) {
        $success = $adminController->updateAdmin($data->id, $data->username, $data->email, $data->password, $data->role);

        if ($success) {
            http_response_code(200);
            echo "Admin updated successfully";
        } else {
            http_response_code(500);
            echo "Failed to update admin";
        }
    } else {
        http_response_code(400);
        echo "Missing required fields";
    }
}

function handleDeleteAdmin($adminController) {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id)) {
        $success = $adminController->deleteAdmin($data->id);

        if ($success) {
            http_response_code(200);
            echo "Admin deleted successfully";
        } else {
            http_response_code(500);
            echo "Failed to delete admin";
        }
    } else {
        http_response_code(400);
        echo "Missing required fields";
    }
}

