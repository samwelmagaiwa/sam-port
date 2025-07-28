<?php
// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// CORS headers for AJAX requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit(0); }

// Load PHPMailer classes from the correct path
require_once __DIR__ . '/../assets/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../assets/vendor/phpmailer/src/SMTP.php';
require_once __DIR__ . '/../assets/vendor/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Set your email address here
$to = 'samwelmagaiwa229@gmail.com';

function sendContactEmailSMTP($to, $data) {
    $name    = trim($data['name'] ?? '');
    $email   = trim($data['email'] ?? '');
    $subject = trim($data['subject'] ?? '');
    $message = trim($data['message'] ?? '');

    $errors = [];
    if (!$name)    { $errors[] = 'Name is required.'; }
    if (!$email)   { $errors[] = 'Email is required.'; }
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address.'; }
    if (!$subject) { $errors[] = 'Subject is required.'; }
    if (!$message) { $errors[] = 'Message is required.'; }

    if ($errors) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'errors' => $errors]);
        return;
    }

    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'samwelmagaiwa229@gmail.com'; // Your Gmail address
        $mail->Password   = 'Samwel123?';    // Your Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress($to);

        // Content
        $mail->isHTML(false);
        $mail->Subject = "Contact Form: $subject";
        $mail->Body    = "You have received a new message from your website contact form.\n\n"
                       . "Name: $name\n"
                       . "Email: $email\n"
                       . "Subject: $subject\n"
                       . "Message:\n$message\n";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'OK']);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Mailer Error: ' . $mail->ErrorInfo
        ]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    sendContactEmailSMTP($to, $_POST);
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
}