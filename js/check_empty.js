$(document).ready(function() {

   $("#register_form").submit("submit", validate_register);
   $("#login_form").submit("submit", validate_login);

});

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

