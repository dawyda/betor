<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/betor/assets/css/home.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/betor/assets/css/menu_bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/betor/assets/css/table.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/betor/assets/css/bottom_footer.css" type="text/css" media="screen" />
<link REL="SHORTCUT ICON" HREF="/betor/assets/img/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="/betor/assets/img/icon.ico" type="image/x-icon">
<link rel="stylesheet" href="/betor/assets/css/login.css" type="text/css" media="screen" />
<title>Login Page | Mybets.co.ke | Kenya's number one online betting site</title>
</head>
<body>
 <div id="cont" style="min-height:570px;">
    	<div id="top-head">
        	<div id="top-nav">
            	<ul>
                	<li><a href="leagues.php">Leagues</a></li>
                    <li><a href="fixtures.php">Fixtures</a></li>
                    <li><a href="#">Bet results</a></li>
                    <li><a href="#">Top earner</a></li>
                    <li><a href="#">How to bet</a></li>
                    <li><a href="#" style="border:none; color:#f7ef00;">594022</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div id="main-nav">
            	<ul>
                	<li><a href="home">Home</a></li>
                    <li><a href="premium">Premium Tips</a></li>
                    <li><a href="about">About Us</a></li>
                    <li><a href="terms">Terms</a></li>
                    <li><a href="contacts">Contacts</a></li>
                </ul>
            </div>
        </div>
        <div id="login_area">
            <div id="form_cont">
             <?php if(isset($_GET['error'])){?><div id="error"><b style="font-family:Arial, Helvetica, sans-serif !important;">Please re-enter</b><br />The <?php 
			// if($_GET['error'] == '2'){
				// echo "username";
			// }
			// else{
				// echo "password";
			// }
			?> you provided is wrong (Make sure capslock is off).</div><?php } ?>
            Login here. <a href="pswdreset.php">Forgot password?</a>
            <form action="login_user.php" method="post">
            <div><label for="email">Email address/ username:</label><input type="text" class="txt" required="required" name="email" id="email" /></div>
            <div><label for="password">Password:</label><input type="password" class="txt" required="required" name="password" id="password" /></div>
            <input type="submit" value="LOGIN" name="submit" id="submit" />
            </form>
            </div>
        </div>
        <div style="height:87px;">
        <!-- sometthing will be placed here-->
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