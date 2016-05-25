<?php

require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
  Redirect::to('../shopLogin.php');

} else {


    $data = $user->data();
    $imagePath = "images/profileImages/" . $data->username . ".png";
?>

<div class="page-content">
      

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
         
          <h4>Edit Profile</h4>
            <!--?php
        

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
                'email_format' => true
                )
             
              ));

              if($validation->passed()){
                $user = new User();

                try{
                  $user->update(array(
                              
                             'firstName' => Input::get('firstName'),
                             'lastName' => Input::get('lastName'),
                             'address'=> Input::get('address'),
                             'contactNo' => Input::get('contactNo'),
                             'email' => Input::get('email'),        
                             
                    ));

                  Session::flash('home', '<div class=" alert alert-success" role="alert">You details have been succesfully updated !</div>');
                  Redirect::to('index.php');

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
        ?-->
            
            <div class="row">
                      <form class="col s12" action="editProfileScript.php" method="post" >
                        <div class="row">
                          
                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">account_circle</i>
                            <input  name="firstName" type="text" value="<?php echo escape($data->firstName);?>" autocomplete="off">
                            <label class="active" for="firstName">First Name</label>
                          </div>


                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">account_circle</i>
                            <input  name="lastName" type="text"  value="<?php echo escape($data->lastName);?>" autocomplete="off">
                            <label class="active" for="lastName">Last Name</label>
                          </div>


                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">phone</i>
                            <input name="contactNo" type="text" value="<?php echo escape($data->contactNo);?>" autocomplete="off">
                            <label class="active" for="contactNo">Contact No</label>
                          </div>


                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">email</i>
                            <input name="email" type="text" value="<?php echo escape($data->email);?>" autocomplete="off">
                            <label class="active" for="email">Email</label>
                          </div>



                            <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">store</i>
                            <textarea name="address" class="materialize-textarea" autocomplete="off"><?php echo escape($data->address);?></textarea>
                            <label class="active" for="address">Address</label>
                          </div>    
                                                  
                          <div class="input-field col s12 m12 l12 center">
                           
                             <button class="btn waves-effect waves-light" type="submit">Done
                                <i class="material-icons right">done_all</i>
                              </button>
                          </div>
                        </div>

                      </form>
                  </div>
        </div>
      </div>
                  
        </div>
      </div>
        

    </div>
  </div>

</div>

<?php
}

?>