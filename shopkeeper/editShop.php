<?php

require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
  Redirect::to('../shopLogin.php');

} else {


    $data = $user->data();
    
?>
<div class="page-content">
      

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
         
          <h4>Edit Shop Details</h4>
            <?php
            require_once('core/init.php'); 
            ?>
            
            <div class="row">
                      <form class="col s12" action="editShopScript.php" method="post" >
                        <div class="row">
                          
                          <div class="input-field col s12">
                            <i class="material-icons prefix">shop</i>
                            <input  name="shopName" type="text" value="<?php echo escape($data->shopName);?>" autocomplete="off">
                            <label class="active" for="shopName">Shop Name</label>
                          </div>

                          <div class="input-field col s6">
                            <i class="material-icons prefix">shop</i>
                            <input  name="shopNo" type="text" value="<?php echo escape($data->shopNo);?>" autocomplete="off">
                            <label class="active" for="shopNo">Shop No</label>
                          </div>

                          <div class="input-field col s6">
                            <i class="material-icons prefix">shop</i>
                            <input  name="shopLevel" type="text" value="<?php echo escape($data->shopLevel);?>" autocomplete="off">
                            <label class="active" for="shopLevel">Shop Level</label>
                          </div>

                          <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">mode_edit</i>
                            <textarea name="shopDescription" class="materialize-textarea" autocomplete="off"><?php echo escape($data->shopDescription);?></textarea>
                            <label class="active" for="shopDescription">Shop Description</label>
                          </div>

                          <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">store</i>
                            <textarea name="shopAddress" class="materialize-textarea" autocomplete="off"><?php echo escape($data->shopAddress);?></textarea>
                            <label class="active" for="shopAddress">Shop Address</label>
                          </div>



                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">phone</i>
                            <input name="shopContactNo" type="text" value="<?php echo escape($data->shopContactNo);?>" autocomplete="off">
                            <label class="active" for="shopContactNo">Shop Contact No</label>
                          </div>


                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">email</i>
                            <input name="shopEmail" type="text" value="<?php echo escape($data->shopEmail);?>" autocomplete="off">
                            <label class="active" for="shopEmail">Shop Email</label>
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