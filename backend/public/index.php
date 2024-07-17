<?php
header('Content-Type: application/json; charset=utf-8');

// Load the required files
require_once '../config/db.php';
require_once '../controllers/AdminController.php';
require_once '../routes/routes.php';

// Create an instance of the Database class
$database = new Database();

// Call the getConnection method to establish the database connection
$db = $database->getConnection();

// Create an instance of the Admin model and pass the $db connection
$adminController = new AdminController($db);

// Handle the request based on the route
$route = $_SERVER['REQUEST_URI'];
handleRequest($route, $adminController);
