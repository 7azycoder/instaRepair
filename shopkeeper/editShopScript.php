<?php
require_once 'core/init.php';

$user = new User();

if(!$user->isLoggedIn()){
	Redirect::to('./shopLogin.php');

}
else {

$errors = array();

//Retrieve form data. 
//GET - user submitted data using AJAX
//POST - in case user does not support javascript, we'll use POST instead
$shopName = $_POST['shopName'];
$shopDescription = $_POST['shopDescription'];
$shopAddress = $_POST['shopAddress'];
$shopContactNo = $_POST['shopContactNo'];
$shopEmail = $_POST['shopEmail'];
$shopNo = $_POST['shopNo'];
$shopLevel = $_POST['shopLevel'];
$shopCategory = $_POST['shopCategory'];
//flag to indicate which method it uses. If POST set it to 1

if ($_POST) $post=1;

//Simple server side validation for POST data, of course, you should validate the shopEmail
if (!$shopName) $errors[count($errors)] = 'Please enter shop name !';
else {
    	if(strlen($shopName)<2)
    		$errors[count($errors)] = 'Shop name is too short (min 2 characters are required)!';
    		else if(strlen($shopName)>100)
    			$errors[count($errors)] = 'Shop name is too long (max 100 characters are allowed)!';
    } 
	

if (!$shopDescription) $errors[count($errors)] = 'Please enter shop description !';
else {
    	if(strlen($shopDescription)<5)
    		$errors[count($errors)] = 'Shop description is too short (min 5 characters are required)!';
    		else if(strlen($shopDescription)>200)
    			$errors[count($errors)] = 'Shop description is too long (max 200 characters are allowed)!';
    } 

if (!$shopAddress) $errors[count($errors)] = 'Please enter shop address !';
else {
    	if(strlen($shopAddress)<5)
    		$errors[count($errors)] = 'Shop address is too short (min 5 characters are required)!';
    		else if(strlen($shopAddress)>150)
    			$errors[count($errors)] = 'Shop address is too long (max 150 characters are allowed)!';
    } 


if (!$shopContactNo) $errors[count($errors)] = 'Please enter Shop Contact Number !';
	else {
    	if(strlen($shopContactNo)>13 || strlen($shopContactNo)<10)
    		$errors[count($errors)] = 'Shop Contact No is invalid !';
    }  

if (!$shopEmail) $errors[count($errors)] = 'Please enter shop email !';
 else if (!filter_var($shopEmail, FILTER_VALIDATE_EMAIL)) {
       $errors[count($errors)] = 'Shop email format is invalid !';
     }

if (!$shopNo) $errors[count($errors)] = 'Please enter Shop no !';
	
if (!$shopLevel) $errors[count($errors)] = 'Please enter Shop Level !';
if (!$shopCategory) $errors[count($errors)] = 'Please select Shop Category !';
	


//if the errors array is empty, send the mail
if (!$errors){
                try{
                  $user->update(array(
                             'shopName' => $shopName,
                             'shopDescription' => $shopDescription,
                             'shopAddress'=> $shopAddress,
                             'shopContactNo' => $shopContactNo,
                             'shopEmail' => $shopEmail,
                             'shopNo' => $shopNo,
                             'shopCategory' => $shopCategory,
                             'shopLevel' => $shopLevel                  
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