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
         
          <h4>Edit Profile</h4>

            
            <div class="row">
                      <form method="post" action="" class="col s12" id="editProfile" name="editProfile" >
                        <div class="row">
                          
                          <div class="input-field col s12 m6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="firstName1" name="firstName" type="text" value="<?php echo escape($data->firstName);?>" autocomplete="off" onblur="validate('firstName', this.value)">
                            <label class="active" for="firstName">First Name</label>
                          </div>

                          <div class="input-field col s12 m6">
                            <div id="firstName"></div>
                          </div>
                          <div class="clearfix">
                          </div>




                          <div class="input-field col s12 m6">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="lastName1" name="lastName" type="text"  value="<?php echo escape($data->lastName);?>" autocomplete="off" onblur="validate('lastName', this.value)" >
                            <label class="active" for="lastName">Last Name</label>
                          </div>
                          <div class="input-field col s12 m6">
                            <div id="lastName"></div>
                          </div>
                          <div class="clearfix">
                          </div>


                          <div class="input-field col s12 m6">
                            <i class="material-icons prefix">phone</i>
                            <input id="contactNo1" name="contactNo" type="text" value="<?php echo escape($data->contactNo);?>" autocomplete="off" onblur="validate('contactNo', this.value)">
                            <label class="active" for="contactNo">Contact No</label>
                          </div>
                          <div class="input-field col s12 m6">
                            <div id="contactNo"></div>
                          </div>
                          <div class="clearfix">
                          </div>


                          <div class="input-field col s12 m6">
                            <i class="material-icons prefix">email</i>
                            <input id="email1" name="email" type="text" value="<?php echo escape($data->email);?>" autocomplete="off" onblur="validate('email', this.value)">
                            <label class="active" for="email">Email</label>
                          </div>
                          <div class="input-field col s12 m6">
                            <div id="email"></div>
                          </div>
                          <div class="clearfix">
                          </div>



                          <div class="input-field col s12 m6">
                            <i class="material-icons prefix">store</i>
                            <textarea id="address1" name="address" class="materialize-textarea" autocomplete="off" onblur="validate('address', this.value)" ><?php echo escape($data->address);?></textarea>
                            <label class="active" for="address">Address</label>
                          </div>
                          <div class="input-field col s12 m6">
                            <div id="address"></div>
                          </div> 
                          <div class="clearfix">
                          </div>   
                                                  
                          <div class="input-field col s12 m12 l12 center">
                           
                             <button class="btn waves-effect waves-light"  type="submit" onclick="checkForm()">Done
                                <i class="material-icons right">done_all</i>
                              </button>
                          </div>
                          
                          <!--input id="submit" type="button" value="Submit"-->
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
 function checkForm() {
      alert("form submitted");
      // Fetching values from all input fields and storing them in variables.
      var firstName = document.getElementById("firstName1").value;
      var lastName = document.getElementById("lastName1").value;
      var contactNo = document.getElementById("contactNo1").value;
      var address = document.getElementById("address1").value;
      var email = document.getElementById("email1").value;

      var dataString = 'firstName=' + firstName + '&email=' + email + '&lastName=' + lastName + '&contactNo=' + contactNo + '&address=' + address;

      //Check input Fields Should not be blanks.
      if (firstName == '' || lastName == ''|| contactNo == '' || email == '' || address == '') {
      alert("Fill All Fields");
      } else {
          //Notifying error fields
          var firstName1 = document.getElementById("firstName").value;
          var lastName1 = document.getElementById("lastName").value;
          var contactNo1 = document.getElementById("contactNo").value;
          var address1 = document.getElementById("address").value;
          var email1 = document.getElementById("email").value;

       
          if (firstName1.innerHTML == 'Must be greater than 2 letters' || firstName1.innerHTML == 'Must be less than 26 letters' || lastName1.innerHTML == 'Must be greater than 2 letters' || lastName1.innerHTML == 'Must be less than 26 letters' || email1.innerHTML == 'Invalid email' || email1.innerHTML == 'Must be less than 50 chars' || address1.innerHTML == 'Must be greater than 2 letters' || address1.innerHTML = 'Must be less than 150 letters' || contactNo1.innerHTML == 'Must be greater than 9 letters' || contactNo1.innerHTML == 'Must be less than 14 letters') {
                    alert("Fill Valid Information");
        }else{
          
         
            $.ajax({
              type: "POST",
              url: "editProfileScript.php",
              data: dataString,
              cache: false,
              success: function(html) {
              alert(html);
              }
              });
        }
}
return false;
}
// AJAX code to check input field values when onblur event triggerd.
function validate(field, query) {

var xmlhttp;
if (window.XMLHttpRequest) { // for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp = new XMLHttpRequest();
} else { // for IE6, IE5
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
document.getElementById(field).innerHTML = "Validating..";
} else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
document.getElementById(field).innerHTML = xmlhttp.responseText;
} else {
document.getElementById(field).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
}
}
xmlhttp.open("GET", "editProfileValidation.php?field=" + field + "&query=" + query, false);
xmlhttp.send();


}
/*
var dataString = 'field=' + field + '&query=' + query;
$.ajax({
type: "POST",
url: "editProfileValidation.php",
data: dataString,
cache: false,
success: function(html) {
alert(html);
}
});
}*/
</script>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>


<?php
}

?>