function contactForm(event) {

	var emailInput = document.getElementById("email").value;
	var subjectInput = document.getElementById("subject").value;
	var bodyInput = document.getElementById("email-body").value;

	var result = true;

	var email_v = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

	var emailMsg = document.getElementById("e_msg");
	var subMsg = document.getElementById("sub_msg");
	var bodyMsg = document.getElementById("body_msg");

	if (emailInput == null || emailInput == "" || !email_v.test(emailInput) || emailInput.length > 60) {
		emailMsg.innerHTML = "Email is empty or invalid. (Example: hello@uregina.ca)";
		result = false;
	}

	if (subjectInput == null || subjectInput == "" || subjectInput.length > 100) {
		subMsg.innerHTML = "Subject is empty or must be shorter than 100 characters.";
		result = false;
	}

	if (bodyInput == null || bodyInput == "" || bodyInput == " " || bodyInput.length > 800) {
		bodyMsg.innerHTML = "Email body can not be blank and it must be shorter than 800 characters.";
		result = false;
	}

	if (result == false) {
		event.preventDefault();
	}
}

function countChar(event) {

	var charCount = document.getElementById("email-body").value;

	var charleftMsg = document.getElementById("charleft_msg");

	var maxAmount = 800;

	charleftMsg.innerHTML = maxAmount - charCount.length + " characters left";
}
