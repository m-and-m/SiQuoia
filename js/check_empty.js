$(document).ready(function() {

   $("#register_form").submit("submit", validate_register);
   $("#login_form").submit("submit", validate_login);
   $("#branded_form").submit("submit", check_code);

});

/*
Check if the field has a value
*/
function check_code () {
//	alert("hello");
	if($("#b_code").val() == "") {
		alert("Code?");
		return false;
	}
	
} // check_code
/* 
Validate user registration information: email, username and password
*/
function validate_register () {
//alert($("#new_email").val() == "");

	if(($("#new_email").val() == "") || ($("#new_name").val() == "") || ($("#new_pass").val() == "")) {
		alert("The * field must be filled!");
		return false;				
	} 
	
} //validate_register

/* 
Validate user login information: email and password
*/
function validate_login () {
//alert($("#new_email").val() == "");

	if(($("#rn_email").val() == "") || ($("#rn_pass").val() == "")) {
		alert("The * field must be filled!");	
		return false;			
	} 
	
} //validate_login

