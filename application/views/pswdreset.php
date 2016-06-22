<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/menu_bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/bottom_footer.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/common.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/passreset.css" type="text/css" media="screen" />
<link REL="SHORTCUT ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<title>Reset My Password - Betips.co.ke - betting tips, soccer predictions, soccer tips</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
<script type="text/javascript">
var sms_form = '<span id="rtitle">SMS Code Sent</span>'+
                '<form method="post" action="" id="code_form" onsubmit="sendCode(event);">'+
                    '<label for="sms">Enter the sms code you received:</label>'+
                    '<input type="text" required="required" id="sms" name="sms" />'+
                    '<input type="submit" name="submit" id="submit" value="submit" />'+
                '</form>'+
                '<div id="resp"></div>';
var pass_form = '<span id="rtitle">Account Password Update</span>'+
                '<form method="post" action="" id="pwd_form" onsubmit="sendPasswd(event);">'+
                    '<label for="password">Enter new password:</label>'+
                    '<input type="password" required="required" id="password" name="password" /><br/>'+
                    '<label for="password">Repeat new password:</label>'+
                    '<input type="password" required="required" id="password2" name="password2" />'+
                    '<input type="submit" name="submit" id="submit" value="submit" />'+
                '</form>'+
                '<div id="resp"></div>';
