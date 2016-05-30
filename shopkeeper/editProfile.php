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
                  
            <div class="row">
                      <span id="resultDisplay" class="col s12" style="color:red;"></span>
                      <form class="col s12" id="editProfile" name="editProfile">
                        <div class="row">
                          
                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="firstName" name="firstName" type="text" value="<?php echo escape($data->firstName);?>" autocomplete="off">
                            <label class="active" for="firstName">First Name</label>
                          </div>


                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="lastName" name="lastName" type="text"  value="<?php echo escape($data->lastName);?>" autocomplete="off">
                            <label class="active" for="lastName">Last Name</label>
                          </div>


                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">phone</i>
                            <input id="contactNo" name="contactNo" type="text" value="<?php echo escape($data->contactNo);?>" autocomplete="off">
                            <label class="active" for="contactNo">Contact No</label>
                          </div>


                          <div class="input-field col s12 m6 l6">
                            <i class="material-icons prefix">email</i>
                            <input id="email" name="email" type="text" value="<?php echo escape($data->email);?>" autocomplete="off">
                            <label class="active" for="email">Email</label>
                          </div>



                            <div class="input-field col s12 m12 l12">
                            <i class="material-icons prefix">store</i>
                            <textarea id="address" name="address" class="materialize-textarea" autocomplete="off"><?php echo escape($data->address);?></textarea>
                            <label class="active" for="address">Address</label>
                          </div>    
                                                  
                          <div class="input-field col s12 m12 l12 center">
                           
                             <button class="btn waves-effect waves-light" id="profile" type="submit" value="submit">Done
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
<script type="text/javascript">
  $(document).ready(function() {
$("#profile").click(function() {
var firstName = $("#firstName").val();
var lastName = $("#lastName").val();
var address = $("#address").val();
var email = $("#email").val();
var contactNo = $("#contactNo").val();
var dataString = 'firstName='+ firstName + '&lastName='+ lastName + '&address='+ address + '&contactNo='+ contactNo + '&email=' + email;

if (firstName == '' || lastName == '' || email == '' || contactNo == '' || address == '') {
//alert(" Please Fill all the fields !!");
$("#resultDisplay").html("<b>Please fill all the fields</b>");
} else {
// Returns successful data submission message when the entered information is stored in database.
$.ajax({
type: "POST",
url: "editProfileScript.php",
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