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
         
          <h4>Change Your Password</h4>
            <?php
            require_once('core/init.php'); 
            ?>
            
            <div class="row">
                      <form class="col s12" action="passwordChangeScript.php" method="post" >
                        <div class="row">
                                
                         
                          <div class="input-field col s12 offset-m3 m6">
                            <i class="material-icons prefix">vpn_key</i>
                            <input name="password" type="password">
                            <label for="password">New Password</label>
                          </div>


                          <div class="input-field col s12 offset-m3 m6">
                            <i class="material-icons prefix">vpn_key</i>
                            <input name="password_again" type="password">
                            <label for="password_again">Renter New Password</label>
                          </div>

                          
                         
                          
                          <div class="input-field col s12 m12 l12 center">
                           
                             <button class="btn waves-effect waves-light" type="submit">Change
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
        

    </div>
  </div>

</div>

<?php
}

?>