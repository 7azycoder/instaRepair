<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('./shopLogin.php');

}
else {

$results = array();

//Retrieve form data. 
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$password = ($_GET['password']) ? $_GET['password'] : $_POST['password'];
$password_again = ($_GET['password_again']) ? $_GET['password_again'] : $_POST['password_again'];

//flag to indicate which method it uses. If POST set it to 1

if ($_POST) $post=1;

if (!$password) $errors[count($errors)] = 'Please enter password.';
else {
    	if(strlen($password)<6)
    		$errors[count($errors)] = "Password is too short (min 6 characters are required).";
    		else if(strlen($password)>32)
    			$errors[count($errors)] = "Password is too long (max 32 characters are allowed).";
    } 
if (!$password_again) $errors[count($errors)] = 'Please enter password again.';
else {
    	if(strcmp($password_again, $password)!=0)
    		$errors[count($errors)] = "Passwords do not match.";    		
 } 





//if the errors array is empty, send the mail
if (!$errors){

			$salt = Hash::salt(32);

                try{
                  $user->update(array(
                             'password' => Hash::make(Input::get('password'),$salt), 
                             'salt' => $salt       
                    ));
                  $result = 1;
	}catch(Exception $e) {
                  die($e->getMessage());
                }
	
	//if POST was used, display the message straight away
	if ($_POST) {
		if ($result) {
			Session::flash('editPro','<div class="alert alert-success" role="alert">Password has been successfully Changed !</div>');
			Redirect::to('index.php');
		}
		else {
			Session::flash('editPro','<div class="alert alert-warning" role="alert">Sorry, unexpected error. Please try again later ! </div>');
			Redirect::to('index.php');
		}
		
	//else if GET was used, return the boolean value so that 
	//ajax script can react accordingly
	//1 means success, 0 means failed
	} else {
		echo $result;	
	}

//if the errors array has values
} else {
	//display the errors message
	$return_string = '';
	for ($i=0; $i<count($errors); $i++) $return_string .= '<div class="alert alert-warning" role="alert">' . $errors[$i] . '</div>';
	
	Session::flash('editPro',$return_string);
	Redirect::to('index.php');
}

}
?>
