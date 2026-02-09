<?php
// Suppress default HTML error display to ensure clean JSON output
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Enable CORS for any origin
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

// Handle preflight OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}

// Database Connection
$conn = mysqli_connect("localhost", "root", "12345", "portfolio_db");
?>