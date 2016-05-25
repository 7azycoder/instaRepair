$(document).ready(function(){
	// load index page when the page loads
	$("#loadSection").load("viewProfile.php");
	$("#viewProfile").click(function(){
	// load home page on click
		$("#loadSection").load("viewProfile.php");
	});
	$("#editProfile").click(function(){
	// load about page on click
		$("#loadSection").load("editProfile.php");
	});
	$("#passwordChange").click(function(){
	// load contact form onclick
		$("#loadSection").load("passwordChange.php");
	});
	$("#viewShop").click(function(){
	// load contact form onclick
		$("#loadSection").load("viewShop.php");
	});
	$("#editShop").click(function(){
	// load contact form onclick
		$("#loadSection").load("editShop.php");
	});
	$("#profilePicChange").click(function(){
	// load contact form onclick
		$("#loadSection").load("profilePicChange.php");
	});
	$("#shopPicChange").click(function(){
	// load contact form onclick
		$("#loadSection").load("shopPicChange.php");
	});
});
