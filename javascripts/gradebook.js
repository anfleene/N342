$(document).ready(function() { 
	$("button.new_entry").click(function() {
		var tr = $("table.add_grades").find("tr:last").clone();
		tr.find("input,select").val("");
		$("table.add_grades").append(tr);
		tr.find("input:first").focus();
	});
	
	$("input:submit").click(function(){
		$("#errorFlash").hide();
		var errorMsg, the_form;
		the_form = $(this).parents("form");
		the_form.find("input, select").removeClass("error");
		errorMsg = validate($(the_form).find("input, select"), "cant be blank", inputNotEmpty);
		errorMsg += validate($(the_form).find("input.number"), "must be a number", inputNumeric);
		errorMsg += validate($(the_form).find("input.number"), "must be greater than zero", inputGreaterThanZero);
		errorMsg += validate($(the_form).find("input.number[name=points_earned[]]"), "must be no greater than the points possible", pointsPossGreaterThanPointsEarned);
		
		if(errorMsg != ""){
			$("#errorFlash").html("<ul>"+ errorMsg +"</ul>").fadeIn();
			return false;	
		}
	});

});

function validate(inputs, Errormsg, validator){
	var msg = "";
	var invalidInputs = Array();
	$.each($(inputs), function(index, input){
		if(!validator(input)){
			$(input).addClass("error");
			invalidInputs.push($(input).attr("name"));
		}
	});
	if(invalidInputs.length > 0){
		$.each(invalidInputs, function(index, name){
			msg += name.replace("[]", "").replace("_", " ") + ", ";
		});
		msg = "<li>" + msg.replace(/, $/, " ") + " " + Errormsg +"</li>";
	}
	return msg;


}

function inputNotEmpty(input){
	  return !($(input).val() == "");
}

function inputNumeric(input){
	return !!parseInt($(input).val());
}

function inputGreaterThanZero(input){
	return !(parseInt($(input).val()) <= 0);
}

function pointsPossGreaterThanPointsEarned(input){
	return !(parseInt($(input).siblings("input[name=points_poss[]]").val()) < parseInt($(input).val()));
}