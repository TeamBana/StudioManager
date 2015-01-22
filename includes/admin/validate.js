window.onload = init;

function init()
{
	var password = document.getElementById("pass2");
	
	password.onblur = check;
}

function check()
{
	var pass1 = document.getElementById("pass1").value;
	var pass2 = document.getElementById("pass2").value;
	
	if(pass1 != pass2)
		alert("Both Passwords do not match!");
}