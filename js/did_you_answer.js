$(document).ready(function() {

	//alert("hello");
   $("#select_answer").submit("submit", got_answer);

});

/* 
Validate user registration information: email, username and password
*/
function got_answer () {
//alert("hello");
	var answer = $("input[name=answer]:checked", "#select_answer").val();

	if(answer == null) {
		alert("Oops! You don't select your answer!");
		return false;
	}
} //got_answer
