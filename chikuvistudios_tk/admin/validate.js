window.onload = init;
var submit;
function init()
{
	var password = document.getElementById("pass2");
    password.onblur = checkSame;

    submit = document.getElementById("createUser");
    submit.disabled = true;
}

function checkSame()
{
	var pass1 = document.getElementById("pass1").value;
	var pass2 = document.getElementById("pass2").value;

	if(pass1 != pass2)
    {
        alert("Both Passwords do not match!");
        submit.disabled = true;
    }
    else
        submit.disabled = false;

}
