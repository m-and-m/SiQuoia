$(document).ready(function() {

	//alert("hello");
   $("#select_answer").submit("submit", got_answer);
   $("form#featured_selection_form").submit("submit", got_featured_choice);
   $("form#random_select_form").submit("submit", got_random_choice);

});

/* 
Check if the user selected the question choice before he takes a quiz
*/
function got_featured_choice () {

	var answer = $("#featured_selection option:selected").text();

	if(answer == "") {
		alert("Oops! You don't select your choice!");
		return false;
	}

} //got_featured_choice

/* 
Check if the user selected the question choice before he takes a quiz
*/
function got_random_choice () {

	var answer = $("#random_selection option:selected").text();

	if(answer == "") {
		alert("Oops! You don't select your choice!");
		return false;
	}

} //got_random_choice

/* 
Check if the user selected answer before evaluate the answer
*/
function got_answer () {
//alert("hello");
	var answer = $("input[name=answer]:checked", "#select_answer").val();

	if(answer == null) {
		alert("Oops! You don't select your choice!");
		return false;
	}
} //got_answer