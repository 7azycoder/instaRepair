<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
   Redirect::to('../shopLogin.php');
}

$data = $user->data();


if(isset($_FILES["file"]["type"]))
{
$validextensions = array("jpeg", "jpg", "png");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
) && ($_FILES["file"]["size"] < 500000)//Approx. 100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
if ($_FILES["file"]["error"] > 0)
{
echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
}
else
{
if (file_exists("images/shopImages/" . $data->username . '.'. $file_extension)) {
	unlink("images/shopImages/" . $data->username . '.'. $file_extension);

}


$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
$targetPath = "images/shopImages/".$_FILES['file']['name']; // Target path where file is to be stored
move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file

 $oldname = "images/shopImages/".$_FILES['file']['name'];
 $newname = "images/shopImages/" . $data->username . '.'. $file_extension; 
     rename ($oldname, $newname);

               try{
                            $user->update(array(
                              'shopImage' =>  $data->username . '.' . $file_extension                                                        
                             ));
                                   
                 }catch(Exception $e) {
                                    die($e->getMessage());
                    }
echo "<span id='success'>Image Uploaded Successfully...<br> You need to logout and login again to view changes in Shop picture!!</span><br/>";
/*echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>"; */

}
}
else
{
echo "<span id='invalid'>***Invalid file Size or Type***<span>";
}
}
?>