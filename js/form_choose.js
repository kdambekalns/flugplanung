function renameAlternativeButtons(firstChoice) {
	firstChoice = parseInt(firstChoice);
	let alternatives = [0, 1, 2].filter(function (item) { return item !== firstChoice })
	if ($('#list_alternative_1').length) {
		$('#list_alternative_1')[0].innerHTML = Fluggebiete[alternatives[0]];
	}
	if ($('#list_alternative_2').length) {
		$('#list_alternative_2')[0].innerHTML = Fluggebiete[alternatives[1]];
	}
}
