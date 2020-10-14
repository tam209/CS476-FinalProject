function createForm(event) {
	
	var fnameInput = document.getElementById("fname").value;
	var lnameInput = document.getElementById("lname").value;
	var emailInput = document.getElementById("email").value;
	var DoBInput = document.getElementById("DoB").value;
	var avatarInput = document.getElementById("fileToUpload").value;
	var usernameInput = document.getElementById("username").value;
	var pwdInput = document.getElementById("pwd").value;
	var pwd2Input = document.getElementById("re-pwd").value;

	var result = true;

	//regex 
	var fname_v = /^[A-Z][a-z]*$/;
	var lname_v = /^[a-zA-Z ,.'-]+$/;
	var email_v = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
	var birth_v = /^([0-9]{4})-(0?[1-9]|1[0-2])-(0?[1-9]|1\d|2\d|3[0-1])$/;
	var username_v = /^[a-zA-Z0-9._-]+$/;
	var pwd_v = /^(\S*)?\d+(\S*)?$/;

	var fnameMsg = document.getElementById("fname_msg");
	var lnameMsg = document.getElementById("lname_msg");
	var emailMsg = document.getElementById("e_msg");
	var birthMsg = document.getElementById("dob_msg");
	var avatarMsg = document.getElementById("avatar_msg");
	var usernameMsg = document.getElementById("u_msg");
	var pMsg = document.getElementById("pwd_msg");
	var p2Msg = document.getElementById("pwd2_msg");

	if (fnameInput == null || fnameInput == "" || !fname_v.test(fnameInput))
	{
		fnameMsg.innerHTML = "First name is empty or invalid. Must begin with a capital letter.";
		result = false;
	}

	if (lnameInput == null || lnameInput == "" || !lname_v.test(lnameInput))
	{
		lnameMsg.innerHTML = "Last name is empty or invalid.";
		result = false;
	}

	if (emailInput == null || emailInput == "" || !email_v.test(emailInput) || emailInput.length > 60)
	{
		emailMsg.innerHTML = "Email is empty or invalid. (Example: hello@uregina.ca)";
		result = false;
	}

	if (DoBInput == null || DoBInput == "" || !birth_v.test(DoBInput))
	{
		birthMsg.innerHTML = "Date of birth is empty or not in proper format. (yyyy-mm-dd)";
		result = false;
	}

	if (avatarInput == null || avatarInput == "")
	{
		avatarMsg.innerHTML = "Please upload an avatar.";
		result = false;
	}

	if (usernameInput == null || usernameInput == "" || !username_v.test(usernameInput))
	{
		usernameMsg.innerHTML = "Please enter the correct format for username. (No leading or trailing spaces)";
		result = false;
	}

	if (pwdInput == null || pwdInput == "" || !pwd_v.test(pwdInput) || pwdInput.length < 8)
	{
		pMsg.innerHTML = "Password must be 8 characters long, at least one non-letter character.";
		result = false;
	}

	if (pwd2Input == null || pwd2Input == "" || pwd2Input != pwdInput)
	{
		p2Msg.innerHTML = "Field is empty or does not match the password above.";
		result = false;
	}

	if (result == false)
	{
		event.preventDefault();
	}

}

function resetForm(event) {
	document.getElementById("fname_msg").innerHTML = "";
	document.getElementById("lname_msg").innerHTML = "";
	document.getElementById("e_msg").innerHTML = "";
	document.getElementById("dob_msg").innerHTML = "";
	document.getElementById("avatar_msg").innerHTML = "";
	document.getElementById("u_msg").innerHTML = "";
	document.getElementById("pwd_msg").innerHTML = "";
	document.getElementById("pwd2_msg").innerHTML = "";
}
