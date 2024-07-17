<?php
require_once 'adminRoutes.php';

function handleRequest($route, $adminController) {
    switch ($route) {
        case '':
        case '/':
            // Handle the root URL, e.g., display a welcome message or redirect
            echo "Welcome to the JPO Admin API";
            break;
        case '/admins':
            handleAdminRoutes($adminController);
            break;
        case '/login':
            echo "login";
            handleAuthenticateAdmin($adminController);
            break;
        default:
            http_response_code(404);
            echo "404 Not Found";
            break;
    }
}

