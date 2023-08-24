<?php
// Save form data to database
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Generate token with encoded form data
$formData = array(
  'name' => $name,
  'email' => $email,
  'message' => $message
);
$token = base64_encode(json_encode($formData));

// Send email to user with token URL
$to = $email;
$subject = 'Your token URL';
$message = "Here's your token URL: https://yourwebsite.com/form1/index.php?token=$token";
$headers = 'From: webmaster@yourwebsite.com' . "\r\n" .
           'Reply-To: webmaster@yourwebsite.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

// Redirect to thank you page
header('Location: thank-you.php?token=' . urlencode($token));
exit;
?>
