<?php
require_once 'core/init.php';
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
          <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Get Started</a>
        </div>
        <br><br>

      </div>
    </div>
    <div class="parallax"><img src="background1.jpg" alt="Unsplashed background img 1"></div>
  </div>

    
    <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
         
          <h3>Shop Registration</h3>
            
            

        <?php
        

        if(Input::exists()){
          if(Token::check(Input::get('token'))) {

            $validate = new Validate();
            $validation = $validate->check($_POST, array(
              'firstName' => array(
                'required' => true,
                'min' => 2,
                'max' => 25
                ),
              'lastName' => array(
                'required' => true,
                'min' => 2,
                'max' => 25
                ),
              'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 25,
                'unique' => 'shopkeeper'
                ),
              'address' => array(
                'required' => true,
                'min' => 4,
                'max' => 150
                ),
              'contactNo' => array(
                'required' => true,
                'min' => 6,
                'max' => 13
                ),
               'email' => array(
                'min' => 2,
                'max' => 50,
                'unique' => 'shopkeeper',
                'email_format' => true
                ),
              'password' => array(
                'required' => true,
                'min' => 6
                ),
              'password_again' => array(
                'required' => true,
                'matches' => 'password'
                )
              ));

              if($validation->passed()){
                $user = new User();

                $salt = Hash::salt(32);
              


                try{
                  $user->create(array(
                             'username' => Input::get('username'),     
                             'password' => Hash::make(Input::get('password'),$salt),    
                             'salt' => $salt,    
                             'firstName' => Input::get('firstName'),
                             'lastName' => Input::get('lastName'),
                             'address'=> Input::get('address'),
                             'contactNo' => Input::get('contactNo'),
                             'email' => Input::get('email'),        
                             'join' => date('Y-m-d H:i:s'),
                             'group' => 1
                    ));

                  Session::flash('home', '<div class=" alert alert-success" role="alert">You have been registered sucessfully and can now log in!</div>');
                  Redirect::to('shopLogin.php');

                } catch(Exception $e) {
                  die($e->getMessage());
                }

              
            } else {
              foreach ($validation->errors() as $error) {
                echo '<div class="alert alert-warning" role="alert">' . $error .'</div>';
              }
            }
          }
        }
        ?>
            
          <div class="row">
                      <form class="col s12" action="" method="post" >
                        <div class="row">
                          
                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">account_circle</i>
                            <input  name="firstName" type="text" value="<?php echo escape(Input::get('first'));?>" autocomplete="off">
                            <label for="firstName">First Name</label>
                          </div>


                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">account_circle</i>
                            <input  name="lastName" type="text"  value="<?php echo escape(Input::get('last'));?>" autocomplete="off">
                            <label for="lastName">Last Name</label>
                          </div>


                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">note_add</i>
                            <input name="username" type="text" value="<?php echo escape(Input::get('username'));?>" autocomplete="off">
                            <label for="username">Username</label>
                          </div>


                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">phone</i>
                            <input name="contactNo" type="text" value="<?php echo escape(Input::get('contact'));?>" autocomplete="off">
                            <label for="contactNo">Contact No</label>
                          </div>


                          <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">email</i>
                            <input name="email" type="text" value="<?php echo escape(Input::get('email'));?>" autocomplete="off">
                            <label for="email">Email</label>
                          </div>


                            <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">store</i>
                            <textarea name="address" class="materialize-textarea" value="<?php echo escape(Input::get('address'));?>" autocomplete="off"></textarea>
                            <label for="address">Address</label>
                          </div>
                          
                          
                         
                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">vpn_key</i>
                            <input name="password" type="password">
                            <label for="password">Password</label>
                          </div>


                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">vpn_key</i>
                            <input name="password_again" type="password">
                            <label for="password_again">Confirm Password</label>
                          </div>

                          
                         
                          
                          <div class="input-field col s12 m12 l12 center">
                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                             <button class="btn waves-effect waves-light" type="submit">Register
                                <i class="material-icons right">send</i>
                              </button>
                          </div>
                        </div>

                      </form>
                  </div>
        </div>
      </div>

    </div>
  </div>

  

  <footer class="page-footer teal">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">instaRepair</h5>
          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Navigation</h5>
          <ul>
            <li><a class="white-text" href="#!">About Us</a></li>
            <li><a class="white-text" href="#!">Login</a></li>
            <li><a class="white-text" href="#!">Register</a></li>
            <li><a class="white-text" href="#!">Repairs</a></li>
           
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Contact Us</h5>
          <ul>
            
            <li><a class="white-text" href="#!">dev.lovepreetsingh@gmail.com</a></li>
            
            <li><a class="white-text" href="#!">jaydeepjaina@gmail.com</a></li>
           
            <li><a class="white-text" href="#!">panchariyalokesh@gmail.com</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="white-text" href="http://materializecss.com">Lavi Jady Lokesh</a>
      </div>
    </div>
  </footer>

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
