var clicked = false;
function verifyAcc(event){
	event.preventDefault();
	if(!clicked){
		clicked = true;
		$('#ver_div').show(300);
		$('#btn_verify').text("verify");
		$.post("actions/SMScodehandler.php",
		{
			"action":"create"
		},
		function(data){
			if(data.success == 0){
				alert("Server error: Please reload (F5) your browser!");
			}
		},
		"json"
		);
	}
	else{
		var str = $('#ver_code').val();
		sendCode(str);
	}
}

function sendCode(str){
	$.post("actions/SMScodehandler.php",
	{
		"action":"check", 
		"code":str
	},
	function(data){
		if(data.success == 1){
			$('#ver_div').hide(100);
			$('#btn_verify').hide(100);
			$('#verified').val("Verified");
		}
		if(data.success == 0){
			$('#lbl_code').text("the code you entered is wrong. Enter again!").css("color", "red");
		}
	},
	"json"
	);
}