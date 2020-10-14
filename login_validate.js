function validateLogin(event) {

	var usernameInput = document.getElementById("username").value;
	var pInput = document.getElementById("pwd").value;

	var result = true;

	var uMsg = document.getElementById("u_msg");
	var pMsg = document.getElementById("pwd_msg");

	var username_v = /^[a-zA-Z0-9._-]+$/;
  	var pswd_v = /^(\S*)?\d+(\S*)?$/;

  	if (usernameInput == null || usernameInput == ""|| !username_v.test(usernameInput)) {
	  uMsg.innerHTML = "Please enter the correct format for username. (No leading or trailing spaces)";
	  result = false;
	}

	if (pInput == null || pInput == "" || pInput.length < 8 || !pswd_v.test(pInput)) {
	  pMsg.innerHTML = "Password must be 8 characters long, at least one non-letter character.";
		result = false;
	}
	
	if (result == false) {
	  event.preventDefault();
	}

}
