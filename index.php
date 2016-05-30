<!--?php
require_once 'core/init.php';
$results = array();
$errors= array();

//Simple mail function with HTML header
function sendmail($to, $subject, $message, $from) {
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
  $headers .= 'From: ' . $from . "\r\n";
  
  $result = mail($to,$subject,$message,$headers);
  
  if ($result) return 1;
  else return 0;
}

if(Input::exists()) {
//Retrieve form data. 
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$name = $_POST["name"];
$email = $_POST["email"];
$feedback = $_POST["feedback"];

//flag to indicate which method it uses. If POST set it to 1

if ($_POST) $post=1;

//Simple server side validation for POST data, of course, you should validate the email
if (!$name) $errors[count($errors)] = 'Please enter your name.';
  else  if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $errors[count($errors)] = "Only letters and white space allowed in name";
     }
if (!$email) $errors[count($errors)] = 'Please enter your email.';
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errors[count($errors)] = "Email format is not valid.";
     }
if (!$feedback) $errors[count($errors)] = 'Please enter a message.'; 
//if the errors array is empty, send the mail
if (!$errors) {

  //recipient - replace your email here
  $to = 'lovepreet.singh010194@gmail.com';  
  //sender - from the form
  $from = $name;
  
  //subject and the html message
  $subject = 'Message from ' . $name; 
  $message = 'Name: ' . $name . '<br/>
           Email: ' . $email . '<br/>  
           Message: ' . nl2br($feedback) . '<br/>';

  //send the mail
  $result = sendmail($to, $subject, $message, $from);

  echo $result;
  
  //if POST was used, display the message straight away
  if ($_POST) {
    if ($result) {
      Session::flash('cont','<div class="alert alert-success" role="alert">Thank you! We have received your message ! </div>');
      Redirect::to('index.php');
    }
      else { 

      Session::flash('cont','<div class="alert alert-warning" role="alert">Sorry, unexpected error. Please try again later ! </div>');
    
    }
  //else if GET was used, return the boolean value so that 
  //ajax script can react accordingly
  //1 means success, 0 means failed
  } else {
    echo $result; 
  }

//if the errors array has values
} else {
  //display the errors message
  for ($i=0; $i<count($errors); $i++) $results[] = '<div class="alert alert-warning" role="alert">' . $errors[$i] . '</div>';
  
}

}

?-->
<?php
require_once 'core/init.php';
$results = array();

//Simple mail function with HTML header
function sendmail($to, $subject, $message, $from) {
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
  $headers .= 'From: ' . $from . "\r\n";
  
  $result = mail($to,$subject,$message,$headers);
  
  if ($result) return 1;
  else return 0;
}

if(Input::exists()) {
//Retrieve form data. 
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$name = $_POST["name"];
$email = $_POST["email"];
$feedback = $_POST["feedback"];

//flag to indicate which method it uses. If POST set it to 1

if ($_POST) $post=1;

//Simple server side validation for POST data, of course, you should validate the email
if (!$name) $errors[count($errors)] = 'Please enter your name.';
  else  if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $errors[count($errors)] = "Only letters and white space allowed in name";
     }
if (!$email) $errors[count($errors)] = 'Please enter your email.';
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errors[count($errors)] = "Email format is not valid.";
     }

if (!$feedback) $errors[count($errors)] = 'Please enter a message.'; 
//if the errors array is empty, send the mail
if (!$errors) {

  //recipient - replace your email here
  $to = 'lovepreet.singh010194@gmail.com';  
  //sender - from the form
  $from = $name . ' <' . $email . '>';
  
  //subject and the html message
  $subject = 'Message from ' . $name; 
  $message = 'Name: ' . $name . '<br/><br/>
           Email: ' . $email . '<br/><br/>  
           Message: ' . nl2br($feedback) . '<br/>';

  //send the mail
  $result = sendmail($to, $subject, $message, $from);
  
  //if POST was used, display the message straight away
  if ($_POST) {
    if ($result) {
      Session::flash('cont','<div class="alert alert-success" role="alert">Thank you! We have received your message ! </div>');
      Redirect::to('index.php');
    }
      else { 

      Session::flash('cont','<div class="alert alert-warning" role="alert">Sorry, unexpected error. Please try again later ! </div>');
    
    }
  //else if GET was used, return the boolean value so that 
  //ajax script can react accordingly
  //1 means success, 0 means failed
  } else {
    echo $result; 
  }

//if the errors array has values
} else {
  //display the errors message
  for ($i=0; $i<count($errors); $i++) $results[] = '<div class="alert alert-warning" role="alert">' . $errors[$i] . '</div>';
  
}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>instaRepair</title>
  <link rel="shortcut icon" type="images/x-icon" href="images/favicon.png">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
 <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

 <?php 
 require('header.php');
 ?>

  <main class="mdl-layout__content">
    <div class="page-content">
      <div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <h1 class="header center teal-text text-lighten-2">instaRepair</h1>
        <div class="row center">
          <h5 class="header col s12 black-text">Lets fix your Gadget</h5>
        </div>
        <div class="row center">
          <a href="repairs.php" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Search for a Repair Shop</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="background1.jpg" alt="Unsplashed background img 1"></div>
  </div>

     

  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 center">
        
          <h4>Services</h4>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center grey-text"><i class="material-icons">videocam</i></h2>
            <h5 class="center">Electronics</h5>

            <p class="light">We help you find a repair shop near you for all of your electronic items such as TV, washing machine, microwave, etc within seconds.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center grey-text"><i class="material-icons">airplay</i></h2>
            <h5 class="center">Computers</h5>

            <p class="light">We help you find a repair shop near you for your computer, laptop and other peripherals in no time.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center grey-text"><i class="material-icons">phonelink_setup</i></h2>
            <h5 class="center">Mobile Phones</h5>

            <p class="light">We help you find a repair shop near you for all of your mobile related issues.</p>
          </div>
        </div>
      </div>

    </div>
  </div>


  <div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
      <div class="container">
        <div class="row center">
          <h3 class="header col s12 white-text">We find you the best repair shops for your devices.</h3>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="background2.jpg" alt="Unsplashed background img 2"></div>
  </div>

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
         
          <h4>Feedback</h4>
          <div class="row">
                     <?php
          if(Session::exists('cont')){
              echo  Session::flash('cont') ;
            }
          else{
          foreach ($results as $statement) {
             echo '<div>' .  $statement . '</div>';
            }
          }


            
        ?>
                      <form class="col s12" method="post" action="">
                        <div class="row">
                          
                         
                          
                          <div class="input-field col s12 m6 l6" >
                            <i class="material-icons prefix grey-text">account_circle</i>
                            <input name="name" for="name" type="text" value="<?php echo escape(Input::get('name'));?>" autocomplete="off">
                            <label for="name">Name</label>
                          </div>

                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix grey-text">email</i>
                            <input name="email" for="email" type="email" value="<?php echo escape(Input::get('email'));?>" autocomplete="off">
                            <label for="email">Email</label>
                          </div>
                         
                       
                            <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix grey-text">chat</i>
                            <textarea name="feedback" for="feedback" class="materialize-textarea" ><?php echo escape(Input::get('feedback'));?></textarea>
                            <label for="feedback">Message</label>
                          </div>              
                         
                                                  
                         
                          <div class="input-field col s12 m12 l12 center">
                             <input name="submit" id="submit" type="submit" value="Send">
                          </div>
                        </div>
                      </form>
                  </div>
      </div>
         
      </div>

    </div>
  </div>


  
  <?php require_once('footer.php'); ?>
  

    </div>
  </main>
</div>
  
  


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/material.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
