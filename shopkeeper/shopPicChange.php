<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
   Redirect::to('../shopLogin.php');
}

else {
  $data = $user->data();
  $shopImage = $data->shopImage;
  $src = 'images/shopImages/' . $shopImage;

  ?>
<div class="page-content">
      

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
         
          <h4>Change Your Shop Picture</h4>
        </div>
     </div>
          <div class="row">
              
              <div class="col s4">
                     <div class="card">
                      <div id="image_preview" class="card-image waves-effect waves-block waves-light">

                        <img class="activator" id="previewing" src=<?php echo $src ; ?>>
                      </div>
                      
                    </div>
              </div>
              
                 
                  <form class="col s6" id="uploadimage" action="" method="post" enctype="multipart/form-data">
                  
                  <div id="selectImage">
                  <label>Select Your Image</label><br/>
                  <input type="file" name="file" id="file" required />
                  <input type="submit" value="Upload" class="submit" />
                  </div>
                  <h4 id='loading' >loading..</h4>
                  <div id="message"></div>
                  
                  </form>
                  
                  
              <!--form action="profilePicChange.php" method="post">
              <div class="file-field input-field col s8">
                            <div class="btn">
                              <span>Select File</span>
                              <input type="file" name="fileToUpload" id="fileToUpload" type="file">
                            </div>
                            <div class="file-path-wrapper">
                              <input class="file-path validate" type="text">
                            </div>
                            <button class="btn waves-effect waves-light" type="submit">Change
                                <i class="material-icons right">done_all</i>
                            </button>
              </div>
              </form-->
          </div>
        

    </div>
  </div>

</div>
<script type="text/javascript">
$(document).ready(function (e) {
$("#uploadimage").on('submit',(function(e) {
e.preventDefault();
$("#message").empty();
$('#loading').show();
$.ajax({
url: "shopPicChangeScript.php", // Url to which the request is send
type: "POST",             // Type of request to be send, called as method
data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
contentType: false,       // The content type used when sending data to the server.
cache: false,             // To unable request pages to be cached
processData:false,        // To send DOMDocument or non processed data file it is set to false
success: function(data)   // A function to be called if request succeeds
{
$('#loading').hide();
$("#message").html(data);
}
});
}));
// Function to preview image after validation
$(function() {
$("#file").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
$('#previewing').attr('src','default.png');
$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
return false;
}
else
{
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
}
});
});
function imageIsLoaded(e) {
$("#file").css("color","green");
$('#image_preview').css("display", "block");
$('#previewing').attr('src', e.target.result);
$('#previewing').attr('width', '250px');
$('#previewing').attr('height', '230px');
};
});
</script>

<?php
}
?>