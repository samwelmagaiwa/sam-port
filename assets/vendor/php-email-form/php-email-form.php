<?php
// class PHP_Email_Form {
//     public $to;
//     public $from_name;
//     public $from_email;
//     public $subject;
//     public $ajax = false;
//     public $smtp = null; // array with SMTP config
//     private $messages = [];

//     public function add_message($content, $label = '') {
//         if ($label) {
//             $this->messages[] = "$label: $content";
//         } else {
//             $this->messages[] = $content;
//         }
//     }

//     public function send() {
//         $headers = "From: {$this->from_name} <{$this->from_email}>\r\n";
//         $headers .= "Reply-To: {$this->from_email}\r\n";
//         $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

//         $body = implode("\n", $this->messages);

//         // SMTP support (basic, using mail() fallback)
//         if ($this->smtp && is_array($this->smtp)) {
//             // For real SMTP, use PHPMailer or similar library
//             // Here, just a placeholder to show where SMTP logic would go
//             return 'SMTP sending not implemented in this basic version.';
//         }

//         if (mail($this->to, $this->subject, $body, $headers)) {
//             return $this->ajax ? 'OK' : 'Message sent successfully!';
//         } else {
//             return $this->ajax ? 'ERROR' : 'Failed to send message.';
//         }
//     }
// }
