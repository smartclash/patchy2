function toggleVerifyMessage(){
	if($("#verifyMessage").hasClass("hidden")){
		$("#verifyMessage").removeClass("hidden");
	}else{
		$("#verifyMessage").addClass("hidden");
	}
}

var SHA512 = new Hashes.SHA512

$(document).ready(function() {
	var notifications = $("#notificationArea");
	
	$("#verificationAdmin").on('submit', function(e) {
		e.preventDefault(); // prevent default
		toggleVerifyMessage();
		
		var verfyStr = "verifyPassword=" + SHA512.hex($("#verifyPassword").val());
		
		$.ajax({
			url: 'assets/php/scripts/admin_login.php', // This script handles the form
			type: 'POST', // Method used to send data !DONT CHANGE
			dataType: 'html', // Request type
			data: verfyStr, // 'serialize' form data 
			beforeSend: function() {
				$("#verifyButton").prop('value', 'Verifying'); // Indicate that the form is being processed
			},
			success: function(data) {
				toggleVerifyMessage();
				notifications.addClass("hasNotification");
				notifications.html(data).fadeIn(1000);
				$("#verifyButton").prop('value', 'Login');
			},
			error: function(e) {
				console.log(e); // Log any errors
			}
		});
	});
});