<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/menu_bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/bottom_footer.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/common.css" type="text/css" media="screen" />
<style type="text/css">
label{
	min-width:100px;
	display:block;
}
textarea{
	width:250px;
	height:150px;
	font-size:14px;
	color:black;
}
</style>
<link REL="SHORTCUT ICON" HREF="<?=base_url();?>assets/css/img/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
	$(document).ready(function(){
	$("#pay_form").submit(function(event){
		alert( "Handler for .submit() called." );
		event.preventDefault();
		
		var msg = $("#msg").val();
		if(msg == "" || msg.length < 30)
		{
			$("#resp").text("Message is not set");
			return;
		}
		else {
			$.post("/betor/sms/action_url",
				{
					"action":"incoming",
					"from":"M-PESA",
					"phone_number":"0721264227",
					"message":msg
				},
				function(data)
				{
					if(data.events[0].message == "OK. Message received.")
					{
						$("#resp").text("Payment Uploaded Successfully");
						$("#pay_form").reset();
					}
					else{
						$("#resp").text("FAILED. Try again. Info:");
						console.log(data);
					}
				},
				"json"
			);
		}
	});
	});
</script>
<noscript>Please enable JavaScript!!</noscript>
<title>Manual M-PESA Uploads - Betips Admin ONLY</title>
</head>
<body>
 <div id="cont">
    	<div id="top-head">
            <div class="clear"></div>
            <div id="main-nav">
            	<ul>
                	<li><a href="<?=base_url();?>admin/home">Admin Home</a></li>
                    <li><a href="<?=base_url();?>admin/logout">Logout</a></li>
                </ul>
            </div>
        </div>
		<div style="background-color:white; position:relative; padding:10px;">
		<div id="resp" style="margin:5px;"></div>
			<form id="pay_form" action="<?=base_url()?>/sms/action_url" method="post">
				<label for="msg">M-PESA Message: <label><br /><textarea required="required" name="msg" id="msg"></textarea><br /><br />
				<input type="hidden" value="hideme" id="token" name="token" />
				<input type="submit" value="upload" name="submit" />
			</form>
		</div>
        <div id="sub_footer">
            <div class="sub_tabs" style="padding-left:20px;">
                <span class="sub_titles">Contact Us</span>
                <div>
                	<span style="font-weight:bold; font-size:16px; color:#42f4ff; display:block;">Nairobi</span>
                    <span style="font-size:15px; line-height:16px; color:#42f4ff; display:block;">Westlands</span>
                    <address><span style="position:relative; line-height:17px; font-size:15px; display:block; top:5px;"><a href="mailto:business@mybets.co.ke" style="color:#1cff04;">business@mybets.co.ke</a></span>
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
            	<span style="color:#ffff00; display:block; font-size:12px;">For enquiries kindly email us at:</span><span style="color:#1bff03; display:block; font-size:12px; line-height:13px;">info@mybets.co.ke</span><span style="color:#fff; font-size:12px;"> or</span> <span style="color:#1bff03; font-size:12px;">support@mybets.co.ke</span>
            </div>
            <div id="foot_right">
            	<ul id="foot_nav">
                	<li><a href="#">Home</a></li>
                    <li><a href="#">Games</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Privacy policy</a></li>
                    <li><a href="#">Terms&amp;Conditions</a></li>
                    <li><a href="#">Services</a></li>
                    <li style="border:none;"><a href="#">Contacts</a></li>
                </ul>
                <span style="color:#15ff03; font-size:12px; display:block; position:absolute; bottom:3px; right:3px;">&copy;2014 mybets inc. All rights reserved.</span>
            </div>
        </div>
    </div>
</body>
</html>