<?php
  // Check if the request is POST
  if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    echo "Method Not Allowed";
    exit;
  }

  // Replace with your real receiving email address
  $receiving_email_address = 'sekoudiarra933@gmail.com';

  // Get POST data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  // Basic validation
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo "All fields are required.";
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
    exit;
  }

  // Import PHPMailer classes
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require '../vendor/autoload.php';

  $mail = new PHPMailer(true);

  try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sekoudiarra933@gmail.com';
    $mail->Password = 'yhto pgcx fbxi ipog'; // App password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('sekoudiarra933@gmail.com', 'Portfolio Contact');
    $mail->addAddress($receiving_email_address);
    $mail->addReplyTo($email, $name);

    // Content
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body = "From: $name\nEmail: $email\n\n$message";

    $mail->send();
    echo "OK";
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
?>