$(document).ready(function(){
    $("form#p_form").submit(function (event)
    {
        var phone = $('#phone').val();
        if(phone.match(/[a-zA-Z]/g) || phone == ""){
            alert("Enter a Valid phone number (number only no spaces)!");
            return;
        }
        else{
            $.post("",
            {
                "action":"create",
                "phone":phone
            },
            function(data){
                if(data.success == "1")
                {
                    $('#rcont').html(sms_form);
                }
                else if(data.success == "0")
                {
                    $('#resp').html('<span style="color:red;">Your phone number(' + phone + ') is not registered.</span> <a href="<?=base_url();?>signup">Create account</a>.');
                }
                else {
                $('#resp').text = data; 
                }
            },
            "json"
            );
        }
         event.preventDefault();
    })
});
function sendCode(event)
{
    event.preventDefault();
    var sms = $('#sms').val();
    if(sms == ""){
		alert("Code not entered!");
		return;
	}
    else{
        $.post("",
        {
            "action":"validate",
            "code":sms
        },
        function(data){
            if(data.success == "1")
            {
                $('#rcont').html(pass_form);
            }
            else if(data.success == "0")
            {
                $('#resp').text('You entered an invalid code. Re-enter code.');
                $('#sms').val = "";
                $('#sms').focus();
            }
            else {
               $('#resp').text = data; 
            }
        },
        "json"
        );
    }
}
function sendPasswd(event)
{
    event.preventDefault();
    
    var pass = $('#password').val();
    var pass2 = $('#password2').val();
    
    if(pass !== pass2){
		$('#resp').html("<span style='color:red;'>Passwords do not match!</span>");
		return;
	}
    else
    {
        $.post("",
        {
            "action":"update",
            "password":pass,
            "password2":pass2
        },
        function(data){
            if(data.success == "1")
            {
                $('#rcont').html("<span style='color:blue;'>Password changed successfully. Go to <a href='<?=base_url();?>'>home page and login</a></span>");
                $('#resp').text("Success!");
            }
            else if(data.success == "0")
            {
                $('#resp').html("<span style='color:red;'>" + data.msg + "</span>");
                $('#password').val = "";
                $('#password').focus();
            }
            else {
               $('#resp').text = data; 
            }
        },
        "json"
        );
    }
}
</script>
</head>
<body>
 <div id="cont">
    	<div id="top-head">
        	<div id="top-nav">
            	<ul>
                	<li><a href="<?=base_url();?>">Home</a></li>
                    <li><a href="<?=base_url();?>terms">Terms</a></li>
                    <li><a href="<?=base_url();?>howto">How to</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div id="main-nav">
            	<ul>
                	<li><a href="<?=base_url();?>home">Home</a></li>
                    <li><a href="<?=base_url();?>terms">Terms&amp;Conditions</a></li>
                    <li><a href="<?=base_url();?>about/services">Services</a></li>
                </ul>
            </div>
            
        </div>
        <div id="resetbody">
        	<div id="rcont">
            	<span id="rtitle">Account Password Reset</span>
                <form action="" id="p_form">
                    <label for="phone">Enter the phone number you registered your account with (e.g. 07xx-xxx-xxx):</label>
                    <input type="text" required="required" id="phone" name="phone" />
                    <input type="submit" name="submit" id="submit" value="submit" />
                </form>
                <div id="resp"></div>
            </div>
            <!--<div id="rcont">
            	<span id="rtitle">SMS Code Sent</span>
                <form method="post" action="" id="reset_form" onsubmit="sendCode(event);">
                    <label for="sms">Enter the sms code you received:</label>
                    <input type="text" required="required" id="sms" name="sms" />
                    <input type="submit" name="submit" id="submit" value="submit" />
                </form>
                <div id="resp"></div>
            </div>
            <div id="rcont">
            	<span id="rtitle">Account Password Update</span>
                <form method="post" action="" id="reset_form" onsubmit="sendPasswd(event);">
                    <label for="password">Enter new password:</label>
                    <input type="text" required="required" id="password" name="password" /><br/>
                    <label for="password">Repeat new password:</label>
                    <input type="text" required="required" id="password2" name="password2" />
                    <input type="submit" name="submit" id="submit" value="submit" />
                </form>
                <div id="resp"></div>
            </div>-->
        </div>
        <div id="sub_footer">
            <div class="sub_tabs" style="padding-left:20px;">
                <span class="sub_titles">Contact Us</span>
                <div>
                	<span style="font-weight:bold; font-size:16px; color:#42f4ff; display:block;">Nairobi</span>
                    <span style="font-size:15px; line-height:16px; color:#42f4ff; display:block;">P.O Box 0988-98765</span>
                    <span style="font-size:15px; line-height:16px; color:#42f4ff; display:block;">Westlands</span>
                    <address><span style="position:relative; line-height:17px; font-size:15px; display:block; top:5px;"><a href="mailto:business@betips.co.ke" style="color:#1cff04;">business@betips.co.ke</a></span>
					<!--<span style="position:relative;line-height:17px; font-size:15px; color:#1cff04; display:block; top:3px;">0712-789-654</span>--></address>
                </div>
            </div>
            <div class="sub_tabs" style="left:80px;">
            	<span class="sub_titles">Games</span>
                <div class="subfoot_links">
                	<ul>
                    	<li><a href="#">Football</a></li>
                        <li><a href="#">Basketball</a></li>
                        <li><a href="#">Horse racing</a></li>
                        <li><a href="#">Rugby</a></li>
                        <li><a href="#">Tennis</a></li>
                    </ul>
                </div>
            </div>
            <div class="sub_tabs" style="left:150px; margin-right:40px;">
            	<span class="sub_titles">Leagues</span>
                <div class="subfoot_links">
                	<ul>
                    	<li><a href="#">KPL</a></li>
                        <li><a href="#">EPL</a></li>
                        <li><a href="#">La Liga</a></li>
                        <li><a href="#">Serie A</a></li>
                        <li><a href="#">NBA</a></li>
                    </ul>
                </div>
            </div>
            <div class="sub_tabs" style="left:150px;">
            	<span class="sub_titles">Links</span>
                <div class="subfoot_links">
                	<ul>
                    	<li><a href="#">Affiliates</a></li>
                        <li><a href="#">Refer a friend</a></li>
                        <li><a href="#">Betting rules</a></li>
                        <li><a href="#">Advertisements</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="footer">
        	<div id="foot_left">
            	<span style="color:#ffff00; display:block; font-size:12px;">For enquiries kindly email us at:</span><span style="color:#1bff03; display:block; font-size:12px; line-height:13px;">info@betips.co.ke</span><span style="color:#fff; font-size:12px;"> or</span> <span style="color:#1bff03; font-size:12px;">support@betips.co.ke</span>
            </div>
            <div id="foot_right">
            	<ul id="foot_nav">
                	<li><a href="<?=base_url();?>">Home</a></li>
                    <li><a href="<?=base_url();?>about">About Us</a></li>
                    <li><a href="<?=base_url();?>terms">Terms&amp;Conditions</a></li>
                    <li><a href="<?=base_url();?>about/services">Services</a></li>
                    <li style="border:none;"><a href="<?=base_url();?>contacts">Contacts</a></li>
                </ul>
                <span style="color:#15ff03; font-size:12px; display:block; position:absolute; bottom:3px; right:3px;">&copy;2016 betips inc. All rights reserved.</span>
            </div>
        </div>
    </div>
</body>
</html>