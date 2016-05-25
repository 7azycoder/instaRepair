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
$shopName = ($_GET['shopName']) ? $_GET['shopName'] : $_POST['shopName'];
$shopDescription = ($_GET['shopDescription']) ? $_GET['shopDescription'] : $_POST['shopDescription'];
$shopAddress = ($_GET['shopAddress']) ? $_GET['shopAddress'] : $_POST['shopAddress'];
$shopContactNo = ($_GET['shopContactNo']) ?$_GET['shopContactNo'] : $_POST['shopContactNo'];
$shopEmail = ($_GET['shopEmail']) ?$_GET['shopEmail'] : $_POST['shopEmail'];
$shopNo = ($_GET['shopNo']) ?$_GET['shopNo'] : $_POST['shopNo'];
$shopLevel = ($_GET['shopLevel']) ?$_GET['shopLevel'] : $_POST['shopLevel'];
//flag to indicate which method it uses. If POST set it to 1

if ($_POST) $post=1;

//Simple server side validation for POST data, of course, you should validate the shopEmail
if (!$shopName) $errors[count($errors)] = 'Please enter Shop name.';
	else if (!preg_match("/^[a-zA-Z ]*$/",$shopName)) {
       $errors[count($errors)] = "Only letters and white space allowed";
     }

if (!$shopDescription) $errors[count($errors)] = 'Please enter Shop description.';
	else if (!preg_match("/^[a-zA-Z ]*$/",$shopDescription)) {
       $errors[count($errors)] = "Only letters and white space allowed";
     }

if (!$shopAddress) $errors[count($errors)] = 'Please enter shop address.';
else {
    	if(strlen($shopAddress)<2)
    		$errors[count($errors)] = "Shop address is too short (min 2 characters are required).";
    		else if(strlen($shopAddress)>150)
    			$errors[count($errors)] = "Shop address is too long (max 150 characters are allowed).";
    } 


if (!$shopContactNo) $errors[count($errors)] = 'Please enter Contact Number.';
	else {
    	if(strlen($shopContactNo)>13 && strlen($shopContactNo)<10)
    		$errors[count($errors)] = "Phone number is of invalid length.";
    }  

if (!$shopEmail) $errors[count($errors)] = 'Please enter shop email.';
 else if (!filter_var($shopEmail, FILTER_VALIDATE_EMAIL)) {
       $errors[count($errors)] = "shop email format is invalid.";
     }

if (!$shopNo) $errors[count($errors)] = 'Please enter Shop no.';
	
if (!$shopLevel) $errors[count($errors)] = 'Please enter Shop name.';
	else if (!preg_match("/^[a-zA-Z ]*$/",$shopLeveL)) {
       $errors[count($errors)] = "Only letters and white space allowed";
     }


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
                             'shopLevel' => $shopLevel                  
                    ));
                  $result = 1;
	}catch(Exception $e) {
                  die($e->getMessage());
                }
	
	//if POST was used, display the message straight away
	if ($_POST) {
		if ($result) {
			Session::flash('editPro','<div class="alert alert-success" role="alert">Your Shop Details have been updated !</div>');
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
