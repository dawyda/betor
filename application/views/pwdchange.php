<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/menu_bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/bottom_footer.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/common.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/changepwd.css" type="text/css" media="screen" />
<link REL="SHORTCUT ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<title>Change Password - Betips.co.ke</title>
<script type="text/javascript">
function changeit(event){
	event.preventDefault();
    var dom = document.getElementById("resp");
	
	if(document.getElementById("oldpass").value == "" || document.getElementById("password").value == "" || document.getElementById("password2").value == ""){
		dom.innerHTML = "Blank fields not allowed.";
		return;
	}
	if(document.getElementById("password").value != document.getElementById("password2").value){
		dom.innerHTML = "Passwords do not match.";
		document.getElementById("password").focus();
        document.getElementById("password2").value = "";
		return;
	}
	if(document.getElementById("password").value.length < 5){
		dom.innerHTML = "Password length must be more than 5 characters.";
		document.getElementById("password").focus();
		return;
	}
	
	var ajax = new XMLHttpRequest() || new ActiveXObject("Microsoft.XMLHTTP");
	ajax.onreadystatechange = function(){
		if(ajax.readyState === 4){
			if(ajax.status === 200){
				if(ajax.responseText == "1"){
					dom.innerHTML = "Success. Password changed. <br /> Go to <a href='<?=base_url();?>home/profile'>Back</a>.";
					dom.style.color = "green";
                    document.getElementById("reset_form").reset();
				}
				else if(ajax.responseText == "0"){
                    dom.style.color = "red";
					dom.innerHTML = "Old password is incorrect.";
				}
                else if(ajax.responseText == "-1")
                {
                    dom.style.color = "red";
                    dom.innerHTML = "Passwords do not match or too short.";
                }
				else{
                    dom.style.color = "red";
					dom.innerHTML = "Error: " + ajax.responseText;
				}
			}
		}
	}
	ajax.open("POST", "", true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajax.send("action=change&oldpass=" + document.getElementById("oldpass").value + "&password=" + document.getElementById("password").value + "&password2=" + document.getElementById("password2").value);
}
</script>
</head>
<body>
 <div id="cont">
    	<div id="top-head">
        	<div id="top-nav">
            	<ul>
                    <li><a href="<?=base_url();?>howto">How to</a></li>
                    <li><a href="<?=base_url();?>">Tips</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div id="main-nav">
            	<ul>
                	<li><a href="<?=base_url();?>">Home</a></li>
                    <li><a href="<?=base_url();?>home/profile">My Profile</a></li>
                    <li><a href="<?=base_url();?>logout">Logout [<?php echo $_SESSION["username"]; ?>]</a></li>
                </ul>
            </div>
            
        </div>
        <div id="resetbody">
        	<div id="rcont">
            	<span id="rtitle">Account Password Change</span>
                <div id="resp"></div>
                <form method="post" action="" id="reset_form" onsubmit="changeit(event);">
                    <div style="position:relative; width:200px; margin:0 auto;"><label for="oldpass">Enter Old password:</label><br />
                    <input type="password" autocomplete="off" required="required" id="oldpass" name="oldpass" value="" placeholder="Old password" /><br />
                    <label for="password">Enter New password:</label><br />
                    <input type="password" required="required" id="password" name="password" /><br />
                    <label for="password2">Re-enter New password:</label><br />
                    <input type="password" required="required" id="password2" name="password2" /><br />
                    <input type="submit" name="submit" value="Change Password" /></div>
                </form>
            </div>
        </div>
        <div id="sub_footer">
            <div class="sub_tabs" style="padding-left:20px;">
                <span class="sub_titles">Contact Us</span>
                <div>
                	<span style="font-weight:bold; font-size:16px; color:#42f4ff; display:block;">Nairobi</span>
                    <span style="font-size:15px; line-height:16px; color:#42f4ff; display:block;">P.O Box 0988-98765</span>
                    <span style="font-size:15px; line-height:16px; color:#42f4ff; display:block;">Westlands</span>
                    <address><span style="position:relative; line-height:17px; font-size:15px; display:block; top:5px;"><a href="mailto:business@betips.co.ke" style="color:#1cff04;">business@betips.co.ke</a></span>
					<span style="position:relative;line-height:17px; font-size:15px; color:#1cff04; display:block; top:3px;">0712-789-654</span></address>
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
                    <li><a href="<?=base_url();?>about">About</a></li>
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