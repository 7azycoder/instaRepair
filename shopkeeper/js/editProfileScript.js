function checkForm() {
// Fetching values from all input fields and storing them in variables.
var firstName = document.getElementById("firstName").value;
var lastName = document.getElementById("lastName").value;
var contactNo = document.getElementById("contactNo").value;
var address = document.getElementById("address").value;
var email = document.getElementById("email").value;

//Check input Fields Should not be blanks.
if (firstName == '' || lastName == ''|| contactNo == '' || email == '' || address == '') {
alert("Fill All Fields");
} else {
//Notifying error fields
var firstName1 = document.getElementById("firstName1").value;
var lastName1 = document.getElementById("lastName1").value;
var contactNo1 = document.getElementById("contactNo1").value;
var address1 = document.getElementById("address1").value;
var email1 = document.getElementById("email1").value;

//Check All Values/Informations Filled by User are Valid Or Not.If All Fields Are invalid Then Generate alert.
if (firstName1.innerHTML == 'Must be greater than 2 letters' firstName1.innerHTML == 'Must be less than 26 letters' || lastName1.innerHTML == 'Must be greater than 2 letters' || lastName1.innerHTML == 'Must be less than 26 letters' || email1.innerHTML == 'Invalid email' || email1.innerHTML == ''Must be less than 50 chars || address1.innerHTML == 'Must be greater than 2 letters' || address1.innerHTML = 'Must be less than 150 letters' || contactNo1.innerHTML == 'Must be greater than 9 letters' || contactNo1.innerHTML == 'Must be less than 14 letters') {
alert("Fill Valid Information");
} else {
var dataString1 = 'firstName=' + firstName + '&email=' + email + '&lastName=' + lastName + '&contactNo=' + contactNo + '&address=' + address;

$.ajax({
type: "POST",
url: "editProfileScript.php",
data: dataString1,
cache: false,
success: function(html) {
alert(html);
}
});
}
}
return false;
}
// AJAX code to check input field values when onblur event triggerd.
function validate(field, query) {

var dataString = 'field=' + field + '&query=' + query;
$.ajax({
type: "POST",
url: "editProfileValidation.php",
data: dataString,
cache: false,
success: function(html) {
alert(html);
}
});
return false;
}

