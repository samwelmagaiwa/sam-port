<?php
// Enable error reporting for debugging (remove in production)
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST, OPTIONS');
// header('Access-Control-Allow-Headers: Content-Type');
// if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit(0); }

// $receiving_email_address = 'samwelmagaiwa229@gmail.com';

// if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
//     include($php_email_form);
// } else {
//     http_response_code(500);
//     die('Unable to load the "PHP Email Form" Library!');
// }

// function validate($data, $fields) {
//     $errors = [];
//     foreach ($fields as $field) {
//         if (empty(trim($data[$field] ?? ''))) {
//             $errors[] = ucfirst($field) . ' is required.';
//         }
//     }
//     if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
//         $errors[] = 'Invalid email address.';
//     }
//     return $errors;
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $required = ['name', 'email', 'phone', 'date', 'department', 'doctor', 'message'];
//     $errors = validate($_POST, $required);
//     if ($errors) {
//         http_response_code(400);
//         echo implode(' ', $errors);
//         exit;
//     }

//     $contact = new PHP_Email_Form;
//     $contact->ajax = true;
//     $contact->to = $receiving_email_address;
//     $contact->from_name = $_POST['name'];
//     $contact->from_email = $_POST['email'];
//     $contact->subject = 'Online Appointment Form';

//     $contact->add_message($_POST['name'], 'Name');
//     $contact->add_message($_POST['email'], 'Email');
//     $contact->add_message($_POST['phone'], 'Phone');
//     $contact->add_message($_POST['date'], 'Appointment Date');
//     $contact->add_message($_POST['department'], 'Department');
//     $contact->add_message($_POST['doctor'], 'Doctor');
//     $contact->add_message($_POST['message'], 'Message');

//     echo $contact->send();
// } else {
//     http_response_code(405);
//     echo 'Method not allowed.';
// }
