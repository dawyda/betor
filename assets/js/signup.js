//var wait = false;

function verify(){
	//return checkCaptcha();
	if(document.getElementById("username").value.length < 6 || document.getElementById("username").value.length > 10){
		alert("username must be 6 - 10 chars long!");
		document.getElementById("username").focus();
		return false;
	}
	if(document.getElementById("password").value.length < 6 || document.getElementById("password").value.length > 14){
		alert("password must be 6 - 14 chars long!");
		document.getElementById("password").focus();
		return false;
	}
	if(document.getElementById("password").value != document.getElementById("pass2").value){
		alert("passwords must be same!");
		document.getElementById("password").focus();
		return false;
	}
	if(document.getElementById("mobile").value.match(/[a-zA-Z]/g)){
		alert("Phone number must have numbers only!");
		document.getElementById("mobile").focus();
		return false;
	}
	return true;
}

/*function checkCaptcha(){
	var xhr = createXHR();
	var str = document.getElementById("captcha").value;
	wait = true;
	
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && xhr.status == 200)
		{
			if(xhr.responseText == "1"){
				wait = false
			}
			else{
				wait = true;
			}
			
			if(wait){
				alert("You entered the wrong text!");
				document.getElementById("captcha").focus();
			}
		}
	}
	
	xhr.open('POST', 'chechcaptcha.php?t=' + Math.random()*5, true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.send("captcha=" + str);
}

function createXHR()
{
    var xhr;
    if (window.ActiveXObject)
    {
        try
        {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e)
        {
            alert(e.message);
            xhr = null;
        }
    }
    else
    {
        xhr = new XMLHttpRequest();
    }

    return xhr;
}*/