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
              <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
              <fieldset>
              <div class="control-group">
                <label class="control-label" for="fileToUpload">Choose File to Upload</label>
                <div class="controls">
                <input class="input-file uniform_on" name="fileToUpload" id="fileToUpload" type="file">
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
