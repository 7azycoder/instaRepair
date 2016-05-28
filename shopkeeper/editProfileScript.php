<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('../shopLogin.php');

}
else {

$errors = array();

//Retrieve form data. 
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$firstName2 = $_POST['firstName'];
$lastName2 = $_POST['lastName'];
$address2 = $_POST['address'];
$contactNo2= $_POST['contactNo'];
$email2 = $_POST['email'];
//flag to indicate which method it uses. If POST set it to 1

if ($_POST) $post=1;

//if the errors array is empty, send the mail
if (1){
                try{
                  $user->update(array(
                             'firstName' => $firstName2,
                             'lastName' => $lastName2,
                             'address'=> $address2,
                             'contactNo' => $contactNo2,
                             'email' => $email2                  
                    ));
                  $result = 1;
	}catch(Exception $e) {
                  die($e->getMessage());
                }
	
	//if POST was used, display the message straight away
	if ($_POST) {
		if ($result) {
			echo 'Your Details have been updated !';
		}
		else {
		echo 'Sorry, unexpected error. Please try again later !';
		
		}
		
	//else if GET was used, return the boolean value so that 
	//ajax script can react accordingly
	//1 means success, 0 means failed
	} else {
		echo $result;	
	}

//if the errors array has values
} 

}
?>
