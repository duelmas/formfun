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
  <title>Fun Form</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1>Fun Form</h1>
    <form action="save.php" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($formData['name']) ? $formData['name'] : ''; ?>">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($formData['email']) ? $formData['email'] : ''; ?>">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message"><?php echo isset($formData['message']) ? $formData['message'] : ''; ?></textarea>
      </div>
      <input type="hidden" name="token" value="<?php echo $token; ?>">
      <button type="submit" class="btn btn-primary">Save and Continue</button>
    </form>
    <form action="send-email.php" method="POST">
      <input type="hidden" name="name" value="<?php echo $name; ?>">
      <input type="hidden" name="email" value="<?php echo $email; ?>">
      <input type="hidden" name="message" value="<?php echo $message; ?>">
      <button type="submit" class="btn btn-primary">submit</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>
</html>
