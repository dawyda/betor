 <!--/* <?php/*
// session_start();
// include("libs/simple-php-captcha.php");
// $_SESSION['captcha'] = simple_php_captcha(array(
	// 'min_length' => 5,
	// 'max_length' => 6,
	// 'characters' => 'ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789',
	// 'min_font_size' => 28,
	// 'max_font_size' => 29,
	// 'color' => '#666',
	// 'angle_min' => 0,
	// 'angle_max' => 10,
	// 'shadow' => true,
	// 'shadow_color' => '#fff',
	// 'shadow_offset_x' => -2,
	// 'shadow_offset_y' => 1
// ));
// */?> -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/betor/assets/css/menu_bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/betor/assets/css/common.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/betor/assets/css/bottom_footer.css" type="text/css" media="screen" />
<link REL="SHORTCUT ICON" HREF="/betor/assets/img/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="/betor/assets/img/icon.ico" type="image/x-icon">
<link rel="stylesheet" href="/betor/assets/css/signup.css" type="text/css" media="screen" />
<script type="text/javascript" src="/betor/assets/js/signup.js"></script>
<style type="text/css">
a.terms{
	text-decoration:none;
}
a.terms:hover{
	text-decoration:underline;
}
</style>
<title>Sign Up Page | Kenya's number one online betting site</title>
</head>
<body>
 <div id="cont">
    	<div id="top-head">
        	<div id="top-nav">
            	<ul>
                	<li><a href="leagues.php">Tip results</a></li>
                    <li><a href="fixtures.php">Value bets</a></li>
                    <li><a href="betresults.php">Premium membership</a></li>
                    <li><a href="#">Top earner</a></li>
                    <li><a href="howto.html">Blog</a></li>
                    <li><a href="#" style="border:none; color:#f7ef00;">594022</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div id="main-nav">
            	<ul>
                	<li><a href="/betor/home/">Home</a></li>
                    <li><a href="/betor/todays/">Today's Tips</a></li>
                    <li><a href="/betor/about">About</a></li>
                    <li><a href="/betor/terms">Terms</a></li>
                    <li><a href="/betor/contacts">Contacts</a></li>
                </ul>
            </div>
        </div>
        <div id="main_cont">
        	<div id="form_left_side">
            	<span style="padding-left:10px;font-family:Arial, Helvetica, sans-serif; font-size:11.5pt;">Already registered? <a class="terms" href="../login">Login</a></span><br />
                <div id="black_head">
                	<span style="display:block; position:relative; top:5px; padding:0; margin-bottom:3px; color:#ff0; font-weight:800; font-size:12.5pt;">USER REGISTRATION FORM</span><span style="position:relative;color:#42f4ff; font-style:italic; font-size:10pt;">All form fields are mandatory</span>
                </div>
                <div class="clear"></div>
                <form id="reg_form" method="post" action="register.php" onsubmit="return verify();">
                    <span class="det_lbl">6-10 characters</span>
                    <label for="username">User Name:</label><input class="txt" type="text" name="username" id="username" required="required" />
                    <span class="det_lbl">Min of 6 & max of 14 characters</span>
                    <label for="password">Password:</label><input class="txt" type="password" name="password" id="password" required="required" />
                    <label for="pass2">Retype password:</label><input class="txt" type="password" name="pass2" id="pass2" required="required" />
                    <span class="det_lbl">Used for account confirmation (optional)</span>
                    <label for="email">Email(optional):</label><input class="txt" type="email" name="email" id="email" value="" />
                    <span class="det_lbl">Used for account transactions (Mandatory)</span>
                    <label for="mobile">Mobile Number:</label><input class="txt" type="text" name="mobile" id="mobile" title="+254-xxx-xxx" required="required" />
                    <label for="captcha">Enter the text:</label><img src="<?php //echo $_SESSION['captcha']['image_src'] ?>" id="cap_img" />
                    <label style="color:#f8f8f8">this is just needed:</label><input style="width:150px;" class="txt" name="captcha" id="captcha" required="required" />
                    <div id="term_sc">
                    	<span style="display:block; position:relative; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#507aff;">Terms &amp; Conditions</span>
                       <span style="color:#686868; font-size:11.8pt; font-family:Arial, Helvetica, sans-serif;">I have read, understood and agreed to the <a class="terms" style="color:#fe1f02;" href="terms.html" target="_blank">terms of service.</a> I'm ready to have my account created.</span>
                       <div style="clear:both;"></div><input type="submit" name="submit" id="submit" value="CREATE MY ACCOUNT" /><div style="clear:both;"></div>
                    </div>
                </form>
            </div><div style="clear:both;"></div>
            <div id="form_right_side">
            <p>If by any event we find that you have violated our <a class="terms" href="terms.html" target="_blank" style="color:#blue;">terms and conditions of service</a>, your account will be suspended for investigations for a period not exceeding 10 days upon which a verdict to either close or resume the account will be made.</p><br /><p>Inorder to register you must be a resident within East Africa and have valid citizenship. Eligible age for registration is <b>19 years</b>.</p><br /><p>You must also be human.</p><br /><p>All your information shall be kept private and will only be shared by your consent.</p><br /><p>Only accept messages from us that are from the number <b>0712*****2</b>.</p><br /><p>For your account to be fully functional you will be required to confirm it by both email and SMS to verify your identity. This can be done later but you will not be able to place a bet without it.</p>
            </div>
        </div>
        <div id="footer">
        	<div id="foot_left">
            	<span style="color:#ffff00; display:block; font-size:12px;">For enquiries kindly email us at:</span><span style="color:#1bff03; display:block; font-size:12px; line-height:13px;">info@mybets.co.ke</span><span style="color:#fff; font-size:12px;"> or</span> <span style="color:#1bff03; font-size:12px;">support@mybets.co.ke</span>
            </div>
            <div id="foot_right">
            	<ul id="foot_nav">
                	<li><a href="home.php">Home</a></li>
                    <li><a href="games.php">Games</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="privacy.php">Privacy policy</a></li>
                    <li><a href="terms.html">Terms&amp;Conditions</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li style="border:none;"><a href="#">Contacts</a></li>
                </ul>
                <span style="color:#15ff03; font-size:12px; display:block; position:absolute; bottom:3px; right:3px;">&copy;2014 mybets inc. All rights reserved.</span>
            </div>
        </div>
    </div>
</body>
</html>