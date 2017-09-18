/*
 * Input become required when checkbox is checked
 */
function requiredInput(checkbox) {

	var id = checkbox.id.split("_");
	var input = document.getElementById(id[0]);

	if (checkbox.checked) {
		input.required = true;
	}
	else {
		input.required = false;
	}

}