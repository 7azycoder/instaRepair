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
                      <span id="resultDisplay" class="col s12" style="color:red;"></span>
                      <form class="col s12" id="editShop" name="editShop">
                        <div class="row">
                          
                          <div class="input-field col s6">
                            <i class="material-icons prefix">shop</i>
                            <input id="shopName" name="shopName" type="text" value="<?php echo escape($data->shopName);?>" autocomplete="off">
                            <label class="active" for="shopName">Shop Name</label>
                          </div>

                           <div class="input-field col s6">
                              <select id="shopCategory" name="shopCategory">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="electronics">Electronics</option>
                                <option value="computers">Computer</option>
                                <option value="mobiles">Mobiles</option>
                              </select>
                              <label>Shop Category</label>
                            </div>
                            <div class="clearfix"></div>


                          <div class="input-field col s6">
                            <i class="material-icons prefix">shop</i>
                            <input id="shopNo"  name="shopNo" type="text" value="<?php echo escape($data->shopNo);?>" autocomplete="off">
                            <label class="active" for="shopNo">Shop No</label>
                          </div>

                          <div class="input-field col s6">
                              <select id="shopLevel" name="shopLevel">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                              </select>
                              <label>Shop Level</label>
                            </div>
                         

                          <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">mode_edit</i>
                            <textarea id="shopDescription" name="shopDescription" class="materialize-textarea" autocomplete="off"><?php echo escape($data->shopDescription);?></textarea>
                            <label class="active" for="shopDescription">Shop Description</label>
                          </div>

                          <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">store</i>
                            <textarea id="shopAddress" name="shopAddress" class="materialize-textarea" autocomplete="off"><?php echo escape($data->shopAddress);?></textarea>
                            <label class="active" for="shopAddress">Shop Address</label>
                          </div>



                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">phone</i>
                            <input id="shopContactNo" name="shopContactNo" type="text" value="<?php echo escape($data->shopContactNo);?>" autocomplete="off">
                            <label class="active" for="shopContactNo">Shop Contact No</label>
                          </div>


                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">email</i>
                            <input id="shopEmail" name="shopEmail" type="text" value="<?php echo escape($data->shopEmail);?>" autocomplete="off">
                            <label class="active" for="shopEmail">Shop Email</label>
                          </div>


                            
                          
                                                  
                          <div class="input-field col s12 m12 l12 center">
                          
                             <button class="btn waves-effect waves-light" id="shop" type="submit">Done
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
  <script src="js/init.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
$("#shop").click(function() {
var shopName = $("#shopName").val();
var shopNo = $("#shopNo").val();
var shopLevel = $("#shopLevel").val();
var shopCategory = $("#shopCategory").val();
var shopEmail = $("#shopEmail").val();
var shopContactNo = $("#shopContactNo").val();
var shopAddress = $("#shopAddress").val();
var shopDescription = $("#shopDescription").val();

var dataString = 'shopName='+ shopName + '&shopNo='+ shopNo + '&shopAddress='+ shopAddress + '&shopContactNo='+ shopContactNo + '&shopEmail=' + shopEmail + '&shopDescription=' + shopDescription + '&shopLevel=' + shopLevel + '&shopCategory=' + shopCategory;

if (shopName == '' || shopNo == '' || shopLevel == '' || shopContactNo == '' || shopEmail == '' || shopAddress == '' || shopDescription == '' || shopCategory == '') {
//alert(" Please Fill all the fields !!");
$("#resultDisplay").html("<b>Please fill all the fields</b>");
} else {
// Returns successful data submission message when the entered information is stored in database.
$.ajax({
type: "POST",
url: "editShopScript.php",
data: dataString,
cache: false,
success: function(result){
var data="";
data=JSON.stringify(result);

$("#resultDisplay").html(data);
}
});
}
return false;
});
});
</script>

<?php
}

?>