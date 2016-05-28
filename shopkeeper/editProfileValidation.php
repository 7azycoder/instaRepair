<?php

$value =  $_GET['query'];
$formfield = $_GET['field'];

if ($formfield == "firstName") {
if (strlen($value) < 2) {
echo "Must be greater than 2 letters";
} else if(strlen($value >25)) {
echo "Must be less than 26 letters";
}
else {
echo "<span>Valid</span>";
}
}

if ($formfield == "lastName") {
if (strlen($value) < 2) {
echo "Must be greater than 2 letters";
} else if(strlen($value)>25) {
echo "Must be less than 26 letters";
}
else {
echo "<span>Valid</span>";
}
}

if ($formfield == "address") {
if (strlen($value) < 2) {
echo "Must be greater than 2 letters";
} else if(strlen($value)>150) {
echo "Must be less than 150 letters";
}
else {
echo "<span>Valid</span>";
}
}

if ($formfield == "contactNo") {
if (strlen($value) < 10) {
echo "Must be greater than 9 letters";
} else if(strlen($value)>13) {
echo "Must be less than 14 letters";
}
else {
echo "<span>Valid</span>";
}
}


// Check Valid or Invalid email when user enters email in email input field.
if ($formfield == "email") {
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)) {
echo "Invalid email";
} else if(strlen($value)>50) {
	echo "Must be less than 50 chars";
}
else{
	echo "<span>Valid</span>";


}
}
// Check Valid or Invalid website address when user enters website address in website input field.
/*if ($formfield == "website") {
if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $value)) {
echo "Invalid website";
} else {
echo "<span>Valid</span>";
}
}
*/
?>