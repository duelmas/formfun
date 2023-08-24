<?php
// Decode form data from token URL
if (isset($_GET['token'])) {
  $token = $_GET['token'];
  $formData = json_decode(base64_decode($token), true);
} else {
  $formData = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank You</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1>Thank You</h1>
    <p>We have sent you an email with a token URL that you can use to return to your form with all your saved data.</p>
    <p>If you are finished, click the button below to send the form data to our email:</p>
    <form action="send-email.php" method="POST">
      <input type="hidden" name="name" value="<?php echo $name; ?>">
      <input type="hidden" name="email" value="<?php echo $email; ?>">
      <input type="hidden" name="message" value="<?php echo $message; ?>">
      <button type="submit" class="btn btn-primary">Send Email</button>
    </form>
    <p>Or click the link below to return to your form:</p>
    <a href="https://yourwebsite.com/form1/index.php?token=<?php echo urlencode($token);?>" class="btn btn-primary">Return to Form : https://yourwebsite.com/form1/index.php?token=<?php echo urlencode($token);?></a>
    Or you can bookmark this link to return to it later but it is also in an email we sent you with the same url token.
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>
