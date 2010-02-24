$(document).ready(function() { 
	$("button.new_entry").click(function() {
		var tr = $("table.add_grades").find("tr:last").clone();
		tr.find("input,select").val("");
		$("table.add_grades").append(tr);
		tr.find("input:first").focus();
	});
	
	$("input:submit").click(function(){
		var errorMsg, the_form;
		the_form = $(this).parents("form");
		errorMsg = validate($(the_form).find("input, select"), "cant be blank", inputNotEmpty);
		errorMsg += validate($(the_form).find("input.number"), "must be a number", inputMustBeNumeric);
		if(errorMsg != ""){
			$("#errorFlash").html("<p>"+ errorMsg +"</p>").show();
			return false;	
		}
	});

});

function validate(inputs, Errormsg, validator){
	var msg = "";
	var invalidInputs = Array();
	$.each($(inputs), function(index, input){
		if(validator(input)){
			$(input).addClass("error");
			invalidInputs.push($(input).attr("name"));
		}
	});
	if(invalidInputs != Array()){
		$.each(invalidInputs, function(index, name){
			msg += name.replace("[]", "").replace("_", " ") + ", ";
		});
		msg = msg.replace(/, $/, " ") + " " + Errormsg +"<br/>";
	}
	return msg;


}

function inputNotEmpty(input){
	  return ($(input).val() == "");
}

function inputMustBeNumeric(input){
	return (parseInt($(input).val()) == NaN);
}

function inputMustBeGreaterThanZero(input){
	return (parseInt($(input).val()) <= 0);
}

function pointsPossGreaterThanPointsEarned(input){
	return (parseInt($(input)) > parseInt($(input).siblings("input[name=points_poss]")));
}