<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
   Redirect::to('../shopLogin.php');
}

else {

   $data = $user->data();
   $src = "images/profileImages/" . $data->profileImage;


?>
<div class="page-content">
      

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
         
          <h4>Your Profile</h4>
        </div>
      </div>
          <div class="row">
              <div class="col s4">
                     <div class="card">
                      <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="<?php echo $src ;?>" >
                      </div>
                      
                    </div>
              </div>
              <div class="col s8">
                     <div class="card-panel teal">
                      <span class="white-text">
                          <div><?php echo escape($data->firstName) . " " . escape($data->lastName); ?></div>
                          <div><?php echo escape($data->address); ?></div>
                          <div><?php echo escape($data->contactNo); ?></div>
                          <div><?php echo escape($data->email); ?></div>
                      </span>
                    </div>
                  
              </div>
          </div>
        

    </div>
  </div>

</div>

<?php
}
?>