$(document).ready(function() {

   $("#register_form").submit("submit", validate_register);
   $("#login_form").submit("submit", validate_login);
 //  $("form#multimedia_question_form").submit("submit", validate_submission);
	/*$("form#multimedia_question_form").submit(function(event) {
    event.preventDefault();
	alert("hello!");});
*/
});

function validate_submission () {

//alert($("textarea#text_question").val());
//alert($("input#answer1").val());
//alert($("#answer2").val());
//alert($("#answer3").val());
//alert($("#answer4").val());
//alert($("input[name=answer]:checked", "#multimedia_question_form").val());
/*
$("#text_question").val();
$("#answer1").val();
$("#answer2").val();
$("#answer3").val();
$("#answer4").val();
$("input[name=answer]:checked", "#multimedia_question_form").val();
*/

return false;
} // validate_submission

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

