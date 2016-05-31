<?php
$logged = false;
$user = '';
if(isset($_SESSION["logged"])){
	$logged = $_SESSION["logged"];
	$user = $_SESSION["username"];
}
?>
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
<script type="text/javascript" src="/betor/assets/js/home.js"></script>
<noscript>Please enable Javascript to enjoy your viewing</noscript>
<title>Welcome to MyBets</title>
</head>
<body onload="startTime()">
    <div id="cont">
    	<div id="top-head">
        	<div id="top-nav">
            	<ul>
                	<li><a href="<?=base_url();?>howto">How it works</a></li>
                    <!--<li><a href="fixture.php">Fixtures</a></li>-->
                    <li><a href="<?=base_url();?>services">Services</a></li>
                    <li><a href="#" style="border:none; color:#f7ef00; width:auto;">M-Pesa to 0712594022</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div id="main-nav">
            	<ul>
                	<li><a href="#">Predictions</a></li>
                    <li><a href="games.php">Today's Value Bets</a></li>
                    <?php
					if($logged){
                    ?>
                    <li><a href="mybets.php">My bets</a></li>
                    <li><a href="<?=base_url();?>home/profile/">My Profile</a></li>
                    <li><a href="<?=base_url();?>premium/">Premium</a></li>
                    <?php
					}else{
                    ?>
                    <li><a href="<?=base_url();?>bethelp/">Bet Advice</a></li>
                    <li><a href="<?=base_url();?>about/">About</a></li>
                     <?php
					}
                    ?>
                    <li><a href="<?=base_url();?>contacts">Contact Us</a></li>
                </ul>
            </div>
            <?php
			if(!$logged){			
			?>
            <div id="login"><span id="ndevo"></span>
				<?php echo form_open("login/auth/"); ?>
            	<!--<form id="login_form" method="post" action="login">-->
                	<div style="float:left;">
                	<label for="email" style="color:#f7ef00; font-size:13px; display:block;">Username:</label>
                	<input type="text" id="email" name="username" class="txt" required="required" placeholder="username" /></div>
                    <div style="float:left; padding-left:5px; padding-right:3px;">
                    <label for="password" style="color:#f7ef00; font-size:13px; display:block;">Password:</label>
                    <input type="password" id="password" name="password" class="txt" required="required" placeholder="********" /></div>
                    <input type="submit" name="submit" id="submit" value="Go" />
                <?php echo form_close(); ?>
                <span id="login_error" style="color:#F00; display:block; width:auto; font-size:13px; visibility:visible;"><!--Wrong logins! Try again or <?php //echo anchor('login/pswdreset','&nbsp;Reset Password?','style="text-decoration:none; color:#42f4ff;"');?>--><?php
				if(isset($disp_msg)) echo $disp_msg;
				?></span>
            </div>
            <?php 
			}else{
			?>
            <a id="logout" href="<?=base_url();?>logout">logout [<?php echo $user; ?>]</a>
            <div id="login">
            	<form id="login_form" method="post" action="login_user.php">
                	<div style="float:left; top:30px; position:relative;">
                	<label for="email" style="color:#f7ef00; font-size:14px; display:block;"><?php //echo 'Your account bal. <span style="color:white;">'.number_format($_SESSION['balance'], 2).'</span>'; ?></label>
                    </div>
                </form>
            </div>
            <?php }?>
        </div>
        <?php if(!$logged){ ?>
        <div id="banner">
        	<div id="reg_cont">
            	<a href="/betor/signup/">Register Now</a>
            </div>
        </div>
        <?php }else{?>
        <div id="logged_banner">
        	
        </div>
        <?php } ?>
        <div id="strip">
        	<span style="float:right;">*as per odds on sportpesa and betin</span>
        </div>
        <!--bet table here -->
        <div id="bet_table">
        	<div id="table_cont">
            	<div class="header">
                	<div id="time_holder">
                    Time: 18:01:08<br />09-03-2014
                    </div>
                    <div id="open_note">
                    Today's Matches to bet on:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Average Odds:
                    </div>
                </div>
                <div class="header">
                	<ul style="padding:0; list-style-type:none;">
                    	<li style="width:110px;">Day &amp;Time</li>
                        <li style="width:260px;">Game</li>
                        <li style="width:80px;">Tip</li>
                        <li style="width:80px;">Weight</li>
                        <li style="width:70px;">1</li>
                        <li style="width:70px;">X</li>
                        <li style="width:70px;">2</li>
						<li style="width:100px;">FT Result</li>
						<li style="width:30px;">@</li>
                        <!--<li style="width:150px;">League</li>
                        <li style="width:110px; border:none;" >Game Type</li>-->
                    </ul>
                </div>
                <div id="match_list_cont">
            <!-- Place matches within here -->
                <!--use div within lists-->
                    <div class="listdiv" style="color:#000;">
                    	<ul class="match_list_ul">
                        	<li style="width:110px; padding-top:10px;">09-03 09:00 PM</li>
                            <li style="width:260px; text-decoration:underline;" class="padli"><a href="#" id="3"><span style="font-family: Verdana, Arial, Helvetica, sans-serif;">Tottenham - Man United</span></a></li>
							<li style="width:80px;" class="padli"><a href="#" id="3" style="font-weight:bold; font-size:9.5pt; color:#F7950C;">12</a></li>
							<li style="width:80px;" class="padli"><a href="#" id="3">10</a></li>
                            <li style="width:70px;" class="padli"><a href="#">2.66</a></li>
                            <li style="width:70px;" class="padli"><a href="#">3.04</a></li>
                            <li style="width:70px;" class="padli"><a href="#">7.86</a></li>
							<li style="width:100px;" class="padli"><a href="#" id="3">2 : 1</a></li>
							<li style="width:30px;" class="padli"><a href="#" id="3"><div class="win"></div></a></li>
                        </ul>
                    </div>
					<div class="listdiv" style="color:#000;background-color:#F2F2F2;">
                    	<ul class="match_list_ul">
                        	<li style="width:110px; padding-top:10px;">09-03 09:00 PM</li>
                            <li style="width:260px; text-decoration:underline;" class="padli"><a href="#" id="3"><span style="font-family: Verdana, Arial, Helvetica, sans-serif;">Man City - Man United</span></a></li>
							<li style="width:80px;" class="padli"><a href="#" id="3" style="font-weight:bold; font-size:9.5pt; color:#F7950C;">X</a></li>
							<li style="width:80px;" class="padli"><a href="#" id="3">10</a></li>
                            <li style="width:70px;" class="padli"><a href="#">2.22</a></li>
                            <li style="width:70px;" class="padli"><a href="#">3.56</a></li>
                            <li style="width:70px;" class="padli"><a href="#">2.47</a></li>
							<li style="width:100px;" class="padli"><a href="#" id="3">0 : 0</a></li>
							<li style="width:30px;" class="padli"><a href="#" id="3"><div class="win"></div></a></li>
                        </ul>
                    </div>
					<div class="listdiv" style="color:#000;">
                    	<ul class="match_list_ul">
                        	<li style="width:110px; padding-top:10px;">09-03 09:00 PM</li>
                            <li style="width:260px; text-decoration:underline;" class="padli"><a href="#" id="3"><span style="font-family: Verdana, Arial, Helvetica, sans-serif;">Man City - Man United</span></a></li>
							<li style="width:80px;" class="padli"><a href="#" id="3" style="font-weight:bold; font-size:9.5pt; color:#F7950C;">1X</a></li>
							<li style="width:80px;" class="padli"><a href="#" id="3">10</a></li>
                            <li style="width:70px;" class="padli"><a href="#">2.66</a></li>
                            <li style="width:70px;" class="padli"><a href="#">3.04</a></li>
                            <li style="width:70px;" class="padli"><a href="#">7.86</a></li>
							<li style="width:100px;" class="padli"><a href="#" id="3">0 : 3</a></li>
							<li style="width:30px;" class="padli"><a href="#" id="3"><div class="lose"></div></a></li>
                        </ul>
                    </div>
					<div class="listdiv" style="color:#000;background-color:#F2F2F2;">
                    	<ul class="match_list_ul">
                        	<li style="width:110px; padding-top:10px;">09-03 09:00 PM</li>
                            <li style="width:260px; text-decoration:underline;" class="padli"><a href="#" id="3"><span style="font-family: Verdana, Arial, Helvetica, sans-serif;">Man City - Man United</span></a></li>
							<li style="width:80px;" class="padli"><a href="#" id="3" style="font-weight:bold; font-size:9.5pt; color:#F7950C;">1X</a></li>
							<li style="width:80px;" class="padli"><a href="#" id="3">10</a></li>
                            <li style="width:70px;" class="padli"><a href="#">2.22</a></li>
                            <li style="width:70px;" class="padli"><a href="#">3.56</a></li>
                            <li style="width:70px;" class="padli"><a href="#">2.47</a></li>
							<li style="width:100px;" class="padli"><a href="#" id="3">2 : 1</a></li>
							<li style="width:30px;" class="padli"><a href="#" id="3"><div class="win"></div></a></li>
                        </ul>
                    </div>
                    <!--match list full end -->
                    <!-- Place matches within here -->
                </div>
            </div>
        </div><!--end table-->
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
<script type="text/javascript" src="/betor/assets/js/bet.js"></script>
</html>