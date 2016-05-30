$(document).ready(function() {
$("#profile").click(function() {
var firstName = $("#firstName").val();
var lastName = $("#lastName").val();
var address = $("#address").val();
var email = $("#email").val();
var contactNo = $("#contactNo").val();

if (firstName == '' || lastName == '' || email == '' || contactNo == '' || address == '') {
alert("Insertion Failed Some Fields are Blank....!!");
} else {
// Returns successful data submission message when the entered information is stored in database.
$.post("editProfileScript.php", {
firstName1: firstName,
email1: email,
contactNo1: contactNo,
address1: address,
lastName1: lastName
}, function(data) {
alert(data);

});
}
});
});