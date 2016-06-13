<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/menu_bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/common.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/bottom_footer.css" type="text/css" media="screen" />
<link REL="SHORTCUT ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<title>Admin Login | Betips</title>
</head>
<body>
 <div id="cont">
    	<div id="top-head">
            <div class="clear"></div>
            <span style="color:white;">This is an admin only login area. Attempts to hack this site are prone to prosecution if attacker's identity is discovered.</span>
            <div id="main-nav">
            	<ul>
                	<li><a href="<?=base_url();?>home">Home</a></li>
                    <li><a href="<?=base_url();?>tips/free">Tips</a></li>
                </ul>
            </div>
        </div>
        <div style="width:960px; height:300px; background:#FFF; position:relative;">
        	<div id="resp"><?php if(isset($login_errors)) echo $login_errors;?></div>
        	<?=form_open("admin/login",'style="display:block; position:relative; width:400px; margin:0 auto; padding-top:10px;"');?>
            	<label for="username">Email/Username:</label><input type="text" name="username" id="username" required="required" placeholder="username or phone" /><br /><br />
                <label for="password">Password:</label><input type="password" name="password" id="password" required="required" /><br /><br />
                <?=$image;?><br/><br/>
				<label for="captcha">Enter captcha:</label><input type="text" name="captcha" id="captcha" required="required" placeholder="enter displayed text" /><br /><br />
				<input type="submit" name="submit" value="Login" />
            </form>
        </div>
        <div id="footer">
        	<div id="foot_left">
            	<span style="color:#ffff00; display:block; font-size:12px;">For enquiries kindly email us at:</span><span style="color:#1bff03; display:block; font-size:12px; line-height:13px;">info@mybets.co.ke</span><span style="color:#fff; font-size:12px;"> or</span> <span style="color:#1bff03; font-size:12px;">support@mybets.co.ke</span>
            </div>
            <div id="foot_right">
            	<ul id="foot_nav">
                	<li><a href="../home.php">Home</a></li>
                    <li><a href="../games.php">Games</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Privacy policy</a></li>
                    <li><a href="../terms.html">Terms&amp;Conditions</a></li>
                    <li><a href="#">Services</a></li>
                    <li style="border:none;"><a href="#">Contacts</a></li>
                </ul>
                <span style="color:#15ff03; font-size:12px; display:block; position:absolute; bottom:3px; right:3px;">&copy;2014 mybets inc. All rights reserved.</span>
            </div>
        </div>
    </div>
</body>
</html>