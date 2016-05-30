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

//Simple server side validation for POST data, of course, you should validate the email
if (!$firstName2) $errors[count($errors)] = 'Please enter First name !';
	else if (!preg_match("/^[a-zA-Z ]*$/",$firstName2)) {
       $errors[count($errors)] = 'Only letters and white space allowed !';
     }

if (!$lastName2) $errors[count($errors)] = 'Please enter Last name !';
	else if (!preg_match("/^[a-zA-Z ]*$/",$lastName2)) {
       $errors[count($errors)] = 'Only letters and white space allowed !' ;
     }

if (!$address2) $errors[count($errors)] = 'Please enter address !';
else {
    	if(strlen($address2)<4)
    		$errors[count($errors)] = 'Address is too short (min 4 characters are required) !';
    	if(strlen($address2)>150)
    		$errors[count($errors)] = 'Address is too long (max 150 characters are allowed) !';
    } 


if (!$contactNo2) $errors[count($errors)] = 'Please enter Contact Number !';
	else {
    	if(strlen($contactNo2)>13 || strlen($contactNo2)<10)
    		$errors[count($errors)] = 'Contact no is not valid !';
    }  

if (!$email2) $errors[count($errors)] = 'Please enter email !';
 else if (!filter_var($email2, FILTER_VALIDATE_EMAIL)) {
       $errors[count($errors)] = 'Email format is not valid !';
     }


//if the errors array is empty, send the mail
if (!$errors){
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
			echo '<b> Your Details have been updated ! </b>';
		}
		else {
		echo '<b> Sorry, unexpected error. Please try again later ! </b>';
		
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
	for ($i=0; $i<count($errors); $i++) echo  '<b>' . $errors[$i] . '</b><br>';
}

}
?>
