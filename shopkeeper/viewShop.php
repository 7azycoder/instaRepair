<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
   Redirect::to('../shopLogin.php');
}

else {

   $data = $user->data();
   $src = "images/shopImages/" . $data->shopImage;


?>
<div class="page-content">
      

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
         
          <h4>Shop Details</h4>
       </div>
     </div>
          <div class="row">
              <div class="col s4">
                     <div class="card">
                      <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="<?php echo $src ;?>">
                      </div>
                      
                    </div>
              </div>
              <div class="col s8">
                     <div class="card-panel teal">
                      <span class="white-text">
                          <div>Shop No : <?php echo escape($data->shopNo); ?></div>
                          <div>Shop Name : <?php echo escape($data->shopName); ?></div>
                          <div>Shop Description : <?php echo escape($data->shopDescription); ?></div>
                          <div>Shop Level : <?php echo escape($data->shopLevel); ?></div>
                          <div>Shop Category : <?php echo escape($data->shopCategory); ?></div>
                          <div>Shop Address : <?php echo escape($data->shopAddress); ?></div>
                          <div>Shop Contact No : <?php echo escape($data->shopContactNo); ?></div>
                          <div>Shop Email : <?php echo escape($data->shopEmail); ?></div>
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