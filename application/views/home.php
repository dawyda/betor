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
<link rel="stylesheet" href="<?=base_url();?>assets/css/home.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/menu_bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/table.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/bottom_footer.css" type="text/css" media="screen" />
<link REL="SHORTCUT ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<script type="text/javascript" src="<?=base_url();?>assets/js/home.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
<script>
    var _html;
$(document).ready(function(){
$('#match_list_cont').load("tips/free");
});
function removeWarning()
{
    $('#warning').remove();
}
function showYester(event)
{
    event.preventDefault();
    _html = $('#match_list_cont').html();
    $('#match_list_cont').load("tips/yesterday");
    $('#day_tip').replaceWith('<a href="#" id="day_tip" onclick="showToday(event);" style="color:white; text-decoration:underline; font-size:14px;">Today\'s Tips</a>');
}
function showToday(event)
{
    event.preventDefault();
    html = $('#match_list_cont').html(_html);
    $('#day_tip').replaceWith('<a href="#" id="day_tip" onclick="showYester(event);" style="color:white; text-decoration:underline; font-size:14px;">Yesterday\'s Tips</a>');
}
</script>
<noscript>Please enable Javascript to enjoy your viewing</noscript>
<title>Home Page | Welcome to Betips.co.ke</title>
</head>
<body onload="startTime()">
    <div id="warning">
    <div style="z-index:10;position:absolute; background:none; width:100%;height:100%;">
    <div style="background:white;position:relative;width:800px; height:100%;padding:10px;margin:0 auto;opacity:0.85;display:table;">
            <h4 style="text-decoration:underline; display:block; margin:5px;">Must Read Before Joining Betips.co.ke</h4>
Ok. Before joining we would like you and us to be clear on a few things. This is a site offering free and premium tips. Premium tips are offered on games with odds greater than 1.90 on both the home and away teams. 
We recently received a text from a user claiming they lost money on a bet we had tipped on. The thing is that we give tips of double chance (1X) where the odds range from 1.15 to 1.30. The user saw these odds translating to little profit and went ahead to do multis of the tips – one game messed the multis. Though we don’t discourage multis, keep them to a max. of 2-3 games.<br /><br />
We come up with predictions by checking many things and when we give a tip as a DC, trust as to have seen the game as risky. Nobody can give a tip with 100% surety unless it is a fixed match – of which we shall give tips on such. If you wish a 100% tip you can go and consult a witch-doctor – we have no such powers. This should not scare you as in long run we will guarantee you profit otherwise we would not have this website. We have had days where we had losing streaks taking me back by KES 20-30k. But we also end up recovering that money in a weekend with profit over. If you sign up wishing to be a millionaire in less than two months, we advise that you chase the government tenders preserved for the youth – there you can inflate prices and smile when cashing your cheque for quick cash.
<br /><br /><b>My point is regardless of the odds what matters is the success rate of the bet.</b><br /> <br />An odd of 1.4 is 40% percent profit. 
This is our pricing strategy. A premium tip is equivalent to KES 500. When you redeem a tip and it fails you will be reimbursed with 2 tips over e.g. Say you had 6 tips balance. If we tip on Chelsea v Man City with a home win and the game ends otherwise, your new tip balance will be 7. We guarantee you that before your monthly tips run out and you follow our staking advice you will have achieved good profit.
We won’t use gimmicks like giving tips on the current week’s jackpots with local bookies. If we could do such then trust me that we would have won those JPs several times and you would all know it. Some games in the jackpots will have tips which we shall give but don’t expect us to tip you on the jackpot as a whole.<br />
Now that we assume you have read this page, you can go ahead and continue using the site by clicking the continue button below.
<input type="button" value="Continue >>" style="postion:relative; margin:25px 5px 0px 0px; display:block;float:right;" onclick="removeWarning();" />
        </div>
        </div>
    <div style="position:absolute;opacity: 0.70;width:100%;height:100%; background:grey; z-index:5;">
    </div>
    </div>
    <div id="cont">
    	<div id="top-head">
        	<div id="top-nav">
            	<ul>
                	<li><a href="<?=base_url();?>howto">How it works</a></li>
                    <!--<li><a href="fixture.php">Fixtures</a></li>-->
                    <li><a href="<?=base_url();?>about/services">Services</a></li>
                    <li><a href="#" style="border:none; color:#f7ef00; width:auto;">M-Pesa to 0712594022</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div id="main-nav">
            	<ul>
                	<li><a href="#">Free Tips</a></li>
                    <li><a href="<?=base_url();?>tips/valuebets/">Value Bet Tips</a></li>
                    <?php
					if($logged){
                    ?>
                    <li><a href="<?=base_url();?>tips/premium/">Premium Tips</a></li>
                    <li><a href="<?=base_url();?>home/profile/">My Profile</a></li>
                    <li><a href="<?=base_url();?>transactions/buy">Buy Credits</a></li>
                    <?php
					}else{
                    ?>
                    <li><a href="<?=base_url();?>bethelp/">Bet Advice</a></li>
                    <li><a href="<?=base_url();?>about/">About</a></li>
                     <?php
					}
                    ?>
                    <li><a href="<?=base_url();?>contacts">Contact Us</a></li>
                    <?php if(!$logged) echo '<li><a href="'.base_url().'signup/">Join Now!</a></li>';?>
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
                    Today's Matches to bet on:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Average Odds:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" id="day_tip" onclick="showYester(event);" style="color:white; text-decoration:underline; font-size:14px;">Yesterday's Tips</a>
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
						<li style="width:60px;">outcome</li>
                        <!--<li style="width:150px;">League</li>
                        <li style="width:110px; border:none;" >Game Type</li>-->
                    </ul>
                </div>
                <div id="match_list_cont">
            <!-- Place matches within here -->
                <!--use div within lists--><!--
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
                    </div>-->
                    <!--match list full end -->
					<!--loaded with Ajax-->
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
                    <li><a href="<?=base_url();?>about">About Us</a></li>
                    <li><a href="privacy.php">Privacy policy</a></li>
                    <li><a href="<?=base_url();?>terms">Terms&amp;Conditions</a></li>
                    <li><a href="<?=base_url();?>about/services">Services</a></li>
                    <li style="border:none;"><a href="#">Contacts</a></li>
                </ul>
                <span style="color:#15ff03; font-size:12px; display:block; position:absolute; bottom:3px; right:3px;">&copy;2014 mybets inc. All rights reserved.</span>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="/betor/assets/js/bet.js"></script>
</html>