<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/betor/assets/css/menu_bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/betor/assets/css/common.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/betor/assets/css/bottom_footer.css" type="text/css" media="screen" />
<style>
    label{
        font-size:16px;
        position:relative;
        margin:5px;
        font-weight:bold;
        font-family:Arial, Helvetica, sans-serif;
        color:grey;
    }
    input[type="text"],input[type="email"] {
        position:relative;
        display:block;
        margin:5px;
        border-radius:3px;
        height:25px;
        padding-left:5px;
        width:200px;
        border:1px solid #B0B0B0;
    }
    textarea{
        position:relative;
        display:block;
        margin:5px;
        border-radius:3px;
        height:180px;
        padding-left:5px;
        width:350px;
        border:1px solid #B0B0B0;
    }
    input[type="submit"]{
        position:relative;
        color:#5E5E5E;
        margin:5px;
        border-radius:15px;
        border:1px solid #B0B0B0;
        width:75px; height:25px;
        font-size:16px;
    }
</style>
<link REL="SHORTCUT ICON" HREF="/betor/assets/img/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="/betor/assets/img/icon.ico" type="image/x-icon">
<title>Contact Us Page - Mybets.co.ke - Kenyan Online Betting Site</title>
</head>
<body>
 <div id="cont" style="min-height:100%;">
    	<div id="top-head">
        	<div id="top-nav">
            	<ul>
                	<li><a href="games.php">Leagues</a></li>
                    <li><a href="games.php">Fixtures</a></li>
                    <li><a href="#" style="border:none; color:#f7ef00;">594022</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div id="main-nav">
            	<ul>
                	<li><a href="/betor/home">Tips</a></li>
                    <li><a href="games.php">Value bets</a></li>
					<li><a href="games.php">Premium</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="/betor/terms">Terms&amp;Conditions</a></li>
                </ul>
            </div>
        </div>
        <div style="background-color:#FFF; padding:10px 0px 10px 20px;">
            <h3 style="font-family:Arial, Helvetica, sans-serif; font-size:20px; margin:0px 0px 10px 5px; position:relative;">Speak to Us</h3>
            <span style="position:relative; color:#5E5E5E; margin:5px; display:block;">Hi, there contact us here for any enquiries and suggestions</span>
            <div style="color:blue; margin:5px;"><?php if(isset($display_msg)) echo $display_msg; ?></div>
            <form action="" method="post">
                <label for="names">Name:</label><input type="text" name="names" id="names" required="required" placeholder="Your Name"/>
                <label for="email">Email:</label><input type="email" name="email" id="email" required="required" placeholder="Your Email Address"/>
                <label for="subject">Subject:</label><input type="text" name="subject" id="subject" required="required" placeholder="Subject of your feedback"/>
                <label for="content">Feedback:</label><textarea required="required" id="content" name="content" placeholder="Your Name"></textarea>
                <input type="submit" value="Submit" name="submit" />
            </form>
        </div>
        <div id="sub_footer">
            <div class="sub_tabs" style="padding-left:20px;">
                <span class="sub_titles">Contact Us</span>
                <div>
                	<span style="font-weight:bold; font-size:16px; color:#42f4ff; display:block;">Nairobi</span>
                    <span style="font-size:15px; line-height:16px; color:#42f4ff; display:block;">Gansta drive, All buildings</span>
                    <span style="font-size:15px; line-height:16px; color:#42f4ff; display:block;">1<sup>st</sup> Floor, Hall 6</span>
                    <span style="font-size:15px; line-height:16px; color:#42f4ff; display:block;">P.O Box 0988-98765</span>
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