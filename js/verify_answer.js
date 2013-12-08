$(document).ready(function() {
	//alert("hello");
//	$("#select_answer").submit("submit", verify_answer);

/*
    $("#addTags").dropdownchecklist({
        maxDropHeight: 200,
        width: 300,
        textFormatFunction: function (options) {
            var selectedOptions = options.filter(":selected");
            var countOfSelected = selectedOptions.size();
            var size = options.size();
            switch (countOfSelected) {
           		case 0:
                	return "Add tags?";
            	case 1:
                	return selectedOptions.text();
            	default:
                	return countOfSelected + " Tags";
            }
        },
        onComplete: function (selector) {
            var values = "";
            for (i = 0; i < selector.options.length; i++) {
                if (selector.options[i].selected && (selector.options[i].value != "")) {
                    values += selector.options[i].value + ";";
                }
            }
        }
    });
*/  
});

/* 
Validate user registration information: email, username and password
*/
function verify_answer () {

	question_id = $("input#questionid").val();

	selected_answer = $("input[name=answer]:checked", "#select_answer").val();
	
//	alert(question_id+" "+selected_answer);

	$.ajax({
		type: "POST",
//		dataType: "html",
		url: "../php/fetch_correct_answer.php?qid="+question_id,
		success: function(answer) {
			console.log(answer);
		} 
	});

} //validate_register

function validate_login () {
//alert($("#new_email").val() == "");

	if(($("#rn_email").val() == "") || ($("#rn_pass").val() == "")) {
		alert("The * field must be filled!");	
		return false;			
	} 
	
} //validate_login
/*
  <form id="select_answer">
	<input type="radio" name="answer" value="1"/>1
	<input type="radio" name="answer" value="2"/>2
	<input type="radio" name="answer" value="3"/>3
	<input type="radio" name="answer" value="4"/>4<br/><br/>

	<input type="submit" value="SUBMIT"/><br/>
  </form>
  */