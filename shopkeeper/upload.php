<?php
require_once 'core/init.php';
$user = new User();
if(!$user->isLoggedIn()){
   Redirect::to('index.php');
}


                if(isset($_FILES['fileToUpload'])){


                $data = $user->data();
                $errors= array();

                $path = 'uploads/' . $data->username . "/";

                if (!file_exists($path)) {
                    mkdir($path,0777);
                }

                $target_file = $path . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $FileType = pathinfo($target_file,PATHINFO_EXTENSION);

                // Check if file already exists
                if (file_exists($target_file)) {
                    $errors[]="File already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 20971520) {
                    $errors[]="Your file is too large ( greater than 20 MB ).";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($FileType != "png" && $FileType != "jpeg" && $FileType != "jpg") {
                    $errors[]= "Only pdf, txt , doc & docx files can be uploaded !";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0 ) {
                    foreach ($errors as $error) {
                        echo '<div class="alert alert-warning" role="alert">' . $error . '</div>' ;
                    }
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo '<div class="alert alert-success" role="alert">The file : '. basename( $_FILES["fileToUpload"]["name"]). ' has been uploaded.</div>';

                    } else {
                        echo '<div class="alert alert-success" role="alert">Sorry, there was an error uploading your file.</div>';
                    }
                }


                }
            ?>
<div class="page-content">
      

  <div class="container">
    <div class="section">

      <div class="row">
        <div class="col s12 center">
         
          <h4>Change Your Profile Picture</h4>
          <div id="message"></div>
        </div>
     </div>
          <div class="row">
              <div class="col s4">
                     <div class="card">
                      <div class="card-image waves-effect waves-block waves-light">

                        <img class="activator" src="<?php echo $src ; ?>">
                      </div>
                      
                    </div>
              </div>
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
              <form id="uploadimage" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
              <fieldset>
              <div class="control-group">
                <label class="control-label" for="file">Choose File to Upload</label>
                <div class="controls">
                <input class="input-file uniform_on" name="file" id="file" type="file">
                </div>
              </div>          
              
              <div class="form-actions">
                <button type="submit" class="btn btn-primary">Upload File</button>
              
              </div>
              </fieldset>
            </form>   
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
url: "ajax_php_file.php", // Url to which the request is send
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
$('#previewing').attr('src','noimage.png');
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
