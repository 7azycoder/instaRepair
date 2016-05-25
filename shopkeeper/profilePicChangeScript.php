<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
   Redirect::to('../shopLogin.php');
}

								if(isset($_FILES['fileToUpload']['name'])){


								$data = $user->data();
								$errors= array();

								$path = 'images/profileImages';

								if (!file_exists($path)) {
								    mkdir($path,0777);
								}


								$target_file = $path . "/" . basename($_FILES["fileToUpload"]["name"]);
								$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
								
								$uploadOk = 1;
								

								// Check if file already exists
								if (file_exists($target_file)) {
								    $errors[]="File already exists.";
								    $uploadOk = 0;
								}
								// Check file size
								if ($_FILES["fileToUpload"]["size"] > 3145728) {
								    $errors[]="Your file is too large ( greater than 3 MB ).";
								    $uploadOk = 0;
								}
								// Allow certain file formats
								if($FileType != "png" && $FileType != "jpeg" && $FileType != "jpg") {
								    $errors[]= "Image can only pe in png , jpeg and jpg format !";
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
								    	
								    	$oldname = $path . "/" . basename($_FILES["fileToUpload"]["name"]);
										$newname = $path . "/" . $data->username . $FileType; 

										rename ($oldname, $newname);

								    	try{
									                  $user->update(array(
									                             'profileImage' => basename($_FILES["fileToUpload"]["name"])
									                                       
									           ));
									                 
										}catch(Exception $e) {
									                  die($e->getMessage());
									      }

								    	Session::flash('editPro','<div class="alert alert-success" role="alert">The file : '. basename( $_FILES["fileToUpload"]["name"]) . ' has been uploaded.</div>');
											Redirect::to('index.php');
								       

								    } else {
								    	Session::flash('editPro','<div class="alert alert-success" role="alert">Sorry, there was an error uploading your file.</div>');
											Redirect::to('index.php');
								        
								    }
								}


								}
								else echo "1";
						?>


