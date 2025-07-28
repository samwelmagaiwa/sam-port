<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// CORS headers for AJAX requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit(0); }

// Database configuration
$host = 'localhost';
$db   = 'samtech_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

function saveQuoteRequest($dsn, $user, $pass, $options, $data) {
    $name     = trim($data['name'] ?? '');
    $email    = trim($data['email'] ?? '');
    $phone    = trim($data['phone'] ?? '');
    $service  = trim($data['service'] ?? '');
    $budget   = trim($data['budget'] ?? '');
    $timeline = trim($data['timeline'] ?? '');
    $message  = trim($data['message'] ?? '');
    $subject  = trim($data['subject'] ?? 'Quote Request');

    $errors = [];
    if (!$name)     { $errors[] = 'Name is required.'; }
    if (!$email)    { $errors[] = 'Email is required.'; }
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.';
    }
    if (!$phone)    { $errors[] = 'Phone is required.'; }
    if (!$service)  { $errors[] = 'Service is required.'; }
    if (!$budget)   { $errors[] = 'Budget is required.'; }
    if (!$timeline) { $errors[] = 'Timeline is required.'; }
    // Message is optional

    if ($errors) {
        http_response_code(400);
        echo implode(' ', $errors);
        return;
    }

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        $stmt = $pdo->prepare('INSERT INTO contact_requests (name, email, subject, message, phone, service, budget, timeline, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())');
        $stmt->execute([$name, $email, $subject, $message, $phone, $service, $budget, $timeline]);
        echo 'OK';
    } catch (PDOException $e) {
        http_response_code(500);
        echo 'Database error: ' . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    saveQuoteRequest($dsn, $user, $pass, $options, $_POST);
} else {
    http_response_code(405);
    echo 'Method not allowed.';
}