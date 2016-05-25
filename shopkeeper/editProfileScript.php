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
$firstName = ($_GET['firstName']) ? $_GET['firstName'] : $_POST['firstName'];
$lastName = ($_GET['lastName']) ? $_GET['lastName'] : $_POST['lastName'];
$address = ($_GET['address']) ? $_GET['address'] : $_POST['address'];
$contactNo = ($_GET['contactNo']) ?$_GET['contactNo'] : $_POST['contactNo'];
$email = ($_GET['email']) ?$_GET['email'] : $_POST['email'];
//flag to indicate which method it uses. If POST set it to 1

if ($_POST) $post=1;

//Simple server side validation for POST data, of course, you should validate the email
if (!$firstName) $errors[count($errors)] = 'Please enter First name.';
	else if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
       $errors[count($errors)] = "Only letters and white space allowed";
     }

if (!$lastName) $errors[count($errors)] = 'Please enter Last name.';
	else if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
       $errors[count($errors)] = "Only letters and white space allowed";
     }

if (!$address) $errors[count($errors)] = 'Please enter address.';
else {
    	if(strlen($address)<2)
    		$errors[count($errors)] = "Address is too short (min 2 characters are required).";
    		else if(strlen($address)>150)
    			$errors[count($errors)] = "Address is too long (max 150 characters are allowed).";
    } 


if (!$contactNo) $errors[count($errors)] = 'Please enter Contact Number.';
	else {
    	if(strlen($contactNo)>13 && strlen($contactNo)<10)
    		$errors[count($errors)] = "Phone number is of invalid length.";
    }  

if (!$email) $errors[count($errors)] = 'Please enter email.';
 else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errors[count($errors)] = "Email format is not valid.";
     }


//if the errors array is empty, send the mail
if (!$errors){
                try{
                  $user->update(array(
                             'firstName' => $firstName,
                             'lastName' => $lastName,
                             'address'=> $address,
                             'contactNo' => $contactNo,
                             'email' => $email                  
                    ));
                  $result = 1;
	}catch(Exception $e) {
                  die($e->getMessage());
                }
	
	//if POST was used, display the message straight away
	if ($_POST) {
		if ($result) {
			Session::flash('editPro','<div class="alert alert-success" role="alert">Your Details have been updated !</div>');
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
