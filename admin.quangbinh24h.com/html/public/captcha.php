<html>
  <body>
    <form action="" method="post">
<?php

require_once('recaptchalib.php');

function getIP()
{
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if (isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
    else $ip = "UNKNOWN";
    return $ip;
}   

// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6LcsDQgUAAAAAAsNID7jd3nNcXnxso3AymlkOJGO";
$privatekey = "6LcsDQgUAAAAAPEaoo7e6GXQtqoGHeJ2KwVh6y5Z";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;


var_dump($_POST);                                     
# was there a reCAPTCHA response?
if (isset($_POST["g-recaptcha-response"])) {
    $reCaptcha = new ReCaptcha($privatekey);
         $response = $reCaptcha->verifyResponse(
        getIP(),
        $_POST["g-recaptcha-response"]
    );
   if ($response != null && $response->success) {
        echo "Hi " . $_POST["name"] . " (" . $_POST["email"] . "), thanks for submitting the form!";
  } else {
                # set the error code so that we can display it
                $error = $response->error;
                echo $error;
                die("error!");
        }
}
?>
       <label for="name">Name:</label>
      <input name="name" required><br />
 
      <label for="email">Email:</label>
      <input name="email" type="email" required><br />
 
      <div class="g-recaptcha" data-sitekey="6LcsDQgUAAAAAAsNID7jd3nNcXnxso3AymlkOJGO"></div>
 
      <input type="submit" value="Submit" />
 
    </form>
 
    <!--js-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </body>
</html>
