$(document).ready(function () {

	$('#registration-form').submit(function (event) {
		$('#register-error').addClass('d-none');
		event.preventDefault();

		var formDataArray = $(this).serializeArray();

		var windenfahrerCheckbox = $('#windenfahrer_register');
		formDataArray.push({
			name: windenfahrerCheckbox.attr('name'),
			value: windenfahrerCheckbox.is(':checked') ? '1' : '0'
		});

		var formData = $.param(formDataArray);

		$.ajax({
			url: 'register.php',
			method: 'POST',
			data: formData,
			dataType: 'json',
			success: function (response) {
				if (response.success) {
					$('.login').addClass('flash-login');
					showToast('Juhu!', 'Das hat geklappt', 'Du bist jetzt registriert und kannst Dich direkt anmelden!', 'success');
					// Fliegendes Einhorn deaktiviert
					//$('#unicorn').addClass('move-image');
				} else {
					$('#register-error').removeClass('d-none');
					$('#register-error').html(response.error);
				}
			},
			error: function (error) {
				console.error('Error:', error);
			}
		});
	});
});

function openRegisterForm() {
	$('#registration-form').removeClass('d-none');
}

function forgotPassword() {
	alert('Funktion ist noch in Arbeit. Bitte bei Justin melden!');
}
