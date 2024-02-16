# formfun

A basic simple lite PHP, HTML, Javascript form with a "save and continue" option.

It seems it is almost there...

Haven't seen a lot of really basic options out there for this functionality.  Could improve the validation, security and UI/UX quite a bit.

Gave up with sql option after hours going around in circles with Claude and perplexity.  Getting better with prompting.  
They seem to lack being able to provide full working code examples and often leave a lot out.  Lazy AI, passive aggressive AI, overworked AI?

Nevermind that.

Here is a basic start for a simple online form option with a save and continue functionality.

This method generates a token, sends token url to user email with saved form data. <br>
User can go back to form url and continue form with data. <br>
Currently the submit button is kind of broken... <br>
it's getting late...  <br>
This could also include an sql option at some point but simplicity seems to maybe do the trick.

<h2>Or AI just do what AI does.... </h2>

prompt= "provide full working complete code for an online form with a save and continue button that sends an email to the user with a generated token url they can return to form with information and a submit button that sends to email@sample.com. Code is completely working PHP, HTML, CSS and Javascript. Full code, not missing anything or leaving anything out with notes."

LLM served by Perplexity Labs / 
CodeLlama-70b

    Create a new file named form.php. This will be our main page where users fill in their details. Add the following code:

html
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta Tags -->
        <meta charset="UTF-8" />
        <title>Online Form</title>
        
        <!-- Stylesheet Links -->
        <link rel="stylesheet" href="/path/to/your/style.css" />
    
        <!-- JavaScript Script Includes (if needed)-->
        <script src="/path/to/jquery.js"></script>
        <script src="/path/to/other_scripts.js"></script>
    </head>

    <body>
        <h2>Fill Out Our Online Form</h2>
        <p class="instructions">Please enter your personal information below.</p>

        <div id="onlineFormContainer">
            <form action="" method="POST" enctype="multipart/form-data" id="onlineForm">
                <label for="nameInput">Name:</label><br/>
                <input type="text" name="user_name" id="nameInput"><br/>
                
                <label for="emailInput">Email Address:</label><br/>
                <input type="email" name="user_email" id="emailInput"><br/>
            
                <button type="submit" name="saveAndContinueBtn" value="Save And Continue">Save &amp; Continue</button>&nbsp;&nbsp;
                <a href="#" onclick="return false;" id="resumeLink">Resume Filling The Form Later...</a>
            </form>
        </div>

        <?php if(isset($_GET['token']) && !empty($_GET['token'])): ?>
          <span style="color:#0f9d58;">Your Token URL Is: http://example.com?token=<?=$_GET['token']; ?></span>
        <?php endif;?>

        <footer>
            Copyright &copy; Your Company Name - All Rights Reserved.
        </footer>

        <script>
            $(document).ready(function() {
              $("#resumeLink").click(function(){
               var data = $('#onlineForm').serialize(); // serialize all input fields into string format
               $.ajax({
			      url : "generateTokenURL.php", // path of php script which generates token url
			      type: 'post',
			      dataType:'json',
			      data : data,
			      success: function(response){
			       console.log("Successfully Generated Token Url");
			           window.location.href='http://example.com/?token='+response.url;// redirecting to same page but with token parameter
			      },error: function(jqXHR, textStatus, errorThrown){
			       alert('Error Occured While Saving Data');
			   }});
              });
            });
        </script>
    </body>
</html>

This creates a simple form with two inputs (name and email) along with a Save & Continue button and a link to resume filling the form later using a unique token URL. If you click on the "Resume..." link, it will generate a token URL and send you back to this page with the token as a query parameter. You'll see a message at the bottom indicating the token URL has been created successfully.

    Now create another file called processData.php, which will handle processing the submitted form data and sending emails. Here's what goes inside:

php
<?php
$errors = array();

if(!filter_var($_REQUEST["user_email"],FILTER_VALIDATE_EMAIL)){
 $errors[] = "Invalid Email";
}

if(count($errors)>0){
 echo json_encode(['status'=>false,'message'=>implode(', ', $errors)]);
 exit;
}else{
 $subject = "New User Registration Details";
 $headers = "From: example@gmail.com\r\nReply-To: example@gmail.com";
 $msgBody = "<b>User Information:</b>\n".$_REQUEST["user_name"]."\n".$_REQUEST["user_email"];
 mail("email@sample.com","Subject: $subject","Message Body: $msgBody","Headers: $headers");
 echo json_encode(['status'=>true]);
}
exit;

    Finally, we need one more file called generateTokenUrl.php, which handles generating the token URLs when requested by clicking on the "Resume..." link. Here's its contents:

php
<?php
session_start();
include_once 'processData.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $_SESSION['temp_data']['user_name'] = filter_input(INPUT_POST,"user_name");
 $_SESSION['temp_data']['user_email'] = filter_input(INPUT_POST,"user_email");

 $uniqueId = uniqid().rand(1000,9999);
 header('Location:/path/to/form.php?token='.$uniqueId.'&action=resume');
 die();
} else {
 header('HTTP/1.0 403 Forbidden');
 echo '<h1>Forbidden Access</h1>';
 die();
}

Now, whenever someone clicks on the "Resume..." link, they are taken to the same form page with a unique token appended to the URL. They can then proceed to finish filling out the rest of the form and hit Submit to process the entire thing. Note: Make sure to replace /path/to/ with actual paths to your files and adjust them accordingly based on your server setup. Additionally, make sure to configure SMTP settings correctly so that emails get sent properly.
